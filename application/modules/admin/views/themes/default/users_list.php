<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Użytkownicy</h1>
	<a href="<?php echo base_url('admin/users/create'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
		<i class="fas fa-download fa-sm text-white-50"></i> Dodaj nowego </a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Lista użytkowników</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<?php if(isset($users)) { ?>
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<th>user_id</th>
					<th>first_name</th>
					<th>last_name</th>
					<th>username</th>
					<th>email</th>
					<th>Office</th>
					<th>Phone</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<th>user_id</th>
					<th>first_name</th>
					<th>last_name</th>
					<th>username</th>
					<th>email</th>
					<th>Office</th>
					<th>Phone</th>
				</tr>
				</tfoot>
				<tbody>
				<?php
				foreach($users as $v) {
					?>
					<tr>
						<td><?php echo $v->user_id; ?></td>
						<td><?php echo $v->first_name; ?></td>
						<td><?php echo $v->last_name; ?></td>
						<td><?php echo $v->username; ?></td>
						<td><?php echo $v->email; ?></td>
						<td><?php echo $v->company; ?></td>
						<td><?php echo $v->phone; ?></td>
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

