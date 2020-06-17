<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<!DOCTYPE html>
<html lang="pl">
<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'header'); ?>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'sidebar'); ?>

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

            <?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'topbar'); ?>

			<!-- Begin Page Content -->
			<div class="container-fluid">
                <?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'content'); ?>
			</div>
			<!-- /.container-fluid -->

		</div>
		<!-- End of Main Content -->

	</div>
	<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'footer'); ?>
</body>
</html>