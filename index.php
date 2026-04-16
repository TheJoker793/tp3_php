<?php
require('./config/session.php'); 
$title = "Accueil";
include 'layout/header.php';
?>

<div class="container">
  <hr>
  
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-2 g-3">
    <div class="col">
      <div class="card border-primary mb-3">
        <div class="card-header text-center text-primary"><h2><i class="lni lni-user"></i> Clients</h2></div>
        <div class="card-body text-primary">
          <h5 class="card-title">Accéder à la section de gestion des clients :</h5>
          <p class="card-text">
            <ul>
              <li>Ajouter un nouveau client, modifier, supprimer</li>
              <li>Afficher un état</li>
              <li>etc.</li>
            </ul>
            Cliquer sur le bouton ci-dessous.
          </p>
        </div>
        <div class="card-footer bg-transparent border-success d-grid gap-2">
          <a href="clients.php" class="btn btn-outline-primary btn-block">Accéder à la page clients</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card border-primary mb-3">
        <div class="card-header text-center text-primary"><h2><i class="lni lni-briefcase"></i> Comptes</h2></div>
        <div class="card-body text-primary">
          <h5 class="card-title">Accéder à la section de gestion des comptes :</h5>
          <p class="card-text">
            <ul>
              <li>Ajouter un nouveau compte, modifier, supprimer</li>
              <li>Afficher un état</li>
              <li>etc.</li>
            </ul>
            Cliquer sur le bouton ci-dessous.
          </p>
        </div>
        <div class="card-footer bg-transparent border-success d-grid gap-2">
          <a href="comptes.php" class="btn btn-outline-primary">Accéder à la page comptes</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>