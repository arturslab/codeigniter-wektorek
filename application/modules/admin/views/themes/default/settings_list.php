<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ustawienia serwisu</h1>
    <a href="<?php echo base_url('admin/settings/create'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Dodaj nowy rekord </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista ustawień</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php if(isset($settings)) { ?>
                <table class="table table-bordered table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        <th>Nazwa</th>
                        <th>Tytuł</th>
                        <th>Opis</th>
                        <th>Wartość</th>
                        <th>Data modyfikacji</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nazwa</th>
                        <th>Tytuł</th>
                        <th>Opis</th>
                        <th>Wartość</th>
                        <th>Data modyfikacji</th>
                        <th>Akcja</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    foreach($settings as $v) {
                        ?>
                        <tr class="<?php echo $v['is_active'] == 0 ? ' text-danger ' : ''; ?>">
                            <td><?php echo $v['id']; ?></td>
                            <td><?php echo $v['name']; ?></td>
                            <td><?php echo $v['title']; ?></td>
                            <td><?php echo $v['description']; ?></td>
                            <td><?php echo $v['value']; ?></td>
                            <td><?php echo $v['updated_at']; ?></td>
							<td>
								<div class="btn-group" role="group" aria-label="Basic example">
									<a class="btn btn-dark" href="<?php echo base_url('admin/settings/edit/' . $v['id']); ?>" title="Edytuj"><i class="fas fa-edit"></i></a>
									<a class="btn btn-danger" href="<?php echo base_url('admin/settings/edit/' . $v['id']); ?>" title="Usuń"><i class="fas fa-trash"></i></a>
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

