<?php $session = session();
$role = $session->get('role');

?>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- header area start -->
        <div class="header-area">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="pull-left ml-0 mt-1">
                        <h3 style="color: #9338DE"> DMS</h3>
                    </div>
                    <!-- <div class="search-box pull-left">
                        <form action="#">
                            <input type="text" name="search" placeholder="Search..." required>
                            <i class="ti-search"></i>
                        </form>
                    </div> -->
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right">
                        <img class="avatar user-thumb" src="<?= base_url('/image/profile/' . $session->get('avatar')) ?>" alt="avatar">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= $session->get('name'); ?> <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <!-- <a class="dropdown-item" href="#">Message</a>-->
                            <a class="dropdown-item" href="<?= base_url('home/user/' . $session->get('id')); ?>">Settings</a>
                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="brand" style="font-weight: 1000;">
                    <!-- <a href="index.html"><img src="<?= base_url(); ?>/image/logo/gvp logo.png" style="max-width: 25%;" alt="logo">
                        <span class="">GVPWebAdmin</span>
                    </a> -->
                    <a href="#">
                        <h3 style="color:#3851DE">GVP<small style="color:#9338DE">DMS</small></h3>

                    </a>

                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="<?= base_url('home/index'); ?>" aria-expanded="true">Dashboard</a>
                            <li>
                                <?php if ($role !== '2') : ?>
                            <li class="active">
                                <a href="<?= base_url('vehicle/index'); ?>" aria-expanded="true">List Kendaraan</a>
                            <li>
                            <li class="active">
                                <a href="<?= base_url('validasi/index'); ?>" aria-expanded="true">Validasi
                                    <?php $total = $session->get('counts');
                                    if ($total > 0) : ?>
                                        <i><span class="badge badge-info right" style="text-align: right;"><?= $total ?></span></i>
                                    <?php endif; ?>
                                </a>
                            <li>
                            <?php endif ?>
                            <li>
                                <?php if ($role == '0') : ?>
                            <li class="active">
                                <a href="<?= base_url('auth/register'); ?>" aria-expanded="true">Register</a>
                            <li>
                            <?php endif; ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">