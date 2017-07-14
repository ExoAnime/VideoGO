<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 12-jul-2017, 16:46:00
 * File Name: Site.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Site
 *
 * @author xlfederalelk0lx
 */
class Site extends CO_Model {

    public function __construct() {
        parent::__construct();
    }

    public function UpdateInfo() {
        if ($this->User->isLogin()) {
            if (@$this->User->getSession()->u_level > 1) {
                $site = $this->db->get_where("configuration", array("c_id" => 1))->row();
                $update = array();
                foreach ($_POST as $key => $value) {
                    if ($site->$key != $_POST[$key]) {
                        $update[$key] = $value;
                    }
                }
                if (sizeof($update) > 0) {
                    $str = $this->db->update_string('configuration', $update, array("c_id" => 1));
                    $this->db->query($str);
                    if (!$this->isDataBaseError()) {
                        $this->notify("datos actualizados correctamente", "info");
                        $this->print_js("location.reload();");
                    }
                    if (@$update['c_ssl'] != '') {
                        if ($update['c_ssl']) {
                            $update['c_ssl'] = "TRUE";
                        } else {
                            $update['c_ssl'] = "FALSE";
                        }
                        $ssl_update = array("csrf_protection", "cookie_secure", "cookie_httponly");
                        $config_file = read_file(APP_INCLUDE . "a/config/config.php");
                        foreach ($ssl_update as $ssl) {
                            $is_equal_ssl = $this->cut_str($config_file, "config['" . $ssl . "'] = ", ";");
                            if ($is_equal_ssl != $update['c_ssl']) {
                                $config_file = str_replace("config['" . $ssl . "'] = " . $is_equal_ssl . ";", "config['" . $ssl . "'] = " . $update['c_ssl'] . ";", $config_file);
                            }
                        }
                        write_file(APP_INCLUDE . "a/config/config.php", $config_file);
                    }
                }
            } else {
                header('HTTP/1.0 404 You do not have the necessary privileges', true, 404);
            }
        } else {
            header('HTTP/1.0 404 You do not have an active session', true, 404);
        }
    }

    public function getConfiguration($site = 1) {
        $c = $this->db->get_where("configuration", array("c_id" => $site));
        if ($c->num_rows() > 0) {
            return $c->row();
        } else {
            header('HTTP/1.0 404 Site configuration was not charged', true, 404);
        }
    }

    public function set_title_page($title) {
        return '<div class="page-title"><div class="title_left"><h3>' . $title . '</h3></div></div><div class="clearfix"></div>';
    }

    public function get_csrf_input() {
        if ($this->getConfiguration()->c_ssl) {
            return '<input type="hidden" name="' . $this->security->get_csrf_token_name() . '" value="' . $this->security->get_csrf_hash() . '" />';
        }
    }

}
