<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 12-jul-2017, 16:23:25
 * File Name: CO_Model.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

/**
 * Description of CO_Model
 *
 * @author xlfederalelk0lx
 */
class CO_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->setHeader("Connection", "keep-alive");
        $this->setHeader("Keep-Alive", 300);
        $this->setHeader("Accept-Charset", "ISO-8859-1,utf-8;q=0.7,*;q=0.7");
        $this->setHeader("Accept-Language", "en-us,en;q=0.5");
        $this->setUserAgent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36");
        $this->setOpt(CURLOPT_ENCODING, "gzip");
    }

    public function get_simple_encode($value) {
        return urlencode($this->encryption->encrypt("name=" . $value . "&expire=" . time()));
    }

    public function get_token_form($class, $method) {
        return urlencode($this->encryption->encrypt("class=" . $class . "&method=" . $method . "&expire=" . time()));
    }

    public function print_js($code_js, $settimeout = 0) {
        if ($code_js != '') {
            if ($settimeout > 0) {
                echo "\n<script>\n"
                . "try{\n"
                . "setTimeout(function(){ " . $code_js . " }, " . $settimeout . ");"
                . "\n}catch(e){\naler(e);\n}\n</script>\n";
            } else {
                echo "\n<script>\n"
                . "try{\n"
                . "" . $code_js . ""
                . "\n}catch(e){\nalert(e);\n}\n</script>\n";
            }
        }
    }

    public function notify($msg, $type = "error") {
        $this->print_js('VideoGO.Notify("' . ucwords($msg) . '", "' . $type . '");');
    }

    public function setHeaderError($error, $code_error = 404) {
        header('HTTP/1.0 ' . $code_error . ' ' . $error, true, $code_error);
        exit();
    }

    public function isDataBaseError() {
        if (@$this->db->error()["message"] != '') {
            $this->setHeaderError("Error de sistema: " . $this->db->error()["code"] . ", " . $this->db->error()["message"]);
        } else {
            return FALSE;
        }
    }

    public function cut_str($str, $left, $right) {
        $str = substr(stristr($str, $left), strlen($left));
        $leftLen = strlen(stristr($str, $right));
        $leftLen = $leftLen ? -($leftLen) : strlen($str);
        $str = substr($str, 0, $leftLen);
        return $str;
    }

    public function script_tag($src = '', $type = 'text/javascript', $index_page = FALSE) {
        $CI = & get_instance();

        $link = "";
        if (is_array($src)) {
            foreach ($src as $v) {
                $link .= script_tag($v, $type, $index_page);
            }
        } else {
            $link = "\n\t\t<script ";
            if (strpos($src, '://') !== FALSE) {
                $link .= 'src="' . $src . '"';
            } elseif ($index_page === TRUE) {
                $link .= 'src="' . $CI->config->site_url($src) . '"';
            } else {
                $link .= 'src="' . $CI->config->slash_item('base_url') . $src . '"';
            }

            //$link .= " type=\"{$type}\"></script>";
            $link .= "></script>";
        }
        return $link;
    }

}
