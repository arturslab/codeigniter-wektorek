<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//$route['admin/dashboard'] = 'admin/dashboard';


// Users routes
$route['admin/users'] = 'admin/Users';
$route['admin/users/create'] = 'admin/Users/create';
$route['admin/users/register'] = 'admin/Users/register';
$route['admin/users/edit/(:any)'] = 'admin/Users/edit/$1';
$route['admin/users/delete/(:any)'] = 'admin/Users/delete/$1';

// User Groups routes
$route['admin/usergroups'] = 'admin/UserGroups';
$route['admin/usergroups/create'] = 'admin/UserGroups/create';
$route['admin/usergroups/edit/(:any)'] = 'admin/UserGroups/edit/$1';
$route['admin/usergroups/delete/(:any)'] = 'admin/UserGroups/delete/$1';

// Files Manager routes
$route['admin/filesmanager'] = 'admin/FilesManager';
$route['admin/filesmanager/get_list'] = 'admin/FilesManager/get_list';
$route['admin/filesmanager/upload'] = 'admin/FilesManager/upload';
$route['admin/filesmanager/do_upload'] = 'admin/FilesManager/do_upload';
$route['admin/filesmanager/create'] = 'admin/FilesManager/create';
$route['admin/filesmanager/edit/(:any)'] = 'admin/FilesManager/edit/$1';
$route['admin/filesmanager/delete/(:any)'] = 'admin/FilesManager/delete/$1';

// Brands routes
$route['admin/brands'] = 'admin/brands';
$route['admin/brands/create'] = 'admin/brands/create';
$route['admin/brands/edit/(:any)'] = 'admin/brands/edit/$1';

// Categories routes
$route['admin/categories'] = 'admin/categories';
$route['admin/categories/create'] = 'admin/categories/create';
$route['admin/categories/edit/(:any)'] = 'admin/categories/edit/$1';

// Products routes
$route['admin/products'] = 'admin/products';
$route['admin/products/create'] = 'admin/products/create';
$route['admin/products/edit/(:any)'] = 'admin/products/edit/$1';

// Dowcipy
$route['humor'] = 'joke/index';

// Testowe
$route['brands'] = 'admin/brands/brands_list';
$route['welcome'] = 'welcome/welcome/index';