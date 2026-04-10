<?php
require_once './config/connexion.php';

if (!empty($_POST)) {

    $id_client = $_GET['id'];

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateN = $_POST['dateN'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];

    $sql = "UPDATE client 
            SET nom = ?, 
                prenom = ?, 
                datenaissance = ?, 
                adresse = ?, 
                tel = ?
            WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->execute([$nom, $prenom, $dateN, $adresse, $tel, $id_client]);

    header("Location: clients.php");
    exit;
}

// ======================
// 2. AFFICHAGE FORM (GET)
// ======================
$id_client = $_GET['id'];

$sql = "SELECT * FROM client WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$id_client]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
    $title = "Erreur";
    include 'layout/header.php';
    echo "<div class='container mt-4'>";
    echo "<div class='alert alert-danger'>Client introuvable.</div>";
    echo "<a href='clients.php' class='btn btn-secondary'>Retour</a>";
    echo "</div>";
    include 'layout/footer.php';
    exit;
}


$title = "Modifier le client";

include 'layout/header.php';
?>

<div class="container">
    <hr>

    <fieldset>
        <legend><h2>Modifier le client</h2></legend>

        <form method="post">

            <div class="row mb-1">
                <label class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-7">
                    <input type="text" name="nom" class="form-control"
                           value="<?= $client['nom'] ?>">
                </div>
            </div>

            <div class="row mb-1">
                <label class="col-sm-2 col-form-label">Prénom</label>
                <div class="col-sm-7">
                    <input type="text" name="prenom" class="form-control"
                           value="<?= $client['prenom'] ?>">
                </div>
            </div>

            <div class="row mb-1">
                <label class="col-sm-2 col-form-label">Date de naissance</label>
                <div class="col-sm-7">
                    <input type="date" name="dateN" class="form-control"
                           value="<?= $client['datenaissance'] ?>">
                </div>
            </div>

            <div class="row mb-1">
                <label class="col-sm-2 col-form-label">Adresse</label>
                <div class="col-sm-7">
                    <input type="text" name="adresse" class="form-control"
                           value="<?= $client['adresse'] ?>">
                </div>
            </div>

            <div class="row mb-1">
                <label class="col-sm-2 col-form-label">Téléphone</label>
                <div class="col-sm-7">
                    <input type="text" name="tel" class="form-control"
                           value="<?= $client['tel'] ?>">
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" name="btValider" class="btn btn-primary">
                    Modifier
                </button>
            </div>

        </form>
    </fieldset>
</div>

<?php include 'layout/footer.php'; ?>