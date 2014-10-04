<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['search/search_keyword'] = 'search/search_keyword';
$route['bares/(:any)'] = 'view_post/index/$1';
$route['bares'] = 'view_post/index';
$route['post/delete_post'] = 'post/delete_post';
$route['post/update_post'] = 'post/update_post';
$route['post/create_post'] = 'post/create_post';
$route['post/get_posts'] = 'post/get_posts';
$route['post/edit/(:any)'] = 'post/edit/$1';
$route['post/(:any)'] = 'post/index/$1';
$route['create'] = 'post/create';
$route['post'] = 'post';
$route['users/delete_user'] = 'users/delete_user';
$route['users/update_user'] = 'users/update_user';
$route['users'] = 'users';
$route['profile/delete_profile'] = 'profile/delete_profile';
$route['profile/check_profile_data'] = 'profile/check_profile_data';
$route['profile'] = 'profile';
$route['register/check_register'] = 'register/check_register';
$route['register'] = 'register';
$route['login/check_login'] = 'login/check_login';
$route['login'] = 'login';
$route['adm'] = 'adm';
$route['(:any)'] = 'pages/index/$1';
$route['default_controller'] = "pages";
$route['404_override'] = 'login';


/* End of file routes.php */
/* Location: ./application/config/routes.php */