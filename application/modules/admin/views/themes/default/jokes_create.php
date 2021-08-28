<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>

<!-- Page Heading -->
<div class="section-page-heading d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Nowy dowcip</h1>
</div>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_description'); ?>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_validation_error'); ?>

<!-- Content Row -->
<div class="row">

    <div class="col-md-11 mb-4">
        <?php
        echo form_open('/admin/jokes/create', ['id' => 'edit-form']);
        ?>

        <div class="form-group">
            <?php
            echo form_label('Kategoria', 'category_id');
            echo form_dropdown('category_id', $category_options, set_value('category_id'), ['id'=>'category_id', 'class' => 'form-control', 'aria-describedby' => 'category_help_block']);
            echo form_error('category_id', '<span class="form_error">', '</span>');
            ?>
            <small id="category_help_block" class="form-text text-muted">
                Wybierz kategorię dowcipu.
            </small>
        </div>

        <div class="form-group">
            <?php
            echo form_label('Tytuł', 'title');
            echo form_input(['name' => 'title', 'class' => 'form-control'], set_value('title'));
            ?>
        </div>

		<div class="form-group">
            <?php
            echo form_label('Slug', 'slug');
            ?>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text"><?php echo base_url('jokes/'); ?></div>
				</div>

                <?php
                echo form_input(['name' => 'slug', 'class' => 'form-control', 'aria-describedby' => 'slug_help_block'], set_value('slug'));
                ?>
			</div>
            <?php
            echo form_error('slug', '<span class="form_error">', '</span>');
            ?>
			<small id="slug_help_block" class="form-text text-muted">
				Przyjazny wyszukiwarkom tytuł dowcipu (znaki a-z0-9_) widoczny jako część adresu URL (np. /jokes/<strong>tytul_1</strong>/). <strong>Uwaga</strong>, wartość musi być unikalna. Jeśli nie wiesz co wpisać, pozostaw to pole puste (slug utworzy się automatycznie po zapisaniu formularza na podstawie tytułu).
			</small>
		</div>

		<div class="form-group">
            <?php
            echo form_label('Treść', 'content');
            echo form_textarea(['name' => 'content', 'class' => 'form-control', 'rows'=>7], set_value('content'));
            ?>
		</div>

        <div class="row">
            <div class="col-md-3 mb-2">
                <?php
                echo form_submit('btnSubmit', 'Zapisz', ['class' => 'btn btn-primary btn-block']);
                ?>
            </div>

            <div class="col-md-3 offset-md-6 mb-2">
                <a href="<?php echo base_url('admin/jokes'); ?>" class="btn btn-primary btn-block">Anuluj</a>
            </div>
        </div>

        <?php echo form_close(); ?>

    </div>
</div><!-- End of Content Row -->