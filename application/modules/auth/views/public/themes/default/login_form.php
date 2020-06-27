<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<div class="container mt-5 section-login">
	<div class="row">
		<div class="col-md-4 offset-md-2 col-image">
			<img class="img-fluid" src="<?php echo base_url(); ?>assets/admin/images/avatar_panel.svg" alt="">
		</div>
		<div class="col-md-4 ">
			<div class="login-panel card shadow">
				<div class="card-body">
					<h3 class="card-title">Zaloguj się</h3>

                    <?php if ($this->session->flashdata('message')): ?>
						<div class="alert bg-danger">
                            <?php echo $this->session->flashdata('message'); ?>
						</div>
                    <?php endif; ?>
					<div class="alert login-message bg-danger hidden"></div>

                    <?php echo form_open('auth/login', ['class' => 'login-form']); ?>
					<fieldset>

						<div class="form-group">
                            <?php echo form_label('E-mail', 'email'); ?>
							<div class="email_error"></div>
                            <?php echo form_input([
                                'type'        => 'email',
                                'name'        => 'email',
                                'id'          => 'email',
                                'class'       => 'form-control',
                                'placeholder' => 'E-mail',
                                'autofocus'   => true,
                            ]); ?>
						</div>

						<div class="form-group">
                            <?php echo form_label('Hasło', 'password'); ?>
							<div class="password_error"></div>
                            <?php echo form_input([
                                'type'        => 'password',
                                'name'        => 'password',
                                'id'          => 'password',
                                'class'       => 'form-control',
                                'placeholder' => 'Hasło',
                            ]); ?>
						</div>

						<div class="checkbox">
							<label> <input name="remember" type="checkbox" value="Remember Me"> Zapamiętaj mnie </label>
						</div>
						<button class="btn btn-lg btn-primary text-white btn-block" type="submit">Zaloguj</button>
					</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	body {
		background-color: #6e707e;
	}
</style>