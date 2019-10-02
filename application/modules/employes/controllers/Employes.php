<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employes extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->helper('mesurement_fields');
        $this->load->model('Employes_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'employes/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'employes/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'employes/index.html';
            $config['first_url'] = base_url() . 'employes/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Employes_model->total_rows($q);
        $employes = $this->Employes_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'employes_data' => $employes,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('employes/employes_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->Employes_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'employes_id' => $row->employes_id,
    		'name' => $row->name,
    		'contact_number' => $row->phone,
    		'type' => $row->type,
    		'details' => $row->details,
    	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('employes/employes_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('employes'));
        }
    }

    public function create() 
    {
        

        $data = array(
            'button' => 'Add',
            'action' => site_url('employes/create_action'),
    	    'employes_id' => set_value('employes_id'),
    	    'name' => set_value('name'),
    	    'phone' => set_value('phone'),
    	    'type' => set_value('type'),
    	    'details' => set_value('details'),
    	    
    	);
        
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('employes/employes_form', $data);
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
        		'phone' => $this->input->post('phone',TRUE),
        		'type' => $this->input->post('type',TRUE),
    	    );
            $this->Employes_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('employes'));
        }
    }
 
    
    public function update($id) 
    {
        $row = $this->Employes_model->get_by_id($id);
        // $table = $this->gents_mesurements($row->details);
        // Load gents form first time into the add field......end.......

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('employes/update_action'),
    		'employes_id' => set_value('employes_id', $row->employes_id),
    		'name' => set_value('name', $row->name),
    		'phone' => set_value('phone', $row->phone),
    		'type' => set_value('type', $row->type),
    		'details' => set_value('details', $row->details),
    	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('employes/employes_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('employes'));
        }
    }

    
    
    public function update_action() 
    {
        $this->_rules();
        
        $this->input->post('employes_id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('employes_id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'type' => $this->input->post('type',TRUE),
	    );

            $this->Employes_model->update($this->input->post('employes_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('employes'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Employes_model->get_by_id($id);

        if ($row) {
            $this->Employes_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('employes'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('employes'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone number', 'trim|required');
	//$this->form_validation->set_rules('cus_type', 'customer type', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "employes.xls";
        $judul = "employes";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Contact Number");
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Details");

	foreach ($this->Employes_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteNumber($tablebody, $kolombody++, $data->contact_number);
	    xlsWriteLabel($tablebody, $kolombody++, $data->type);
	    xlsWriteLabel($tablebody, $kolombody++, $data->details);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=customers.doc");

        $data = array(
            'employes_data' => $this->Employes_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('employes/employes_doc',$data);
    }
    
    
    
}

/* End of file Customers.php */
/* Location: ./application/controllers/Customers.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-04 11:54:11 */
/* http://harviacode.com */