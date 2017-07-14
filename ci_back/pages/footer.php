
    <script src="<?= @$site->url ?>/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= @$site->url ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= @$site->url ?>/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <script src="<?= @$site->url ?>/vendors/pnotify/dist/pnotify.js"></script>
    <script src="<?= @$site->url ?>/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?= @$site->url ?>/vendors/pnotify/dist/pnotify.nonblock.js"></script>
    <script src="<?= @$site->url ?>/vendors/fastclick/lib/fastclick.js"></script>
    <script src="<?= @$site->url ?>/vendors/nprogress/nprogress.js"></script>
    <script src="<?= @$site->url ?>/vendors/build/js/script.js?v=<?=time()?>"></script>
    <?php
    if(@$vg_user!=''){
        ?>
    <script src="<?= @$site->url ?>/vendors/build/js/custom.min.js?v=<?=time()?>"></script>
    <?php
    }
    ?>
    
    </body>
</html>
