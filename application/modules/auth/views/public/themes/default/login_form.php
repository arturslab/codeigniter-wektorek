<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<div class="container mt-5">
	<div class="row">
		<div class="col-md-4 offset-md-2 col-image">
			<img class="img-fluid" src="<?php echo base_url(); ?>assets/admin/images/avatar_panel.svg" alt="">
		</div>
		<div class="col-md-4 ">
			<div class="login-panel card border border-dark">
				<div class="card-body">
					<h3 class="card-title">Zaloguj się</h3>

                    <?php if ($this->session->flashdata('message')): ?>
						<div class="alert alert-danger fade in">
							<a href="#" class="close" data-dismiss="alert">&times;</a> <?php echo $this->session->flashdata('message'); ?>
						</div>
                    <?php endif; ?>
					<form role="form" method="POST" action="<?php echo base_url('auth/login'); ?>">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Hasło" name="password" type="password" value="">
							</div>
							<div class="checkbox"><label> <input name="remember" type="checkbox" value="Remember Me">
									Zapamiętaj mnie </label></div>
							<!-- Change this to a button or input when using this as a form -->
							<button class="btn btn-lg btn-dark text-white btn-block" type="submit">Login</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.col-image {
		text-align: center;
	}
	.col-image img{
		max-width: 120px;
	}

	@media screen and (min-width: 768px) {
		.col-image {
			text-align: right;
		}
		.col-image img{
			max-width: 100%;
		}
	}
</style>