<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 25-jul-2017, 0:43:40
 * File Name: Movie.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Movie
 *
 * @author xlfederalelk0lx
 */
class Movie extends CO_Model {

    public function __construct() {
        parent::__construct();
    }

    public function Add() {
        if ($this->User->isLogin()) {
            if (@$this->User->getSession()->u_level > 1) {
                $_POST['m_seo'] = $this->slug($_POST['m_title']);
                $_POST['m_date'] = time();
                $_POST['m_online'] = $_POST['online'];
                unset($_POST['online']);
                $isMovie = $this->db->get_where("movies", array("m_seo" => $_POST['m_seo']));
                if ($isMovie->num_rows() < 1) {
                    $this->db->insert("movies", $_POST);
                    if (!$this->isDataBaseError()) {
                        if ($this->db->insert_id() > 0) {
                            $this->notify("pelicula agregada correctamente", "success");
                            $this->UploadImg("upload_cover", 320, 216, APP_FRONT . "images/", "cover_movie_" . $this->db->insert_id() . ".png");
                            $this->notify("cover de pelicula subido correctamente", "success");
                            $this->print_js('location.reload();');
                        }
                    }
                } else {
                    $this->setHeaderError("There is already a movie with the same title");
                }
            } else {
                $this->setHeaderError("You do not have the necessary privileges");
            }
        } else {
            $this->setHeaderError("You do not have an active session");
        }
    }

}
