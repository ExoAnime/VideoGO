
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form>
                    <h1>Inicia tu Sesion</h1>
                    <?= $this->Site->get_csrf_input() ?>
                    
                    <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("user", "login") ?>" />                    
                    <div>
                        <input type="text" name="<?= $this->Site->get_simple_encode("u_username") ?>" class="form-control" placeholder="Username" required autofocus />
                    </div>
                    <div>
                        <input type="password" name="<?= $this->Site->get_simple_encode("u_password") ?>" class="form-control" placeholder="Password" required autofocus />
                    </div>
                    <div><button class="btn btn-default">Iniciar</button></div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Eres nuevo en el sitio?
                            <a href="#signup" class="to_register"> Crear Cuenta </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-codepen"></i> <?= @$site->c_name ?></h1>
                            <p>©2017 All Rights Reserved by xlFederallk0lx. This site was created with VideoGO Script. <a href="http://shink.in/GiRuB" target="_blank">Download Script</a></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form id="regform">
                    <h1>Crea tu Cuenta</h1>
                    <?= $this->Site->get_csrf_input() ?>

                    <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("user", "register") ?>" />
                    <div>
                        <input type="text" name="<?= $this->Site->get_simple_encode("u_username") ?>" class="form-control" placeholder="Selecciona un nombre de usuario" required autofocus />
                    </div>
                    <div>
                        <input type="email" name="<?= $this->Site->get_simple_encode("u_email") ?>" class="form-control" placeholder="Ingresa tu correo" required autofocus />
                    </div>
                    <div>
                        <input type="text" name="<?= $this->Site->get_simple_encode("u_name") ?>" class="form-control" placeholder="Ingresa tu nombre" required autofocus />
                    </div>
                    <div><button class="btn btn-default pull-right">Crear</button></div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Ya eres miembro?
                            <a href="#signin" class="to_register"> Iniciar Sesion</a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-codepen"></i> <?= @$site->c_name ?></h1>
                            <p>©2017 All Rights Reserved by xlFederallk0lx. This site was created with VideoGO Script. <a href="http://shink.in/GiRuB" target="_blank">Download Script</a></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>