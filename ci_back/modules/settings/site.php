
<?= $this->Site->set_title_page(@$site->c_title); ?>

<div class="row">

    <form>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title"><h2>Basica</h2><div class="clearfix"></div></div>
                <div class="x_content">
                    <div class="form-horizontal">

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input class="form-control" required autofocus type="text" name="<?= $this->Site->get_simple_encode("c_name") ?>" value="<?= @$site->c_name ?>" placeholder="Nombre del Sitio" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Eslogan</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input class="form-control" required autofocus type="text" name="<?= $this->Site->get_simple_encode("c_slogan") ?>" value="<?= @$site->c_slogan ?>" placeholder="Descripcion rapida del Sitio" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Descripcion</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <textarea name="<?= $this->Site->get_simple_encode("c_description") ?>" placeholder="Descripcion detallada del Sitio" required autofocus class="form-control"><?= @$site->c_description ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">SEO</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input name="<?= $this->Site->get_simple_encode("c_seo") ?>" id="tags" placeholder="SEO del sitio para los buscadores" required autofocus class="form-control input-tags" value="<?= @$site->c_seo ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Fanpage</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input class="form-control" required autofocus type="url" name="<?= $this->Site->get_simple_encode("c_fb_page") ?>" value="<?= @$site->c_fb_page ?>" placeholder="Pagina de Facebook del Sitio" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title"><h2>Seguridad</h2><div class="clearfix"></div></div>
                <div class="x_content">

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Activar SSL</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="<?= $this->Site->get_simple_encode("c_ssl") ?>" class="form-control" required autofocus>
                                    <option value="1"<?= (@$site->c_ssl) ? " selected" : "" ?>>SI</option>
                                    <option value="0"<?= (@$site->c_ssl) ? "" : " selected" ?>>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Activar WWW</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="<?= $this->Site->get_simple_encode("c_www") ?>" class="form-control" required autofocus>
                                    <option value="1"<?= (@$site->c_www) ? " selected" : "" ?>>SI</option>
                                    <option value="0"<?= (@$site->c_www) ? "" : " selected" ?>>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Api Time</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="number" name="<?= $this->Site->get_simple_encode("c_expire_limit") ?>" value="<?= @$site->c_expire_limit ?>" class="form-control" required autofocus />
                            </div>
                        </div>
                        <?= $this->Site->get_csrf_input() ?>

                        <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("site", "updateInfo") ?>" />
                        <div class="ln_solid api-view"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-dark pull-right">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>