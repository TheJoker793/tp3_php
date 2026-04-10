<?php
require_once './config/connexion.php';

// ======================
// 1. TRAITEMENT UPDATE
// ======================
if (!empty($_POST)) {

    $id_compte = $_GET['id'];

    $numcompte = $_POST['numcompte'];
    $codebank = $_POST['codebank'];
    $codeguichet = $_POST['codeguichet'];
    $clerib = $_POST['clerib'];
    $titulaire = $_POST['titulaire'];
    $solde = $_POST['solde'];
    $devise = $_POST['devise'];
    $datecreation = $_POST['datecreation'];

    $sql = "UPDATE compte
            SET numcompte = ?,
                codebank = ?,
                codeguichet = ?,
                clerib = ?,
                titulaire = ?,
                solde = ?,
                devise = ?,
                datecreation = ?
            WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->execute([
        $numcompte,
        $codebank,
        $codeguichet,
        $clerib,
        $titulaire,
        $solde,
        $devise,
        $datecreation,
        $id_compte
    ]);

    header("Location: comptes.php");
    exit;
}

// ======================
// 2. AFFICHAGE FORMULAIRE
// ======================
$id_compte = $_GET['id'];

$sql = "SELECT * FROM compte WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$id_compte]);
$compte = $stmt->fetch(PDO::FETCH_ASSOC);

$title = "Modifier le compte";
include 'layout/header.php';
?>

<div class="container">
    <hr>

    <fieldset>
        <legend><h2>Modifier le compte</h2></legend>

        <form method="post">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Numéro Compte</label>
                <div class="col-sm-7">
                    <input type="text" name="numcompte" class="form-control"
                           value="<?= $compte['numcompte'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Code Banque</label>
                <div class="col-sm-7">
                    <input type="text" name="codebank" class="form-control"
                           value="<?= $compte['codebank'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Code Guichet</label>
                <div class="col-sm-7">
                    <input type="text" name="codeguichet" class="form-control"
                           value="<?= $compte['codeguichet'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Clé RIB</label>
                <div class="col-sm-7">
                    <input type="text" name="clerib" class="form-control"
                           value="<?= $compte['clerib'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Titulaire</label>
                <div class="col-sm-7">
                    <input type="text" name="titulaire" class="form-control"
                           value="<?= $compte['titulaire'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Solde</label>
                <div class="col-sm-7">
                    <input type="number" step="0.01" name="solde" class="form-control"
                           value="<?= $compte['solde'] ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Devise</label>
                <div class="col-sm-7">
                    <select name="devise" class="form-select">
                        <option value="DTN" <?= ($compte['devise'] == 'DTN') ? 'selected' : '' ?>>DTN</option>
                        <option value="EUR" <?= ($compte['devise'] == 'EUR') ? 'selected' : '' ?>>Euro</option>
                        <option value="USD" <?= ($compte['devise'] == 'USD') ? 'selected' : '' ?>>Dollar US</option>
                        <option value="GBP" <?= ($compte['devise'] == 'GBP') ? 'selected' : '' ?>>Livre Sterling</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Date Création</label>
                <div class="col-sm-7">
                    <input type="date" name="datecreation" class="form-control"
value="<?= date('Y-m-d', strtotime($compte['datecreation'])) ?>"                           >
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