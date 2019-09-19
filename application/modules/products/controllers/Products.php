<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Products_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'products/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'products/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'products/index.html';
            $config['first_url'] = base_url() . 'products/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Products_model->total_rows($q);
        $products = $this->Products_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'products_data' => $products,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('products/products_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->Products_model->get_by_id($id);
        if ($row) {
            $data = array(
		'pro_id' => $row->pro_id,
		'name' => $row->name,
		'price' => $row->price,
		'quantity' => $row->quantity,
		'date_time' => $row->date_time,
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('products/products_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('products/create_action'),
	    'pro_id' => set_value('pro_id'),
	    'name' => set_value('name'),
	    'price' => set_value('price'),
	    'quantity' => set_value('quantity'),
	    'date_time' => set_value('date_time'),
	);
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('products/products_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'price' => $this->input->post('price',TRUE),
		'quantity' => $this->input->post('quantity',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Products_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('products'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Products_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('products/update_action'),
		'pro_id' => set_value('pro_id', $row->pro_id),
		'name' => set_value('name', $row->name),
		'price' => set_value('price', $row->price),
		'quantity' => set_value('quantity', $row->quantity),
		'date_time' => set_value('date_time', $row->date_time),
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('products/products_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pro_id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'price' => $this->input->post('price',TRUE),
		'quantity' => $this->input->post('quantity',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Products_model->update($this->input->post('pro_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('products'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Products_model->get_by_id($id);

        if ($row) {
            $this->Products_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('products'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('products'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('price', 'price', 'trim|required');
	$this->form_validation->set_rules('quantity', 'quantity', 'trim|required');
	$this->form_validation->set_rules('date_time', 'date time', 'trim|required');

	$this->form_validation->set_rules('pro_id', 'pro_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "products.xls";
        $judul = "products";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Price");
	xlsWriteLabel($tablehead, $kolomhead++, "Quantity");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Time");

	foreach ($this->Products_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteNumber($tablebody, $kolombody++, $data->price);
	    xlsWriteNumber($tablebody, $kolombody++, $data->quantity);
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
        header("Content-Disposition: attachment;Filename=products.doc");

        $data = array(
            'products_data' => $this->Products_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('products/products_doc',$data);
    }

}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-28 09:20:28 */
/* http://harviacode.com */