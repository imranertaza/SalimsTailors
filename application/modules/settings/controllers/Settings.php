<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Settings_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'settings/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'settings/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'settings/index.html';
            $config['first_url'] = base_url() . 'settings/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Settings_model->total_rows($q);
        $settings = $this->Settings_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'settings_data' => $settings,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('settings/settings_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->Settings_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'lebel' => $row->lebel,
		'value' => $row->value,
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('settings/settings_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('settings'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('settings/create_action'),
	    'id' => set_value('id'),
	    'lebel' => set_value('lebel'),
	    'value' => set_value('value'),
	);
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('settings/settings_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'lebel' => $this->input->post('lebel',TRUE),
		'value' => $this->input->post('value',TRUE),
	    );

            $this->Settings_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('settings'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Settings_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('settings/update_action'),
		'id' => set_value('id', $row->id),
		'lebel' => set_value('lebel', $row->lebel),
		'value' => set_value('value', $row->value),
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('settings/settings_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('settings'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'lebel' => $this->input->post('lebel',TRUE),
		'value' => $this->input->post('value',TRUE),
	    );

            $this->Settings_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('settings'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Settings_model->get_by_id($id);

        if ($row) {
            $this->Settings_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('settings'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('settings'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('lebel', 'lebel', 'trim|required');
	$this->form_validation->set_rules('value', 'value', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-28 09:01:53 */
/* http://harviacode.com */