<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Defines the root path
$config['ci_my_public_template_dir'] = "";

// sets the path to the public templates path. The public templates are used for the login window
$config['ci_my_public_template_dir_public'] = $config['ci_my_public_template_dir'] . "public/themes/default/";

// sets the path to the admin section templates
$config['ci_my_public_template_dir_admin'] = $config['ci_my_public_template_dir'] . "public/themes/default/";

//sets the path to the frontend templates
$config['ci_my_public_template_dir_welcome'] = $config['ci_my_public_template_dir'] . "welcome/themes/default/";