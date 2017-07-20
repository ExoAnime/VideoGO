
<?= $this->Site->set_title_page(@$site->title); ?>

<div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Agregar Genero</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal">
                    <?= $this->Site->get_csrf_input(); ?>

                    <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("site", "add_genders") ?>" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="<?= $this->Site->get_simple_encode("g_name") ?>" placeholder="Ejemplo: ciencia ficcion" required autofocus class="form-control" />
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button class="btn btn-dark pull-right">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="ads table-responsive"><?= @$advertising->a_300x250 ?></div>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Generos Actuales: <?= @$all_genders->count ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table display compact" cellspacing="0" width="100%">
                    <thead>
                        <tr><th>ID</th><th>Nombre</th></tr>
                    </thead>
                    <tbody>
                        <?
                        if (sizeof(@$all_genders->data) > 0) {
                            foreach (@$all_genders->data as $gender) {
                                ?>
                                <tr><th scope="row"><?= @$gender->g_id ?></th><td><?= ucfirst(@$gender->g_name) ?></td></tr>
                                <?
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>