<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main/home';
$route['home'] = 'main/home';
$route['about-us'] = 'main/about';
$route['contact-us'] = 'main/contact';
$route['events'] = 'main/events';
$route['facilities'] = 'main/facilities';
$route['courses'] = 'main/courses';
$route['gallery'] = 'main/gallery';
$route['branches'] = 'main/branches';
$route['results'] = 'main/results';


$route['JEE-MAIN-results'] = 'main/JeeMain';
$route['NEET-results'] = 'main/Neet';
$route['EAMCET-ENGG-MEDICAL-results'] = 'main/Eamcet';
$route['POLYCET-APRJC-results'] = 'main/Polycet';
$route['IPE-results'] = 'main/Ipc';

$route['registration'] = 'register/registration';

$route['2020-results'] = 'main/year2020';
$route['2019-results'] = 'main/year2019';
$route['2018-results'] = 'main/year2018';


$route['admin'] = 'auth/admin';
$route['404_override'] = 'my404';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
