<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 12-jul-2017, 16:25:31
 * File Name: Back.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

/**
 * Description of Back
 *
 * @author xlfederalelk0lx
 */
class Back extends CO_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function view() {
        $this->data['page'] = implode("/", $this->uri->segment_array(2, 3));

        if ($this->data['page'] == 'install') {
            $this->data['page'] = "modules/settings/install";
            $this->load->view("../../." . APP_BACK . "pages/header", $this->data);
            $this->load->view("../../." . APP_BACK . $this->data['page']);
        } else {
            if (@$this->data['vg_user'] == '') {
                if ($this->data['page'] == 'user/active') {
                    $this->data['page'] = "modules/user/active";
                } else {
                    $this->data['page'] = "modules/user/access";
                }
                if (!file_exists(APP_BACK . $this->data['page'] . ".php")) {
                    $this->data['page'] = "pages/errors/404";
                }
                @$this->data['site'] = $this->getPageTitle(@$this->data['page'], @$this->data['site']);
                $this->load->view("../../." . APP_BACK . "pages/header", $this->data);
                $this->load->view("../../." . APP_BACK . $this->data['page']);
            } else {
                if ($this->data['page'] == 'dashboard') {
                    $this->data['page'] = "pages/" . $this->data['page'];
                } else {
                    $this->data['page'] = str_replace("dashboard", "modules", $this->data['page']);
                }
                if (!file_exists(APP_BACK . $this->data['page'] . ".php")) {
                    $this->data['page'] = "pages/errors/404";
                }
                $this->isAdministratorPage();
                $this->data['site'] = $this->getPageTitle($this->data['page'], $this->data['site']);
                $this->load->view("../../." . APP_BACK . "pages/header", $this->data);
                $this->load->view("../../." . APP_BACK . "index");
            }
        }
        $this->load->view("../../." . APP_BACK . "pages/footer");
    }

    private function isAdministratorPage() {
        $page_administrator = array(
            "modules/settings/site"
        );
        if (@$this->data['vg_user']->u_level < 2) {
            if (in_array($this->data['page'], $page_administrator)) {
                $this->data['page'] = "pages/errors/404";
            }
        }
    }

    public function getPageTitle($uri_page, $configuration_site) {
        //echo $uri_page;
        @$configuration_site->slogan = $configuration_site->c_name;
        switch ($uri_page) {
            case "modules/user/active":
                @$configuration_site->title = 'Activando cuenta';
                break;
            case "modules/settings/site":
                @$configuration_site->title = 'Configuracion del Sitio';
                break;
            case "pages/errors/404":
                @$configuration_site->title = 'Pagina no encontrada';
                break;
            case "modules/user/profile":
                $uris = $this->uri->segment_array();
                if (@$uris[2] == "user" && @$uris[3] == 'profile') {
                    $this->data['user_profile'] = $this->User->getSession();
                    @$configuration_site->title = 'Tu Perfil';
                }
                break;
            default:
                @$configuration_site->title = 'Panel de Control';
                break;
        }

        if (@$this->User->getSession() == '' && $uri_page != "modules/user/active") {
            @$configuration_site->title = "Acceder al Sitio";
        }

        return $configuration_site;
    }

    public function logout() {
        $this->session->sess_destroy();
        header("Location: /dashboard");
    }

}
