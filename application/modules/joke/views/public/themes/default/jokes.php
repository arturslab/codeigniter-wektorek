<!--<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/public/js/masonry.pkgd.min.js"></script>
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