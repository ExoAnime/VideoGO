<?php
/*
 * Project's Name: VideoGO
 * Description: Script con la finalidad para implementar un sitio web de pliculas, series y anime online
 * Programming Languages: PHP, JavaScript, HTML, CSS
 * Programmer: Jose Luis Coyotzi Ipatzi
 * File Created: 13-jul-2017, 13:12:28
 * File Name: active.php
 * Email: jlci811122@gmail.com
 * 
 * Copyright @2017 xlfederalelk0lx.
 */

$s = $this->encryption->decrypt(str_replace(" ", "+", $_GET['signature']));
if ($s != '') {
    parse_str($s);
    if (@$class == 'user' && @$method == 'active') {
        ?>
        <center>
            <div class="x_panel" style="max-width: 600px; margin-top: 2em;">
                <div class="x_content">
                    <form id="activeform">
                        <?= $this->Site->get_csrf_input() ?>

                        <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form(@$class, @$method) ?>" />
                        <input type="hidden" name="<?= $this->Site->get_simple_encode("u_username") ?>" value="<?= $this->Site->get_simple_encode(@$username) ?>" />
                        <div>Estas activando tu cuenta espera un momento.</div>
                    </form>
                </div>
            </div>
        </center>
        <?php
    } else {
        ?>
        <div class="alert alert-danger" style="max-width: 400px; margin: auto; margin-top: 2em;">El codigo de activacion es incorrecto</div>
        <?php
    }
} else {
    ?>
    <div class="alert alert-danger" style="max-width: 400px; margin: auto; margin-top: 2em;">El codigo de activacion es incorrecto</div>
    <?php
}