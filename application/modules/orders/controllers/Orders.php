<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->helper('customers/mesurement_fields');
        $this->load->model('Orders_model');
        //$this->load->model('Customers_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'orders/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'orders/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'orders/index.html';
            $config['first_url'] = base_url() . 'orders/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Orders_model->total_rows($q);
        $orders = $this->Orders_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'orders_data' => $orders,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('orders/orders_list', $data);
        $this->load->view('../../footer');   
    }
    

    public function read($id) 
    {
        $row = $this->Orders_model->get_by_id($id);
        if ($row) {
            $data = array(
		'order_id' => $row->order_id,
		'customer_id' => $row->customer_id,
		'price' => $row->price,
		'advance' => $row->advance,
		'delivary_date' => $row->delivary_date,
		'date_time' => $row->date_time,
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('orders/orders_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders'));
        }
    }

    public function create() 
    {
        spl_autoload_register(function ($name) {
            $filename = APPPATH.'/modules/customers/libraries/'.$name.'.php';
            include_once($filename);
        });
        $directions = new directions_pant();
        $p_directions= $directions->direction_json();
        
        $table = modules::run('customers/gents_mesurements', $p_directions);
        // Load gents form first time into the add field......end.......
        
        $data = array(
            'button' => 'Create',
            'action' => site_url('orders/create_action'),
	    'order_id' => set_value('order_id'),
	    'customer_id' => set_value('customer_id'),
	    'price' => set_value('price'),
	    'advance' => set_value('advance'),
	    'delivary_date' => set_value('delivary_date'),
	    'date_time' => set_value('date_time'),
            'name' => set_value('name'),
	    'contact_number' => set_value('contact_number'),
	    'type' => set_value('type'),
	    'details' => set_value('details'),
	    'table' => $table,
            'readonly' => '',
	);
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('orders/orders_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        $this->_rules();
        
        // Mesurement array adding into database
        $details = modules::run('customers/mesurement_array_add'); //$this->Customers->mesurement_array_add();
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data_customer = array(
		'name' => $this->input->post('name',TRUE),
                'contact_number' => $this->input->post('contact_number',TRUE),
                'type' => $this->input->post('cus_type',TRUE),
                'details' => $details,
	    );
            $this->Customers_model->insert($data_customer);
            $customer_id = $this->db->insert_id(); //$this->input->post('customer_id',TRUE);
            
            
            $data_order = array(
		'customer_id' => $customer_id,
		'price' => $this->input->post('price',TRUE),
		'advance' => $this->input->post('advance',TRUE),
		'delivary_date' => $this->input->post('delivary_date',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );
            $this->Orders_model->insert($data_order);
            
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('orders/order_invoice/'.$customer_id));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Orders_model->get_by_id($id);
        
        $table = modules::run('customers/gents_mesurements', $p_directions);
        //$table = $this->Customers->gents_mesurements();
        

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('orders/update_action'),
		'order_id' => set_value('order_id', $row->order_id),
		'price' => set_value('price', $row->price),
		'advance' => set_value('advance', $row->advance),
		'delivary_date' => set_value('delivary_date', $row->delivary_date),
		'date_time' => set_value('date_time', $row->date_time),
                'name' => set_value('name'),
                'contact_number' => set_value('contact_number'),
                'type' => set_value('type'),
                'details' => set_value('details'),
                'table' => $table,
                'readonly' => '',
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('orders/orders_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('order_id', TRUE));
        } else {
            $data = array(
		'customer_id' => $this->input->post('customer_id',TRUE),
		'price' => $this->input->post('price',TRUE),
		'advance' => $this->input->post('advance',TRUE),
		'delivary_date' => $this->input->post('delivary_date',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Orders_model->update($this->input->post('order_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('orders'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Orders_model->get_by_id($id);

        if ($row) {
            $this->Orders_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('orders'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('orders'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('price', 'price', 'trim|required');
	$this->form_validation->set_rules('advance', 'advance', 'trim|required');
	$this->form_validation->set_rules('delivary_date', 'delivary date', 'trim|required');

	$this->form_validation->set_rules('order_id', 'order_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
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