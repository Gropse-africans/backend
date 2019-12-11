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
$route['default_controller']                 = 'web';

//---------------------------------- Admin -------------------------------//
$route['admin']                              = 'admin/Login';
$route['admin/dashboard']                    = 'admin/Admin/index';
$route['admin/user-list']                    = 'admin/Admin/user_list';
$route['admin/user-detail/(:any)']           = 'admin/Admin/user_detail';

$route['admin/vendor-list']                  = 'admin/Admin/vendor_list';
$route['admin/vendor-detail/(:any)']         = 'admin/Admin/vendor_detail';

$route['admin/verify-product-list']          = 'admin/Admin/verify_product_list';
$route['admin/unverify-product-list']        = 'admin/Admin/unverify_product_list';
$route['admin/product-detail/(:any)']        = 'admin/Admin/product_detail';
$route['admin/add-product']                  = 'admin/Admin/add_product';
$route['admin/edit-product/(:any)']          = 'admin/Admin/edit_product';

$route['admin/brand']                        = 'admin/Admin/brand';
$route['admin/brand/(:any)']                 = 'admin/Admin/edit_brand';

$route['admin/category']                     = 'admin/Admin/category';
$route['admin/category/(:any)']              = 'admin/Admin/edit_category';
$route['admin/sub-category']                 = 'admin/Admin/sub_category';
$route['admin/sub-category/(:any)']          = 'admin/Admin/edit_sub_category';

//$route['admin/upload-image/(:any)']          = 'admin/Admin/upload_image';

$route['admin/advertisment']                 = 'admin/Admin/advertisment';
$route['admin/subscription-plan']            = 'admin/Admin/subscription_plan';
$route['admin/logout']                       = 'admin/Admin/logout';

//---------------------------------- Admin -------------------------------//

//----------------------------- Web Services Start Point --------------------------------//

//----------------------------- Web Services For User --------------------------------//
$route['user/userRegister']                 = 'api/UserApi/userRegister';
$route['user/verifyOtp']                    = 'api/UserApi/verifyOtp';
$route['user/userLogin']                    = 'api/UserApi/userLogin';
$route['user/createOtp']                    = 'api/UserApi/createOtp';
$route['user/resetPassword']                = 'api/UserApi/resetPassword';

$route['user/getProfile']                   = 'api/UserApi/getProfile';
$route['user/uploadImage']                  = 'api/UserApi/uploadImage';
$route['user/editProfile']                  = 'api/UserApi/editProfile';
$route['user/getHomepage']                  = 'api/UserApi/getHomepage';
$route['user/checkPassword']                = 'api/UserApi/checkPassword';

$route['user/getHomepage']                  = 'api/UserApi/getHomepage';
$route['user/getCategory']                  = 'api/UserApi/getCategory';
$route['user/getCategoryProducts']          = 'api/UserApi/getCategoryProducts';
$route['user/productDetail']                = 'api/UserApi/productDetail';

$route['user/getReviews']                   = 'api/UserApi/getReviews';
$route['user/addReviews']                   = 'api/UserApi/addReviews';
$route['user/addToCart']                    = 'api/UserApi/addToCart';
$route['user/getMyCart']                    = 'api/UserApi/getMyCart';
$route['user/addToFavourite']               = 'api/UserApi/addToFavourite';
$route['user/myFavouriteList']              = 'api/UserApi/myFavouriteList';

$route['user/searchProduct']                = 'api/UserApi/searchProduct';
$route['user/filterProduct']                = 'api/UserApi/filterProduct';
$route['user/adsList']                      = 'api/UserApi/adsList';

$route['user/getServiceCategory']           = 'api/UserApi/getServiceCategory';
$route['user/getServiceList']               = 'api/UserApi/getServiceList';
$route['user/getServiceDetail']             = 'api/UserApi/getServiceDetail';
$route['user/getServiceReviews']            = 'api/UserApi/getServiceReviews';
$route['user/addServiceReviews']            = 'api/UserApi/addServiceReviews';
$route['user/serviceBooking']               = 'api/UserApi/serviceBooking';
$route['user/placeOrder']                   = 'api/UserApi/placeOrder';
$route['user/myOrders']                     = 'api/UserApi/myOrders';
$route['user/orderDetail']                  = 'api/UserApi/orderDetail';
$route['user/myBookings']                   = 'api/UserApi/myBookings';
$route['user/bookingDetail']                = 'api/UserApi/bookingDetail';

//----------------------------- Web Services For User --------------------------------//

//----------------------------- Web Services End Point ---------------------------------//


//---------------------------------- Website -------------------------------//
$route['home']                             ='web/web';
$route['login']                            ='web/web/login';
$route['register']                         ='web/web/register';
$route['verification']                     ='web/web/verification';
$route['forgot-password']                  ='web/web/forgot_password';
$route['category-list']                    ='web/web/category_list';
$route['subcategory-list/(:any)']          ='web/web/subcategory_list';
$route['reset-password']                   ='web/web/reset_password';
$route['product-list/(:any)/(:any)']       ='web/web/product_list';
$route['product-list']                     ='web/web/product_list';
$route['product-detail/(:any)']            ='web/web/product_detail';
$route['advertisement-list']               ='web/web/advertisement_list';
$route['about-us']                         ='web/web/about_us';
$route['term-and-condition']               ='web/web/term_condition';
$route['privacy-policy']                   ='web/web/privacy_policy';
$route['delivery-information']             ='web/web/delivery_information';
$route['contact-us']                       ='web/web/contact_us';
$route['search-results']                   ='web/web/search';
$route['logout']                           ='web/web/logout';
$route['my-account']                       ='web/user';
$route['edit-account']                     ='web/user/edit_profile';
$route['change-password']                  ='web/user/change_password';
$route['wishlist']                         ='web/user/wishlist';
$route['ajax/login']                       ='web/ajax/login';
$route['ajax/register']                    ='web/ajax/register';
$route['ajax/verify']                      ='web/ajax/verify_otp';
$route['ajax/resend_otp']                  ='web/ajax/forgotPassword';
$route['ajax/edit_userprofile']            ='web/ajax/edit_profile';
$route['ajax/user_login']                  ='web/ajax/reset_password';
//---------------------------------- Website -------------------------------//
//---------------------------------Vendor ----------------------------------------------//
$route['vendor']                            = 'vendor/Login/index';
$route['vendor/dashboard']                  = 'vendor/Home/dashboard';
$route['vendor/register']                   = 'vendor/Login/register';
$route['vendor/product-list']               = 'vendor/Home/product_list';
$route['vendor/add-product']                = 'vendor/Home/add_product';
$route['vendor/product-detail/(:any)']      = 'vendor/Home/product_detail';
$route['vendor/edit-product/(:any)']        = 'vendor/Home/edit_product';


$route['vendor/subscription-plan']          = 'vendor/Home/subscription_plan';
$route['vendor/advertisement-list']         = 'vendor/Home/advertisement_list';
$route['vendor/add-advertisement']          = 'vendor/Home/add_advertisement';
$route['vendor/advertisement-detail/(:any)']= 'vendor/Home/advertisement_detail';
$route['vendor/edit-advertisement/(:any)']  = 'vendor/Home/edit_advertisement';
$route['vendor/forgot-password']            = 'vendor/Login/forgot_password';
$route['vendor/reset-password/(:any)']      = 'vendor/Login/reset_password';

$route['vendor/logout']                     = 'vendor/login/logout';
//---------------------------------Vendor ----------------------------------------------//



$route['404_override'] = 'custom404';
$route['translate_uri_dashes'] = FALSE;
