<?php
/*
 * This file contains passwords and other important data.
 * Don't share this file for security reasons!
 *
 * Enter required data in this file and change filename from env.php.sample to env.php
 */

// Configuration array
$cf = [];

// Database access data
$cf['db'] = [
	'hostname' => 'localhost',
	'database' => '',
	'username' => '',
	'password' => '',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
];

// Security salt strings
$cf['auth'] = [
	'salt' => 'LvUEs~R`#=p97-n[/U<Ol@gUb@$npi|hhOswPh;R0W+B[ee|zjT4w1,[jOk(P|6z',
	'session_salt' => 'RGUzid-aavyzmz*OlIcj3ac<fb,ryB~$iBh!`a> r#t[EgAc |z{DUva+6xj%/-m',
	'encryption_key' => 'cMJFE2vFYbPRS7z4pUaSFZvlBERLgT4a',
];

// Mailer SMTP configuration
$cf['smtp'] = [
	'smtp_host' => '',
	'smtp_port' => 587,
	'smtp_username' => '',
	'smtp_pass' => '',
	'email_from' => '',
];

?>