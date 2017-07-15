
<?= $this->Site->set_title_page(@$site->title); ?>

<div class="row">

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Avatar</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="profile_img">
                    <div id="crop-avatar" class="">
                        <img class="avatar-view img-responsive" style="margin: auto;" src="<?= @$user_profile->u_avatar ?>" alt="<?= @$user_profile->u_username ?>" title="Change the avatar" />
                    </div>
                </div>
                <?
                if ($user_profile->u_id == $vg_user->u_id && !@$user_profile_public) {
                    ?>
                    <br>
                    <form id="form_upload">
                        <?= $this->Site->get_csrf_input(); ?>

                        <input type="hidden" name="<?= $this->Site->get_simple_encode("u_id") ?>" value="<?= urlencode($this->encryption->encrypt($user_profile->u_id)) ?>" />
                        <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("user", "upload_avatar") ?>" />
                        <input type="file" name="upload_avatar" id="upload_avatar" class="hidden" />
                    </form>
                    <button class="btn btn-default btn-block btn-sm btn_upload_avatar">Cambiar Avatar</button>
                    <?
                }
                ?>
            </div>
        </div>    
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#personal" id="personal-tab" role="tab" data-toggle="tab" aria-expanded="true">Informacion Publica</a></li>
                    <?= (!@$user_profile_public) ? '<li role="presentation" class=""><a href="#acceso" role="tab" id="accesso-tab" data-toggle="tab" aria-expanded="false">Credenciales de Acceso</a></li>' : "" ?>
                </ul>
                <div id="myTabContent" class="tab-content">

                    <div role="tabpanel" class="tab-pane fade active in" id="personal" aria-labelledby="personal-tab">
                        <form class="form-horizontal">
                            <?= $this->Site->get_csrf_input(); ?>

                            <input type="hidden" name="<?= $this->Site->get_simple_encode("u_id") ?>" value="<?= urlencode($this->encryption->encrypt($user_profile->u_id)) ?>" />
                            <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("user", "update_information") ?>" />
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombres <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input value="<?= @$user_profile->u_first_name ?>" type="text" name="<?= $this->Site->get_simple_encode("u_first_name") ?>" required autofocus class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Apellidos <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input  value="<?= @$user_profile->u_last_name ?>" type="text" name="<?= $this->Site->get_simple_encode("u_last_name") ?>" required autofocus class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Genero</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default btn-gender <?= (@$user_profile->u_gender == 'male') ? "btn-gender-active" : "" ?>" onclick="$('.btn-gender').removeClass('btn-dark').addClass('btn-default'); $(this).addClass('btn-dark').removeClass('btn-default')" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="male" data-parsley-multiple="gender"> Hombre
                                        </label>
                                        <label class="btn btn-default btn-gender <?= (@$user_profile->u_gender == 'female') ? "btn-gender-active" : "" ?>" onclick="$('.btn-gender').removeClass('btn-dark').addClass('btn-default'); $(this).addClass('btn-dark').removeClass('btn-default')" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="gender" value="female" data-parsley-multiple="gender"> Mujer
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Bios<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea name="<?= $this->Site->get_simple_encode("u_bios") ?>" required autofocus class="form-control col-md-7 col-xs-12"><?= @$user_profile->u_bios ?></textarea>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Pais</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input value="<?= @$user_profile->u_country ?>" type="text" name="<?= $this->Site->get_simple_encode("u_country") ?>" required autofocus readonly class="form-control" />
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12">Ciudad</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <input value="<?= @$user_profile->u_city ?>" type="text" name="<?= $this->Site->get_simple_encode("u_city") ?>" required autofocus readonly class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">C.P.</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input value="<?= @$user_profile->u_zip_code ?>" readonly type="text" name="<?= $this->Site->get_simple_encode("u_zip_code") ?>" required autofocus class="form-control" />
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12">Localidad</label>
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <select class="form-control" required autofocus name="<?= $this->Site->get_simple_encode("u_location") ?>">
                                        <?
                                        foreach (@$user_profile->places as $place) {
                                            ?>
                                            <option <?= (strtolower($place->place_name) == @$user_profile->u_location) ? "selected" : "" ?> value="<?= strtolower($place->place_name) ?>"><?= $place->place_name ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-dark pull-right">Actualizar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="acceso" aria-labelledby="profile-tab">
                        <div class="alert alert-warning"><strong class="fa fa-warning"></strong> Al cambiar tu contraseña se cerrara tu sesion, y tendras que iniciar nuevamente.</div>
                        <form class="form-horizontal" data-view="api-user">
                            <?= $this->Site->get_csrf_input(); ?>

                            <input type="hidden" name="<?= $this->Site->get_simple_encode("u_id") ?>" value="<?= urlencode($this->encryption->encrypt($user_profile->u_id)) ?>" />
                            <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("user", "change_password") ?>" />

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Usuario <span class="required">*</span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" value="<?= @$user_profile->u_username ?>" title="Este no se puede cambiar" placeholder="Nombre de Usuario" disabled readonly class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña <span class="required">*</span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="password" name="<?= $this->Site->get_simple_encode("old_password") ?>" placeholder="Ingresa tu Contraseña Actual" required autofocus class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña Nueva <span class="required">*</span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="password" name="<?= $this->Site->get_simple_encode("u_password") ?>" placeholder="Ingresa tu Contraseña Nueva" required autofocus class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirmar Contraseña <span class="required">*</span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="password" name="<?= $this->Site->get_simple_encode("u_confirm_password") ?>" placeholder="Confirma tu Contraseña Nueva" required autofocus class="form-control" />
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-dark pull-right">Cambiar</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>