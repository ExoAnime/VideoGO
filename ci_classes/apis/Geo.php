<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 15-jul-2017, 13:21:28
 * File Name: Geo.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Geo
 *
 * @author xlfederalelk0lx
 */
class Geo extends CO_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_info_ip($ip) {
        $this->get("http://freegeoip.net/json/" . $ip);
        return $this->response;
    }

    public function get_info_zipcode($zipcode, $country_code) {
        $this->get("http://api.zippopotam.us/" . $country_code . "/" . $zipcode);
        return $this->response;
    }

    public function get_geo_ip_profile($ip) {
        $geo = $this->get_info_ip($ip);
        $geo_p = new stdClass();
        @$geo_p->u_country = @$geo->country_name;
        @$geo_p->u_city = @$geo->region_name;
        @$geo_p->u_zip_code = @$geo->zip_code;
        @$geo_p->places = $this->get_info_zipcode(@$geo->zip_code, @$geo->country_code)->places;
        @$geo_p->places = json_decode(str_replace("place name", "place_name", json_encode(@$geo_p->places)));
        return $geo_p;
    }

}
