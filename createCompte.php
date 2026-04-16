<?php
session_start();
require_once './config/connexion.php';

if (!empty($_POST)) {

    $numcompte = $_POST['numcompte'];
    $codebank = $_POST['codebank'];
    $codeguichet = $_POST['codeguichet'];
    $clerib = $_POST['clerib'];
    $titulaire = $_POST['titulaire'];
    $solde = $_POST['solde'];
    $devise = $_POST['devise'];
    $datecreation = $_POST['datecreation'];

    $sql = "INSERT INTO compte 
            (numcompte, codebank, codeguichet, clerib, titulaire, solde, devise, datecreation)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $result = $stmt->execute([
        $numcompte,
        $codebank,
        $codeguichet,
        $clerib,
        $titulaire,
        $solde,
        $devise,
        $datecreation
    ]);

    if ($result) {
        header("Location: comptes.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Erreur insertion</div>";
    }
}
?>

<?php
$title = "Nouveau compte";
include 'layout/header.php';
?>

<div class="container">
    <hr>
    <fieldset>
        <legend><h2>Nouveau Compte</h2></legend>
        <hr>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Numéro de Compte</label>
                <div class="col-sm-7">
                    <input type="text" name="numcompte" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Code Banque</label>
                <div class="col-sm-7">
                    <input type="text" name="codebank" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Code Guichet</label>
                <div class="col-sm-7">
                    <input type="text" name="codeguichet" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Clé RIB</label>
                <div class="col-sm-7">
                    <input type="text" name="clerib" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Titulaire</label>
                <div class="col-sm-7">
                    <input type="text" name="titulaire" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Solde</label>
                <div class="col-sm-7">
                    <input type="number" step="0.01" name="solde" class="form-control" required>
                </div>
            </div>

<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="devise">Devise</label>
    <div class="col-sm-7">
        <select name="devise" id="devise" class="form-select" required>
            <option value="">-- Choisir une devise --</option>
            <option value="DTN">DTN (Dinar Tunisien)</option>
            <option value="EUR">Euro</option>
            <option value="USD">Dollar US</option>
            <option value="GBP">Livre Sterling</option>
            <option value="JPY">Yen Japonais</option>
        </select>
    </div>
</div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Date de création</label>
                <div class="col-sm-7">
                    <input type="date" name="datecreation" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-9 offset-sm-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" required>
                        <label class="form-check-label">
                            Contrat lu et accepté
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 offset-sm-2">
                    <button type="submit" name="btValider" class="btn btn-primary">
                        Valider
                    </button>
                </div>
            </div>

        </form>
    </fieldset>
</div>

<?php include 'layout/footer.php'; ?>