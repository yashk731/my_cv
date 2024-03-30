<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel", "UM");

    }
    public function index()
	{
		$data['countries']=$this->UM->get_country();
		$this->load->view('index',$data);
	}

    public function ProcessLoginUser()
    {
        $email=$this->input->post("email");
        // print_r($_POST);exit; 
        $result = $this->UM->check_useremail($email)->num_rows();
        //print_r($result);exit;
        if ($result == 1) {
            $password = md5($this->input->post("password"));
            $res = $this->UM->check_useremail($email)->row();
            if ($res->password == $password) {
                $data = array(
                    'user_id' => $res->id,
                    'user_email' => $res->email_id,
                );
                $this->session->set_userdata($data);
                echo 1;
                // $this->session->set_flashdata('success', '<script>
                // Swal.fire({
                // title: "Congratulations!",
                // text: " You are login succesfully !",
                // icon: "success",
                // });
                // </script>');
                // redirect(base_url() . "UserDashboard");
            } else {
            // $this->session->set_flashdata('error', '<script>
            // Swal.fire({
            // title: "Sorry!",
            // text: " Invalid Password!",
            // icon: "warning",
            // });
            // </script>');
            echo 2;
            //redirect(base_url());
            }
        } else {
            echo 3;
            // $this->session->set_flashdata('error', '<script>
            // Swal.fire({
            // title: "Sorry!",
            // text: " Invalid Id and Password!",
            // icon: "warning",
            // button: "ok",
            // });
            // </script>');
            // redirect(base_url());
        }
    }
    public function LogoutUser()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        redirect(base_url());
    }
}