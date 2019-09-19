<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customers extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->helper('mesurement_fields');
        $this->load->model('Customers_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'customers/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'customers/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'customers/index.html';
            $config['first_url'] = base_url() . 'customers/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Customers_model->total_rows($q);
        $customers = $this->Customers_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'customers_data' => $customers,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('customers/customers_list', $data);
        $this->load->view('../../footer');   
    }

    public function read($id) 
    {
        $row = $this->Customers_model->get_by_id($id);
        if ($row) {
            $data = array(
		'customer_id' => $row->customer_id,
		'name' => $row->name,
		'contact_number' => $row->contact_number,
		'type' => $row->type,
		'details' => $row->details,
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('customers/customers_read', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customers'));
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
        $table = $this->gents_mesurements($p_directions);
        // Load gents form first time into the add field......end.......

        $data = array(
            'button' => 'Add',
            'action' => site_url('customers/create_action'),
	    'customer_id' => set_value('customer_id'),
	    'name' => set_value('name'),
	    'contact_number' => set_value('contact_number'),
	    'type' => set_value('type'),
	    'details' => set_value('details'),
	    'table' => $table,
            'readonly' => '',
	);
        
        $this->load->view('../../header');
        $this->load->view('../../sidebar');
        $this->load->view('customers/customers_form', $data);
        $this->load->view('../../footer');   
    }
    
    public function create_action() 
    {
        $this->_rules();
        
        // Mesurement array adding into database
        $details = $this->mesurement_array_add();
       
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'contact_number' => $this->input->post('contact_number',TRUE),
		'type' => $this->input->post('cus_type',TRUE),
		'details' => $details,
	    );

            $this->Customers_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('customers'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Customers_model->get_by_id($id);
        $table = $this->gents_mesurements($row->details);
        // Load gents form first time into the add field......end.......

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('customers/update_action'),
		'customer_id' => set_value('customer_id', $row->customer_id),
		'name' => set_value('name', $row->name),
		'contact_number' => set_value('contact_number', $row->contact_number),
		'type' => set_value('type', $row->type),
		'details' => set_value('details', $row->details),
		'table' => $table,
		'readonly' => 'disabled="disabled"',
	    );
            $this->load->view('../../header');
            $this->load->view('../../sidebar');
            $this->load->view('customers/customers_form', $data);
            $this->load->view('../../footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customers'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $details = $this->mesurement_array_add();
        $this->input->post('customer_id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('customer_id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'contact_number' => $this->input->post('contact_number',TRUE),
		'type' => $this->input->post('cus_type',TRUE),
		'details' => $details,
	    );

            $this->Customers_model->update($this->input->post('customer_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('customers'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Customers_model->get_by_id($id);

        if ($row) {
            $this->Customers_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('customers'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customers'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('contact_number', 'contact number', 'trim|required');
	//$this->form_validation->set_rules('cus_type', 'customer type', 'trim|required');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "customers.xls";
        $judul = "customers";
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

	foreach ($this->Customers_model->get_all() as $data) {
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
            'customers_data' => $this->Customers_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('customers/customers_doc',$data);
    }
    
    public function fields()
    {
        spl_autoload_register(function ($name) {
            $filename = APPPATH.'/modules/customers/libraries/'.$name.'.php';
            include_once($filename);
        });
        $directions = new directions_pant();
        $p_directions= $directions->direction_json();
        
        $customer_type = $this->input->post('customer_type');
        if ($customer_type == "gent"){
            $table  = $this->gents_mesurements($p_directions);
        }else {
            $table = selecting_notice_table();
        }
        print $table;
    }

    public function mesurement_array_add(){
        
        // Pant inputs
        $p_jul = $this->input->post('p_jul');
        $p_mohuri = $this->input->post('p_mohuri');
        $p_komor = $this->input->post('p_komor');
        $p_shamna = $this->input->post('p_shamna');
        $p_back = $this->input->post('p_back');
        $p_hatu = $this->input->post('p_hatu');
        $p_hip = $this->input->post('p_hip');
        $p_thai = $this->input->post('p_thai');
        $p_high = $this->input->post('p_high');
        $p_pocket = $this->input->post('p_pocket');
        $p_hip_pocket = $this->input->post('p_hip_pocket');
        $p_taken = $this->input->post('p_taken');
        $p_shamna_down = $this->input->post('p_shamna_down');
        $p_back_shape = $this->input->post('p_back_shape');
        $p_mobile_pocket = $this->input->post('p_mobile_pocket');
        $p_folding = $this->input->post('p_folding');
        $p_shaliy = $this->input->post('p_shaliy');
        $p_sticker = $this->input->post('p_sticker');
        $p_cuting = $this->input->post('p_cuting');
        


                              

        // Shirt inputs
        $s_jul = $this->input->post('s_jul');
        $s_buk = $this->input->post('s_buk');
        $s_put = $this->input->post('s_put');
        $s_hata = $this->input->post('s_hata');
        $s_gola = $this->input->post('s_gola');
        $s_mohuri = $this->input->post('s_mohuri');
        $s_komor = $this->input->post('s_komor');
        $s_shamna = $this->input->post('s_shamna');
        $s_hip = $this->input->post('s_hip');
        $s_side_chera = $this->input->post('s_side_chera');
        $s_mohoda = $this->input->post('s_mohoda');
        $s_back = $this->input->post('s_back');
        $s_cutting = $this->input->post('s_cutting');
        $s_pocket = $this->input->post('s_pocket');
        $s_clolor = $this->input->post('s_clolor');
        $s_plate = $this->input->post('s_plate');
        $s_istekar = $this->input->post('s_istekar');
        $s_shali = $this->input->post('s_shali');
        $s_loose = $this->input->post('s_loose');
        
        
        
        // Suit court inputs
        $su_jul = $this->input->post('su_jul');
        $su_buk = $this->input->post('su_buk');
        $su_put = $this->input->post('su_put');
        $su_hata = $this->input->post('su_hata');
        $su_gola = $this->input->post('su_gola');
        $su_mohuri = $this->input->post('su_mohuri');
        $su_komor = $this->input->post('su_komor');
        $su_shamna = $this->input->post('su_shamna');
        $su_shesth = $this->input->post('su_shesth');
        $su_back = $this->input->post('su_back');
        $su_hip = $this->input->post('su_hip');
        $suit_style = $this->input->post('su_suit_style');
        $button = $this->input->post('su_button');
        $round = $this->input->post('su_round');
        $hand_but = $this->input->post('su_hand_but');
        $side_open = $this->input->post('su_side_open');
        $fiting = $this->input->post('su_fiting');

	// Panjabi court inputs
        $pa_jul = $this->input->post('pa_jul');
        $pa_buk = $this->input->post('pa_buk');
        $pa_put = $this->input->post('pa_put');
        $pa_hata = $this->input->post('pa_hata');
        $pa_gola = $this->input->post('pa_gola');
        $pa_mohuri = $this->input->post('pa_mohuri');
        $pa_komor = $this->input->post('pa_komor');
        $pa_shamna = $this->input->post('pa_shamna');
        $pa_hip = $this->input->post('pa_hip');
        $pa_mohora = $this->input->post('pa_mohora');
        $pa_panjabi_style = $this->input->post('pa_panjabi_style');
        $pa_design = $this->input->post('pa_design');
        $pa_loose = $this->input->post('pa_loose');
	


        // Panjabi court inputs
        $pj_jul = $this->input->post('pj_jul');
        $pj_mohuri = $this->input->post('pj_mohuri');
        $pj_komor = $this->input->post('pj_komor');
        $pj_hip = $this->input->post('pj_hip');
        $pj_thai = $this->input->post('pj_thai');
        $pj_high = $this->input->post('pj_high');
        $pj_pocket = $this->input->post('pj_pocket');
        $pj_hip = $this->input->post('pj_hip');
        $pj_cuting = $this->input->post('pj_cuting');
        $pj_bon = $this->input->post('pj_bon');
        
           
		   
		  
		  
		  
			
        
        $details = array(
                        "pant" => array(
                            "jul" => $p_jul,
                            "mohuri" => $p_mohuri,
                            "komor" => $p_komor,
                            "shamna" => $p_shamna,
                            "back" => $p_back,
                            "hatu" => $p_hatu,
                            "hip" => $p_hip,
                            "thai" => $p_thai,
                            "high" => $p_high,
                            "pocket" => $p_pocket,
                            "hip_pocket" => $p_hip_pocket,
                            "taken" => $p_taken,
                            "shamna_down" => $p_shamna_down,
                            "back_shape" => $p_back_shape,
                            "mobile_pocket" => $p_mobile_pocket,
                            "folding" => $p_folding,
                            "shaliy" => $p_shaliy,
                            "sticker" => $p_sticker,
                            "cuting" => $p_cuting,
                        ),
                        "shirt" => array(
                                "jul" => $s_jul,
                                "buk" => $s_buk,
                                "put" => $s_put,
                                "hata" => $s_hata,
                                "gola" => $s_gola,
                                "mohuri" => $s_mohuri,
                                "komor" => $s_komor,
                                "shamna" => $s_shamna,
                                "back" => $s_back,
                                "mohoda" => $s_mohoda,
                                "hip" => $s_hip,
                                "cutting" => $s_cutting,
                                "pocket" => $s_pocket,
                                "clolor" =>$s_clolor,
                                "plate" => $s_plate,					
                                "shali" => $s_shali,
                                "loose" => $s_loose,
                                "istekar" => $s_istekar,
                        ),
                        "suit" => array(
                                "jul" => $su_jul,
                                "buk" => $su_buk,
                                "put" => $su_put,
                                "hata" => $su_hata,
                                "gola" => $su_gola,
                                "mohuri" => $su_mohuri,
                                "komor" => $su_komor,
                                "mohora" => "",
                                "shamna" => $su_shamna,
                                "back" => $su_back,
                                "sheste" => $su_shesth,
                                "hip" => $su_hip,
                                "suit_style" => $suit_style,
                                "button" => $button,
                                "round" => $round,
                                "hand_but" => $hand_but,
                                "side_open" => $side_open,					
                                "fiting" => $fiting,
                        ),
                        "panjabi" => array(
                           
				"jul" => $pa_jul,
                                "buk" => $pa_buk,
                                "put" => $pa_put,
                                "hata" => $pa_hata,
                                "gola" => $pa_gola,
                                "mohuri" => $pa_mohuri,
                                "komor" => $pa_komor,
                                "shamna" => $pa_shamna,
                                "mohora" => $pa_mohora,
                                "hip" => $pa_hip,
                                "panjabi_style" => $pa_panjabi_style,
                                "design" => $pa_design,
                                "loose" => $pa_loose,
                        ),
						
                        "pajama" => array(
                            "jul" => $pj_jul,
                            "mohuri" => $pj_mohuri,
                            "komor" => $pj_komor,
                            "hip" => $pj_hip,
                            "thai" => $pj_thai,
                            "high" => $pj_high,
                            "pocket" => $pj_pocket,
                            "hip" => $pj_hip,
                            "cuting" =>  $pj_cuting,
                            "bon" => $pj_bon,
                        ),
                    );
         
        
       $details = json_encode($details);
       return $details;
    }
    
    
    public function gents_mesurements($p_directions){
        //require_once(APPPATH.'/modules/customers/libraries/directions_pant.php');
        spl_autoload_register(function ($name) {
            $filename = APPPATH.'/modules/customers/libraries/'.$name.'.php';
            include_once($filename);
        });
        
        $directions = new directions_pant();
        $table = $directions->fields($p_directions);
        $table .= $directions->direction_html($p_directions);

        $directions = new directions_shirt();
        $table .= $directions->fields($p_directions);
        $table .= $directions->direction_html($p_directions);

        $directions = new directions_suit();
        $table .= $directions->fields($p_directions);
        $table .= $directions->direction_html($p_directions);

        $directions = new directions_pajama();
        $table .= $directions->fields($p_directions);
        $table .= $directions->direction_html($p_directions);

        $directions = new directions_panjabi();
        $table .= $directions->fields($p_directions);
        $table .= $directions->direction_html($p_directions);
        return $table;
    }        
    
}

/* End of file Customers.php */
/* Location: ./application/controllers/Customers.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-03-04 11:54:11 */
/* http://harviacode.com */