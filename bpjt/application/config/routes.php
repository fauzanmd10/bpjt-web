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
// $route['default_controller'] = 'welcome';
// $route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;






$route['default_controller'] = "home";
$route['404_override'] = '';
$route['berita'] = 'articles/index';
$route['admin'] = 'home';
$route['halamanadminBPJT'] = '../admin/home/index';
$route['v2/berita'] = 'v2/articles/index';
$route['berita/pdf/(:any)'] = 'articles/pdf_version/$1';
$route['v2/berita/pdf/(:any)'] = 'articles/pdf_version/$1';
$route['berita/(:any)'] = 'articles/show/$1';
$route['konten/berita/mudik'] = 'articles/tag/31';
$route['konten/en/news/mudik'] = 'articles/tag/32';
$route['v2/berita/(:any)'] = 'v2/articles/show/$1';
$route['galeri-foto'] = 'photo_galleries/index';
$route['galeri-foto/album-foto/(:any)/show/(:any)/(:num)'] = 'photo_galleries/show_by_album/$1/$2/$3';
$route['galeri-foto/album-foto/(:any)'] = 'photo_galleries/albums/$1';
$route['galeri-foto/(:any)/(:num)'] = "photo_galleries/show/$1/$2";
$route['v2/galeri-foto'] = 'v2/photo_galleries/index';
$route['v2/galeri-foto/album-foto/(:any)/show/(:any)/(:num)'] = 'v2/photo_galleries/show_by_album/$1/$2/$3';
$route['v2/galeri-foto/album-foto/(:any)'] = 'v2/photo_galleries/albums/$1';
$route['v2/galeri-foto/(:any)/(:num)'] = "v2/photo_galleries/show/$1/$2";
$route['galeri-video'] = 'video_galleries/index';
$route['galeri-video/album-video/(:any)/show/(:any)/(:num)'] = 'video_galleries/show_by_album/$1/$2/$3';
$route['galeri-video/album-video/(:any)'] = 'video_galleries/albums/$1';
$route['galeri-video/(:any)/(:num)'] = "video_galleries/show/$1/$2";
$route['v2/galeri-video'] = 'v2/video_galleries/index';
$route['v2/galeri-video/album-video/(:any)/show/(:any)/(:num)'] = 'v2/video_galleries/show_by_album/$1/$2/$3';
$route['v2/galeri-video/album-video/(:any)'] = 'v2/video_galleries/albums/$1';
$route['v2/galeri-video/(:any)/(:num)'] = "v2/video_galleries/show/$1/$2";
$route['admin/documents/(:any)'] = 'admin/documents/index/$1';
$route['admin/documents/add/(:any)'] = 'admin/documents/add/$1';
$route['admin/contents/save'] = 'admin/contents/save';
$route['admin/contents/cms/save'] = 'admin/contents/save_cms';
$route['admin/contents/cms/(:any)'] = 'admin/contents/cms/$1/$2';
$route['admin/contents/cms/(:any)/(:any)'] = 'admin/contents/cms/$1/$2';
$route['admin/contents/(:any)'] = 'admin/contents/form/$1/$2';
$route['admin/contents/(:any)/(:any)'] = 'admin/contents/form/$1/$2';
$route['admin/contents/(:any)/(:any)/(:any)'] = 'admin/contents/form/$1/$3';
$route['admin/form_toll'] = 'admin/form_toll/index';
$route['admin/form_toll/add'] = 'admin/form_toll/add';
$route['admin/cctv'] = 'admin/cctv';
$route['konten/pdf/(:any)'] = 'contents/pdf/$1';
$route['konten/pdf/(:any)/(:any)'] = 'contents/pdf/$1/$2';
$route['konten/pdf/(:any)/(:any)/(:any)'] = 'contents/pdf/$1/$2/$3';
$route['konten/(:any)'] = 'contents/show/$1';
$route['konten/(:any)/(:any)'] = 'contents/show/$1/$2';
$route['konten/(:any)/(:any)/(:any)'] = 'contents/show/$1/$3';
$route['v2/konten/(:any)'] = 'v2/contents/show/$1';
$route['v2/konten/(:any)/(:any)'] = 'v2/contents/show/$1/$2';
$route['v2/konten/(:any)/(:any)/(:any)'] = 'v2/contents/show/$1/$2/$3';
$route['peraturan'] = 'regulations/index';
$route['peraturan/dokumen/(:any)'] = 'regulations/show/$1';
$route['peraturan/(:any)'] = 'regulations/index/$1';
$route['v2/peraturan'] = 'v2/regulations/index';
$route['v2/peraturan/dokumen/(:any)'] = 'v2/regulations/show/$1';
$route['v2/peraturan/(:any)'] = 'v2/regulations/index/$1';
$route['spm/rekapitulasi'] = 'spm/recap';
$route['v2/spm/rekapitulasi'] = 'v2/spm/recap';
$route['tabel-tarif-tol'] = 'toll_roads/index';
$route['cek-tarif-tol'] = 'cek_tarif';
$route['tarif'] = 'tarif';
$route['v2/tabel-tarif-tol'] = 'v2/toll_roads/index';
$route['v2/cek-tarif-tol'] = 'v2/cek_tarif';
$route['kontak'] = 'contents/contact_us';
$route['peta-situs'] = 'contents/sitemap';
$route['admin/bidang-umum'] = 'admin/dashboard/bidang_umum';
$route['admin/progres-konstruksi'] = 'admin/dashboard/progress_konstruksi';
$route['auction'] = 'admin/home/lelang';
$route['register'] = 'admin/Register_auction/add';
$route['register_add'] = 'admin/register_auction/create';
$route['auctions'] = 'admin/lelangdoc';
$route['auctions_form'] = 'admin/lelangdoc/add_form';
$route['auctions_doc'] = 'admin/lelangdoc/add';
$route['auctions_list'] = 'admin/lelangs';
$route['auction_admin'] = 'admin/home/lelang_admin';
$route['invest_registration'] = 'admin/Register_auction/add_invest';
$route['register_invest'] = 'admin/register_auction/create_invest';
$route['conf_registration'] = 'admin/Register_auction/add_conf';
$route['register_conf'] = 'admin/register_auction/create_conf';
$route['invest_registration2'] = 'admin/Register_auction/add_invest2';
$route['register_invest2'] = 'admin/register_auction/create_invest2';
$route['invest_registration_jorr2el'] = 'admin/Register_auction/add_investjorr2';
$route['register_invest_jorr2el'] = 'admin/register_auction/create_investjorr2';
$route['invest_reg_patimban'] = 'admin/Register_auction/add_investpatimban';
$route['reg_invest_patimban'] = 'admin/register_auction/create_investpatimban';
$route['invest_reg_kater'] = 'admin/Register_auction/add_investkater';
$route['reg_invest_kater'] = 'admin/register_auction/create_investkater';
$route['buku_BPJT_2020'] = 'booklet/buku_BPJT_2020';
$route['booklet'] = 'index.php/booklet/';
$route['invest_reg_sentul'] = 'admin/Register_auction/add_investsetakarat';
$route['reg_invest_sentul'] = 'admin/register_auction/create_investsetakarat';
$route['reg_invest_setakarat'] = 'admin/register_auction/create_investsetakarat';
$route['invest_reg_boser'] = 'admin/Register_auction/add_investboser';
$route['reg_invest_boser'] = 'admin/register_auction/create_investboser';
$route['invest_reg_gaetacim'] = 'admin/Register_auction/add_investgaetacim';
$route['reg_invest_gaetacim'] = 'admin/register_auction/create_investgaetacim';
$route['sisnita-admin'] = 'sisnita-admin/public/index.php/home';
$route['invest_reg_kedigung'] = 'admin/Register_auction/add_investkedigung';
$route['reg_invest_kedigung'] = 'admin/register_auction/create_investkedigung';
$route['invest_reg_gilmeng'] = 'admin/Register_auction/add_invest_gilmeng';
$route['reg_invest_gilmeng'] = 'admin/register_auction/create_invest_gilmeng';
$route['success_page'] = 'admin/register_auction/success_page';
