<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserDashboard extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}

    public function dashboard()
	{
		$this->load->view('user/dashboard/dashboard');
	}
}
