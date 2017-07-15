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

    public function Update_information() {
        if ($this->isLogin()) {
            if (@$this->getSession()->u_id == @$_POST['u_id']) {
                @$_POST['u_gender'] = @$_POST['gender'];
                $u_id = $_POST['u_id'];
                unset($_POST['gender'], $_POST['u_id']);
                $user_info = $this->db->get_where("users", array("u_id" => $u_id))->row();
                $update = array();
                foreach ($_POST as $key => $value) {
                    if ($_POST[$key] != @$user_info->$key) {
                        $update[$key] = trim($value);
                    }
                }
                if (sizeof($update) > 0) {
                    if (@$update['u_first_name'] != '' && @$update['u_last_name'] != '') {
                        @$update['u_name'] = @$update['u_first_name'] . " " . @$update['u_last_name'];
                    } else if (@$update['u_first_name'] != '' && @$update['u_last_name'] == '') {
                        @$update['u_name'] = @$update['u_first_name'] . " " . @$user_info->u_last_name;
                    } else if (@$update['u_first_name'] == '' && @$update['u_last_name'] != '') {
                        @$update['u_name'] = @$user_info->u_first_name . " " . @$update['u_last_name'];
                    }
                    $str = $this->db->update_string('users', $update, array("u_id" => $u_id));
                    $this->db->query($str);
                    if (!$this->isDataBaseError()) {
                        $this->notify("datos actualizados correctamente", "info");
                        $this->updateSession();
                        $this->print_js("location.reload();");
                    }
                }
            } else {
                $this->setHeaderError("Wrong profile");
            }
        } else {
            $this->setHeaderError("You are not logged in");
        }
    }

    public function Change_password() {
        if ($this->isLogin()) {
            if (@$this->getSession()->u_id == @$_POST['u_id']) {
                if (@$this->getSession()->u_password == md5(@$_POST['old_password'])) {
                    if (@$this->getSession()->u_password != md5(@$_POST['u_password'])) {
                        if (@$_POST['u_password'] == @$_POST['u_confirm_password']) {
                            if ($this->CheckPasswordStrength($_POST['u_password']) > 3) {
                                $str = $this->db->update_string('users', array("u_password" => md5(@$_POST['u_password'])), array("u_id" => $_POST['u_id']));
                                $this->db->query($str);
                                if (!$this->isDataBaseError()) {
                                    $this->notify("contraseña cambiada correctamente", "success");
                                    $this->print_js("location.href='/logout';",1000);
                                }
                            } else {
                                $this->setHeaderError("The new password is very weak");
                            }
                        } else {
                            $this->setHeaderError("New passwords do not match");
                        }
                    } else {
                        $this->setHeaderError("The current and the new password are the same");
                    }
                } else {
                    $this->setHeaderError("Current password does not match");
                }
            } else {
                $this->setHeaderError("Wrong profile");
            }
        } else {
            $this->setHeaderError("You are not logged in");
        }
    }

    public function Upload_avatar() {
        if ($this->isLogin()) {
            if (@$this->getSession()->u_id == @$_POST['u_id']) {
                $this->UploadImg("upload_avatar", 170, 0, APP_FRONT . "avatars/", md5($_FILES['upload_avatar']['name']) . ".png");
                $this->db->query("UPDATE `users` SET `u_avatar` = '/avatar/" . md5($_FILES['upload_avatar']['name']) . ".png' WHERE `u_id` = " . @$_POST['u_id'] . ";");
                $this->notify("avatar de usuario actualizado", "success");
                $this->print_js('$(".avatar-view, .img-circle").attr("src","/avatar/' . md5($_FILES['upload_avatar']['name']) . '.png");');
                $this->updateSession();
            } else {
                $this->setHeaderError("Wrong profile");
            }
        } else {
            $this->setHeaderError("You are not logged in");
        }
    }

    public function getSession() {
        return @$this->session->userdata("vg_user");
    }

    public function isLogin() {
        if ($this->getSession() != '') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function updateSession() {
        $other = array(
            "u_username" => $this->getSession()->u_username,
            "u_password" => $this->getSession()->u_password
        );
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($other);
        $isUser = $this->db->get()->row();
        $this->session->set_userdata("vg_user", $isUser);
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
        $this->setBasicAuthentication($this->encryption->decrypt("d9dc793fe7f4b9e6a17077155b8e1cb598eb96cb99a4157fa92e3f27f5a527969cee160546110839ed7566ff1dd5be970cd12b2959b6454936fc80ff2e0eef8dqsNWeBgycVPMfw2uPdZr5B2UEUpjL4R8Gv0gsQtTgd0="), $this->encryption->decrypt('f329ad5094a09aa2adf1b0c1255c66faad649a3d4f2c526f8a4cc90dd979e970e1ded62452ac52df313bc008db2cc3aba501630e5f2cc8dea62e4eb24f895048LROo7pekvuD8eV8sbap+8gkO8RXDdtJm8H1ezqeCEyNM/yuNUl6SFSyIjlD/UEeSgII9NsS2T0l3BoI3E/tn6Q=='));
        $this->post($this->encryption->decrypt("5a11bc24f82b27c049e0d03819664abcb0da30443568c25ed2430e7b41e414b9f8f16d1e0a6c23b6396645ba142b56410c7d658a0cd89c9817a52fc1cc41c92eEC2lnBWVLr6Ee9z5ktsYxjOknODbwmai3ctgATLgyt88WkU+szWuvUQkWyA9FW0irgqKL+TlNz+Ts0mFXjVNPr8QC1A2y4qHy2SR+u1JoCw="), $post);
        if (@$this->response->message == 'Queued. Thank you.') {
            $this->notify('se envio un correo de activacion, al correo registrado', 'info');
        } else {
            $this->notify(@$this->response->message);
        }
    }

}
