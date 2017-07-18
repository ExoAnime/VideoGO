
<?= $this->Site->set_title_page(@$site->title); ?>

<div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Agregar Calidades</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal">
                    <?= $this->Site->get_csrf_input(); ?>

                    <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("site", "add_qualities") ?>" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Calidad <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" name="<?= $this->Site->get_simple_encode("q_name") ?>" placeholder="Ejemplo: DVD-R" required autofocus class="form-control" />
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
    </div>
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Calidades Actuales: <?= @$all_qualities->count ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table display compact" cellspacing="0" width="100%">
                    <thead>
                        <tr><th>ID</th><th>Nombre</th></tr>
                    </thead>
                    <tbody>
                        <?
                        if (sizeof(@$all_qualities->data) > 0) {
                            foreach (@$all_qualities->data as $qualitie) {
                                ?>
                                <tr><th scope="row"><?= @$qualitie->q_id ?></th><td><?= strtoupper(@$qualitie->q_name) ?></td></tr>
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