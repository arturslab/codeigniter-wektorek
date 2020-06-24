<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>

<!-- Page Heading -->
<div class="section-page-heading d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0">Dodaj plik</h1>
</div>

<?php if(isset($module_description) && !empty($module_description)) { ?>
    <?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'module_description', $module_description); ?>
<?php } ?>

<?php echo $error; ?>

<!-- Content Row -->
<div class="row">

	<div class="col-md-6 mb-4">

        <?php echo form_open_multipart('/admin/filesmanager/do_upload'); ?>

		<div class="input-group mb-3">
			<div class="custom-file">
				<input type="file" class="custom-file-input" name="userfile" id="userfile" size="20">
				<label class="custom-file-label" for="userfile" aria-describedby="userfileAddon02">Wybierz plik</label>
			</div>
			<div class="input-group-append">
				<input type="submit" class="input-group-text" id="userfileAddon02" value="Prześlij"/>
			</div>
		</div>

		<br/><br/>


		</form>

	</div>
</div>
<!-- End of Content Row -->