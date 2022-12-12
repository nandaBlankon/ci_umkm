<?php
defined('BASEPATH') or exit('No direct script access allowed');

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


$route['login'] = 'welcome/login';
$route['login-proses'] = 'welcome/loginproses';
$route['daftar'] = 'welcome/register';
$route['tentang-kami'] = 'welcome/tentang';
$route['kontak-kami'] = 'welcome/kontak';
$route['cara-pesan'] = 'welcome/carapesan';
$route['kebijakan-privasi'] = 'welcome/kebijakan';
$route['syarat-ketentuan'] = 'welcome/syarat';
// $route['produk/(:any)'] = 'welcome/produk/$1';
// $route['(:any)'] = 'welcome/produk/$1'; for slug
$route['product/(:any)'] = 'view/index/$1';
$route['semua-produk'] = 'welcome/semuaproduk';
$route['semua-lapak'] = 'welcome/semualapak';
$route['penjual/(:any)'] = 'welcome/penjual/$1';
$route['merklist/(:any)'] = 'welcome/merk/$1';
$route['checkout'] = 'welcome/checkout';
$route['view-cart'] = 'welcome/show';
$route['pesan'] = 'welcome/pesan';

$route['mytransaksi'] = 'transaksi/transaksiPembeli';
$route['transaksi'] = 'transaksi/transaksiPenjual';

$route['profil-saya'] = 'dashboard/profil';
$route['keluar'] = 'welcome/logout';

$route['category/(:any)'] = 'view/kategori/$1';
