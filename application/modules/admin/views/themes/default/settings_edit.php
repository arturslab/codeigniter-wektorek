<?php if(isset($env)) { show_filename($env, __FILE__); } ?>

<!-- Page Heading -->
<div class="section-page-heading d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Ustawienia - edycja</h1>
</div>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_description'); ?>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_validation_error'); ?>

<!-- Content Row -->
<div class="row">

    <div class="col-md-6 mb-4">
        <?php
        echo form_open('/admin/settings/edit/' . $setting->id, ['id' => 'edit-form']);
		?>

		<div class="form-group">
			<?php
			echo form_label($setting->title, 'user_id');
			if($setting->field_type === 'textarea') {

			}
			elseif($setting->field_type === 'image') {

			}
			else {
				echo form_input(['name' => 'value', 'class' => 'form-control'], $setting->value);
			}

			if($setting->description) {
				echo '<p class="text-muted mt-1">' . $setting->description . '</p>';
			}
			?>
		</div>

        <div class="row">
			<div class="col-md-3 mb-2">
				<?php
				echo form_submit('btnSubmit', 'Zapisz', ['class' => 'btn btn-primary btn-block']);
				?>
			</div>

			<div class="col-md-3 offset-md-6 mb-2">
        		<a href="<?php echo base_url('admin/settings'); ?>" class="btn btn-primary btn-block">Anuluj</a>
			</div>
		</div>

        <?php echo form_close(); ?>

    </div>
</div>
<!-- End of Content Row -->