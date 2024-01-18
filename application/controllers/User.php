<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'UM');
    }
    public function get_state()
    {
        $country_id = $this->input->post('country_id');
        $states = $this->UM->get_state($country_id);
        if (!empty($states)) {
            echo '<option value="">Select State</option>';
            foreach ($states as $state) {
                echo '<option value="' . $state->id . '">' . $state->name . '</option>';
            }
        } else {
            echo '<option value="">State not available</option>';
        }
    }
    public function get_city()
    {
        $state_id = $this->input->post('state_id');
        $country_id = $this->input->post('country_id');
        $cities = $this->UM->get_city($state_id, $country_id);
        if (!empty($cities)) {
            echo '<option value="">Select City</option>';
            foreach ($cities as $city) {
                echo '<option value="' . $city->id . '">' . $city->name . '</option>';
            }
        } else {
            echo '<option value="">City not available</option>';
        }
    }
    public function user_register()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
        $this->form_validation->set_rules('email_id', 'Email ID', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        // Run the form validation
        if ($this->form_validation->run() == FALSE) {
          //  echo validation_errors();
          echo 5;
        } else {
        $email= $this->input->post('email_id');
        $mobile= $this->input->post('mobile_no');
        $check_email_data=$this->db->where('email_id',$email)->get('tbl_users')->num_rows();
        $check_phone_data=$this->db->where('mobile_no',$mobile)->get('tbl_users')->num_rows();
        if($check_email_data>0 &&  $check_phone_data>0){
            echo 4;
        }
        else if($check_email_data>0) {
            echo 2;
        }else if($check_phone_data>0) {
            echo 3;
        }
        else{
            $insert_array = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'mobile_no' => $mobile,
                'email_id' =>  $email,
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'pincode' => $this->input->post('pincode'),
                'password' => md5($this->input->post('password')),
            );
            $result = $this->db->insert('tbl_users', $insert_array);
                if ($result) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        }
    }
}


