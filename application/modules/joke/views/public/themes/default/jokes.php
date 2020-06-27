<!-- Custom styles for this template-->
<!--<link href="--><?php //echo base_url(); ?><!--assets/public/css/avatar.min.css" rel="stylesheet">-->
<style>
	body {background: linear-gradient(45deg, #fd5800, #fe8300);}

	.theme-blue {
		/*background-color: #fe8300;*/


		background-image: url(/assets/images/texture_1.png);
		background-repeat: repeat;
	}

	.section-jokes .buttons .btn {
		font-size: 2em;
		margin-bottom: 0;
		font-family: Bangers, cursive;
		letter-spacing: .03em;
	}

	.jokes {
		/*
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        flex-basis: 0;
        flex-grow: 1;
        */

	}

	.jokes .card {
		/*
        flex: 0 1 calc(100% - 1em);
        min-width: 0;
        box-sizing: border-box;
        */
		margin: 1rem .25em;
		padding: 10px;
		font-size: 1rem;
		color: #fff;
		background: #06669e;


		/*display: flex;*/
		/*-ms-flex-direction: column;*/
		/*flex-direction: column;*/

		word-wrap: break-word;
		background-clip: border-box;
		border: 1px solid rgba(0, 0, 0, .125);
		border-radius: .25rem;


	}

	.grid-item {
		margin-bottom: 10px;
		padding: 10px;
		font-size: 1rem;
		color: #fff;
		background: #06669e;
		word-wrap: break-word;
		background-clip: border-box;
		border: 1px solid rgba(0, 0, 0, .125);
		border-radius: .25rem;

		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
		transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
	}

	.grid-item:hover {
		box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
	}

	.grid-sizer,
	.grid-item {
		width: 100%;
	}

	.grid-item--width2 {
		width: 400px;
	}

	.jokes .grid-item .title {
		font-size: .8rem;
		text-align: left;
		font-style: italic;
		margin-bottom: 20px;
	}

	.jokes .grid-item .content {
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
	}

	/* Color themes */


	.section-jokes .cat-3 {
		background-color: #ffc60b;
		color: #5a4605;
	}

	.section-jokes .cat-7 {
		background-color: #d76cff;
		color: #4e285d;
	}

	.section-jokes .cat-11 {
		background-color: #ff4141;
		color: #4c1414;
	}

	.section-jokes .cat-4 {
		background-color: #56a1e5;
		color: #1c354c;
	}


	.section-jokes .cat-5 {
		background-color: #99c539;
		color: #303e12;
	}

	.section-jokes .cat-12 {
		background-color: #a8218e;
		color: #21081c;
	}

	.section-jokes .cat-13 {
		background-color: #faa61a;
		color: #382506;
	}

	.section-jokes .cat-999 {
		background-color: #2d2d2d;
		color: #cacaca;
	}

	.section-jokes .cat-999 {
		background-color: #364e59;
		color: #92cae4;
	}


	@media screen and (min-width: 768px) {
		.cards {
			/*display: flex;*/
			/*flex-wrap: wrap;*/
			/*justify-content: space-between;*/
		}

		.grid-sizer,
		.grid-item {
			width: 47%;
		}

		.jokes .card {
			/*flex: 0 1 calc(33.333% - 1em);*/
		}
	}

	@media screen and (min-width: 1366px) {
		.cards {
			/*display: flex;*/
			/*flex-wrap: wrap;*/
			/*justify-content: space-between;*/
		}

		.jokes .card {
			/*flex: 0 1 calc(33.333% - 1em);*/
		}

		.grid-sizer,
		.grid-item {
			width: 30%;
		}
	}


</style>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<div class="theme-blue">
	<div class="container pb-5">

		<div class="page-header">
			<img src="/assets/images/mascot_fun.svg" alt="">
			<h1 class="text-center"><?php echo $title; ?></h1>
		</div>
        <?php echo validation_errors(); ?>

        <?php $this->load->view('notifications.phtml'); ?>

		<div id="wrapper">

			<!--
            <div class="alert text-white bg-dark" role="alert">
                <div>Humor
                </div>
            </div>
            -->


			<div class="container section-jokes">

				<div class="buttons">
					<a href="#" class="btn btn-dark cat-4">Baca</a> <a href="#" class="btn btn-dark cat-13">Bajki</a>
					<a href="#" class="btn btn-dark cat-11">Chuck Norris</a> <a href="#" class="btn btn-dark cat-12">Hrabia</a>
					<a href="#" class="btn btn-dark cat-7">O Jasiu</a> <a href="#" class="btn btn-dark cat-5">Różne</a>
					<a href="#" class="btn btn-dark cat-3">Szkolna ława</a>
				</div>

				<div class="jokes grid mt-4">
                    <?php
                    $this->load->view($this->config->item('ci_my_admin_template_dir_public')
                                      . 'includes/cards_joke', $posts);
                    ?>

				</div>
			</div>


		</div>

	</div> <!-- /.container -->


</div> <!-- /.theme -->

<script>
	var module_path = '<?php echo $module_path; ?>'
	var module_url = '<?php echo $module_url; ?>'

	$(function () {

		$('.grid').masonry({
			// options
			// set itemSelector so .grid-sizer is not used in layout
			itemSelector: '.grid-item',
			// use element for option
			columnWidth: '.grid-sizer',
			gutter: 10,
			percentPosition: true,
			transitionDuration: '0.8s',
			stagger: 50,
		})

	})
</script>