<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<?php
$sidear_open_class = isset($view_data['cookies']['sidebar_open']) && $view_data['cookies']['sidebar_open'] === 1 ? '' : 'sidebar-toggled';
?>
<!DOCTYPE html>
<html lang="pl">
<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'header'); ?>
<body id="page-top" class="<?php echo $sidear_open_class; ?>">
<script>
	var module_path = '<?php echo $module_path; ?>'
	var module_url = '<?php echo $module_url; ?>';
</script>

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