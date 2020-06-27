<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>404 Page Not Found</title>
	<link href="https://fonts.googleapis.com/css2?family=Bangers&family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

	<style>

		::selection { background-color: #E13300; color: white; }

		::-moz-selection { background-color: #E13300; color: white; }

		html {
			min-height: 100%;
		}

		body {
			min-height: 100vh;
			margin: 0;
			padding: 0;
			color: #333;
			font-family: 'Lato', sans-serif;
			font-size:1.2rem;

			background: #009688;
			background-image: url(/assets/images/texture_1.png); /* fallback */
			background-image: url(/assets/images/texture_1.png), linear-gradient(45deg, #009688, #E91E63); /* W3C */
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		.img-fluid {
			width: 100%;
			height: auto;
		}

		.container {
			max-width: 1335px;
			margin: 60px auto;
		}

		.grid-row {
			display: flex;
			flex-flow: row wrap;
			justify-content: center;
		}

		.col {
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
				flex-basis: 15%;
				flex: 0 0 15%;
				max-width: 15%;
			}

			.col-2 {
				flex: 0 0 70%;
				max-width: 70%;
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



<div id="container" class="container">
	<div class="grid-row">
		<div class="col col-1">
			<img class="img-fluid" src="/assets/images/mascot_error_general_opt.svg" alt="Mascot - General error page">
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