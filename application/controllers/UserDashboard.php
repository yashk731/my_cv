<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserDashboard extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->model('UserModel','UM');
		if(!$this->session->userdata('user_id'))
        {
            redirect(base_url());
        }
		// try {
		// 	$this->load->model('UserModel', 'UM');
		// } catch (Exception $e) {
		// 	log_message('error', 'Error loading UserModel: ' . $e->getMessage());
		// 	// You may choose to redirect or display an error page here
		// }
        //$this->load->model('UserModel','UM');
    }
	
    public function dashboard()
	{
		$user_id=$this->session->userdata('user_id');
		$data['user_img']=$this->UM->user_image_data($user_id);
		$data['total_project']=$this->UM->total_project($user_id);
		$data['total_client']=$this->UM->total_client($user_id);
		$data['total_experience']=$this->UM->total_experience($user_id);
		$this->load->view('user/dashboard/dashboard',$data);
	}

	public function aboutUs()
	{
		$data['about_data']= $this->UM->get_aboutus_data();
		$this->load->view('user/dashboard/aboutUs',$data);
	}
	public function education()
	{
		$this->load->view('user/dashboard/education');
	}
	public function experience()
	{
		$this->load->view('user/dashboard/experience');
	}
	public function skills()
	{
		// $data = [1,2,3,5,6,5,6];
		// if($this->input->post('is_form_ajax_app_api')){
		// 	echo json_encode($data);
		// }else{
		// 	$this->load->view('user/dashboard/skills',$data);
		// }
		$this->load->view('user/dashboard/skills');
	}
	public function projects()
	{
		$this->load->view('user/dashboard/projects');
	}
	public function clients()
	{
		$this->load->view('user/dashboard/clients');
	}

    public function test() {
		$file_path = APPPATH . 'views/index.php';
        $html = file_get_contents($file_path );
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_use_internal_errors(false);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            echo $src . '<br>';
        }
    }


}
