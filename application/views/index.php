<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="logo/favicon.png" type="image/png" />
	<!--plugins-->
	<link href="admin-assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="admin-assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="admin-assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="admin-assets/css/pace.min.css" rel="stylesheet" />
	<script src="admin-assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="admin-assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="admin-assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="admin-assets/css/app.css" rel="stylesheet">
	<link href="admin-assets/css/icons.css" rel="stylesheet">
	<title>easyprofile - user login</title>
	<style>
		.form-control {opacity:50%;}
		.btn-primary {background-color:#6d6d6e;border-color:#6d6d6e;}
		.btn-primary:hover {background-color:black;border-color:black;}
		a{color:#6d6d6e;}
		a:hover{color:black;}
	</style>
</head>

<body class="">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 mt-5">
				<div class="aligns-items-center justify-content-center card text-center mt-5" style="background-image: url('admin-assets/images/login-bg.png');">
					<div class="card-body">
						<div class="row ">
							<div class="col-md-3 text-start mb-4">
								<img src="logo/logo-black.png" class="w-100" alt="" />
							</div>
							<div class="col-md-12 text-start">
								<div class="mb-4">
									<h5 class="mb-0">Please log in to your account</h5>
								</div>
								<form class="g-3" action="user/dashboard/">
									<div class="col-md-6 mb-3">
										<label for="inputEmailAddress" class="form-label">Email<span class="text-danger">*<span></label>
										<input type="email" class="form-control" id="inputEmailAddress" placeholder="Enter Email Id." require>
									</div>
									<div class="col-md-6 mb-3">
										<label for="inputChoosePassword" class="form-label">Password<span class="text-danger">*<span></label>
										<div class="input-group" id="show_hide_password" >
											<input type="password" class="form-control border-end-0" require id="inputChoosePassword"  placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
										</div>
									</div>
									<div class="col-md-6 text-end mb-3">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
									</div>
									<div class="col-md-6 mb-3">
										<div class="d-grid">
											<button type="submit" class="btn btn-primary">Login</button>
										</div>
									</div>
									<div class="col-md-6 mb-3">
										<div class="text-center ">
											<p class="mb-0">Don't have an account yet? <a href="#" data-bs-toggle="modal" data-bs-target="#userRegistration">Sign up here</a>
											</p>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!-- ==========Registration Modal============== -->
<div class="modal fade" id="userRegistration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-md-6">
						<img src="logo/logo-black.png" class="w-100" alt="" />
					</div>
				</div>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="text-center mb-4">
					<h5 class="mb-0">Please Register Your Self !</h5>
				</div>
				<form class="row g-3" action="">
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">First Name<span class="text-danger">*<span></label>
						<input type="text" class="form-control" id="firstName" placeholder="Enter Your First Name" required>
					</div>
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">Last Name<span class="text-danger">*<span></label>
						<input type="text" class="form-control" id="lastName" placeholder="Enter Your Last Name" require>
					</div>
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">Mobile No.<span class="text-danger">*<span></label>
						<!-- <input type="number" class="form-control" id="mobileNo" placeholder="Enter Your Mobile No." require> -->
						<div class="input-group mb-3">
						<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">+91</button>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="#">+1</a></li>
							<li><a class="dropdown-item" href="#">+60</a></li>
							<li><a class="dropdown-item" href="#">+78</a></li>
						</ul>
						<input type="text" class="form-control" aria-label="Text input with dropdown button">
						</div>
					</div>
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">Email<span class="text-danger">*<span></label>
						<input type="email" class="form-control" id="emailId" placeholder="Enter Your Email Id." require>
					</div>
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">Country<span class="text-danger">*<span></label>
						<select class="form-select" id="country" name="country" require>
							<option selected="" disabled="" value="">Choose...</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">State<span class="text-danger">*<span></label>
						<select class="form-select" id="state" name="state" require>
							<option selected="" disabled="" value="">Choose...</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">City<span class="text-danger">*<span></label>
						<select class="form-select" id="city" name="city" require>
							<option selected="" disabled="" value="">Choose...</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
					<div class="col-md-6">
						<label for="inputEmailAddress" class="form-label">PIN Code<span class="text-danger">*<span></label>
						<input type="number" class="form-control" id="pinCode" placeholder="Enter PIN Code">
					</div>
					<div class="col-md-6">
						<label for="inputChoosePassword" class="form-label">Password<span class="text-danger">*<span></label>
						<div class="input-group" id="show_hide_password">
							<input type="password" class="form-control border-end-0" id="password" value="12345678" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
						</div>
					</div>
					<div class="col-md-6">
						<label for="inputChoosePassword" class="form-label">Confirm Password<span class="text-danger">*<span></label>
						<div class="input-group" id="show_hide_password">
							<input type="password" class="form-control border-end-0" id="confirmPassword" value="12345678" placeholder="Confirm Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
						</div>
					</div>

					<div class="col-12">
						<div class="d-grid">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
					<div class="col-12">
						<div class="text-center ">
							<p class="mb-0">Already have an account ? <a href="#" data-bs-dismiss="modal" aria-label="Close"> Login in here</a>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- ========================================== -->


	<!-- Bootstrap JS -->
	<script src="admin-assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="admin-assets/js/jquery.min.js"></script>
	<script src="admin-assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="admin-assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="admin-assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="admin-assets/js/app.js"></script>
</body>
</html>