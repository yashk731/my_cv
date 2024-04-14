<!doctype html>
<html lang="en" class="dark-theme">
    <head>
        <?php include_once('includes/main-head.php') ?>
        <style>
            .imageBox{background-image:url('<?=base_url()?>admin-assets/images/pro-pic.jpg');}
            
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
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
                <div class="row">
                    
                <div class="col-md-4">
                        <div class="card bdr-white">
                            <div class="card-body">
                                <form action="<?=base_url()?>UserDashboard/update_dashboard_status"  method="post">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h6 class="mb-0 text-uppercase">Total Experiance</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check form-switch text-end">
                                                <input class="form-check-input" type="checkbox"<?=$dashboard_data->is_experience==1?'checked':""?>  id="flexSwitchCheckChecked" onchange="change_dashboard_status(this,'is_experience','<?=$dashboard_data->total_experience?>')">
                                            </div>
                                        </div>
                                    </div><hr/>

                                    <input type="hidden" class="form-control"  name="experience" value="experience">
                                    <input type="text" class="form-control"  onkeypress="return onlyNumbers(event)" placeholder="Example : 3 years" required name="total_experience" value="<?=isset($dashboard_data->total_experience)?$dashboard_data->total_experience:""?>">
                                    <button  type="submit" class="btn btn-outline-secondary mt-3" style="float: right;"><?=!empty($dashboard_data->total_experience)?'Update':'Save'?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bdr-white">
                            <div class="card-body">
                            <form action="<?=base_url()?>UserDashboard/update_dashboard_status"  method="post">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="mb-0 text-uppercase">Total Projects</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check form-switch text-end">
                                            <input  class="form-check-input" type="checkbox" <?=$dashboard_data->is_project==1?'checked':""?>  id="flexSwitchCheckChecked" onchange="change_dashboard_status(this,'is_project','<?=$dashboard_data->total_project?>')">
                                            </div>
                                        </div>
                                    </div><hr/>
                                    <input type="hidden" class="form-control"  name="project" value="project">
                                
                                    <input type="text" class="form-control"   onkeypress="return onlyNumbers(event)" placeholder="Example : 3 years" required name="total_project" value="<?=isset($dashboard_data->total_project)?$dashboard_data->total_project:""?>">
                                    <button class="btn btn-outline-secondary mt-3" style="float: right;"><?=!empty($dashboard_data->total_project)?'Update':'Save'?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bdr-white">
                            <div class="card-body">
                            <form action="<?=base_url()?>UserDashboard/update_dashboard_status"  method="post">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="mb-0 text-uppercase">Total Clients</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check form-switch text-end">
                                            <input class="form-check-input" type="checkbox" <?=$dashboard_data->is_client==1?'checked':""?>  id="flexSwitchCheckChecked" onchange="change_dashboard_status(this,'is_client','<?=$dashboard_data->total_client?>')">
                                            </div>
                                        </div>
                                    </div><hr/>
                                    <input type="hidden" class="form-control"  name="client" value="client">
                                    <input type="text" class="form-control" required  onkeypress="return onlyNumbers(event)" name="total_client" value="<?=isset($dashboard_data->total_client)?$dashboard_data->total_client:""?>">

                                    <button class="btn btn-outline-secondary mt-3" style="float: right;"><?=!empty($dashboard_data->total_client)?'Update':'Save'?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h6 class="mb-0 text-uppercase">Upload Your Profile Pic.</h6>
                                    </div><hr>
                                    
                                    <div class="col-md-5 text-center">

                                
                                        <div class="imageBox">
                                            <div class="thumbBox"></div>
                                            <div class="spinner" style="display: none">Loading...</div>
                                        </div>
                                    <form action="<?=base_url()?>user/upload_cropped_image" method="post" enctype = "multipart/form-data">
                                        <div class="action">
                                            <input type="file" id="file" name="image" class="form-control mb-3 mt-3">
                                            <input class="btn btn-outline-primary" type="button" id="btnCrop" value="Crop" style="float: right" onclick="showDiv()">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <!-- <form action="<?=base_url()?>save_user_img" method="post" enctype = "multipart/form-data"> -->
                                        <div class="cropped"></div>
                                        <input type="hidden" id="croppedImage" name="cropped_image" class="form-control mb-3 mt-3">
                                        <button class="btn btn-outline-secondary mt-3 mr-3" id="btnSave" style="float: right;display:none;">Save</button>
                                        <!-- </form> -->
                                    </div>
</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
       
        <script src="<?=base_url()?>admin-assets/js/img-croper.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
        <script>
           document.addEventListener('DOMContentLoaded', function () {
            // Get the image element
            var image = document.getElementById('image');

            // Initialize Cropper.js
            var cropper = new Cropper(image, {
                aspectRatio: 16 / 9, // You can adjust the aspect ratio as needed
                crop: function(event) {
                    // Optional callback function when crop selection changes
                }
            });

            // Add event listener to the crop button
            document.getElementById('btnCrop').addEventListener('click', function () {
                // Get the cropped data as a base64-encoded string
                var croppedDataUrl = cropper.getCroppedCanvas().toDataURL();

                // Send the cropped image data to the server
                saveCroppedImage(croppedDataUrl);
            });
        });

        // Function to send cropped image data to the server
        function saveCroppedImage(croppedDataUrl) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo site_url("user/upload"); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the server if needed
                    console.log('Image saved successfully');
                }
            };
            xhr.send('image=' + encodeURIComponent(croppedDataUrl));
        } -->
            </script>
             <?php include_once('includes/footer.php') ?>
          
