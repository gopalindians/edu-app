<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

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
$route['default_controller'] = 'Home/Index';

$route['auth/login']['post']    = 'Auth/Login/post';
$route['auth/login']['get']     = 'Auth/Login';
$route['auth/register']['get']  = 'Auth/Register';
$route['auth/register']['post'] = 'Auth/Register/post';
$route['auth/logout']['get']    = 'Auth/Logout';

$route['question/(:num)/(:any)']['get']       = 'Question/view/$1/$2';
$route['question/(:num)/(:any)']['post']      = 'Comment/post_comment/$1/$2';
$route['question/load_more_comments']['post'] = 'Comment/get_more_comments';
$route['question/(:num)/(:any)/edit']['get']  = 'Question/edit/$1/$2';
$route['question/(:num)/(:any)/edit']['post'] = 'Question/post_edit/$1/$2';
$route['question/add']['get']                 = 'Question/add';
$route['question/add']['post']                = 'Question/post';

$route['profile/(:num)/(:any)']['get']        = 'Profile/view/$1/$2';
$route['profile/(:num)/(:any)/edit']['get']   = 'Profile/edit/$1/$2';
$route['profile/(:num)/(:any)/edit']['post']  = 'Profile/edit_post/$1/$2';
$route['profile/load_more_questions']['post'] = 'Profile/get_more_questions';


//Facebook
$route['facebook/handle_callback']['get'] = 'Facebook/handle_callback';

/*ADMIN*/
$route['admin/auth/login']['get']     = 'Admin/Auth/Login';
$route['admin/auth/login']['post']    = 'Admin/Auth/Login/post';
$route['admin/auth/register']['get']  = 'Admin/Auth/Register';
$route['admin/auth/register']['post'] = 'Admin/Auth/Register/post';
$route['admin/auth/logout']['get']    = 'Admin/Auth/Logout';
$route['admin']['get']                = 'Admin/Home/index';
$route['admin/questions']['get']      = 'Admin/Questions/index';

$route['report']['get']  = 'report/index';
$route['report']['post'] = 'report/index';

/*ADMIN ENDS*/


/*API*/
$route['api/v1/auth/login']['post']    = 'api/auth/login/index';
$route['api/v1/auth/register']['post'] = 'api/auth/register/index';
$route['api/v1/auth/register']['get']  = 'api/auth/register/index';
$route['404_override']                 = '';
$route['translate_uri_dashes']         = false;
