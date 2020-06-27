<!--
<style>

	/* Card Crossword animations */
	#svg-card-crossword {
		animation: zoom 10s ease infinite;
		transform-origin: center;
		transform-box: fill-box;
	}

	#svg-card-crossword-penguin {
		animation: rotate 2s linear infinite;
		transform-origin: center;
		transform-box: fill-box;
	}

	/* Card Avatar animations */
	#svg-card-avatar-group-avatars {}

	#svg-card-avatar-item-1 {
	}

	#svg-card-avatar-item-2 {
	}

	#svg-card-avatar-item-3 {
	}

	#svg-card-avatar-item-4 {
	}

	#svg-card-avatar-penguin {
	}

	@keyframes hideshow {
		0% { opacity: 1; }
		40% { opacity: 1; }
		50% { opacity: 0; }
		60% { opacity: 1; }
		100% { opacity: 1; }
	}

	@keyframes rotate {
		0% {
			transform: rotateZ(0deg);
		}
		50% {
			transform: rotateZ(5deg);
		}
		100% {
			transform: rotateZ(0deg);
		}
	}

	@keyframes zoom {
		0% {
			transform: scale(.9, .9);
		}
		50% {
			transform: scale(1.1, 1.1);
		}
		100% {
			transform: scale(.9, .9);
		}
	}
</style>
-->
<div class="theme-green">
	<div class="container">

		<div class="page-header">
			<img src="/assets/images/logo.svg" alt="Webiste logo">
			<h1 class="text-center"><?php echo $title; ?></h1>
		</div>
        <?php echo validation_errors(); ?>

        <?php $this->load->view('notifications.phtml'); ?>

		<div id="wrapper">

			<div class="row justify-content-center">

				<div class="col-md-6 col-lg-3 mb-3">
					<div class="card h-100 card-fx js-card-clickable" data-target="/crossword">
						<span class="step_number text-title">Krzyżówki</span>

						<div class="card-img-top p-3">
                            <?php include($assets_path . 'images/module_card_crossword_opt.svg'); ?>
						</div>
						<!--					<img class="card-img-top p-3" src="/assets/images/module_card_crossword_opt.svg" alt="Choose avatar">-->
						<div class="card-body d-flex flex-column">
							<!--						<h5 class="card-title text-title mt-auto">Krzyżówki</h5>-->
							<p class="card-text mt-auto">Krzyżówki dla dzieci z podziałem na kategorie.</p>
							<a href="/crossword" class="btn btn-custom btn-block mt-auto">Przejdź</a>
						</div>
					</div>
				</div>


				<div class="col-md-6 col-lg-3 mb-3">
					<div class="card h-100 card-fx js-card-clickable" data-target="/avatar">
						<span class="step_number text-title">Awatary</span>
						<div class="card-img-top p-3">
                            <?php include($assets_path . 'images/module_card_avatar_opt.svg'); ?>
						</div>
						<!--					<img class="card-img-top p-3" src="/assets/images/module_card_avatar_opt.svg" alt="Choose avatar">-->
						<div class="card-body d-flex flex-column">
							<!--						<h5 class="card-title text-title mt-auto">Awatary</h5>-->
							<p class="card-text mt-auto">Pochwal się znajomym swoim awatarem!</p>
							<a href="/avatar" class="btn btn-custom btn-block mt-auto">Przejdź</a>
						</div>
					</div>
				</div>


				<div class="col-md-6 col-lg-3 mb-3">
					<div class="card h-100 card-fx js-card-clickable" data-target="/humor">
						<span class="step_number text-title">Humor</span>
						<div class="card-img-top p-3">
							<img class="card-img-top p-3" src="/assets/images/module_card_joke.svg" alt="Jokes">
						</div>
						<!--					<img class="card-img-top p-3" src="/assets/images/module_card_avatar_opt.svg" alt="Choose avatar">-->
						<div class="card-body d-flex flex-column">
							<!--						<h5 class="card-title text-title mt-auto">Awatary</h5>-->
							<p class="card-text mt-auto">Pośmiej się sam lub ze znajomymi!</p>
							<a href="/humor" class="btn btn-custom btn-block mt-auto">Przejdź</a>
						</div>
					</div>
				</div>


			</div>

		</div>
	</div> <!-- /.container -->
</div> <!-- /.theme -->


<script>
	//var module_path = '<?php //echo $module_path; ?>//'
	//var module_url = '<?php //echo $module_url; ?>//'

	$(function () {

		$('.js-card-clickable').on('click', function (e) {
			e.preventDefault()
			window.location.href = $(this).data('target')
		})

	})
</script>