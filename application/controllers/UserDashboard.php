<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
		$data['dashboard_data'] = $this->UM->dashboard_data($user_id);

		$user_data = $this->UM->get_user_data();
		$data['name_id'] = $user_data->first_name . "" . $user_data->last_name . "" . $user_data->id;
		//	$data['user_data']=$this->db->select('*')->where("CONCAT(first_name,last_name,id)",$name_id)->get('tbl_users')->row();

		$this->load->view('user/dashboard/dashboard', $data);
	}

	public function aboutUs()
	{

		$user_id = $this->session->userdata('user_id');
		$data['about_data'] = $this->UM->get_aboutus_data($user_id);
		$data['user_data'] = $this->UM->get_user_data();
		$data['about_count'] = $this->db->where(['user_id' => $user_id])->get('tbl_about')->num_rows();
		$this->load->view('user/dashboard/aboutUs', $data);
	}
	public function education()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user_data'] = $this->UM->get_user_data();
		$data['education_data'] = $this->UM->get_education_data();
		$data['education_count'] = $this->db->where(['user_id' => $user_id])->get('tbl_qualification')->num_rows();
		$this->load->view('user/dashboard/education', $data);
	}
	public function experience()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user_data'] = $this->UM->get_user_data();
		$data['experience_data'] = $this->UM->get_experience_data();
		$data['experience_count'] = $this->db->where(['user_id' => $user_id])->get('tbl_experience')->num_rows();
		$this->load->view('user/dashboard/experience', $data);
	}
	public function skills()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user_data'] = $this->UM->get_user_data();
		$data['skills_data'] = $this->UM->get_skill_data();
		$data['skills_count'] = $this->db->where(['user_id' => $user_id])->get('tbl_skills')->num_rows();
		$this->load->view('user/dashboard/skills', $data);
	}
	public function projects()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user_data'] = $this->UM->get_user_data();
		$data['project_data'] = $this->UM->getTotalProjectData();
		$this->load->view('user/dashboard/projects', $data);
	}
	public function clients()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user_data'] = $this->UM->get_user_data();
		$data['client_data'] = $this->UM->get_client_data();
		$data['client_count'] = $this->db->where(['user_id' => $user_id])->get('tbl_client')->num_rows();
		$this->load->view('user/dashboard/clients', $data);
	}

	public function myProfile()
	{
		$this->load->view('user/dashboard/myProfile');
	}
	public function changePassword()
	{
		$this->load->view('user/dashboard/changePassword');
	}
	public function demo()
	{
		$this->load->view('user/dashboard/test');
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
				$response = $this->db->where_not_in('id', $ids)->delete('tbl_skills');
			}
			for ($i = 0; $i < count($skills); $i++) {
				$data = array(
					'skill' => $skills[$i],
					'percantage' => $percentages[$i],
					'user_id' => $this->session->userdata('user_id'),
				);
				if (isset($ids[$i]) && !empty($ids[$i])) {
					$response = $this->db->where('id', $ids[$i])->update('tbl_skills', $data);
				} else {
					$response = $this->db->insert('tbl_skills', $data);
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
		$ids = $this->input->post('delete_id');
		$work_type = $this->input->post('work_type');
		$organisation_name = $this->input->post('organisation_name');
		$website_url = $this->input->post('website_url');
		$work_from = $this->input->post('work_from');
		$work_to = $this->input->post('work_to');

		if (!empty($work_type) && !empty($organisation_name) && !empty($website_url) && !empty($work_from) && !empty($work_to)) {
			$user_id = $this->session->userdata('user_id');
			if (!empty($ids)) {
				$response = $this->db->where_not_in('id', $ids)->delete('tbl_experience');
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
					$response = $this->db->where('id', $ids[$i])->update('tbl_experience', $data);
				} else {
					$response = $this->db->insert('tbl_experience', $data);
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
		$education_type = $this->input->post('education_type');
		$institute = $this->input->post('institute');
		$year = $this->input->post('year');
		$description = $this->input->post('description');


		if (!empty($education_type) && !empty($institute) && !empty($year) && !empty($description)) {
			$user_id = $this->session->userdata('user_id');
			if (!empty($ids)) {
				$response = $this->db->where_not_in('id', $ids)->delete('tbl_qualification');
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
					$response = $this->db->where('id', $ids[$i])->update('tbl_qualification', $data);
				} else {
					$response = $this->db->insert('tbl_qualification', $data);
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
		// print_r($_FILES);exit;
		$user_id = $this->session->userdata('user_id');
		$file = $_FILES["user_cv"];
		$MyFileName = "";
		$userdata = $this->UM->get_aboutus_data($user_id);
		if (!empty($userdata) && isset($userdata->cv)) {
			$previous_cv_path = $userdata->cv;
			if (file_exists($previous_cv_path)) {
				unlink($previous_cv_path);
			}
		}
		if (strlen($file['name']) > 0) {
			$image = $file["name"];
			$config['upload_path'] = './assets/upload/CV';
			$config['allowed_types'] = 'pdf';
			//$config['max_size'] = '1024';  // Size in KB
			$config['file_name'] = $image;
			$this->load->library("upload", $config);
			$filestatus = $this->upload->do_upload('user_cv');
			if ($filestatus == true) {
				$MyFileName = $this->upload->data('file_name');
				$array['cv'] = "assets/upload/CV/" . $MyFileName;

			} else {
				$error = array('error' => $this->upload->display_errors());
				//print_r($error );exit;
				$result = $error;
			}
		}
		//End: File upload code

		$array['introduction'] = $this->input->post('introduction');
		$array['designation'] = $this->input->post('designation');
		$array['carrier_objective'] = $this->input->post('carrier_objective');
		$array['user_id'] = $user_id;
		$userdata = $this->UM->get_aboutus_data($user_id);
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




	private function upload_logo($file_name)
	{
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
	public function delete_project($id)
	{
		$response = $this->db->where('id', $id)->delete('tbl_project');
		if ($response) {
			echo 1;
		} else {
			echo 0;
		}
	}
	public function add_project()
	{

		$user_id = $this->session->userdata('user_id');
		$file = $_FILES["faeture_image"];
		$MyFileName = "";
		if (strlen($file['name']) > 0) {
			$image = $file["name"];
			$config['upload_path'] = './assets/upload/Project_Image';
			$config['allowed_types'] = 'jpg|png|jpeg';
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
			echo 1;
		} else {
			echo 0;
		}
	}

	public function update_dashboard_status()
	{
		$user_id = $this->session->userdata('user_id');
		if ($this->input->post('experience') == 'experience') {
			$value = $this->input->post('total_experience') == 0 ? 0 : $this->input->post('total_experience');
			$key = 'total_experience';
		} elseif ($this->input->post('project') == 'project') {
			$value = $this->input->post('total_project') == 0 ? 0 : $this->input->post('total_project');
			$key = 'total_project';
		} elseif ($this->input->post('client') == 'client') {
			$value = $this->input->post('total_client') == 0 ? 0 : $this->input->post('total_client');
			$key = 'total_client';
		}
		$array = array(
			$key => $value,
			'user_id' => $user_id
		);
		$user_data = $this->db->where('user_id', $user_id)->get('tbl_dashboard')->row();
		if (!empty($user_data)) {
			$response = $this->db->where('user_id', $user_id)->update('tbl_dashboard', $array);
		} else {
			$response = $this->db->insert('tbl_dashboard', $array);
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
		}
		redirect(base_url() . "UserDashboard/dashboard");
	}
	public function change_dashboard_status()
	{
		$status = $this->input->post('status');
		$key = $this->input->post('key');

		$user_id = $this->session->userdata('user_id');
		$response = $this->db->where(['user_id' => $user_id])->update('tbl_dashboard', array($key => $status));
		if ($response) {
			echo 1;
		} else {
			echo 0;
		}
	}


	public function save_client_old()
	{
		$url = $this->input->post('url');
		$ids = $this->input->post('delete_id');
		$old_file_name = $this->input->post('existing_logo');

		if (!empty($url)) {
			$user_id = $this->session->userdata('user_id');

			if (!empty($ids)) {
				$this->db->where_not_in('id', $ids)->delete('tbl_client');
			}

			// Iterate through each URL and handle the corresponding logo file
			for ($i = 0; $i < count($url); $i++) {
				$data['url'] = $url[$i]; // Assign URL
				$data['user_id'] = $this->session->userdata('user_id');
				//   if(!empty($_FILES['existing_logo']['name'][$i]  && $ids)){

				//   }
				if (!empty($_FILES['logo']['name'][$i])) {
					$config = array(
						'upload_path' => './assets/upload/logo',
						'allowed_types' => 'jpg|gif|png|jpeg',
						'overwrite' => 1,
					);
					$this->load->library('upload', $config);

					$_FILES['userfile'] = array(
						'name' => $_FILES['logo']['name'][$i],
						'type' => $_FILES['logo']['type'][$i],
						'tmp_name' => $_FILES['logo']['tmp_name'][$i],
						'error' => $_FILES['logo']['error'][$i],
						'size' => $_FILES['logo']['size'][$i],
					);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('userfile')) {
						$uploadData = $this->upload->data();
						$data['logo'] = $uploadData['file_name']; // Assign logo filename
					} else {
						$error = $this->upload->display_errors();
						// Handle upload errors here
					}
				} else {
					// echo "<pre>";
					// print_r($old_file_name[$i]);
					// exit;
					// If no new logo uploaded, keep the existing logo
					if (isset($old_file_name[$i])) {
						$data['logo'] = $old_file_name[$i];
					}
				}


				// Insert data into tbl_client table
				if (isset($ids[$i]) && !empty($ids[$i])) {
					$response = $this->db->where('id', $ids[$i])->update('tbl_client', $data);
				} else {
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
				}
			}
		}
		redirect(base_url() . "UserDashboard/clients");
	}
	public function save_client()
	{
		$url = $this->input->post('url');
		$ids = $this->input->post('delete_id');
		$old_file_name = $this->input->post('existing_logo');
		if (!empty($url)) {
			$user_id = $this->session->userdata('user_id');
			if (!empty($ids)) {
				$this->db->where_not_in('id', $ids)->delete('tbl_client');
			}

			foreach ($url as $key => $value) {
				$data['url'] = $value; // Assign URL
				$data['user_id'] = $user_id;

				// Check if there's a new logo uploaded
				if (!empty($_FILES['logo']['name'][$key])) {
					// Upload the new logo
					$config = array(
						'upload_path' => './assets/upload/logo',
						'allowed_types' => 'jpg|gif|png|jpeg',
						'overwrite' => 1,
					);
					$this->load->library('upload', $config);

					$_FILES['userfile'] = array(
						'name' => $_FILES['logo']['name'][$key],
						'type' => $_FILES['logo']['type'][$key],
						'tmp_name' => $_FILES['logo']['tmp_name'][$key],
						'error' => $_FILES['logo']['error'][$key],
						'size' => $_FILES['logo']['size'][$key],
					);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('userfile')) {
						$uploadData = $this->upload->data();
						$data['logo'] = $uploadData['file_name']; // Assign new logo filename
					} else {
						$error = $this->upload->display_errors();
						// Handle upload errors here
					}
				} else {
					// If no new logo uploaded, retain the existing logo
					if (isset($old_file_name[$key])) {
						$update_data['logo'] = $old_file_name[$key];
					}
				}

				// Insert data into tbl_client table
				if (isset($ids[$key]) && !empty($ids[$key])) {
					$response = $this->db->where('id', $ids[$key])->update('tbl_client', $update_data);
				} else {
					$response = $this->db->insert('tbl_client', $data);
				}

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
			}
		}
		redirect(base_url() . "UserDashboard/clients");
	}

}


