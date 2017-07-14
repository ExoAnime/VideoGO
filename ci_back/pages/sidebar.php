

<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= @$site->url ?>/dashboard" class="site_title"><i class="fa fa-codepen"></i> <span><?= @$site->c_name ?> <?= @$site->version ?></span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?= @$vg_user->u_avatar ?>" alt="<?= @$vg_user->u_username ?>" class="profile_img img-circle" style="background: transparent;" />
            </div>
            <div class="profile_info">
                <span>Level: <?= ucfirst($vg_user->u_level_name) ?>,</span>
                <h2><?= @$vg_user->u_username ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">

                    <li>
                        <a><i class="fa fa-user-circle-o"></i>Usuario<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= @$site->url ?>/dashboard/user/profile">Perfil</a></li>
                        </ul>
                    </li>
                    <?php
                    if (@$vg_user->u_level > 1) {
                        ?>
                        <li>
                            <a><i class="fa fa-cogs"></i>Configuracion<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?= @$site->url ?>/dashboard/settings/site">Sitio</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Tu Perfil" href="<?= @$site->url ?>/dashboard/user/profile">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Configura tu Player" href="<?= @$site->web->base_url ?>/settings/player">
                <span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="">
                <span class="glyphicon" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesion" href="<?= @$site->web->base_url ?>/logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
