<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= ENV['APP_NAME'] ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="shortcut icon" href="#">
    <link href="./css.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto d-flex align-items-center">
            <!-- User Dropdown Menu -->
            <p data-toggle="dropdown" class="btn mb-0 bg-dark mr-2 p-1 shadow rounded"><i class="fas fa-lg fa-user-circle"></i>&nbsp;&nbsp;<?php $user = unserialize($_SESSION['user']);
            echo  $user->getFirstname().' '.$user->getLastname().' ['.$user->getRole()->getLabel().']';?></p>
            <li class="nav-item dropdown">
                <br/><br/>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a class="dropdown-item" href="?route=profil">Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?route=authenticate&action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a>
                </div>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <aside class="main-sidebar bg-dark elevation-2">
        <!-- Brand Logo -->
        
        <a href="?route=dashboard" class="brand-link"><img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"><span class="brand-text font-weight-light"><?= ENV['APP_NAME'] ?></span></a>

        <!-- Left Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <?php include('../page/template/menu.php'); ?>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>
                            <?= $tabTitle ?>
                            <?php
                            $user = unserialize($_SESSION['user']);
                            if($tabTitle=='Liste des tâches' AND $user->can('addTask')){
                                echo '<a href="?route=taskAdd"><i class="nav-icon fas fa-plus-circle" aria-hidden="true"></i></a>';
                            }
                            ?>
                        </h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">