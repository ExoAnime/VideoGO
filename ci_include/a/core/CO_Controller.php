<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 12-jul-2017, 16:23:15
 * File Name: CO_Controller.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

/**
 * Description of CO_Controller
 *
 * @author xlfederalelk0lx
 */
class CO_Controller extends CI_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->LoadApis();
        if ($this->isInstall()) {
            $this->setConfiguration();
        }
    }

    private function isInstall() {
        if (gettype(@$this->db) == 'object' && gettype(@$this->db) != NULL) {
            if ($this->uri->segment(1) == 'install') {
                header("Location: /");
                exit();
            }
            return TRUE;
        } else {
            @$this->data['site']->title = "Script installer";
            @$this->data['site']->slogan = "VideoGO";
            @$this->data['site']->url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'];
            $this->data['site']->c_expire_limit = 18000;
            if ($this->uri->segment(1) != 'install' && $this->uri->segment(1) != 'api') {
                header("Location: /install");
                exit();
            } else {
                return FALSE;
            }
        }
    }

    private function LoadApis() {
        $apis = directory_map(APP_CLASSES . "apis");
        foreach ($apis as $value) {
            $value = str_replace(".php", "", $value);
            $this->load->model("../../." . APP_CLASSES . "apis/" . $value, $value);
        }
        $this->encryption->initialize(array('driver' => 'mcrypt'));
    }

    private function setConfiguration() {
        $this->data['vg_user'] = $this->User->getSession();
        $this->data['site'] = $this->Site->getConfiguration();
        $this->data['site']->url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'];
        $this->onSSL($this->data['site']->c_ssl);
        $this->onWWW($this->data['site']->c_www);
    }

    private function onWWW($on = true) {
        if ($on) {
            if (strpos($_SERVER['SERVER_NAME'], "www.") === false) {
                $www_on = $_SERVER['REQUEST_SCHEME'] . "://www." . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                header("Location: " . $www_on);
                exit();
            }
        } else {
            if (strpos($_SERVER['SERVER_NAME'], "www.") !== false) {
                $www_off = $_SERVER['REQUEST_SCHEME'] . "://" . str_replace("www.", "", $_SERVER['SERVER_NAME']) . $_SERVER['REQUEST_URI'];
                header("Location: " . $www_off);
                exit();
            }
        }
    }

    private function onSSL($on = true) {
        if ($on) {
            if ($_SERVER['REQUEST_SCHEME'] != 'https') {
                $ssl_on = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                header("Location: " . $ssl_on);
                exit();
            }
        } else {
            if ($_SERVER['REQUEST_SCHEME'] != 'http') {
                $ssl_off = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                header("Location: " . $ssl_off);
                exit();
            }
        }
    }

}
