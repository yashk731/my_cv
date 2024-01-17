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
	<script>
		new PerfectScrollbar(".app-container")
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
	</script>