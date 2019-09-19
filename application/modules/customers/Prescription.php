<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prescription extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('home');
        $this->load->model('Category_model');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $data['id'] = rand();
        $data['date'] = date('Y-m-d');
        $details = $this->session->userdata("prescription");
        if (empty($details)) {
        $details = array(
                        "name" => "",
                        "age"  => "",
                        "date" => "",
                        "medicines" => array(),
                        "C_C" => array(),
                        "M_H" => array(),
                        "O_E" => array(),
                        "treatment" => array(),
                        "advice" => array(),
                        );
        $details = $this->session->set_userdata("prescription", $details);
        }
        
        $data['details'] = (object) $details;
        
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('prescription/index', $data);
        $this->load->view('footer');
    }
    
    // Add items
    public function add_new_item()
    {
       //print $id = $this->input->post('id', TRUE);
       $name = $this->input->post('medicine', TRUE);
       $type = $this->input->post('type', TRUE);
       $dosage = $this->input->post('dosage', TRUE);
       $days = $this->input->post('days', TRUE);
       $before_after = $this->input->post('before_after', TRUE);
       $when = $this->input->post('when', TRUE);
       $details = $this->session->userdata('prescription');
       array_push($details['medicines'],array(
                                        "name" => $name,
                                        "type" => $type,
                                        "dosage" => $dosage,
                                        "days" => $days,
                                        "before_after" => $before_after,
                                        "when" => $when,
                                        ));
       
       $new_table = prescription_new_table($details['medicines']);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
       
    }
    // Delete item
    public function delete_item($item_id)
    {
       $details = $this->session->userdata('prescription');
       unset($details['medicines'][$item_id]);
       
       $new_table = prescription_new_table($details['medicines']);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
       
    }
    
    //add treatment 
    public function add_new_treatment()
    {
       $type = $this->input->post('t_type', TRUE);
       $top_left = $this->input->post('top_left', TRUE);
       $top_right = $this->input->post('top_right', TRUE);
       $bottom_left = $this->input->post('bottom_left', TRUE);
       $bottom_right = $this->input->post('bottom_right', TRUE);
       $problem = $this->input->post('problem', TRUE);
       
       $details = $this->session->userdata('prescription');
       array_push($details[$type],array(
                                        "problem" => $problem,
                                        "teeth" => array(
                                                    "t_l" => $top_left,
                                                    "t_r" => $top_right,
                                                    "b_l" => $bottom_left,
                                                    "b_r" => $bottom_right,
                                                    ),
                                        "type" => $type,
                                        ));
       
       $new_table = treatment_cc_new_table($type, $details[$type]);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
       
    }
    
    //treatement delete
    public function delete_treatment($t_type)
    {
       $treatment_id = $_POST['treatment_id'];
       $details = $this->session->userdata('prescription');
       unset($details[$t_type][$treatment_id]);
       
       $new_table = treatment_cc_new_table($t_type, $details[$t_type]);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
       
    }
    
    
    // Advice create
    public function add_new_advice()
    {
       $type = 'advice';
       $top_left = $this->input->post('a_top_left', TRUE);
       $top_right = $this->input->post('a_top_right', TRUE);
       $bottom_left = $this->input->post('a_bottom_left', TRUE);
       $bottom_right = $this->input->post('a_bottom_right', TRUE);
       $advice = $this->input->post('advice', TRUE);
       
       $details = $this->session->userdata('prescription');
       array_push($details[$type],array(
                                        "problem" => $advice,
                                        "teeth" => array(
                                                    "t_l" => $top_left,
                                                    "t_r" => $top_right,
                                                    "b_l" => $bottom_left,
                                                    "b_r" => $bottom_right,
                                                    ),
                                        "type" => $type,
                                        ));
       
       $new_table = treatment_cc_new_table($type, $details[$type]);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
       
    }
    //advice delete
    public function delete_advice($item_id)
    {
       $details = $this->session->userdata('prescription');
       unset($details['medicines'][$item_id]);
       
       $new_table = prescription_new_table($details['medicines']);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
       
    }
    
    
    public function print_view()
    {
       $details = $this->session->userdata('prescription');
       if (is_array($details)){
       $name = $this->input->post('name', TRUE);
       $age = $this->input->post('age', TRUE);
       $date = $this->input->post('date', TRUE);
       $details = array_replace($details, array(
                                'name' => $name,
                                'age' => $age,
                                'date' => $date,
                                ));
       $this->session->set_userdata('prescription', $details);
       $data['details'] = (object) $this->session->userdata('prescription');
       $this->load->view('prescription/preview', $data);
       session_destroy();
        }else {
            redirect(base_url().'prescription/');
        }
    }
    
    public function company_list($label = '--Select Company--')
    {
        $type = $this->input->post('type', TRUE);
        $this->db->where("type", $type);
        $this->db->group_by("com_id");
        $query = $this->db->get("medicine");
        $option = '<option value="0">'.$label.'</option>';
        foreach ($query->result() as $row)
        {
            $option .= '<option value="'.$row->com_id.'">'.getCompanyNameById($row->com_id).'</option>';
        }
        print $option;
    }
    
    
    public function category_list($label = '--Select Category--')
    {
        $company = $this->input->post('company', TRUE);
        $type = $this->input->post('type', TRUE);
        $this->db->where(array(
                                "com_id" => $company,
                                "type" => $type,
                                ));
        $this->db->group_by("cat_id");
        $query = $this->db->get("medicine");
        print $this->db->last_query();
        $option = '<option value="0">'.$label.'</option>';
        foreach ($query->result() as $row)
        {
            $option .= '<option value="'.$row->cat_id.'">'.getCategoryNameById($row->cat_id).'</option>';
        }
        print $option;
    }
    
    
    public function medicine_list($label = '--Select Medicine--')
    {
        $category = $this->input->post('category', TRUE);
        $company = $this->input->post('company', TRUE);
        $type = $this->input->post('type', TRUE);
        
        $this->db->where(array(
                            "cat_id" => $category,
                            "com_id" => $company,
                            "type" => $type,
                            ));
        $query = $this->db->get("medicine");
        print $this->db->last_query();
        $option = '<option value="0">'.$label.'</option>';
        foreach ($query->result() as $row)
        {
            $option .= '<option>'.getMedicineNameById($row->med_id).'</option>';
        }
        print $option;
    }
    
    /*public function index(){
        $data = array(
            'name' => '',
            'age' => '',
            'date' => date('Y-m-d'),
        );
        $this->db->insert('prescription', $data);
        $id = $this->db->insert_id();                
        redirect('home/prescription/'. $id );
    }*/
}
