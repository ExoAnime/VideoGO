<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 25-jul-2017, 17:19:51
 * File Name: Gender.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Gender
 *
 * @author xlfederalelk0lx
 */
class Gender extends CO_Model {

    public function __construct() {
        parent::__construct();
    }

    public function GetAll() {
        return $this->DB2Array($this->db->get("genders"));
    }

    public function Add() {
        if ($this->User->isLogin()) {
            if (@$this->User->getSession()->u_level > 1) {
                @$_POST["g_seo"] = $this->slug(trim($_POST['g_name']));
                $isGender = @$this->db->get_where("genders", array("g_seo" => $_POST["g_seo"]))->row();
                if ($isGender == '') {
                    $_POST['g_name'] = strtolower(trim($_POST['g_name']));
                    $this->db->insert("genders", $_POST);
                    if (!$this->isDataBaseError()) {
                        $this->notify("genero agregado correctamente", "success");
                        $this->print_js("location.reload();");
                    }
                } else {
                    $this->setHeaderError("A gender with this name already exists");
                }
            } else {
                $this->setHeaderError("You do not have the necessary privileges");
            }
        } else {
            $this->setHeaderError("You do not have an active session");
        }
    }

}
