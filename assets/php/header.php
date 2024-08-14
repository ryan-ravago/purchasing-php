<?php
session_start();
if (!isset($_SESSION["email"])) {
  header('location: index.php?message=loginError');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./libs/bootstrap.min.css">
  <link rel="stylesheet" href="./libs/icons-1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./libs/Datatables/DataTables-1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="./libs/Datatables/FixedHeader-3.4.0/css/fixedHeader.bootstrap5.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./libs/summernote/summernote-lite.css">
  <title>
    <?php
      if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
        echo 'Dashboard';
      } else if (basename($_SERVER['PHP_SELF']) == 'my-requests.php') {
        echo 'My Requests';
      } else if (basename($_SERVER['PHP_SELF']) == 'requests.php') {
        echo 'Requests';
      } else if (basename($_SERVER['PHP_SELF']) == 'settings.php') {
        echo 'Settings';
      } 
    ?>
  </title>
  <style>
    <?php require_once "assets/css/style.css";?>
  </style>
</head>

<body>
  <header>
    <!-- Start Navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg bg-warning fixed-top">
      <div class="container-fluid">
        <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand mx-auto fw-bold ps-md-3" href="#">PURCHASING</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white fw-medium" href="./assets/php/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Offcanvas -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark text-white" tabindex="-1" id="offcanvas" data-bs-backdrop="false">
      <div class="offcanvas-header" style="margin-top:-3px;" >
        <a href="dashboard.php" class="text-white" style="text-decoration: none;">
          <h5 class="offcanvas-title fw-bold" id="offcanvasExampleLabel">
            <i class="bi bi-speedometer2"></i> &nbsp;RAVAGO
          </h5>
        </a>
        <a href="#" class="burger text-light" data-bs-dismiss="offcanvas"><i class="bi bi-list"></i></a>
      </div>
      <hr style="margin-top:-3px">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav" style="font-size:17px;">
            <li>
              <a href="dashboard.php" class="nav-link px-3 py-3 sidebar-link fw-medium <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-warning text-black' : 'text-white'?>">
                <i class="bi bi-flag"></i> &nbsp;Dashboard
              </a>
            </li>
            <li>
              <a href="my-requests.php" class="nav-link px-3 py-3 sidebar-link fw-medium <?= basename($_SERVER['PHP_SELF']) == 'my-requests.php' ? 'bg-warning text-black' : 'text-white' ?>">
                <i class="bi bi-diagram-3"></i> &nbsp;My Requests
              </a>
            </li>
            <li>
              <a href="requests.php" class="nav-link px-3 py-3 sidebar-link fw-medium <?= basename($_SERVER['PHP_SELF']) == 'requests.php' ? 'bg-warning text-black' : 'text-white' ?>">
                <i class="bi bi-book"></i> &nbsp;Requests
              </a>
            </li>
            <li>
              <a href="settings.php" class="nav-link px-3 py-3 sidebar-link fw-medium <?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'bg-warning text-black' : 'text-white' ?>">
                <i class="bi bi-list-check"></i> &nbsp;Settings
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- End Offcanvas -->

  </header>