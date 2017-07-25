<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 25-jul-2017, 17:30:55
 * File Name: Language.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Language
 *
 * @author xlfederalelk0lx
 */
class Language extends CO_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function GetAll(){
        return $this->DB2Array($this->db->get("languages"));
    }
    
    public function Add() {
        if ($this->User->isLogin()) {
            if (@$this->User->getSession()->u_level > 1) {
                @$_POST["l_seo"] = $this->slug(trim($_POST['l_name']));
                $isQualitie = @$this->db->get_where("languages", array("l_seo" => $_POST["l_seo"]))->row();
                if ($isQualitie == '') {
                    $_POST['l_name'] = strtolower(trim($_POST['l_name']));
                    $this->db->insert("languages", $_POST);
                    if (!$this->isDataBaseError()) {
                        $this->notify("idioma agregado correctamente", "success");
                        $this->print_js("location.reload();");
                    }
                } else {
                    $this->setHeaderError("The language is already registered");
                }
            } else {
                $this->setHeaderError("You do not have the necessary privileges");
            }
        } else {
            $this->setHeaderError("You do not have an active session");
        }
    }

}
