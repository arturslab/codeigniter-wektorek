<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<footer class="footer bg-dark text-center pb-2 pt-2">
	Copyright <?php echo date("Y"); ?> by wektorek.pl
</footer>

<script>
	if ($(".login-form")[0]) {
		$('.login-form').on('submit', function (e) {
			var email = $("#email").val();
			var password = $("#password").val();
			if (email.length == 0 || password.length == 0) {
				$(".login-message").html("You need to have a username and a password to login").removeClass('hidden');
			}
			else {
				$.ajax({
					url: "<?php echo site_url('auth/login');?>",
					type: "post",
					data: { ajax: 1, email: email, password: password },
					cache: false
				}).done(function (json) {
					/*
                    var message = json.message;
                    console.log(message);
                    */
					var error_message = json.error;
					var success = json.logged_in;
					if (typeof error_message !== "undefined") {
						$(".login-message").html(error_message).removeClass('hidden');
					}
					else if (typeof success !== "undefined" && success == "1") {
						$(".login-message").html("You've been successfully logged in!").removeClass('hidden');
						$(".login-form").hide();
						window.location.replace("<?php echo site_url('admin/dashboard');?>");
					}
					else {
						$(".email_error").html(json.email_error);
						$(".password_error").html(json.password_error);
					}

				}).always(function () {
					console.log('Logowanie...' + email + '|' + password);

				});
			}

			e.preventDefault();
		});
	}
</script>

</body>
</html>