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

    public function UploadImg($file_id, $max_height = 0, $max_width = 0, $save_path, $save_name_file) {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $config['upload_path'] = $save_path;
        $config['file_name'] = $save_name_file;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($file_id)) {
            $this->setHeaderError(str_replace(array("<p>", "</p>"), "", $this->upload->display_errors()));
        }
        if ($max_height > 0 || $max_width > 0) {
            $this->ResizeImg($max_width, $max_height, $save_path . $save_name_file);
        }
    }

    public function ResizeImg($w, $h, $file) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $file;
        $config['create_thumb'] = FALSE;
        $config['quality'] = 100;
        if ($w > 0) {
            $config['width'] = $w;
        }
        if ($h > 0) {
            $config['height'] = $h;
        }
        if ($w > 0 && $h > 0) {
            $config['maintain_ratio'] = FALSE;
        } else {
            $config['maintain_ratio'] = TRUE;
        }
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    public function CheckPasswordStrength($password) {        
        $strength = 0;
        $patterns = array('#[a-z]#', '#[A-Z]#', '#[0-9]#', '/[¬!"£$%^&*()`{}\[\]:@~;\'#<>?,.\/\\-=_+\|]/');
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $password, $matches)) {
                $strength++;
            }
        }
        return $strength;
    }
    
    public function DB2Array($query){
        $result=array();
        if($query->num_rows()>0){
            foreach ($query->result() as $value) {
                array_push($result, $value);
            }
        }
        return $result;
    }

}
