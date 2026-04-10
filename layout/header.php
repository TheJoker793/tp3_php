<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= $title ?? 'title' ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/icon-font/lineicons.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Gestion de comptes bancaires</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- HOME -->
        <li class="nav-item">
          <a class="nav-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">
            <i class="lni lni-home"></i> Home
          </a>
        </li>

        <!-- CLIENTS -->
        <li class="nav-item">
          <a class="nav-link <?= (stripos($currentPage, 'client') !== false) ? 'active' : '' ?>" href="clients.php">
            <i class="lni lni-user"></i> Clients
          </a>
        </li>

        <!-- COMPTES -->
        <li class="nav-item">
          <a class="nav-link <?= (stripos($currentPage, 'compte') !== false) ? 'active' : '' ?>" href="comptes.php">
            <i class="lni lni-briefcase"></i> Comptes
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>