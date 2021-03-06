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
        $uris = $this->uri->segment_array();
        unset($uris[4]);
        $this->data['page'] = implode("/", $uris);

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
                    if ($this->uri->segment(2) == 'profile') {
                        $this->data['page'] = "dashboard/user/profile";
                    }
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
        @$configuration_site->slogan = $configuration_site->c_name;
        switch ($uri_page) {
            case "modules/movie/all":
                @$configuration_site->title = 'Listado de Peliculas';
                break;
            case "modules/movie/add":
                @$this->data['all_languages'] = $this->Language->GetAll();
                @$this->data['all_qualities'] = $this->Qualitie->GetAll();
                @$this->data['all_genders'] = $this->Gender->GetAll();
                @$configuration_site->title = 'Agregar película';
                break;
            case "modules/settings/site":
                @$configuration_site->title = 'Configuracion del Sitio';
                break;
            case "modules/settings/advertising":
                @$configuration_site->title = 'Publicidad del sitio';
                break;
            case "modules/settings/languages":
                $this->db->order_by('l_name', 'ASC');
                @$this->data['all_languages'] = $this->Language->GetAll();
                @$configuration_site->title = 'Idiomas del Contenido';
                break;
            case "modules/settings/qualities":
                $this->db->order_by('q_name', 'ASC');
                @$this->data['all_qualities'] = $this->Qualitie->GetAll();
                @$configuration_site->title = 'Calidades del Contenido';
                break;
            case "modules/settings/genders":
                $this->db->order_by('g_name', 'ASC');
                @$this->data['all_genders'] = $this->Gender->GetAll();
                @$configuration_site->title = 'Generos del Contenido';
                break;
            case "pages/errors/404":
                @$configuration_site->title = 'Pagina no encontrada';
                break;
            case "modules/user/active":
                @$configuration_site->title = 'Activando cuenta';
                break;
            case "modules/user/all":
                $config['total_rows'] = $this->db->count_all_results("users");
                $config['uri_segment'] = 4;
                $config['per_page'] = 9;
                $config['base_url'] = base_url() . "dashboard/user/all";
                $this->pagination->initialize($config);
                $this->db->order_by('u_username', 'ASC');
                $this->db->limit(9, $this->uri->segment(4));
                @$this->data['all_users']->data = $this->Site->DB2Array($this->db->get("users"));
                @$configuration_site->title = 'Usuarios del sitio';
                break;
            case "modules/user/profile":
                $uris = $this->uri->segment_array();
                if (@$uris[2] == "user" && @$uris[3] == 'profile') {
                    $this->data['user_profile'] = $this->User->getSession();
                    foreach ($this->Geo->get_geo_ip_profile($_SERVER['REMOTE_ADDR']) as $key => $value) {
                        @$this->data['user_profile']->$key = $value;
                    }
                    @$configuration_site->title = 'Tu Perfil ' . ucwords($this->data['user_profile']->u_name);
                } else {
                    $user = $this->db->get_where("users", array("u_username" => $this->uri->segment(3)))->row();
                    if (@$user != '') {
                        $this->data['user_profile'] = $user;
                        $this->data['user_profile_public'] = true;
                        @$configuration_site->title = "Perfil de " . ucwords($this->data['user_profile']->u_name);
                    } else {
                        $this->data['page'] = 'pages/errors/404';
                        @$configuration_site->title = 'Pagina no encontrada';
                    }
                }
                break;
            default:
                @$this->data['all_movies']->count = $this->db->count_all_results('movies');
                @$this->data['all_genders']->count = $this->db->count_all_results('genders');
                @$this->data['all_users']->count = $this->db->count_all_results('users');
                @$configuration_site->title = 'Panel de Control';
                break;
        }

        if (@$this->User->getSession() == '' && $uri_page != "modules/user/active") {
            @$configuration_site->title = "Acceder al Sitio";
        }

        $this->data['advertising'] = $this->db->get_where("advertising", array("c_id" => 1))->row();

        return $configuration_site;
    }

    public function logout() {
        $this->session->sess_destroy();
        header("Location: /dashboard");
    }

}
