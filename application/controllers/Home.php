<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('UserModel','UM');
		
    }

	public function index($name_id)
	{ 
		$user_data=$this->db->select('*')->where("CONCAT(first_name,last_name,'_',id)",$name_id)->get('tbl_users')->row();
		$user_id=$user_data->id;
		$data['user_name'] = $user_data->first_name." ".$user_data->last_name; 
		$data['about_data']=$this->UM->show_user_data($user_id);
		$data['aboutus_data']=$this->UM->get_aboutus_data($user_id);
		$data['user_data'] = $user_data;
		$data['education_data']=$this->UM->show_education($user_id);
		$data['experience_data']=$this->UM->show_experience($user_id);
		$data['skills_data']=$this->UM->show_skills($user_id);
		$data['dashboard_data']=$this->UM->dashboard_data($user_id);
		$data['contact_data']=$this->UM->get_contactus_data($user_id);
		$data['client_data']=$this->UM->get_client_data($user_id);
		// echo "<pre>";
		// print_r($data['client_data']);
		// exit;
		if(!empty($data['user_data']))
		$this->load->view('user/index',$data);
		else
		$this->load->view('user/nodata');
	}
}
