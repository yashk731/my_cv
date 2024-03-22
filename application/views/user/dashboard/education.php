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
                                <h6 class="mb-0 text-uppercase">Add Educational Details</h6>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-check form-switch text-end">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?=$user_data->is_education==1?'checked':""?> onchange="change_status(this,'is_education')">
                                </div>
                            </div>
                        </div><hr/>
                        <form action="<?=base_url()?>User/save_education" method="post">
                        <div id="repeater">
                            <!-- Repeater Heading -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0"></h5>
                                <button class="btn btn-outline-primary  repeater-add-btn px-4" title="Add More Colloum"><i class="bx bx-plus"></i></button>
                            </div>
                            <!-- Repeater Items -->
                          
                                <div class="items" data-group="eduction_data">
                                    <!-- Repeater Content -->
                                  
                                    <div class="item-content">
                                        <div class="mb-3">
                                            <label for="inputEmail1" class="form-label">Enter Qualification Type<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" data-name="education_type" placeholder="Example : MCA" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputEmail1" class="form-label">Enter School/College/Institute/University Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" data-name="institute" placeholder="Enter Your School/College/Institute/University Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputEmail1" class="form-label">Year of Passing<span class="text-danger">*</span></label>
                                            <input class="form-control" data-name="year"  type="month" id="">
                                        </div>
                                        <div class="mt-3">
                                            <label for="file" class="mb-2">Add Some Description <span class="text-danger">*</span> (Max 40 words Accepted)</label>
                                        </div>
                                        <div id="editor" required>
                                        <textarea data-name="description" id="">Hii Welcome</textarea>
                                        </div>
                                    </div>
                                    <!-- Repeater Remove Btn -->
                                    <div class="row mt-3">
                                        <div class="col-md-6 repeater-remove-btn">
                                            <button class="btn btn-outline-danger remove-btn px-4" title="Remove Colloum"><i class="bx bx-x"></i></button>
                                        </div>
                                    </div><hr>
                                </div>
                            </div>
                            
					
                            <div class="col-md-12 text-end">
                                <button class="btn btn-outline-secondary w-25" type="submit">Save</button>
                            </div>
                        </form>
                        </div>
				</div>
            </div>
        </div>
        <!--end page wrapper -->
        <?php include_once('includes/footer.php') ?>
        <script src="<?=base_url()?>admin-assets/plugins/form-repeater/repeater.js"></script>
        <script>
        /* Create Repeater */
        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });
    </script>
    </body>
</html>