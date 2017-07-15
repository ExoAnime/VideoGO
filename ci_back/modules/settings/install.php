
<div class="container" style="max-width: 600px; padding: 2em 5px 5px 5px">
    <div class="x_panel">
        <div class="x_title"><?= heading("VideoGO: " . $site->title, 2) ?><div class="clearfix" style=""></div></div>
        <div class="x_content">
            <form id="install_form">
                <div id="wizard_install" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps" style="padding-left: 0px;">
                        <li>
                            <a href="#step-1">
                                <span class="step_no">1</span>
                                <span class="step_descr">
                                    Database<br />
                                    <small>Configuration</small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <span class="step_no">2</span>
                                <span class="step_descr">
                                    Site<br />
                                    <small>Settings</small>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <span class="step_no">3</span>
                                <span class="step_descr">
                                    Administrator<br />
                                    <small>Configuration</small>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div id="step-1">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Host</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="host" placeholder="Enter the database host" name="<?= $this->Site->get_simple_encode("i_host") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Database</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="database" placeholder="Enter the database name" name="<?= $this->Site->get_simple_encode("i_database") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Username</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="username" placeholder="Enter the username of the database" name="<?= $this->Site->get_simple_encode("i_username") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Password</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="password" placeholder="Enter the password of the database" name="<?= $this->Site->get_simple_encode("i_password") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="step-2">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="sname" placeholder="Enter the site name" name="<?= $this->Site->get_simple_encode("c_name") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Slogan</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="sslogan" placeholder="Enter a short description" name="<?= $this->Site->get_simple_encode("c_slogan") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Description</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <textarea id="sdescription" name="<?= $this->Site->get_simple_encode("c_description") ?>" placeholder="Enter a detailed description of the site" class="form-control" required autofocus=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Fanpage</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="sfbpage" placeholder="Enter the facebook page of the site" name="<?= $this->Site->get_simple_encode("c_fb_page") ?>" class="form-control" required autofocus type="url" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="step-3">
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Username</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="ausername" placeholder="Enter a username" name="<?= $this->Site->get_simple_encode("u_username") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Password</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="apassword" placeholder="Enter a password" name="<?= $this->Site->get_simple_encode("u_password") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="aemail" placeholder="Enter a email" name="<?= $this->Site->get_simple_encode("u_email") ?>" class="form-control" required autofocus type="email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Name</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="aname" placeholder="Enter your name" name="<?= $this->Site->get_simple_encode("u_name") ?>" class="form-control" required autofocus type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Site->get_csrf_input(@$site->c_ssl) ?>

                <input type="hidden" name="<?= $this->Site->get_simple_encode("token") ?>" value="<?= $this->Site->get_token_form("site", "install") ?>" />
            </form>
        </div>
    </div>
</div>