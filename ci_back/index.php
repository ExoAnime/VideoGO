

<div class="container body">
    <div class="main_container">

        <?php
        $this->load->view("../../." . APP_BACK . "pages/sidebar");
        $this->load->view("../../." . APP_BACK . "pages/navbar");
        ?>

        <div class="right_col" role="main">
            <div class="">
                <?php
                $this->load->view("../../." . APP_BACK . @$page);
                ?>
                <div class="ads table-responsive"><?= @$advertising->a_728x90 ?></div>
            </div>        
        </div>

        <footer>
            <div class="pull-right">
                ©2017 All Rights Reserved by xlFederallk0lx. This site was created with VideoGO Script. <a href="http://shink.in/GiRuB" target="_blank">Download Script</a>
            </div>
            <div class="clearfix"></div>
        </footer>

    </div>
</div>