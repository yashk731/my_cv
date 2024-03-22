		<!--start overlay-->
        <div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button-->
		  <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2024. All right reserved. <a href="#">easyprofile.in</a></p>
		</footer>
	</div>

	<!--end wrapper-->

	<!-- Bootstrap JS -->
	<script src="<?=base_url()?>admin-assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?=base_url()?>admin-assets/js/jquery.min.js"></script>
	<script src="<?=base_url()?>admin-assets/js/index.js"></script>
	<script src="<?=base_url()?>admin-assets/js/quill.js"></script>
	<!--app JS-->
	<script src="<?=base_url()?>admin-assets/js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

	 <!--sweetalert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
	<?= $this->session->flashdata('error') ?>
<?= $this->session->flashdata('success') ?>

	<script>
		new PerfectScrollbar(".app-container")
	</script>
	<script>
		function logoutuser(urll) {
            event.preventDefault();
            const url = urll;
            Swal.fire({
			icon: "warning",
			title: "Are you sure",
			text: "You want to log out!",
			buttons: ["Cancel", "Yes!"],
            }).then(function (value) {
                if (value) {
                    window.location.href = url;
                }
            });
        }
		</script>
	<script>
		var quill = new Quill('#editor', {
		  theme: 'snow'
		});
	</script>
	<script>
		function copytoClipboard() {
		// Get the text field
		var copyText = document.getElementById("copytoClipboard");

		// Select the text field
		copyText.select();
		copyText.setSelectionRange(0, 99999); // For mobile devices

		// Copy the text inside the text field
		navigator.clipboard.writeText(copyText.value);
		
		// Alert the copied text
		alert("URL Copied");
		}
		function change_status(val,key){
			var checkboxValue = val.checked;
			if(checkboxValue==true){
				var status=1;
			}else{
				var status=0;
			}
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url()?>/User/ChangeStatus",
                        data: {
                            status: status,
                            key: key
                        },
                        success: function (response) {
							if(response==1)
							{
								Swal.fire({
								title: "Success!",
								text: " Status Change Successfully!",
								icon: "success",
								});
                            } else{
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Invalid Id and Password",
                                });
                            } 
						}
					});

		}
	</script>