
<?php
echo $this->Site->script_tag(@$site->url . "/vendors/jquery/dist/jquery.min.js");
echo $this->Site->script_tag(@$site->url . "/vendors/bootstrap/dist/js/bootstrap.min.js");
echo $this->Site->script_tag(@$site->url . "/vendors/jquery.tagsinput/src/jquery.tagsinput.js");
echo $this->Site->script_tag(@$site->url . "/vendors/pnotify/dist/pnotify.js");
echo $this->Site->script_tag(@$site->url . "/vendors/pnotify/dist/pnotify.buttons.js");
echo $this->Site->script_tag(@$site->url . "/vendors/pnotify/dist/pnotify.nonblock.js");
echo $this->Site->script_tag(@$site->url . "/vendors/fastclick/lib/fastclick.js");
echo $this->Site->script_tag(@$site->url . "/vendors/nprogress/nprogress.js");
echo $this->Site->script_tag(@$site->url . "/vendors/build/js/script.js?v=" . time());
if (@$vg_user != '' || @$page == 'modules/settings/install') {
    if (@$page == 'modules/settings/install') {
        echo $this->Site->script_tag(@$site->url . "/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js");
    }
    echo $this->Site->script_tag(@$site->url . "/vendors/build/js/custom.min.js");
}
?>

    </body>
</html>
