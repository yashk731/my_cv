<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect(base_url());
        }
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
            $email = $this->input->post('email_id');
            $mobile = $this->input->post('mobile_no');
            $check_email_data = $this->db->where('email_id', $email)->get('tbl_users')->num_rows();
            $check_phone_data = $this->db->where('mobile_no', $mobile)->get('tbl_users')->num_rows();
            if ($check_email_data > 0 && $check_phone_data > 0) {
                echo 4;
            } else if ($check_email_data > 0) {
                echo 2;
            } else if ($check_phone_data > 0) {
                echo 3;
            } else {
                $insert_array = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'mobile_no' => $mobile,
                    'email_id' => $email,
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
    public function about_us()
    {
        $this->form_validation->set_rules('introduction', 'Introduction', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {

            echo 5;
        } else {

            $user_id = $this->session->userdata('user_id');
            $file = $_FILES["user_cv"];
            $MyFileName = "";
            if (strlen($file['name']) > 0) {
                $image = $file["name"];
                $config['upload_path'] = './assets/upload/CV';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '1024';  // Size in KB
                $config['file_name'] = $image;
                $this->load->library("upload", $config);
                $filestatus = $this->upload->do_upload('user_cv');
                if ($filestatus == true) {
                    $MyFileName = $this->upload->data('file_name');
                    $array['cv'] = "assets/upload/CV/" . $MyFileName;

                } else {
                    $error = array('error' => $this->upload->display_errors());
                    exit;
                    $result = $error;
                }
            }
            //End: File upload code

            $array['introduction'] = $this->input->post('introduction');
            $array['user_id'] = $user_id;
            $userdata = $this->UM->get_aboutus_data();
            if (!empty($userdata)) {
                $response = $this->db->where('user_id', $user_id)->update('tbl_about', $array);
            } else {
                $response = $this->db->insert('tbl_about', $array);
            }
            if ($response) {
                $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "You data save successfully!",
                });
            });
            </script>');
                redirect(base_url() . "UserDashboard/aboutUs");
            } else {
                $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            });
            </script>');
                redirect(base_url() . "UserDashboard/aboutUs");
            }
        }
    }
    public function check_pdf_availability()
    {
        $result = $this->UM->get_aboutus_data();
        $pdfCount = $result->cv;
        if (!empty($pdfCount)) {
            echo 1;
        } else {
            echo 0;
        }

        //echo json_encode(array('pdf_available' => $pdfAvailable));
    }
    public function save_education()
    {
        $eduction_data = $this->input->post('eduction_data');
        foreach ($eduction_data as $row) {
            $data = array(
                'education_type' => $row['education_type'],
                'institute' => $row['institute'],
                'year' => $row['year'],
                // Assuming 'description' is not present in the provided array
                'description' => $row['description'], // Adjust this as per your requirement
                'user_id' => $this->session->userdata('user_id'),
            );
            $response = $this->db->insert('tbl_qualification', $data);
        }
        if ($response) {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "You data save successfully!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/education");
        } else {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/education");
        }

    }

    public function save_experience()
    {
        $experience_data = $this->input->post('experience_data');
        foreach ($experience_data as $row) {
            $data = array(
                'work_type' => $row['work_type'],
                'organisation_name' => $row['organisation_name'],
                'website_url' => $row['website_url'],
                'work_from' => $row['work_from'],
                'work_to' => $row['work_to'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $response = $this->db->insert('tbl_experience', $data);
        }
        if ($response) {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "You data save successfully!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/experience");
        } else {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/experience");
        }

    }
    public function save_skills()
    {
        $skill_data = $this->input->post('skill_data');

        foreach ($skill_data as $row) {
            $data = array(
                'skill' => $row['skill'],
                'percantage' => $row['percantage'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $response = $this->db->insert('tbl_skills', $data);
        }
        if ($response) {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "You data save successfully!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/skills");
        } else {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/skills");
        }

    }
    public function save_client()
{
    $data = [];
    if (!empty($_FILES['client_data']["name"])) {
        $this->load->library('upload');
        $config['upload_path'] = './assets/upload/logos';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '5000';
        // $config['encrypt_name'] = TRUE;
        $files = $_FILES['client_data'];
        foreach ($files['name'] as $key => $image) {
            if (empty($files['name'][$key]))
                break;
            $_FILES['temp_file']['name'] = $files['name'][$key];
            $_FILES['temp_file']['type'] = $files['type'][$key];
            $_FILES['temp_file']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['temp_file']['error'] = $files['error'][$key];
            $_FILES['temp_file']['size'] = $files['size'][$key];
            $config['file_name'] = '___dfdf'.rand();
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('temp_file')) {
                $error_file[$key] = $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
            }
            if (!empty($upload_data["file_name"])) {
                $fileName = $upload_data["file_name"];
                $images[] = $fileName;
                $title[$key] = 'jkhjk';//$amenities_title[$key];
                $ntitle[] = $title[$key];
            }
           
        }
    }
    
      echo "<pre>";
      print_r($_FILES);
      die();
    // Process each uploaded file
    foreach ($_FILES['client_data']['name'] as $key => $file_name) {
       
        // die();
        // Check if file is uploaded
        if (!empty($file_name)) {
            $url = $this->input->post('url')[$key] ?: '';
            // Set up file upload configuration
            $config['upload_path'] = './assets/upload/logos/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
          //  $config['max_size'] = 5000; // in KB
            $config['file_name'] = $file_name;
            print_r($key);
                die();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('logo['.$key.']')) { 
                
                $upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
                
                $data[] = ['logo' => $filename, 'url' => $url];
            } else {
                // Handle upload errors if any
                $upload_error = $this->upload->display_errors();
                echo $upload_error;
            }
        }
    }
    // Insert data into the database
    if (!empty($data)) {
        $this->db->insert_batch('tbl_client', $data);
    }
    // Print or process data after insertion
    echo "<pre>";
    print_r($data);
    die();
}

    // Redirect or display success message
    

    public function save_client_()
    {
        echo "<pre>";
        print_r($_FILES);
        print_r($_POST);
        exit;
        $client_data = $this->input->post('client_data');
        foreach ($client_data as $row) {
            $data['url'] = $row['url'];
            $file = $_FILES["logo"];
            $MyFileName = "";
            if (strlen($file['name']) > 0) {
                $image = $file["name"];
                $config['upload_path'] = './assets/upload/CV';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '1024';  // Size in KB
                $config['file_name'] = $image;
                $this->load->library("upload", $config);
                $filestatus = $this->upload->do_upload('logo');
                if ($filestatus == true) {
                    $MyFileName = $this->upload->data('file_name');
                    $data['logo'] = "assets/upload/CV/" . $MyFileName;

                } else {
                    $error = array('error' => $this->upload->display_errors());
                    //exit;
                    $result = $error;
                }
            }
            //End: File upload code
            $response = $this->db->insert('tbl_client', $data);
        }
        if ($response) {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "You data save successfully!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/clients");
        } else {
            $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard/clients");
        }

    }
    public function save_user_img(){
//  print_r($_FILES);exit;
        //to start image validation
        $file = $_FILES["image"];
        $MyFileName="";
        if(strlen($file['name'])>0)
        {
        $image=$file["name"];
        $config['upload_path'] = './assets/upload/User_Images';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
     
        $config['file_name']=$image;
        $this->load->library("upload",$config);
        $filestatus=$this->upload->do_upload('image');
        if($filestatus==true) 
        {
        // $data = array('upload_data' => $this->upload->data());
        $MyFileName=$this->upload->data('file_name');
        $array['image']="/assets/upload/User_Images/".$MyFileName;
        }
        else
        {
        $error = array('error' => $this->upload->display_errors());
        $result=$error;
        }
        }
        //End: File upload code


    }
    public function demo(){
        $this->load->view('image');
    }
   
    public function upload_cropped_image() {
        // Check if form is submitted
        if ($this->input->post()) {
            $cropped_image_data = $this->input->post('cropped_image');
            $cropped_image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $cropped_image_data));
            $upload_path = './assets/upload/User_Images/';
            $filename = uniqid() . '.png'; 
            if (file_put_contents($upload_path . $filename, $cropped_image_data)) {
                $user_id=$this->session->userdata('user_id');
                // Image uploaded successfully
                $array['image']=$filename;
                $array['user_id']=$user_id;
               $check_user_data=  $this->UM->user_image_data($user_id);
               if(empty($check_user_data)){
                $this->UM->save_user_image($array);
               }else{
                $this->db->where(['status'=>1,'user_id'=>$user_id])->update('tbl_user_image',$array);
               }
                $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Image uploaded successfully!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard");
            } else {
                // Failed to upload image
                $this->session->set_flashdata('success', '<script>
                $(document).ready(function(){
                Swal.fire({
                    icon: "erroe",
                    title: "Error",
                    text: "Failed to upload image!",
                });
            });
            </script>');
            redirect(base_url() . "UserDashboard");
               // echo "Failed to upload image!";
            }
        } else {
            $this->session->set_flashdata('success', '<script>
            $(document).ready(function(){
            Swal.fire({
                icon: "erroe",
                title: "Error",
                text: "Form not submitted!",
            });
        });
        </script>');
        redirect(base_url() . "UserDashboard");
        
        }
    }
}
