<!doctype html>
<html lang="en" class="dark-theme">
    <head>
        <?php include_once('includes/main-head.php') ?>
        <style>
            .imageBox{background-image:url('<?=base_url()?>admin-assets/images/pro-pic.jpg');}
        </style>
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
                                <form action="" >
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h6 class="mb-0 text-uppercase">Total Experiance</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check form-switch text-end">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            </div>
                                        </div>
                                    </div><hr/>
                                    <input type="text" class="form-control" placeholder="Example : 3 years" required>
                                    <button class="btn btn-outline-secondary mt-3" style="float: right;">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bdr-white">
                            <div class="card-body">
                                <form action="" >
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="mb-0 text-uppercase">Total Projects</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check form-switch text-end">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            </div>
                                        </div>
                                    </div><hr/>
                                    <input type="text" class="form-control" placeholder="Example : 3" required>
                                    <button class="btn btn-outline-secondary mt-3" style="float: right;">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bdr-white">
                            <div class="card-body">
                                <form action="" >
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6 class="mb-0 text-uppercase">Total Clients</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check form-switch text-end">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                            </div>
                                        </div>
                                    </div><hr/>
                                    <input type="text" class="form-control" placeholder="Example : 3" required>
                                    <button class="btn btn-outline-secondary mt-3" style="float: right;">Save</button>
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
                                        <div class="action">
                                            <input type="file" id="file" class="form-control mb-3 mt-3">
                                            <input class="btn btn-outline-primary" type="button" id="btnCrop" value="Crop" style="float: right" onclick="showDiv()">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <form action="">
                                        <div class="cropped"></div>
                                        <button class="btn btn-outline-secondary mt-3 mr-3" id="btnSave" style="float: right;display:none;">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
        <?php include_once('includes/footer.php') ?>
        <script src="<?=base_url()?>admin-assets/js/img-croper.js"></script>
    </body>
</html>