<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'front/view';
$route['install'] = 'back/view';
$route['profile/(.*)'] = 'back/view';
$route['dashboard/(.*)'] = 'back/view/$1';
$route['logout'] = 'back/logout';
$route['user/active'] = 'back/view/$1';
$route['dashboard'] = 'back/view';
$route['api'] = 'api';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
