
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= @$site->url ?>/dashboard" class="site_title"><i class="fa fa-codepen"></i> <span><?= @$site->c_name ?> <?= @$site->version ?></span></a>
        </div>
        <div class="clearfix"></div>

        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?= @$vg_user->u_avatar ?>" alt="<?= @$vg_user->u_username ?>" class="profile_img img-circle" style="background: transparent;" />
            </div>
            <div class="profile_info">
                <span>Level: <?= ucfirst($vg_user->u_level_name) ?>,</span>
                <h2><?= @$vg_user->u_username ?></h2>
            </div>
        </div>
        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-user-circle-o"></i>Usuario<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= @$site->url ?>/dashboard/user/all">Ver Todos</a></li>
                            <li><a href="<?= @$site->url ?>/dashboard/user/profile">Tu Perfil</a></li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-play"></i>Peliculas<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= @$site->url ?>/dashboard/movie/all">Ver Todas</a></li>
                            <li><a href="<?= @$site->url ?>/dashboard/movie/add">Agregar</a></li>
                        </ul>
                    </li>
                    <?php
                    if (@$vg_user->u_level > 1) {
                        ?>
                        <li>
                            <a><i class="fa fa-cogs"></i>Configuracion<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?= @$site->url ?>/dashboard/settings/site">Sitio</a></li>
                                <li><a href="<?= @$site->url ?>/dashboard/settings/genders">Generos</a></li>
                                <li><a href="<?= @$site->url ?>/dashboard/settings/qualities">Calidades</a></li>
                                <li><a href="<?= @$site->url ?>/dashboard/settings/languages">Idiomas</a></li>
                                <li><a href="<?= @$site->url ?>/dashboard/settings/advertising">Publicidad</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>