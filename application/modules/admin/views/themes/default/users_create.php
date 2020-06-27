<?php if(isset($env)) { show_filename($env, __FILE__); } ?>

<?php
echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : FALSE;
?>

<!-- Page Heading -->
<div class="section-page-heading d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0">Rejestracja użytkownika</h1>
</div>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_description'); ?>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_validation_error'); ?>

<!-- Content Row -->
<div class="row">

	<div class="col-md-6 mb-4">

		<?php
		echo form_open();
		?>

		<div class="form-group">
			<?php
			echo form_label('Grupa:','groups');
			echo form_error('group_id');
			echo form_dropdown(['name' => 'group_id', 'id' => 'group_id', 'class' => 'custom-select'], $groups, set_value('groups'));
			?>
		</div>

		<div class="form-group">
			<?php
			echo form_label('Imię:','first_name');
			echo form_error('first_name');
			echo form_input(['name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control'], set_value('first_name'));
			?>
		</div>

		<div class="form-group">
			<?php
			echo form_label('Nazwisko:','last_name');
			echo form_error('last_name');
			echo form_input(['name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control'], set_value('last_name'));
			?>
		</div>

		<div class="form-group">
			<?php
			echo form_label('Nazwa użytkownika:','username');
			echo form_error('username');
			echo form_input(['name' => 'username', 'id' => 'username', 'class' => 'form-control'], set_value('username'));
			?>
		</div>

		<div class="form-group">
			<?php
			echo form_label('E-mail:','email');
			echo form_error('email');
			echo form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control'], set_value('email'));
			?>
		</div>

		<div class="form-group">
			<?php
			echo form_label('Hasło:','password');
			echo form_error('password');
			echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control'], set_value('password'));
			?>
		</div>

		<div class="form-group">
			<?php
			echo form_label('Powtórz hasło:','confirm_password');
			echo form_error('confirm_password');
			echo form_password(['name' => 'confirm_password', 'id' => 'confirm_password', 'class' => 'form-control'], set_value('confirm_password'));
			?>
		</div>

		<div class="form-group">
			<?php
			echo form_submit('btnSubmit', 'Zarejestruj', ['class' => 'btn btn-primary btn-block']);
			?>
		</div>

		<?php echo form_close(); ?>

	</div>
</div>
<!-- End of Content Row -->