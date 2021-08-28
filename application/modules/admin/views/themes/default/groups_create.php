<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>

<!-- Page Heading -->
<div class="section-page-heading d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Grupa użytkowników</h1>
</div>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_description'); ?>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_validation_error'); ?>

<!-- Content Row -->
<div class="row">

    <div class="col-md-6 mb-4">
        <?php
        echo form_open('/admin/usergroups/create');
        ?>
        <div class="form-group">
            <?php
            echo form_label('Nazwa grupy', 'name');
            echo form_input(['name' => 'name', 'id' => 'name', 'class' => 'form-control']);
            ?>
        </div>
        <div class="form-group">
            <?php
            echo form_label('Opis grupy', 'description');
            echo form_input(['name' => 'description', 'id' => 'description', 'class' => 'form-control']);
            ?>
        </div>
        <div class="row">
            <div class="col-md-3 mb-2">
                <?php
                echo form_submit('btnSubmit', 'Zapisz', ['class' => 'btn btn-primary btn-block']);
                ?>
            </div>

            <div class="col-md-3 offset-md-6 mb-2">
                <a href="<?php echo base_url('admin/usergroups'); ?>" class="btn btn-block">Anuluj</a>
            </div>
        </div>
        <?php
        echo form_close();
        ?>
    </div>

</div><!-- End of Content Row -->