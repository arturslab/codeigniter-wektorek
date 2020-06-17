<?php if(isset($env)) { show_filename($env, __FILE__); } ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ustawienia - edycja</h1>
    <a href="<?php echo base_url('admin/settings/create'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Dodaj nowy rekord </a>
</div>

<!-- Content Row -->
<div class="row">

    <div class="col-md-6 mb-4">
        <?php

        echo form_open('/admin/settings/edit/' . $setting->id, ['id' => 'edit-form']);

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
		<?php
        echo form_close();
        ?>
    </div>

</div>
<!-- End of Content Row -->