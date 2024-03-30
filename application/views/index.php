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
        .form-control {
            opacity: 50%;
        }

        .btn-primary {
            background-color: #6d6d6e;
            border-color: #6d6d6e;
        }

        .btn-primary:hover {
            background-color: black;
            border-color: black;
        }

        a {
            color: #6d6d6e;
        }

        a:hover {
            color: black;
        }
    </style>
</head>

<body class="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="aligns-items-center justify-content-center card text-center mt-5"
                    style="background-image: url('admin-assets/images/login-bg.png');">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-3 text-start mb-4">
                                <img src="logo/logo-black.png" class="w-100" alt="" />
                            </div>
                            <div class="col-md-12 text-start">
                                <div class="mb-4">
                                    <h5 class="mb-0">Please log in to your account</h5>
                                </div>
                                <form class="g-3" action="<?= base_url() ?>Login/ProcessLoginUser" method="post"
                                    id="login_form_id">
                                    <div class="col-md-6 mb-3">
                                        <label for="inputEmailAddress" class="form-label">Email<span
                                                class="text-danger">*<span></label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Enter Email Id." required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="inputChoosePassword" class="form-label">Password<span
                                                class="text-danger">*<span></label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" name="password" class="form-control border-end-0"
                                                required id="password" placeholder="Enter Password"> <a
                                                href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end mb-3"><a
                                            href="authentication-forgot-password.html">Forgot Password ?</a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="text-center ">
                                            <p class="mb-0">Don't have an account yet? <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#userRegistration">Sign up
                                                    here</a>
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
                    <form method="post" class="row g-3" id="form_id" name="form_id">
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">Firsth Name<span
                                    class="text-danger">*<span></label>
                            <input type="text" class="form-control" id="firstName" name="firstName"
                                placeholder="Enter Your First Name">
                            <span id="firstname_error" class="error_msg"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">Last Name<span
                                    class="text-danger">*<span></label>
                            <input type="text" class="form-control" id="lastName" name="lastName"
                                placeholder="Enter Your Last Name" required>
                            <span id="lastname_error" class="error_msg"></span>
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">Mobile No.<span
                                    class="text-danger">*<span></label>
                            <input type="number" class="form-control" id="mobileNo" name="mobileNo"
                                placeholder="Enter Your Mobile No." required>
                            <span id="mobileno_error" class="error_msg"></span>
                        </div> -->
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">Mobile No.<span
                                    class="text-danger">*<span></label>
                            <!-- <input type="number" class="form-control" id="mobileNo" placeholder="Enter Your Mobile No." require> -->
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">+91</button>
                                <ul class="dropdown-menu">
                                    <?php
                                    foreach ($countries as $country) {
                                        ?>
                                        <li><a class="dropdown-item" href="#">
                                                <?= $country->phone_code ?>
                                            </a></li>
                                    <?php } ?>
                                    <li><a class="dropdown-item" href="#">+60</a></li>
                                    <li><a class="dropdown-item" href="#">+78</a></li>
                                </ul>
                                <input type="number" class="form-control" id="mobileNo" name="mobileNo"
                                    placeholder="Enter Your Mobile No." required>
                                <span id="mobileno_error" class="error_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">Email<span
                                    class="text-danger">*<span></label>
                            <input type="email" class="form-control" id="emailId" name="emailId"
                                placeholder="Enter Your Email Id." required>
                            <span id="email_error" class="error_msg"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">Country<span
                                    class="text-danger">*<span></label>
                            <select class="form-select" id="country" name="country">
                                <option selected="" disabled="" value="">Select Country ...</option>
                                <?php
                                foreach ($countries as $country) {
                                    ?>
                                    <option value="<?= $country->id ?>">
                                        <?= $country->name ?>
                                    </option>
                                <?php } ?>

                            </select>
                            <span id="country_error" class="error_msg"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">State<span
                                    class="text-danger">*<span></label>
                            <select class="form-select" id="state" name="state">
                                <option selected="" disabled="" value="">Select State</option>

                            </select>
                            <span id="state_error" class="error_msg"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">City<span
                                    class="text-danger">*<span></label>
                            <select class="form-select" id="city" name="city" required>
                                <option selected="" disabled="" value="">Select City</option>

                            </select>
                            <span id="city_error" class="error_msg"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmailAddress" class="form-label">PIN Code<span
                                    class="text-danger">*<span></label>
                            <input type="number" class="form-control" id="pincode" name="pincode"
                                placeholder="Enter PIN Code">
                            <span id="pincode_error" class="error_msg"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="inputChoosePassword" class="form-label">Password<span
                                    class="text-danger">*<span></label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="password_signup" name="password_signup"
                                    placeholder="Enter Password"> <a href="javascript:;"
                                    class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                <span id="password_error" class="error_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputChoosePassword" class="form-label">Confirm Password<span
                                    class="text-danger">*<span></label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" id="confirmpassword"
                                    name="confirmpassword" placeholder="Confirm Password"> <a href="javascript:;"
                                    class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" id="register_button">Save</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center ">
                                <p class="mb-0">Already have an account ? <a href="#" data-bs-dismiss="modal"
                                        aria-label="Close"> Login in here</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ========================================== -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
       
    <!-- jqery validate cdn -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <!--sweetalert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="admin-assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <!-- <script src="admin-assets/js/jquery.min.js"></script> -->
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

    <script>
        $(document).ready(function () {
            $('#form_id').validate({
                rules: {
                    firstName: "required",
                    lastName: "required",
                    country: "required",
                    state: "required",
                    city: "required",
                    mobileNo: {
                        required: true,
                        digits: true,
                        rangelength: [10, 10],
                        //	mobileCheck: true
                    },
                    emailId: {
                        required: true,
                        email: true,
                        //emailCheck:true
                    },
                    pincode: {
                        required: true,
                        number: true,
                        rangelength: [6, 6],
                        //pincodeCheck:true
                    },
                    password_signup: {
                        required: true,
                        rangelength: [6, 6]
                    },
                    confirmpassword: {
                        required: true,
                        equalTo: '#password_signup'
                    },
                },
                messages: {
                    firstName: {
                        required: "Enter First Name",
                    },
                    lastName: {
                        required: "Enter Last Name",
                    },
                    mobileNo: {
                        required: "Enter Mobile No.",
                    },
                    emailId: {
                        required: "Enter Email",
                    },
                    pincode: {
                        required: "Enter Pincode",
                    },
                    password: {
                        required: "Enter Password",
                    },
                    country: {
                        required: "Enter Country",
                    },
                    state: {
                        required: "Enter State",
                    },
                    city: {
                        required: "Enter City",
                    },
                    confirmpassword: {
                        required: "Enter Confirm Password",
                    }
                },
                submitHandler: function (form, e) {

                    e.preventDefault();
                    //alert(form);
                    let first_name = $('#firstName').val();
                    let last_name = $('#lastName').val();
                    let mobile_no = $('#mobileNo').val();
                    let email_id = $('#emailId').val();
                    let country = $('#country').val();
                    let state = $('#state').val();
                    let city = $('#city').val();
                    let pincode = $('#pincode').val();
                    let password = $('#password_signup').val();
                   
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>/User/user_register",
                        data: {
                            first_name: first_name,
                            last_name: last_name,
                            mobile_no: mobile_no,
                            email_id: email_id,
                            country: country,
                            state: state,
                            city: city,
                            pincode: pincode,
                            password: password
                        },
                        success: function (response) {
                            if (response == 1) {
                                $('#form_id')[0].reset();
                                $('#userRegistration').modal('hide');
                                Swal.fire({
                                    title: "Success!",
                                    text: "You are register successfully!",
                                    icon: "success"
                                });
                            } else if (response == 2) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Email already exists!",
                                });
                            } else if (response == 3) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Mobile no. already exists!",
                                });
                            } else if (response == 4) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Email and Mobile no. already exists!",
                                });
                            } else if (response == 5) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Please fill all field!",
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong",
                                });
                            }
                        }
                    });

                }
            });
            $('#login_form_id').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        //emailCheck:true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Enter Email Id",
                    },
                    password: {
                        required: "Enter Password",
                    }
                },
                submitHandler: function (form, e) {
                    e.preventDefault();
                    let email = $('#email').val();
                    let password = $('#password').val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>/Login/ProcessLoginUser",
                        data: {
                            email: email,
                            password: password
                        },
                        success: function (response) {
                            if (response == 1) {
                                $('#login_form_id')[0].reset();
                                // Swal.fire({
                                //     title: "Congratulations!",
                                //     text: " You are login succesfully !",
                                //     icon: "success",
                                // });
                                window.location = "<?= base_url() ?>UserDashboard";
                            }
                            else if (response == 2) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Invalid Password!",
                                });
                            } else if (response == 3) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Invalid Id and Password",
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong",
                                });
                            }
                        }
                    });

                }
            });

        });
        $(document).ready(function () {
            $('#country').on('change', function () {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url()?>/User/get_state',
                        data: {
                            country_id: country_id
                        },
                        success: function (html) {
                            $('#state').html(html);
                            $('#city').html('<option value="">Select state first</option>');
                        }
                    });
                } else {
                    $('#state').html('<option value="">Select country first</option>');
                    $('#city').html('<option value="">Select state first</option>');
                }
            });

            $('#state').on('change', function () {
                var country_id = $('#country').val();
                var state_id = $(this).val();
                if (state_id) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url() ?>User/get_city',
                        data: {
                            state_id: state_id,
                            country_id: country_id
                        },
                        success: function (html) {
                            $('#city').html(html);
                        }
                    });
                } else {
                    $('#city').html('<option value="">Select state first</option>');
                }
            });
        });
    </script>

</body>
<?= $this->session->flashdata('error') ?>
<?= $this->session->flashdata('success') ?>


</html>