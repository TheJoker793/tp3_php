<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$pagesPubliques = ['login.php', 'signup.php'];
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

<?php if (!in_array($currentPage, $pagesPubliques)) : ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Gestion de comptes bancaires</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>" href="index.php">
            <i class="lni lni-home"></i> Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= (stripos($currentPage, 'client') !== false) ? 'active' : '' ?>" href="clients.php">
            <i class="lni lni-user"></i> Clients
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= (stripos($currentPage, 'compte') !== false) ? 'active' : '' ?>" href="comptes.php">
            <i class="lni lni-briefcase"></i> Comptes
          </a>
        </li>

      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            <i class="lni lni-user"></i>
            <?= isset($connected_user) ? htmlspecialchars($connected_user['user_name']) : 'Compte' ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <a class="dropdown-item" href="#">
                <i class="lni lni-user"></i> Mon profil
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item text-danger" href="logout.php">
                <i class="lni lni-exit"></i> Déconnexion
              </a>
            </li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</nav>
<?php endif; ?>