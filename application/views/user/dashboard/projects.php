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
                                <h6 class="mb-0 text-uppercase">Add Your Projects</h6>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-check form-switch text-end">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?=$user_data->is_project==1?'checked':""?> onchange="change_status(this,'is_project')">
                                </div>
                            </div>
                        </div><hr/>
                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="pill" href="#pills-addProject" role="tab" aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-plus font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Add Project</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="pill" href="#pills-viewProject" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-list-ul font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">View Projects</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="pill" href="#pills-editProject" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-edit font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Edit Project</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent" >
                            <div class="tab-pane fade show active" id="pills-addProject" role="tabpanel">
                                <form id="yourFormId" method="post" enctype= multipart/form-data>
                                    <div class="items" data-group="test">
                                        <!-- Repeater Content -->
                                        <div class="row item-content">
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Project Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter Project Name" required  id="project_name" name="project_name">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Project URL</label>
                                                <input type="url" name="project_url" class="form-control" id="project_url" placeholder="Enter Project URL" >
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Your Working Role <span class="text-danger">*</span></label>
                                                <input type="text" name="working_role"  class="form-control" id="working_role" placeholder="Example : Project Manager" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Upload Feature Image<span class="text-danger">*</span> (Image must be in 330 × 192 px )</label>
                                                <input class="form-control" type="file" id="faeture_image" name="faeture_image" accept="image/*"  required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Project Description<span class="text-danger">*</span> (Max 40 words Accepted)</label>
                                                <textarea class="form-control" name="description" aria-label="With textarea" style="height: 110px;" required></textarea>
                                            </div>
                                            <div class="col-md-12 text-end">
                                                <button type="submit" class="btn btn-outline-secondary w-25" id="submitButton">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-viewProject" role="tabpanel">
                                <div class="table-responsive updated-container">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Feature Image</th>
                                                <th>Project Name</th>
                                                <th>Project URL</th>
                                                <th>Working Role</th>
                                                <th>Project Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach($project_data as $row)
                                            {
                                                if($row->project_url!=null || $row->project_url!=""){
                                                    $project_url=$row->project_url;
                                                }else{
                                                    $project_url="___";
                                                }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    
                                                    if(!empty($row->faeture_image)){?>
                                                    <img src="<?=base_url()?>assets/upload/Project_Image/<?=$row->faeture_image?>" alt="" height="100px" width="100px">
                                                <?php }else{?>
                                                    <img src="<?=base_url()?>admin-assets/images/login-images/login-cover.svg" alt="" >
                                                    <?php }?>
                                                </td>
                                                <td><?=$row->project_name?></td>
                                              <td><?=$project_url?></td>
                                              <td><?=$row->working_role?></td>
                                                <td><?=$row->description?></td>
                                                <td>
                                   
                                                    <button class="btn btn-outline-success " title="Edit Project" data-id="<?=$row->id?>"><i class="bx bx-edit"></i></button>
                                                    <button class="btn btn-outline-success delete-btn" title="Delete Project"  onclick="delete_project(<?=$row->id?>)">Delete</button>
                                                    <!-- <a class="btn btn-outline-danger" href="<?=base_url()?>/User/delete_project/<?=$row->id?>"    onclick="return confirm('Are you sure you want to delete this Projects?');" title="Delete Project"><i class="bx bx-trash"></i>Delete</a> -->
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="pills-editProject" role="tabpanel" style="display:none;">
                                <form action="">
                                    <div class="items" data-group="test">
                                        <!-- Repeater Content -->
                                        <div class="row item-content">
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Project Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter Project Name" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Project URL</label>
                                                <input type="url" class="form-control" placeholder="Enter Project URL" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Your Working Role <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Example : Project Manager" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Upload Feature Image<span class="text-danger">*</span> (Image must be in 330 × 192 px )</label>
                                                <input class="form-control"  type="file" id="" accept="image/*"  required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="inputEmail1" class="form-label">Project Description<span class="text-danger">*</span> (Max 40 words Accepted)</label>
                                                <textarea class="form-control" aria-label="With textarea" style="height: 110px;" required></textarea>
                                            </div>
                                            <div class="col-md-12 text-end">
                                                <button class="btn btn-outline-secondary w-25">Save</button>
                                            </div>
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
        <!--end page wrapper -->
      
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
        <script>
        function delete_project(id){
            var activeTabId = $('#pills-viewProject');
            var confirmation = confirm("Are you sure you want to delete this project?");
            if(confirmation){
            $.ajax({
                url: '<?=base_url('UserDashboard/delete_project/')?>' + id, 
                type: 'POST',
                success: function(response) {
                    if(response==1){
                        $('.updated-container').load(window.location.href + ' .updated-container', function() {
                        $(activeTabId).tab('show');
                    });
                    }
                },
                error: function(xhr, status, error)  {
                    console.error(xhr.responseText);
                }
            });
            }
        }
        $(document).ready(function(){
    // Attach click event handler to the button
    $('#yourFormId').submit(function(e){
        e.preventDefault(); // Prevent default form submission
        
       
    });
});
        
$('#submitButton').click(function(){
  
        submitForm();
    });

      function submitForm(){
       
      //  var nextTabId = '#pills-viewProject'; 
            
            var formData = new FormData($('#yourFormId')[0]); 
            $.ajax({
                url: '<?= base_url() ?>UserDashboard/add_project',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    alert(response);
                    if(response==1){
                    $('#pills-viewProject').tab('show');
                    }
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                }
            });
        }
</script>
<?php include_once('includes/footer.php') ?>