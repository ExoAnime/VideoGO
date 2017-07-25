<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 25-jul-2017, 17:28:28
 * File Name: Qualitie.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Qualities
 *
 * @author xlfederalelk0lx
 */
class Qualitie extends CO_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function GetAll(){
        return $this->DB2Array($this->db->get("qualities"));
    }
    
    public function Add() {
        if ($this->User->isLogin()) {
            if (@$this->User->getSession()->u_level > 1) {
                @$_POST["q_seo"] = $this->slug(trim($_POST['q_name']));
                $isQualitie = @$this->db->get_where("qualities", array("q_seo" => $_POST["q_seo"]))->row();
                if ($isQualitie == '') {
                    $_POST['q_name'] = strtolower(trim($_POST['q_name']));
                    $this->db->insert("qualities", $_POST);
                    if (!$this->isDataBaseError()) {
                        $this->notify("calidad agregada correctamente", "success");
                        $this->print_js("location.reload();");
                    }
                } else {
                    $this->setHeaderError("The quality is already registered");
                }
            } else {
                $this->setHeaderError("You do not have the necessary privileges");
            }
        } else {
            $this->setHeaderError("You do not have an active session");
        }
    }

}
