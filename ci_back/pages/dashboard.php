
<div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon m-top-19"><i class="fa fa-play"></i></div>
            <div class="count"><?= @$all_movies->count ?></div>
            <h3>Peliculas</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon m-top-19"><i class="fa fa-users"></i></div>
            <div class="count"><?= @$all_users->count ?></div>
            <h3>Usuarios</h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon m-top-19"><i class="fa fa-tags"></i></div>
            <div class="count"><?= @$all_genders->count ?></div>
            <h3>Generos</h3>
        </div>
    </div>
</div>