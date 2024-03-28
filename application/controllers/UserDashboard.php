<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class UserDashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel', 'UM');
		if (!$this->session->userdata('user_id')) {
			redirect(base_url());
		}
	}

	public function dashboard()
	{

		$user_id = $this->session->userdata('user_id');
		$data['user_img'] = $this->UM->user_image_data($user_id);
		$data['total_project'] = $this->UM->total_project($user_id);
		$data['total_client'] = $this->UM->total_client($user_id);
		$data['total_experience'] = $this->UM->total_experience($user_id);
		$user_data = $this->UM->get_user_data();
		$data['name_id'] = $user_data->first_name . "" . $user_data->last_name . "" . $user_data->id;
		//	$data['user_data']=$this->db->select('*')->where("CONCAT(first_name,last_name,id)",$name_id)->get('tbl_users')->row();

		$this->load->view('user/dashboard/dashboard', $data);
	}

	public function aboutUs()
	{

		$data['about_data'] = $this->UM->get_aboutus_data();
		$data['user_data'] = $this->UM->get_user_data();
		$this->load->view('user/dashboard/aboutUs', $data);
	}
	public function education()
	{
		$data['user_data'] = $this->UM->get_user_data();
		$data['education_data'] = $this->UM->get_education_data();
		$this->load->view('user/dashboard/education', $data);
	}
	public function experience()
	{
		$data['user_data'] = $this->UM->get_user_data();
		$data['experience_data'] = $this->UM->get_experience_data();
		$this->load->view('user/dashboard/experience', $data);
	}
	public function skills()
	{
		$data['user_data'] = $this->UM->get_user_data();
		$data['skills_data'] = $this->UM->get_skill_data();
		$this->load->view('user/dashboard/skills', $data);
	}
	public function projects()
	{
		$data['user_data'] = $this->UM->get_user_data();
		$data['project_data'] = $this->UM->getTotalProjectData();
		$this->load->view('user/dashboard/projects', $data);
	}
	public function clients()
	{
		$data['user_data'] = $this->UM->get_user_data();
		$data['client_data'] = $this->UM->get_client_data();
		$this->load->view('user/dashboard/clients',$data);
	}

	public function test()
	{
		$file_path = APPPATH . 'views/index.php';
		$html = file_get_contents($file_path);
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
	
	public function save_skills()
	{
		$ids = $this->input->post('delete_id');
		$skills = $this->input->post('skill');
		$percentages = $this->input->post('percantage');
		if (!empty($skills) && !empty($percentages)) {
			$user_id = $this->session->userdata('user_id');
			if (!empty($ids)) {
				$response=$this->db->where_not_in('id', $ids)->delete('tbl_skills');
			}
			for ($i = 0; $i < count($skills); $i++) {
							$data = array(
								'skill' => $skills[$i],
								'percantage' => $percentages[$i],
								'user_id' => $this->session->userdata('user_id'),
							);
				if (isset($ids[$i]) && !empty($ids[$i])) {
				$response=	$this->db->where('id', $ids[$i])->update('tbl_skills', $data);
				} else {
					$response=	$this->db->insert('tbl_skills', $data);
				}
			}
			// Check if any database operation failed
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
			} else {
				// Error message
				$this->session->set_flashdata('success', '<script>
					$(document).ready(function(){
					Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Something went wrong!",
					});
					});
					</script>');
			}
		} else {
			// Error message for invalid data
			$this->session->set_flashdata('success', '<script>
			$(document).ready(function(){
			Swal.fire({
			icon: "error",
			title: "Oops..",
			text: "Invalid data submitted. Please check your input!",
			});
			});
			</script>');
		}
	
		// Redirect to the same page
		redirect(base_url() . "UserDashboard/skills");
	}
	public function save_experience()
	{
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// exit;
		$ids = $this->input->post('delete_id');
		$work_type=$this->input->post('work_type');
		$organisation_name=$this->input->post('organisation_name');
		$website_url=$this->input->post('website_url');
		$work_from=$this->input->post('work_from');
		$work_to=$this->input->post('work_to');
		
		if (!empty($work_type) && !empty($organisation_name) && !empty($website_url) &&  !empty($work_from)  && !empty($work_to)) {
			$user_id = $this->session->userdata('user_id');
			if (!empty($ids)) {
				$response=$this->db->where_not_in('id', $ids)->delete('tbl_experience');
			}
			for ($i = 0; $i < count($work_type); $i++) {
							$data = array(
								'work_type' => $work_type[$i],
								'organisation_name' => $organisation_name[$i],
								'website_url' => $website_url[$i],
								'work_from' => $work_from[$i],
								'work_to' => $work_to[$i],
								'user_id' => $this->session->userdata('user_id'),
							);
				if (isset($ids[$i]) && !empty($ids[$i])) {
				$response=	$this->db->where('id', $ids[$i])->update('tbl_experience', $data);
				} else {
					$response=	$this->db->insert('tbl_experience', $data);
				}
			}
			// Check if any database operation failed
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
			} else {
				// Error message
				$this->session->set_flashdata('success', '<script>
					$(document).ready(function(){
					Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Something went wrong!",
					});
					});
					</script>');
			}
		} else {
			// Error message for invalid data
			$this->session->set_flashdata('success', '<script>
			$(document).ready(function(){
			Swal.fire({
			icon: "error",
			title: "Oops..",
			text: "Invalid data submitted. Please check your input!",
			});
			});
			</script>');
		}
	
		// Redirect to the same page
		redirect(base_url() . "UserDashboard/experience");
	}
	public function save_education()
	{
		
		$ids = $this->input->post('delete_id');
		$education_type=$this->input->post('education_type');
		$institute=$this->input->post('institute');
		$year=$this->input->post('year');
		$description=$this->input->post('description');
		
		
		if (!empty($education_type) && !empty($institute) && !empty($year) &&  !empty($description)){ 
			$user_id = $this->session->userdata('user_id');
			if (!empty($ids)) {
				$response=$this->db->where_not_in('id', $ids)->delete('tbl_qualification');
			}
			for ($i = 0; $i < count($education_type); $i++) {
							$data = array(
								'education_type' => $education_type[$i],
								'institute' => $institute[$i],
								'year' => $year[$i],
								'description' => $description[$i],
								'user_id' => $this->session->userdata('user_id'),
							);
				if (isset($ids[$i]) && !empty($ids[$i])) {
				$response=	$this->db->where('id', $ids[$i])->update('tbl_qualification', $data);
				} else {
					$response=	$this->db->insert('tbl_qualification', $data);
				}
			}
			// Check if any database operation failed
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
			} else {
				// Error message
				$this->session->set_flashdata('success', '<script>
					$(document).ready(function(){
					Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Something went wrong!",
					});
					});
					</script>');
			}
		} else {
			// Error message for invalid data
			$this->session->set_flashdata('success', '<script>
			$(document).ready(function(){
			Swal.fire({
			icon: "error",
			title: "Oops..",
			text: "Invalid data submitted. Please check your input!",
			});
			});
			</script>');
		}
	
		// Redirect to the same page
		redirect(base_url() . "UserDashboard/education");
	}
	public function about_us()
    {
    
            $user_id = $this->session->userdata('user_id');
            $file = $_FILES["user_cv"];
            $MyFileName = "";
            $userdata = $this->UM->get_aboutus_data();
            if (!empty($userdata) && isset($userdata->cv)) {
                $previous_cv_path =$userdata->cv;
                if (file_exists($previous_cv_path)) {
                    unlink($previous_cv_path);
                }
            }
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
                    $result = $error;
                }
            }
            //End: File upload code

            $array['introduction'] = $this->input->post('introduction');
			$array['designation'] = $this->input->post('designation');
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
		public function save_client2() {
			$this->load->library('upload'); 
		
			$config['upload_path'] = './assets/upload/logo';
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; 
			//$config['max_size'] = 2048; 
			$config['encrypt_name'] = true; 
			$this->upload->initialize($config);
		
			$urls = $this->input->post('url');
			$data = array();
			$response = false;
		
			// Loop through the uploaded files
			foreach ($urls as $key => $url) {
				// Check if file is uploaded
				if (!empty($_FILES['logo']['name'][$key])) {
					$_FILES['userfile']['name']     = $_FILES['logo']['name'][$key];
					$_FILES['userfile']['type']     = $_FILES['logo']['type'][$key];
					$_FILES['userfile']['tmp_name'] = $_FILES['logo']['tmp_name'][$key];
					$_FILES['userfile']['error']    = $_FILES['logo']['error'][$key];
					$_FILES['userfile']['size']     = $_FILES['logo']['size'][$key];
					
					// Upload the file
					if ($this->upload->do_upload('userfile')) {
						$upload_data = $this->upload->data();
						 $image_path = $upload_data['file_name']; 
						 var_dump($image_path);
						 $image_path = $this->input->post('existing_logo')[$key];
						if(empty($image_path)){
							$data = array(
								'url' => $url,
								'logo' => $image_path,
								'user_id' => $this->session->userdata('user_id'),
							);
							$response = $this->db->insert('tbl_client', $data);
						}else{
							$id = $this->input->post('id')[$key];
							$image_path = $this->input->post('existing_logo')[$key];
							//$existing_logo_path = $this->db->select('logo')->where('id', $id)->get('tbl_client')->row()->logo;
							//unlink('./assets/upload/logo/'.$existing_logo_path);
							
							// Update existing data
							$update_data = array(
								'url' => $url,
								'logo' => $image_path,
								'user_id' => $this->session->userdata('user_id'),
							);
							//$this->db->where('id', $id);
							$response = $this->db->where('id', $id)->update('tbl_client', $update_data);
						}
							
						
					}else{
						
						//Check if there's an existing logo ID for update
						
						    $id = $this->input->post('id')[$key];
							$image_path = $this->input->post('existing_logo')[$key];
							//$existing_logo_path = $this->db->select('logo')->where('id', $id)->get('tbl_client')->row()->logo;
							//unlink('./assets/upload/logo/'.$existing_logo_path);
							
							// Update existing data
							$update_data = array(
								'url' => $url,
								'logo' => $image_path,
								'user_id' => $this->session->userdata('user_id'),
							);
							//$this->db->where('id', $id);
							$response = $this->db->where('id', $id)->update('tbl_client', $update_data);
					

						$error = $this->upload->display_errors();
						echo "Failed to upload image: $error";
							
						}
					} 
				}
			
			
			
			// Set flash message based on response
			if ($response) {
				$this->session->set_flashdata('success', '<script>
					$(document).ready(function(){
						Swal.fire({
							icon: "success",
							title: "Success",
							text: "Your data saved successfully!",
						});
					});
				</script>');
			} else {
				$this->session->set_flashdata('error', '<script>
					$(document).ready(function(){
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "Something went wrong!",
						});
					});
				</script>');
			}
		redirect(base_url() . "UserDashboard/clients");
		}
		
		public function save_client() {
			// Check if form data is submitted
			if ($this->input->post()) {
				// Get form data
				$ids = $this->input->post('id');
				$logos = $this->input->post('logo');
				$existing_logos = $this->input->post('existing_logo');
				$urls = $this->input->post('url');
				$user_id = $this->session->userdata('user_id'); // Assuming user_id is stored in session
	
				// Loop through the submitted data
				foreach ($ids as $key => $id) {
					// Check if an existing logo is provided for updating
					if (!empty($existing_logos[$key])) {
						$update_data = array(
							'url' => $urls[$key],
							'logo' => $existing_logos[$key],
							'user_id' => $user_id
						);
						$this->db->where('id',$id)->update('tbl_client',$update_data);
					} else {
						// Handle new logo uploads
						if (!empty($logos['name'][$key])) {
							// Handle logo upload if provided
							// Example: $this->upload_logo($logos['name'][$key]);
							$upload_data = $this->upload_logo($logos['name'][$key]);
							$image_path = $upload_data['file_name'];
	
							// Prepare data for insertion
							$insert_data = array(
								'url' => $urls[$key],
								'logo' => $image_path,
								'user_id' => $user_id
							);
	
							// Insert new client data
							$this->db->insert($insert_data);
						}
					}
				}
	
				// Redirect to appropriate page after processing form data
				redirect('UserDashboard/clients');
			} else {
				// Handle form not being submitted
				// Redirect or show error message as needed
			}
		}
		private function upload_logo($file_name) {
			// Load the upload library
			$this->load->library('upload');
		
			// Define upload configuration
			$config['upload_path'] = './assets/upload/logo'; // Directory where you want to save the uploaded files
			$config['allowed_types'] = 'gif|jpg|jpeg|png'; // Allowed file types
			$config['encrypt_name'] = true; // Encrypt file name for security
		
			// Initialize upload library with the configuration
			$this->upload->initialize($config);
	
			// Perform the upload
			if ($this->upload->do_upload($file_name)) {
				// If upload is successful, return the upload data
				return $this->upload->data();
			} else {
				// If upload fails, return false
				$error = $this->upload->display_errors();
				echo "Failed to upload logo: $error";
				return false;
			}
		}
		public function delete_project($id){
			$response = $this->db->where('id',$id)->delete('tbl_project');   
			if($response){
				echo 1;
			}else{
				echo 0;
			}
		}
		public function add_project()
		{
		//    echo "<pre>";
		//    print_r($_POST);
		//    print_r($_FILES);
		//    echo "</pre>";
		//    exit;
				$user_id = $this->session->userdata('user_id');
				$file = $_FILES["faeture_image"];
				$MyFileName = "";
				if (strlen($file['name']) > 0) {
					$image = $file["name"];
					$config['upload_path'] = './assets/upload/Project_Image';
					$config['allowed_types'] = 'jpg|png|jpeg';
					//$config['max_size'] = '1024';  // Size in KB
					$config['file_name'] = $image;
					$this->load->library("upload", $config);
					$filestatus = $this->upload->do_upload('faeture_image');
					if ($filestatus == true) {
						$MyFileName = $this->upload->data('file_name');
						$array['faeture_image'] = $MyFileName;
	
					} else {
						$error = array('error' => $this->upload->display_errors());
					   
						$result = $error;
					}
				}
				//End: File upload code
	
				$array['project_name'] = $this->input->post('project_name');
				$array['working_role'] = $this->input->post('working_role');
				$array['description'] = $this->input->post('description');
				$array['project_url'] = $this->input->post('project_url');
				$array['user_id'] = $user_id;
				
					$response = $this->db->insert('tbl_project', $array);
				
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
					redirect(base_url() . "UserDashboard/projects");
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
					redirect(base_url() . "UserDashboard/projects");
				}
			}
}


