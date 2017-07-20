
<?= $this->Site->set_title_page(@$site->title); ?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Publicidad Actual</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal">
                    <?= $this->Site->get_csrf_input(); ?>

                    <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("site", "advertising") ?>" />

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner 250x250 <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea style="min-height: 80px;" name="<?= $this->Site->get_simple_encode("a_250x250") ?>" required autofocus class="form-control"><?= @$advertising->a_250x250 ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner 300x250 <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea style="min-height: 80px;" name="<?= $this->Site->get_simple_encode("a_300x250") ?>" required autofocus class="form-control"><?= @$advertising->a_300x250 ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner 728x90 <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea style="min-height: 80px;" name="<?= $this->Site->get_simple_encode("a_728x90") ?>" required autofocus class="form-control"><?= @$advertising->a_728x90 ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Banner 160x600 <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea style="min-height: 80px;" name="<?= $this->Site->get_simple_encode("a_160x600") ?>" required autofocus class="form-control"><?= @$advertising->a_160x600 ?></textarea>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button class="btn btn-dark pull-right">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>