<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404 Page Not Found</title>
	<link href="https://fonts.googleapis.com/css2?family=Bangers&family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<style type="text/css">

		::selection { background-color: #E13300; color: white; }

		::-moz-selection { background-color: #E13300; color: white; }

		html {
			font-size: 18px;
		}

		body {
			background-color: #6ebfff;
			margin: 40px;
			color: #4F5155;
			font-family: 'Lato', sans-serif;
		}

		.img-fluid {
			width: 100%;
			height: auto;
		}

		.container {
			max-width: 1335px;
			margin: 0 auto;
		}

		.grid-row {
			display: flex;
			flex-flow: row wrap;
			justify-content: center;
		}

		.col {
			/*flex-basis: 20%;*/
			/*-ms-flex: auto;*/
			padding: 10px;
			box-sizing: border-box;
			align-self: auto;
		}

		.col-1 {
			flex-basis: 50%;
		}
		.col-2 {
			flex-basis: 50%;
			padding-left: 30px;
		}

		h1 {
			font-size: 3em;
			margin-bottom: 0;
			font-family: 'Bangers', cursive;
			color: #353535;
			letter-spacing: .03em;
		}


		a {
			color: #FFF;
			font-weight: 700;
		}

		@media screen and (min-width: 768px) {
			.col-1 {
				flex-basis: 20%;
			}

			h1 {
				margin-bottom: 10px;
			}
		}
		@media screen and (min-width: 1366px) {
			h1 {
				margin-bottom: 100px;
			}
		}

	</style>
</head>
<body>
<div class="container">
	<div class="grid-row">
		<div class="col col-1">
			<img class="img-fluid" src="/assets/images/mascot_error_404_opt.svg" alt="Mascot - Page not found">
		</div>
		<div class="col col-2">
			<h1>404 Strony nie znaleziono</h1>
			<p>
				Nie znalazłem strony, której szukasz. <br><a href="<?php echo base_url(); ?>">Wróć na stronę główną.</a>
			</p>
		</div>
	</div>

</div>
</body>
</html>