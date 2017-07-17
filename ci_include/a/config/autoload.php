<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array("email", "encryption", "upload", "image_lib", "table", "user_agent", "pagination");
$autoload['drivers'] = array();
$autoload['helper'] = array("date", "directory", "email", "file", "string", "text", "url", "cookie", "html");
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array();
//array_push($autoload['libraries'], "database");
//array_push($autoload['libraries'], "session");
