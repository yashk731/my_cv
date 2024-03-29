<!doctype html>
<html lang="en" class="dark-theme">
    <head>
        <?php include_once('includes/main-head.php') ?>
    </head>
    <body>
        <!--sidebar wrapper -->
        <?php include_once('includes/sidebar.php') ?>
        <!--end sidebar wrapper -->
        <!--start header -->
        <?php include_once('includes/header.php') ?>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="card">
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0 text-uppercase">Add About Us</h6>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-check form-switch text-end">
                                    <input class="form-check-input" type="checkbox" <?=$user_data->is_about_us==1?'checked':""?> id="flexSwitchCheckChecked" onchange="change_status(this,'is_about_us')">
                                </div>
                            </div>
                        </div><hr/>
                        <form action="<?=base_url()?>UserDashboard/about_us" method="post" enctype= multipart/form-data>
                            <div class="mt-3">
                            
                                <label for="file" class="mb-2">Add Your Introduction <span class="text-danger">*</span> (Only 100 words Accepted)</label>
                                <input type="text" name="introduction" minlength="10" maxlength="100" class="form-control" value="<?=!empty($about_data->introduction)?$about_data->introduction:""?>">
                            </div>
                            <div class="mt-3">
                            
                                <label for="file" class="mb-2">Designation <span class="text-danger">*</span></label>
                                <input type="text" name="designation" minlength="10"  class="form-control" value="<?=!empty($about_data->designation)?$about_data->designation:""?>">
                            </div>
                            <div class="mt-3">
                            
                            <label for="file" class="mb-2">Carrier Objective <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="carrier_objective" aria-label="With textarea" style="height: 110px;" required><?=$about_data->carrier_objective?></textarea>
                        </div>
                            

                            <!-- <div id="editor" required>
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br></p>
                            </div> -->
                            <div class="mt-3">
                                <label for="file" class="mb-2">Upload Your CV/Resume<span class="text-danger">*</span> (Only .pdf Accepted)</label>
                                <input type="file" name="user_cv" id="user_cv" class="form-control" accept = "application/pdf" >
                                <br/>
                                <?php
                                if(!empty($about_data->cv))
                                {
                                ?>
                                <a href="<?=base_url()?><?=$about_data->cv?>" target="_blank">View Pdf</a>
                                <?php }else{?>
                                        <h6>No PDF Added</h6>
                                    <?php }?>
                            </div>
                            <div class="col-md-12 text-end">
                                <?php
                                if(!empty($about_data)){
                                ?>
                                <button class="btn btn-outline-secondary mt-4 w-25" type="submit">Update</button>
                                <?php }else{?>
                                    <button class="btn btn-outline-secondary mt-4 w-25" type="submit">Save</button>
                                    <?php }?>

                            </div>
                        </form>
					</div>
				</div>
            </div>
        </div>
      
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
        <!--end page wrapper -->
      
        <script>

            function checkPDFAvailability() {
    $.ajax({
        url: "<?php echo base_url('user/check_pdf_availability'); ?>",
        type: "GET",
       /// dataType: "json",
        success: function(response) {
            console.log(response.pdf_available);
            if (response==1) {
                $('#user_cv').prop('required', false);
            } else {
                $('#user_cv').prop('required', true);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
$(document).ready(function() {
   
            checkPDFAvailability();
        });
            </script>
        <?php include_once('includes/footer.php') ?>
