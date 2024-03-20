<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('partials/meta'); ?>
<!-- START: Body-->

<body id="main-container" class="default">
    <!-- START: Pre Loader-->
    <div class="se-pre-con">
        <img src="<?=base_url();?>assets/img/logocss1.jpg" alt="logo" width="25" class="img-fluid" />
    </div>
    <!-- END: Pre Loader-->

    <!-- START: Header-->
    <?php $this->load->view('partials/navbar.php');?>
    <!-- END: Header-->

    <!-- START: Main Menu-->
    <?php $this->load->view('partials/sidebar.php');?>
    <!-- END: Main Menu-->

    <!-- START: Main Content-->
    <main>
        <div class="container-fluid">
            <!-- START: Breadcrumbs-->
            <div class="row ">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <div class="w-sm-100 mr-auto">
                            <h4 class="mb-0"><?=$judul;?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->
            <!-- START: Card Data-->
            <?php echo $contents;?>
            <!-- END: Card DATA-->
        </div>
    </main>
    <!-- END: Content-->

    <!-- START: Footer-->
    <footer class="site-footer">© 2024 Bravo Solution Indonesia.</footer>
    <!-- END: Footer-->

    <!-- START: Back to top-->
    <a href="#" class="scrollup text-center">
        <i class="icon-arrow-up"></i>
    </a>
    <!-- END: Back to top-->
    <?php $this->load->view('partials/script.php');?>
</body>
<!-- END: Body-->

</html>