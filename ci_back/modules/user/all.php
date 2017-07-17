
<?= $this->Site->set_title_page(@$site->title); ?>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <?
                        echo $this->pagination->create_links();
                        ?>
                    </div>
                    <div class="clearfix"></div>
                    <?
                    foreach (@$all_users->data as $users) {
                        ?>
                        <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                                <div class="col-sm-12">
                                    <h4 class="brief"><i><?= ucwords(@$users->u_name) ?></i></h4>
                                    <div class="left col-xs-7">
                                        <h2><?= @$users->u_username ?></h2>
                                        <ul class="list-unstyled">
                                            <li title="Register"><i class="fa fa-calendar"></i> <?= date("d.m.Y h:i:s a", @$users->u_date) ?></li>
                                            <li title="Level"><i class="fa fa-cube"></i> <?= ucfirst(@$users->u_level_name) ?></li>
                                            <li title="Email"><i class="fa fa-envelope-o"></i> <?= @$users->u_email ?></li>
                                        </ul>
                                    </div>
                                    <div class="right col-xs-5 text-center">
                                        <img src="<?= @$users->u_avatar ?>" style="max-height: 109px; min-width: 109px;" alt="<?= @$users->u_username ?>" class="img-circle img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-12 bottom text-center">
                                    <div class="col-xs-12 col-sm-6 emphasis pull-right">
                                        <a target="_blank" class="btn btn-primary btn-xs" href="<?= @$site->url ?>/dashboard/profile/<?= $users->u_username ?>"><span class="fa fa-user"></span> Ver Perfil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>