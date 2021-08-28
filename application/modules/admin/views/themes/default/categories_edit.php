<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>

<!-- Page Heading -->
<div class="section-page-heading d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0">Edycja kategorii</h1>
</div>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_description'); ?>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_validation_error'); ?>

<!-- Content Row -->
<div class="row">

	<div class="col-md-6 mb-4">
        <?php
        echo form_open('/admin/categories/edit/' . $category->id, ['id' => 'edit-form']);
        ?>

		<div class="form-group">
            <?php
            echo form_label('Kategoria nadrzędna', 'parent_id');
            echo form_dropdown('parent_id', $category_options, set_value('parent_id', $category->parent_id), ['id'=>'parent_id', 'class' => 'form-control', 'aria-describedby' => 'parent_help_block']);
            echo form_error('parent_id', '<span class="form_error">', '</span>');
            ?>
			<small id="parent_help_block" class="form-text text-muted">
				Wybierz kategorię nadrzędną, do której ma należeć tworzona kategoria. Pozostaw wartość <strong>Brak</strong>, jeśli tworzysz kategorię najwyższego rzędu.
			</small>
		</div>

		<div class="form-group">
            <?php
            echo form_label('Nazwa kategorii', 'name');
            echo form_input(['name' => 'name', 'class' => 'form-control'], set_value('name', $category->name));
            ?>
		</div>

		<div class="form-group">
            <?php
            echo form_label('Slug', 'slug');
            echo form_input(['name' => 'slug', 'class' => 'form-control', 'aria-describedby' => 'slug_help_block'], set_value('slug', $category->slug));
            ?>
			<small id="slug_help_block" class="form-text text-muted">
				SEO friendly nazwa kategorii (znaki a-z0-9_) widoczna jako część adresu URL (np. /blog/<strong>tytul_1</strong>/). <strong>Uwaga</strong>, wartość musi być unikalna.
			</small>
		</div>

		<div class="form-group">
            <?php
            echo form_label('Tytuł', 'title');
            echo form_input(['name' => 'title', 'class' => 'form-control'], set_value('title', $category->title));
            ?>
		</div>

		<div class="form-group">
            <?php
            echo form_label('Opis', 'description');
            echo form_textarea(['name' => 'description', 'class' => 'form-control', 'rows'=>3], set_value('description', $category->description));
            ?>
		</div>

		<div class="row">
			<div class="col-md-3 mb-2">
                <?php
                echo form_submit('btnSubmit', 'Zapisz', ['class' => 'btn btn-primary btn-block']);
                ?>
			</div>

			<div class="col-md-3 offset-md-6 mb-2">
				<a href="<?php echo base_url('admin/categories'); ?>" class="btn btn-primary btn-block">Anuluj</a>
			</div>
		</div>

        <?php echo form_close(); ?>

	</div>
</div><!-- End of Content Row -->