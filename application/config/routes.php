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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*******Backend routing Start*******/
$route['admin'] = 'admin/login';
$route['admin/logout'] = 'admin/login/logout';

$route['admin/user_management'] = 'admin/dashboard/user_management';
$route['admin/user_management/(:num)'] = 'admin/dashboard/user_management/$1';
$route['admin/profile'] = 'admin/dashboard/profile';
$route['admin/history'] = 'admin/dashboard/history';
$route['admin/history/(:num)'] = 'admin/dashboard/history/$1';
$route['admin/user_history/(:num)'] = 'admin/dashboard/user_history/$i';
$route['admin/referral_setting'] = 'admin/dashboard/referral_setting';
$route['admin/user_wallet/(:num)'] = 'admin/dashboard/wallet/$i';
/*******Backend routing End*******/


/*******Frontend routing Start*******/
$route['register'] = 'login/signup';
$route['forgot_password'] = 'login/forgot_password';
$route['reset_password'] = 'login/reset_password';
$route['killer_token_sale'] = 'login/killer_token_sale';

$route['user/wallet'] = 'user/profile/wallet';
$route['user/assets'] = 'user/profile/assets';
$route['user/history'] = 'user/profile/history';
$route['user/change_password'] = 'user/profile/change_password';
$route['user/change_profile_image'] = 'user/profile/change_profile_image';

$route['payment/paypal'] = 'user/payment/paypal';
$route['payment/cancel_payment/(:num)'] = 'user/payment/cancel_payment/$i';
$route['payment/success_payment/(:num)'] = 'user/payment/success_payment/$i';
$route['payment/stripe_payment'] = 'user/payment/stripe_payment';
$route['thanks'] = 'home/thanks';
$route['logout'] = 'login/logout';

$route['team'] = 'home/team';
/*******Frontend routing End*******/