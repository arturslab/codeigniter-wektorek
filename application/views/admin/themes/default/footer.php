<?php if(isset($env)) { show_filename($env, __FILE__); } ?>

<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Wektorek.pl 2020</span>
		</div>
	</div>
</footer>
<!-- End of Footer -->


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Wylogowanie</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Kliknij wyloguj, aby opuścić bieżącą sesję.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Anuluj</button>
				<a class="btn btn-primary" href="<?= base_url('auth/logout')?>">Wyloguj</a>
			</div>
		</div>
	</div>
</div>


<div id="theme-switch" class="themes">
	<div class="colors">
		<h3>Motyw</h3>
		<ul class="theme-colors">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		<h3>Kolor wyróżnienia</h3>
		<ul class="accent-colors">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<p class="themes-btn"><i class="fas fa-cog fa-2x fa-spin"></i></p>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url(); ?>assets/admin/js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/common.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url(); ?>assets/admin/js/Chart.min.js"></script>


<!-- Page level plugins -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>

	// Call the dataTables jQuery plugin
	$(document).ready(function() {
		$('#dataTable').DataTable({ responsive: true });
	});

</script>

