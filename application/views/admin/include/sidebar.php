<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url('assets/back/');?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">eTicaret Sitesi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/back/');?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?php
                        $name = $_SESSION['admininfo'];
                        echo $name->name;
                    ?>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-header">MENU</li>
        <li class="nav-item">
            <a href="<?= base_url('admin/panel') ?>" class="nav-link <?php active('panel'); ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>Home</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('admin/product') ?>" class="nav-link <?php active('product'); ?>">
                <i class="nav-icon fas fa-shopping-bag"></i>
                <p>Products</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('admin/categories') ?>" class="nav-link <?php active('categories'); ?>">
                <i class="nav-icon fas fa-align-justify"></i>
                <p>Categories</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('admin/product_options') ?>" class="nav-link <?php active('product_options'); ?>">
                <i class="nav-icon fas fa-sort"></i>
                <p>Options</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('admin/config') ?>" class="nav-link <?php active('config'); ?>">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('admin/logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
        <li class="nav-header">FUNCTIONS</li>
        <li class="nav-item">
            <?php if ($this->session->userdata('delete_function')): ?>
            <a href="<?= base_url('admin/delete_function') ?>" class="nav-link navbar-success">
                <i class="nav-icon fas fa-check"></i>
                <p>Delete Function Open</p>
            </a>
            <?php else: ?>
            <a href="<?= base_url('admin/delete_function') ?>" class="nav-link">
                <i class="nav-icon fas fa-ban"></i>
                <p>Delete Function Close</p>
            </a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php if(isset($head)){echo $head;} ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <?php flashread(); ?>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->