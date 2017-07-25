
<?= $this->Site->set_title_page(@$site->title); ?>

<div class="row">

    <form id="gralform">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Basica</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Titulo <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="<?= $this->Site->get_simple_encode("m_title") ?>" placeholder="Nombre de la pelicula" required autofocus class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Sinopsis <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea style="height: 100px;" name="<?= $this->Site->get_simple_encode("m_sinopsis") ?>" placeholder="Escribe una breve reseña sobree la película" required autofocus class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Online <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div id="gender" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default btn-gender <?= (@$user_profile->u_gender == 0) ? "btn-dark active" : "" ?>" onclick="$('.btn-gender').removeClass('btn-dark').addClass('btn-default'); $(this).addClass('btn-dark').removeClass('btn-default')" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input type="radio" name="online" value="0" data-parsley-multiple="online" checked="checked"> No
                                </label>
                                <label class="btn btn-default btn-gender <?= (@$user_profile->u_gender == 1) ? "btn-dark active" : "" ?>" onclick="$('.btn-gender').removeClass('btn-dark').addClass('btn-default'); $(this).addClass('btn-dark').removeClass('btn-default')" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input type="radio" name="online" value="1" data-parsley-multiple="online"> Si
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Caratula <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="file" name="upload_cover" id="upload_cover" placeholder="Imagen de la Pelicula" required autofocus class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Detallada</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Año <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="<?= $this->Site->get_simple_encode("m_year") ?>" required autofocus class="form-control">
                                <?
                                for ($i = date("Y"); $i > 1959; $i--) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Generos <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select required autofocus class="form-control select2-selection--multiple" data-input="h_genero" multiple="multiple">
                                <?
                                foreach ($all_genders as $r) {
                                    echo '<option value="' . $r->g_id . '">' . ucfirst($r->g_name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Idiomas <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select required autofocus class="form-control select2-selection--multiple" data-input="h_idioma" multiple="multiple">
                                <?
                                foreach ($all_languages as $r) {
                                    echo '<option value="' . $r->l_id . '">' . ucfirst($r->l_name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Calidad <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="<?= $this->Site->get_simple_encode("m_qualitie") ?>" required autofocus class="form-control">
                                <?
                                foreach ($all_qualities as $r) {
                                    echo '<option value="' . $r->q_id . '">' . strtoupper($r->q_name) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button class="btn btn-dark pull-right">Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Site->get_csrf_input(); ?>
        <input type="hidden" id="h_genero" name="<?= $this->Site->get_simple_encode("m_genders") ?>" value=""/>
        <input type="hidden" id="h_idioma" name="<?= $this->Site->get_simple_encode("m_languages") ?>" value=""/>
        <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("movie", "add") ?>" />
    </form>

</div>