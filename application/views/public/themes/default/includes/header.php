<?php if (isset($env)) {
    show_filename($env, __FILE__);
} ?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo $meta_title; ?> <?php echo isset($title) && !empty($title) ? ' - '.$title:'';?></title>

	<link href="https://fonts.googleapis.com/css2?family=Bangers&family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link href="<?php echo base_url(); ?>assets/public/css/default.min.css?3" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"><\/script>')</script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

	<!-- Generics -->
	<link rel="icon" href="/favicons/favicon-32.png" sizes="32x32">
	<link rel="icon" href="/favicons/favicon-57.png" sizes="57x57">
	<link rel="icon" href="/favicons/favicon-76.png" sizes="76x76">
	<link rel="icon" href="/favicons/favicon-96.png" sizes="96x96">
	<link rel="icon" href="/favicons/favicon-128.png" sizes="128x128">
	<link rel="icon" href="/favicons/favicon-192.png" sizes="192x192">
	<link rel="icon" href="/favicons/favicon-228.png" sizes="228x228">

	<!-- Android -->
	<link rel="shortcut icon" sizes="196x196" href="/favicons/favicon-196.png">

	<!-- iOS -->
	<link rel="apple-touch-icon" href="/favicons/favicon-120.png" sizes="120x120">
	<link rel="apple-touch-icon" href="path/to/favicon-152.png" sizes="152x152">
	<link rel="apple-touch-icon" href="path/to/favicon-180.png" sizes="180x180">

	<!-- Windows 8 IE 10-->
	<meta name="msapplication-TileColor" content="#FD7F11">
	<meta name="msapplication-TileImage" content="/favicons/favicon-144.png">

	<!-- Windows 8.1 + IE11 and above -->
	<meta name="msapplication-config" content="/favicons/browserconfig.xml">
</head>
<body class="preload page-<?php echo isset($page_slug) ? $page_slug : ''; ?>">