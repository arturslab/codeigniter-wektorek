<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>

<!-- Page Heading -->
<div class="section-page-heading d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Grupy użytkowników</h1>
    <a href="<?php echo base_url('admin/usergroups/create'); ?>" class="d-none d-sm-inline-block btn btn-sm shadow-sm btn-primary">
		<i class="fas fa-user-plus text-white-50"></i> Dodaj grupę </a>
</div>

<?php $this->load->view($this->config->item('ci_my_admin_template_dir_admin') . 'includes/module_description'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Lista grup</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php if(isset($groups)) { ?>
                <table class="table table-bordered table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Opis</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tfoot class="tfoot">
                    <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Opis</th>
                        <th>Akcja</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach($groups as $v) {
                        ?>
                        <tr>
                            <td><?php echo $v->id; ?></td>
                            <td><?php echo $v->name; ?></td>
                            <td><?php echo $v->description; ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn btn-dark" href="<?php echo base_url('admin/usergroups/edit/' . $v->id); ?>" title="Edytuj"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger" href="<?php echo base_url('admin/usergroups/delete/' . $v->id); ?>" title="Usuń"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>

