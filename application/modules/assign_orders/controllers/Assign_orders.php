<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assign_orders extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Assign_order_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'assign_orders/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'assign_orders/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'assign_orders/index.html';
            $config['first_url'] = base_url() . 'assign_orders/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Assign_order_model->total_rows($q);
        $assign = $this->Assign_order_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'assign_data' => $assign,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('assign_orders/assign_orders_list', $data);
        $this->load->view('../../footer');   
    }
    

    public function read($id) 
    {
        $row = $this->Assign_order_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'order_id' => $row->order_id,
        		'employes_id' => $row->employes_id,
        		'delivary_date' => $row->delivary_date,
        		'date_time' => $row->date_time,
    	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('assign_orders/assign_orders_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('assign_orders'));
        }
    }

    public function create() 
    {
        $data['order'] = $this->db->get('orders')->result();
        $data['employe'] = $this->db->get('employes')->result();
        $data['pro_type'] = $this->db->get('product_type')->result();

        $data['action'] = site_url('assign_orders/create_action');

        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('assign_orders/assign_orders_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        
        $data = array(
    		'employes_id' => $this->input->post('employes_id',TRUE),
    		'order_id' => $this->input->post('order_id',TRUE),
            'pro_id' => $this->input->post('pro_id',TRUE),
    		'delivary_date' => $this->input->post('delivary_date',TRUE),
    	);

        $this->Assign_order_model->insert($data);            
        $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message"><b>Create Record Success</b></div>');
        redirect(site_url('assign_orders'));
        
    }
    
    public function update($id) 
    {
        $row = $this->Assign_order_model->get_by_id($id);
        

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('assign_orders/update_action'),
		'order_id' => set_value('order_id', $row->order_id),
		'employes_id' => set_value('employes_id', $row->employes_id),
		'delivary_date' => set_value('delivary_date', $row->delivary_date),
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('assign_orders/assign_orders_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('assign_orders'));
        }
    }
    
 //    public function update_action() 
 //    {
 //        $this->_rules();

 //        if ($this->form_validation->run() == FALSE) {
 //            $this->update($this->input->post('order_id', TRUE));
 //        } else {
 //            $data = array(
	// 	'customer_id' => $this->input->post('customer_id',TRUE),
	// 	'price' => $this->input->post('price',TRUE),
	// 	'advance' => $this->input->post('advance',TRUE),
	// 	'delivary_date' => $this->input->post('delivary_date',TRUE),
	// 	'date_time' => $this->input->post('date_time',TRUE),
	//     );

 //            $this->Assign_order_model->update($this->input->post('order_id', TRUE), $data);
 //            $this->session->set_flashdata('message', 'Update Record Success');
 //            redirect(site_url('orders'));
 //        }
 //    }
    
    public function delete($id) 
    {
        $row = $this->Assign_order_model->get_by_id($id);

        if ($row) {
            $this->Assign_order_model->delete($id);
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message"><b>Delete Record Success</b></div>');
            redirect(site_url('assign_orders'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('assign_orders'));
        }
    }

    public function _rules() 
    {
    	// $this->form_validation->set_rules('price', 'price', 'trim|required');
    	// $this->form_validation->set_rules('advance', 'advance', 'trim|required');
    	// $this->form_validation->set_rules('delivary_date', 'delivary date', 'trim|required');

    	// $this->form_validation->set_rules('order_id', 'order_id', 'trim');
    	// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "orders.xls";
        $judul = "orders";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Customer Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Price");
	xlsWriteLabel($tablehead, $kolomhead++, "Advance");
	xlsWriteLabel($tablehead, $kolomhead++, "Delivary Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Time");

	foreach ($this->Orders_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->customer_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->price);
	    xlsWriteNumber($tablebody, $kolombody++, $data->advance);
	    xlsWriteLabel($tablebody, $kolombody++, $data->delivary_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_time);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=orders.doc");

        $data = array(
            'orders_data' => $this->Orders_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('orders/orders_doc',$data);
    }
    
    
    
    public function order_invoice($id)
    {
        $row = $this->Orders_model->get_order_details($id);
        var_dump($row);
        if ($row) {
            $data = array(
		'order_id' => $row->order_id,
		'customer_id' => $row->customer_id,
		'price' => $row->price,
		'advance' => $row->advance,
		'delivary_date' => $row->delivary_date,
		'date_time' => $row->date_time,
	    );
//            $this->load->view('../../header');
//            $this->load->view('../../sidebar');
            $this->load->view('orders/orders_invoice', $data);
//            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders'));
        } 
    }
    
    
}

/* End of file Orders.php */
/* Location: ./application/controllers/Orders.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-04 11:54:07 */
/* http://harviacode.com */