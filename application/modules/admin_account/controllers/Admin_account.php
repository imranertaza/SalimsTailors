<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_account extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->helper('mesurement_fields');
        $this->load->model('Admin_account_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'admin_account/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'admin_account/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'admin_account/index.html';
            $config['first_url'] = base_url() . 'admin_account/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Admin_account_model->total_rows($q);
        $admin_account = $this->Admin_account_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'admin_account' => $admin_account,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('admin_account/admin_account_list', $data);
        $this->load->view('../../footer');   
    }

    //search
    public function liveSearch(){

        $search_name=$this->input->post("search_name"); 

        $data=$this->db->select('*')->from('account_holder')
                    ->where("username LIKE '%$search_name%'")
                    ->get()->result();
        $view = '';
        foreach ($data as $sval) {
            $view = $view .'<input class="form-control" onclick="onText(\''.$sval->username.'\')" value="'.$sval->username.'" >';
        }
        echo $view;
    }
    //search
    public function search_name(){

        $search_name=$this->input->post("search_name"); 

        $data=$this->db->select('*')->from('account_holder')
                    ->where("username LIKE '%$search_name%'")
                    ->get()->result();
        $view = '';
        foreach ($data as $sval) {
            $view = $view .'<input class="form-control" onclick="addText(\''.$sval->username.'\')" value="'.$sval->username.'" >';
        }
        echo $view;
    }

    public function get_balance(){
        echo "Ok";
    }
    public function cost_balance(){
        echo "Ok";
    }
    
    
    
}

/* End of file admin_account.php */
/* Location: ./application/controllers/admin_account.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-04 11:54:11 */
/* http://harviacode.com */