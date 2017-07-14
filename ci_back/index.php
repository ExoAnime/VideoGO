
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
            </div>
        </div>        

    </div>
</div>