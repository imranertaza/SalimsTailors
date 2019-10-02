<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Account_holder extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');;
        $this->load->model('Accounts_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'account_holder/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'account_holder/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'account_holder/index.html';
            $config['first_url'] = base_url() . 'account_holder/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Accounts_model->total_rows($q);
        $account = $this->Accounts_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        //$account_hol = $this->db->get('account_holder')->result();

        $data = array(
            'account_holder' => $account,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        

        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('account_holder/account_holder_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->db->get_where('account_holder',array('ac_holder_id' => $id ))->row();
        if ($row) {
            $data = array(
    		'ac_holder_id' => $row->ac_holder_id,
    		'name' => $row->username,
    		'contact_number' => $row->phone,
    		'type' => $row->type,
    	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('account_holder/account_holder_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Account_holder'));
        }
    }

    public function create() 
    {
        

        $data = array(
            'button' => 'Add',
            'action' => site_url('account_holder/create_action'),
    	    'name' => set_value('username'),
    	    'phone' => set_value('phone'),
    	    'type' => set_value('type'),
            'ac_holder_id' => set_value('ac_holder_id'),
    	    
    	);
        
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('account_holder/account_holder_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        
            $data = array(
        		'username' => $this->input->post('name',TRUE),
                'password' => sha1($this->input->post('password',TRUE)),
        		'phone' => $this->input->post('phone',TRUE),
        		'type' => $this->input->post('type',TRUE),
    	    );
            $this->db->insert('account_holder',$data);
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message"><b>Create Record Success</b></div>');
            redirect(site_url('account_holder'));
        
    }
 
    
    public function update($id) 
    {
        $row = $this->db->get_where('account_holder',array('ac_holder_id' => $id ))->row();
        // $table = $this->gents_mesurements($row->details);
        // Load gents form first time into the add field......end.......

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('account_holder/update_action'),
    		'ac_holder_id' => set_value('ac_holder_id', $row->ac_holder_id),
    		'name' => set_value('name', $row->username),
    		'phone' => set_value('phone', $row->phone),
    		'type' => set_value('type', $row->type),
    	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('account_holder/account_holder_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('account_holder'));
        }
    }

    
    
    public function update_action() 
    {
        
            $data = array(
        		'username' => $this->input->post('name',TRUE),
        		'phone' => $this->input->post('phone',TRUE),
        		'type' => $this->input->post('type',TRUE),
                'updatedTime' => date('Y-m-d h:i:s'),
    	    );
            if ($this->input->post('password', TRUE)) 
                {
                    $data['password'] = sha1($this->input->post('password', TRUE));
                }

            $this->db->where('ac_holder_id',$this->input->post('ac_holder_id',TRUE));
            $this->db->update('account_holder',$data);
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message"><b>Update Record Success</b></div>');
            redirect(site_url('account_holder'));
        
    }
    public function delete($id) 
    {
            
        $this->db->where('ac_holder_id', $id);
        $this->db->delete('account_holder');
        $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message"><b>Delete Record Success</b></div>');
            redirect(site_url('account_holder'));
        
    }

    public function transaction($id){

            $row = $this->Accounts_model->get_by_id($id);
            if ($row) {
                $data = array(

                    'ac_holder_id' => $row->ac_holder_id,
                    'username' => $row->username,
                    'balance' => $row->balance,
                    'phone' => $row->phone,
                    'type' => $row->type,
                );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('account_holder/transaction_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('account_holder'));
        }
    }

    public function _rules() 
    {
    	// $this->form_validation->set_rules('name', 'name', 'trim|required');
    	// $this->form_validation->set_rules('phone', 'phone number', 'trim|required');
    	// //$this->form_validation->set_rules('cus_type', 'customer type', 'trim|required');
    	// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "account_holder.xls";
        $judul = "account_holder";
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

	foreach ($this->Accounts_model->get_all() as $data) {
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
            'account_holder' => $this->Accounts_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('account_holder/account_holder_doc',$data);
    }
    
    
    
}

/* End of file Customers.php */
/* Location: ./application/controllers/Customers.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-04 11:54:11 */
/* http://harviacode.com */