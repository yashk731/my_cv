<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserDashboard extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        $this->load->model('UserModel','UM');
    }
	public function index()
	{
		$data['countries']=$this->UM->get_country();
		$this->load->view('index',$data);
	}

    public function dashboard()
	{
		$this->load->view('user/dashboard/dashboard');
	}

	public function aboutUs()
	{
		$this->load->view('user/dashboard/aboutUs');
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
}
