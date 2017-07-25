<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 12-jul-2017, 16:26:12
 * File Name: Api.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

/**
 * Description of Api
 *
 * @author xlfederalelk0lx
 */
class Api extends CO_Controller {

    private $expire_limit = 0;
    private $expire_params = false;

    public function __construct() {
        parent::__construct();
        $this->expire_limit = $this->data['site']->c_expire_limit;
    }

    public function index() {
        if (sizeof($this->input->post()) > 0) {
            $this->decode_post_keys();
            $this->decode_post_values();
            parse_str($this->decode_post_token());
            if (class_exists(@$class)) {
                if (method_exists(@$class, @$method)) {
                    unset($_POST['token']);
                    $this->$class->$method();
                } else {
                    header('HTTP/1.0 404 The requested resource does not exist in the library', true, 404);
                }
            } else {
                header('HTTP/1.0 404 The library does not exist in cache', true, 404);
            }
        } else {
            header('HTTP/1.0 404 Wrong request', true, 404);
            exit();
        }
    }

    private function decode_post_token() {
        if (@$_POST['token'] != '') {
            parse_str($_POST['token'], $x);
            if (@$x['class'] != '' && @$x['method'] != '') {
                $limit = time() - @$x['expire'];
                if ($limit < $this->expire_limit) {
                    unset($x['expire']);
                    foreach ($x as $key => $value) {
                        $x[$key] = ucwords($value);
                    }
                    return http_build_query($x);
                } else {
                    header('HTTP/1.0 404 The request has expired', true, 404);
                    exit();
                }
            } else {
                header('HTTP/1.0 404 Wrong request', true, 404);
                exit();
            }
        } else {
            header('HTTP/1.0 404 Wrong request', true, 404);
            exit();
        }
    }

    private function decode_post_values() {
        foreach ($_POST as $key => $value) {
            $x = $this->encryption->decrypt(urldecode($value));
            if ($x != '') {
                $_POST[$key] = $x;
            }
        }
    }

    private function decode_post_keys() {        
        foreach ($this->input->post() as $key => $value) {
            $x = $this->encryption->decrypt(urldecode($key));
            if ($x != '') {
                parse_str($x, $x);
                $limit = time() - @$x['expire'];
                if ($limit < $this->expire_limit) {
                    if (@$x['name'] != '') {
                        @$_POST[@$x['name']] = $value;
                        unset($_POST[$key], $_POST[0]);
                    }
                } else {
                    header('HTTP/1.0 404 The request has expired', true, 404);
                    exit();
                }
            }
        }        
    }

}
