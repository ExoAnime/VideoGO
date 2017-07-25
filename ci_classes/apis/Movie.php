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

    public function Boot() {
        $this->get("http://www.pelispedia.tv/api/666more.php?rangeStart=284&rangeEnd=283&flagViewMore=true&letra=&year=&genre=");
        preg_match_all("/(.*)<img src=\"(.*)\" alt=\"(.*)<br>(.*)\"(.*)/", $this->response, $matches);
        @$data->images = $matches[2];
        @$data->titles = $matches[3];
        preg_match_all("/(.*)<a href=\"(.*)\" title=\"\"(.*)/", $this->response, $matches);
        @$data->links = $matches[2];
        $json = array();
        for ($i = 0; $i < sizeof($data->links); $i++) {
            $this->get($data->links[$i]);
            $this->response = html_entity_decode($this->response);
            @$json[$i]->m_title = $data->titles[$i];
            @$json[$i]->m_seo = $this->slug(@$json[$i]->m_title);
            @$json[$i]->m_sinopsis = $this->cut_str($this->response, 'description" content="', '"');
            @$json[$i]->m_year = $this->cut_str($this->response, 'href="/anio/', '/');
            @$json[$i]->m_date = time() + rand(1, 9999);
            @$json[$i]->m_qualitie = 15;
            $generos = $this->cut_str($this->response, 'font-weight: bold;">Genero:</span>', "</div>");
            $generos = explode('</a>', $generos);
            $n=array();
            for ($j = 0; $j < sizeof($generos); $j++) {
                $x = str_replace(array(",", "</a>"), "", $this->slug($this->cut_str(@$generos[$j], ">", ",")));
                $r = @$this->db->get_where("genders", array("g_seo" => trim($x)))->row()->g_id;
                if ($r >0) {
                    $n[sizeof($n)] = $r;
                }
            }
            @$json[$i]->m_genders = trim(implode(",", $n));
            @$json[$i]->m_languages = 6;
            @$json[$i]->m_online = 1;
        }
        
        foreach ($json as $key => $value) {
            $isMovie = $this->db->get_where("movies", array("m_seo" => $value->m_seo));
            if ($isMovie->num_rows() < 1) {
                $this->db->insert("movies",$value);
                $this->get($data->images[$key]);
                write_file(APP_FRONT . "images/cover_movie_" . $this->db->insert_id() . ".png", $this->response);
            }
        }
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
