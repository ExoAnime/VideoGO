<?php

/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 12-jul-2017, 17:32:19
 * File Name: User.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User
 *
 * @author xlfederalelk0lx
 */
class User extends CO_Model {

    public function __construct() {
        parent::__construct();
    }

    public function Login() {
        if (!$this->isLogin()) {
            $_POST['u_password'] = md5($_POST['u_password']);
            $isUser = $this->db->get_where("users", $_POST);
            if ($isUser->num_rows() > 0) {
                $isUser = $isUser->row();
                if ($isUser->u_status > 0) {
                    $this->session->set_userdata("vg_user", $isUser);
                    $this->notify("Welcome " . $isUser->u_username, "success");
                    $this->print_js("location.reload();");
                } else {
                    $this->setHeaderError("You have not activated your account yet");
                }
            } else {
                $this->setHeaderError("The username or password is incorrect");
            }
        } else {
            $this->setHeaderError("Error you have an active session");
        }
    }

    public function Register() {
        if (!$this->isLogin()) {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('u_username =', $_POST['u_username']);
            $this->db->or_where('u_email =', $_POST['u_email']);
            $isUser = $this->db->get();
            if ($isUser->num_rows() < 1) {
                $username_len = strlen($_POST['u_username']);
                if ($username_len < 8 || $username_len > 16) {
                    $this->setHeaderError("Username must be between 8 and 15 characters");
                } else if (!valid_email($_POST['u_email'])) {
                    $this->setHeaderError("The email entered is invalid");
                } else {
                    $pwd = random_string("alnum", 12);
                    $_POST['u_password'] = md5($pwd);
                    $_POST['u_date'] = time();
                    $this->db->insert('users', $_POST);
                    $_POST['u_password'] = $pwd;
                    $this->SendEmailRegister();
                    $this->notify('cuenta creada con exito', 'success');
                    $this->print_js('document.getElementById("regform").reset();');
                }
            } else {
                $isUser = $isUser->row();
                if ($isUser->u_username == $_POST['u_username']) {
                    $this->setHeaderError("The username is already in use");
                } else if ($isUser->u_email == $_POST['u_email']) {
                    $this->setHeaderError("Email is already assigned to an account");
                }
            }
        } else {
            $this->setHeaderError("Error you have an active session");
        }
    }

    public function Active() {
        if (!$this->isLogin()) {
            parse_str($_POST['u_username']);
            if (@$name != '' && @$expire > 0) {
                $_POST['u_username'] = $name;
                $isUser = $this->db->get_where("users", $_POST)->row();
                if ($isUser != '') {
                    if ($isUser->u_status < 1) {
                        $str = $this->db->update_string('users', array("u_status" => 1), array("u_id" => @$isUser->u_id));
                        $this->db->query($str);
                        if (!$this->isDataBaseError()) {
                            $this->notify("cuenta activada correctamente", "success");
                            $this->print_js("location.href='/dashboard';", 1000);
                        }
                    } else {
                        $this->setHeaderError("This account has already been activated before");
                    }
                } else {
                    $this->setHeaderError("We did not find a record of the requested account");
                }
            } else {
                $this->setHeaderError("Wrong request");
            }
        } else {
            $this->setHeaderError("Error you have an active session");
        }
    }

    public function getSession() {
        return $this->session->userdata("vg_user");
    }

    public function isLogin() {
        if ($this->getSession() != '') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function SendEmailRegister() {
        $url_active = "http://" . $_SERVER['SERVER_NAME'] . '/user/active?signature=' . $this->encryption->encrypt("username=" . @$_POST['u_username'] . "&class=user&method=active&expire=" . time());
        $msg = file_get_contents("./ci_back/pages/plantilla_email.html");
        $msg = str_replace(array('Username', 'Password', 'active=activarcuenta'), array(@$_POST['u_username'], @$_POST['u_password'], $url_active), $msg);
        $post = array(
            'from' => 'VideoGO <postmaster@' . str_replace("www.", "", $_SERVER['SERVER_NAME']) . '>',
            'to' => @$_POST['u_username'] . ' <' . @$_POST['u_email'] . '>',
            'subject' => '¡Ya casi! Activa Tu Cuenta',
            'html' => $msg
        );
        $this->setBasicAuthentication("api", $this->encryption->decrypt('d6ddce688f6c17ac11c7efad182d71e7d19be72fe498b47d1b6fedae76efde49f20e96d55f9f2b20a322ba4030277510923541a90f916c3df23f36b26177b3935erJ1z1YGF/v5pVCs8uIYWBJXgg/3v1AgoOmmlJVBit+LB80zG4Zb0/vR4YNFWShNNpNOxMCvLJDRtsW6OuJeA=='));
        $this->post($this->encryption->decrypt("45203fb45b887c439225de8576fc13f8760ca9460c01b22b7cbdb54adf49f9036d1e29840a75a92d5d4f647e650cce2ce5c320160b26928ae01d23e098492aa8XrkiBEx+9anAAD96WIIpNVVyD18WbuiAkzxTdOiwAykACVbVcvl1XmfGFkO8uZh54+Wsz9ULb9gjCbUFwZNjZduayO6dRhJ5RMIygBx05tM="), $post);
        if (@$this->response->message == 'Queued. Thank you.') {
            $this->notify('se envio un correo de activacion, al correo registrado', 'info');
        } else {
            $this->notify(@$this->response->message);
        }
    }

}
