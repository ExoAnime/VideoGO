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

    public function Advertising() {
        if ($this->User->isLogin()) {
            if (@$this->User->getSession()->u_level > 1) {
                $str = $this->db->update_string('advertising', $_POST, array("c_id" => 1));
                $this->db->query($str);
                if (!$this->isDataBaseError()) {
                    $this->notify("publicidad actualizada correctamente", "info");
                    $this->print_js("location.reload();");
                }
            } else {
                $this->setHeaderError("You do not have the necessary privileges");
            }
        } else {
            $this->setHeaderError("You do not have an active session");
        }
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
        $c = @$this->db->get_where("configuration", array("c_id" => $site));
        if ($c->num_rows() > 0) {
            return $c->row();
        } else {
            header('HTTP/1.0 404 Site configuration was not charged', true, 404);
        }
    }

    public function set_title_page($title) {
        return '<div class="page-title"><div class="title_left"><h3>' . $title . '</h3></div></div><div class="clearfix"></div>';
    }

    public function get_csrf_input($ssl = true) {
        if ($_SERVER['REQUEST_SCHEME'] == 'https') {
            return '<input type="hidden" name="' . $this->security->get_csrf_token_name() . '" value="' . $this->security->get_csrf_hash() . '" />';
        }
    }

    public function Install() {
        if ($_POST['i_host'] != '' && $_POST['i_database'] != '' && $_POST['i_username'] != '' && $_POST['i_password'] != '') {
            $config['hostname'] = @$_POST['i_host'];
            $config['username'] = @$_POST['i_username'];
            $config['password'] = @$_POST['i_password'];
            $config['database'] = @$_POST['i_database'];
            $config['dbdriver'] = 'mysqli';
            $config['pconnect'] = TRUE;
            $config['db_debug'] = FALSE;
            $config['cache_on'] = FALSE;
            $this->load->database($config);
            if ($this->db->error()['code'] < 1) {
                $sql_file = read_file("./videogo_script_sql.json");
                if ($sql_file) {
                    $sql_file = json_decode($sql_file);
                    foreach ($sql_file->tables as $table => $querys) {
                        if (!$this->db->table_exists($table)) {
                            foreach ($querys->querys as $sql) {
                                $this->db->query($sql);
                                if ($this->db->error()['code'] > 0) {
                                    $this->setHeaderError($this->db->error()['message']);
                                }
                            }
                            $this->notify("The table " . $table . " were created correctly", "success");
                        }
                        if ($table == 'configuration') {
                            $data = array();
                            foreach ($_POST as $key => $value) {
                                if (in_array($key, array("c_name", "c_slogan", "c_description", "c_fb_page"))) {
                                    @$data[$key] = $value;
                                }
                            }
                            @$data['c_id'] = 1;
                            $this->db->insert("configuration", $data);
                            if ($this->db->error()['message'] != "Duplicate entry '1' for key 'PRIMARY'") {
                                $this->notify("Site settings were successfully registered", "success");
                            }
                        }
                        if ($table == 'users') {
                            $data = array();
                            foreach ($_POST as $key => $value) {
                                if (in_array($key, array("u_username", "u_password", "u_email", "u_name"))) {
                                    @$data[$key] = $value;
                                }
                            }
                            $data['u_password'] = md5($data['u_password']);
                            @$data['u_level'] = 2;
                            @$data['u_level_name'] = "administrator";
                            @$data['u_date'] = time();
                            @$data['u_id'] = 1;
                            @$data['u_status'] = 1;
                            $this->db->insert("users", $data);
                            if ($this->db->error()['message'] != "Duplicate entry '1' for key 'PRIMARY'") {
                                $this->notify("The administrator account was successfully registered", "success");
                            }
                        }
                    }

                    $autoload = str_replace("//", "", read_file(APP_INCLUDE . "a/config/autoload.php"));
                    @$param['hostname'] = @$_POST['i_host'];
                    @$param['username'] = @$_POST['i_username'];
                    @$param['password'] = @$_POST['i_password'];
                    @$param['database'] = @$_POST['i_database'];
                    $database = read_file(APP_INCLUDE . "a/config/database.php");
                    $on_changes = FALSE;
                    foreach ($param as $key => $value) {
                        $set_param = $this->cut_str($database, "'" . $key . "' => '", "'");
                        if ($set_param != $value) {
                            $on_changes = TRUE;
                            $database = str_replace("'" . $key . "' => '" . $set_param . "',", "'" . $key . "' => '" . $value . "',", $database);
                        }
                    }
                    if ($on_changes) {
                        write_file(APP_INCLUDE . "a/config/database.php", $database);
                        write_file(APP_INCLUDE . "a/config/autoload.php", $autoload);
                        $this->notify("The script was set up correctly", "success");
                        $this->print_js("location.href='/';", 1200);
                    }
                } else {
                    $this->setHeaderError("The sql file was not found");
                }
            } else {
                $this->setHeaderError($this->db->error()['message']);
            }
        } else {
            $this->setHeaderError("All the parameters of the database are necessary");
        }
    }

}
