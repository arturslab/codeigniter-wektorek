<?php
// Konfiguracja popupów formularzy - przenieść do kontroolera...
$data = [];

$data[1] = [
    'item_active'                  => true,
    'item_nr'                      => 1,
    'item_id'                      => 'hair',
    'card_title'                   => 'Fryzury',
    'card_description'             => 'Wybierz fryzurę i kolor włosów swojej postaci',
    'popup_elements'               => range(1, 20),
    'popup_element_title'          => 'Wybierz fryzurę',
    'popup_color_title'            => 'Wybierz kolor włosów',
    'popup_element_allow_random'   => true,
    'popup_element_random_legend'  => 'Kliknij %s aby wybierać losowo fryzury.',
    'popup_element_allow_uncheck'  => true,
    'popup_element_uncheck_legend' => 'Kliknij %s aby usunąć włosy.',
    'popup_colors'                 => isset($custom_colors['hair']) ? $custom_colors['hair'] : null,
    'popup_color_allow_random'     => true,
];

$data[2] = [
    'item_active'                  => true,
    'item_nr'                      => 2,
    'item_id'                      => 'blouse',
    'card_title'                   => 'Bluzki',
    'card_description'             => 'Wybierz rodzaj i kolor bluzki swojej postaci',
    'popup_elements'               => range(1, 8),
    'popup_element_title'          => 'Wybierz rodzaj bluzki',
    'popup_color_title'            => 'Wybierz kolor bluzki',
    'popup_element_allow_random'   => true,
    'popup_element_random_legend'  => 'Kliknij %s aby wybierać losowo bluzki.',
    'popup_element_allow_uncheck'  => false,
    'popup_element_uncheck_legend' => 'Kliknij %s aby usunąć bluzki.',
    'popup_colors'                 => isset($custom_colors['blouse']) ? $custom_colors['blouse'] : null,
    'popup_color_allow_random'     => true,
];

$data[3] = [
    'item_active'                  => true,
    'item_nr'                      => 3,
    'item_id'                      => 'eye',
    'card_title'                   => 'Oczy',
    'card_description'             => 'Wybierz rodzaj i kolor oczu dla swojej postaci',
    'popup_elements'               => range(1, 6),
    'popup_element_title'          => 'Wybierz rodzaj oczu',
    'popup_color_title'            => 'Wybierz kolor oczu',
    'popup_element_allow_random'   => true,
    'popup_element_random_legend'  => 'Kliknij %s aby wybierać losowo oczy.',
    'popup_element_allow_uncheck'  => false,
    'popup_element_uncheck_legend' => 'Kliknij %s aby usunąć oczy.',
    'popup_colors'                 => isset($custom_colors['eye']) ? $custom_colors['eye'] : null,
    'popup_color_allow_random'     => true,
];

$data[4] = [
    'item_active'                  => true,
    'item_nr'                      => 4,
    'item_id'                      => 'eyeglasses',
    'card_title'                   => 'Okulary',
    'card_description'             => 'Wybierz rodzaj i kolor okularów swojej postaci',
    'popup_elements'               => range(1, 4),
    'popup_element_title'          => 'Wybierz rodzaj okularów',
    'popup_color_title'            => 'Wybierz kolor ramki okularów',
    'popup_element_allow_random'   => true,
    'popup_element_random_legend'  => 'Kliknij %s aby wybierać losowo okulary.',
    'popup_element_allow_uncheck'  => true,
    'popup_element_uncheck_legend' => 'Kliknij %s aby usunąć okulary.',
    'popup_colors'                 => isset($custom_colors['eyeglasses']) ? $custom_colors['eyeglasses'] : null,
    'popup_color_allow_random'     => true,
];

?>

<!-- Custom styles for this template-->
<!--<link href="--><?php //echo base_url(); ?><!--assets/public/css/avatar.min.css" rel="stylesheet">-->
<style>
	<?php
if(isset($custom_colors)) {
	foreach($custom_colors as $element => $list) {
		foreach($list as $id => $v) {
		?>
	.custom_bg_<?php echo $element; ?>_<?php echo $id; ?> {background-color: <?php echo $v; ?>}

	.custom_color_<?php echo $element; ?>_<?php echo $id; ?> {color: <?php echo $v; ?>}

	<?php
    }
}
}
?>

	.custom_bg_hair_4 .svg_checkmark,
	.custom_bg_hair_5 .svg_checkmark,
	.custom_bg_hair_15 .svg_checkmark,
	.custom_bg_eye_2 .svg_checkmark,
	.custom_bg_blouse_4 .svg_checkmark,
	.custom_bg_blouse_5 .svg_checkmark,
	.custom_bg_blouse_15 .svg_checkmark,
	.custom_bg_eyeglasses_4 .svg_checkmark,
	.custom_bg_eyeglasses_5 .svg_checkmark,
	.custom_bg_eyeglasses_15 .svg_checkmark {
		fill: #d8d8d8 !important;
	}
</style>
<div class="theme-yellow">
	<div class="container">

		<div class="page-header">
			<img src="/assets/images/mascot_wizard_opt.svg" alt="">
			<h1 class="text-center"><?php echo $title; ?></h1>
		</div>
        <?php echo validation_errors(); ?>

        <?php $this->load->view('notifications.phtml'); ?>

        <?php //echo $avatar->getCssStyle(); ?>

		<div id="wrapper">

			<div class="alert text-white bg-dark" role="alert">
				<div>Wyczaruj swojego awatarka w <?php echo count($data) + 1; ?> krokach.<br>Awatara możesz używać w
					serwisach społecznościowych, czatach, komunikatorach. Wszędzie tam, gdzie masz ochotę.
				</div>
			</div>

			<div class="form mb-3">
				<form id="form-wizard" method="post">

					<div class="row">

                        <?php
                        // Popupy z kaflami
                        foreach ($data as $d) {
                            //$this->load->view('card_items.phtml', $d);

                            $this->load->view($this->config->item('ci_my_admin_template_dir_public')
                                              . 'includes/card_items', $d);

                        }
                        ?>

						<div class="col mb-3">
							<div id="finish_card" class="card h-100 bg-dark">
								<span class="step_number text-title">Krok 5</span>
								<img class="card-img-top p-3" src="/assets/images/choose_avatar.svg" alt="Choose avatar">
								<div class="card-body d-flex flex-column">
									<h5 class="card-title text-title mt-auto">Gotowe</h5>
									<p class="card-text mt-auto">Teraz możesz zobaczyć swoją postać</p>
									<a href="#" class="btn btn-custom btn-block mt-auto">Pokaż awatarka</a>
								</div>
							</div>
						</div>

					</div>

				</form>

			</div> <!-- /.form -->


            <?php //echo $svg_image_data; ?>

			<div class="row">
				<div class="col-md-3 mb-3 text-center" id="preview">
					<img src="" class="img-fluid rounded-circle">
				</div>
				<div class="col-md-9" id="result_url">
					<div class="alert alert-custom hidden" role="alert">
						<img class="glyphicon" src="/assets/images/mascot_alert_info_opt.svg" alt="Information icon">
						<div>
							Adres URL do Twojego awatara:<br> <small>(Kliknij w adres, aby otworzyć obrazek w nowym
								oknie)</small><br> <span class="text-break"></span>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div> <!-- /.container -->


    <?php
    // Popupy z formularzami
    foreach ($data as $d) {
//        $this->load->view('popup_items.phtml', $d);
        $this->load->view($this->config->item('ci_my_admin_template_dir_public')
                          . 'includes/popup_items', $d);
    }
    ?>

</div> <!-- /.theme -->

<script>
	var module_path = '<?php echo $module_path; ?>'
	var module_url = '<?php echo $module_url; ?>'

	$(function () {

		function openPopup (target) {

			$('.custom_popup').addClass('hidden')
			$('#' + target).removeClass('hidden')

			$([document.documentElement, document.body]).animate({
				scrollTop: $('#' + target).offset().top - 10,
			}, 400)
		}

		function getRandomAvatar () {
			$.ajax({
				method: 'GET',
				url: module_url + 'get_random/',
			}).done(function (data) {
				// console.log(data)
				let image_url = '<?php echo base_url("images/avatars/"); ?>' + data
				$('#preview img').attr('src', image_url)

				$('#result_url span').
					html('<a href="' + image_url + '" class="alert-link" target="_blank">' + image_url + '</a>')
				$('#result_url .alert').removeClass('hidden')

			}).always(function () {
				//openPopup('preview');

			})
		}

		getRandomAvatar()

		// Aby nie submitować dwukrotnie
		$('#finish_card a').on('click', function (e) {
			e.preventDefault()
		})
		$('#form-wizard').on('submit', function (e) {
			e.preventDefault()

			let hair = $('input[name=\'radio_hair\']:checked').val()
			let blouse = $('input[name=\'radio_blouse\']:checked').val()
			let eye = $('input[name=\'radio_eye\']:checked').val()
			let eyeglasses = $('input[name=\'radio_eyeglasses\']:checked').val()
			let hair_color = $('input[name=\'radio_hair_color\']:checked').val()
			let eye_color = $('input[name=\'radio_eye_color\']:checked').val()
			let blouse_color = $('input[name=\'radio_blouse_color\']:checked').val()
			let eyeglasses_color = $('input[name=\'radio_eyeglasses_color\']:checked').val()

			$.ajax({
				method: 'POST',
				url: module_url + 'draw_avatar/',
				data: {
					hair: hair,
					blouse: blouse,
					eye: eye,
					eyeglasses: eyeglasses,
					eye_color: eye_color,
					hair_color: hair_color,
					blouse_color: blouse_color,
					eyeglasses_color: eyeglasses_color,
				},
				// data: $(this).serialize(),
				// dataType:"json",
			}).done(function (data) {
				// console.log(data)
				let image_url = '<?php echo base_url("images/avatars/"); ?>' + data
				$('#preview img').attr('src', '/images/avatars/' + data)

				$('#result_url span').
					html('<a href="' + image_url + '" class="alert-link" target="_blank">' + image_url + '</a>')
				$('#result_url .alert').removeClass('hidden')

			}).always(function () {
				openPopup('preview')

			})

		})

		$('.popup_close').on('click', function (e) {
			$(this).parent().addClass('hidden')
		})

		$('.js-close').on('click', function (e) {
			$('#' + $(this).data('close')).addClass('hidden')

			let target = $(this).data('target')
			openPopup(target)
			$('.card').removeClass('card-active')
			$('#' + target).addClass('card-active')
		})

		$('.js-open-popup,.js-card-clickable').on('click', function (e) {
			e.preventDefault()
			openPopup($(this).data('target'))
		})
		$('#finish_card').on('click', function (e) {
			$('#form-wizard').submit()
		})

	})
</script>