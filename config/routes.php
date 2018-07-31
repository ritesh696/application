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
$route['default_controller'] = 'c_home';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

/*
Custom Route
*/

$route['home'] = 'c_home';
$route['sign-in'] = 'c_home/sign-in';
$route['logout'] = 'c_home/logout';
$route['sign-up'] = 'c_home/sign-up';
$route['verify-otp'] = 'c_home/verify-otp';
//$route['OTP-expired'] = 'c_home/OTP-expired';
$route['login-with-otp'] = 'c_home/login-with-otp';
$route['verify-otp/(:num)'] = 'c_home/verify-otp/$1';
$route['ad-post'] = 'c_home/ad-post';
$route['post-done'] = 'c_home/post-done';
$route['ad-post/(:any)'] = 'c_home/ad-post/$1';
$route['category/(:any)'] = 'c_home/category/$1';
//$route['cars'] = 'c_home/searchbar';
$route['product/(:any)'] = 'c_home/product/$1';
$route['contact-us'] = 'c_home/contact-us';
$route['about-us'] = 'c_home/about-us';
$route['help-support'] = 'c_home/help-support';
$route['ad-post-details'] = 'c_home/ad-post-details';

$route['ad-post-details/(:any)'] = 'c_home/ad-post-details/$1';
$route['edit-post-details/(:any)'] = 'c_home/edit-post-details/$1';



require_once( BASEPATH .'database/DB.php');
$db =& DB();
$db->select('category_name');
$db->from('tbl_category');
$query = $db->get();
$result = $query->result();
foreach( $result as $row )
{
	$category_name = preg_replace('/\\s+/',' ', $row->category_name);
	$url = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/',' ', $category_name));
	$url = preg_replace('/\\s+/', '-', $url);
    $route[$url.'/(:any)/(:any)'] = 'c_home/searchbar/$1/$2';
    $route[$url.'/(:any)/(:any)/(:any)'] = 'c_home/searchbar/$1/$2/$3';
    $route['result/'.$url.'/(:any)/(:any)/(:any)'] = 'c_home/searchbar_v1/$1/$2/$3';
    $route[$url.'/(:any)/(:any)/(:any)/(:any)'] = 'c_home/searchbar/$1/$2/$3/$4';
}

$route['item/(:any)/(:any)'] = 'c_home/product-details/$1/$2';
$route['all-result/user/(:any)'] = 'c_home/search_user/$1';
$route['all-result/(:any)/(:any)'] = 'c_home/search_value/$1/$2';
$route['all-result/(:any)'] = 'c_home/search_value/$1';
$route['result/(:any)'] = 'c_home/search_city/$1';


/*$db->select('sub_category_name');
$db->from('tbl_sub_category');
$query = $db->get();
$result = $query->result();
foreach( $result as $row )
{
	$sub_category_name = preg_replace('/\\s+/',' ', $row->sub_category_name);
	$url = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/',' ', $sub_category_name));
	$url = preg_replace('/\\s+/', '-', $url);
    $route[$url] = 'C_home/searchbar';
}*/