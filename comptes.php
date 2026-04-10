<?php
require_once './config/connexion.php';

$sql = "SELECT * FROM compte";
$stmt = $con->prepare($sql);
$stmt->execute();
$comptes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = "Liste des comptes";

include 'layout/header.php';
?>

<div class="container">
    <hr>

    <div class="row">
        <a href="createCompte.php">
            <button class="btn btn-primary">
                <i class="lni lni-wallet"></i> Nouveau compte
            </button> </a>
    </div>

    <hr>

    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Numéro</th>
                <th>Code bancaire</th>
                <th>code guichet</th>
                <th>clé rib</th>
                <th>titulaire</th>
                <th>solde</th>
                <th>Date de création</th>


                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($comptes as $index => $compte): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $compte["numcompte"] ?></td>
                    <td><?= $compte["codebank"] ?></td>
                    <td><?= $compte["codeguichet"] ?></td>
                    <td><?= $compte["clerib"] ?></td>
                    <td><?= $compte["titulaire"] ?></td>
                    <td><?= $compte["solde"] . " " . $compte["devise"] ?></td>
                    <td><?= $compte["datecreation"] ?></td>
                    <td>

                        <!-- UPDATE -->
                        <a href="updateCompte.php?id=<?= $compte['id'] ?>">
                            <i class="lni lni-pencil"></i>
                        </a>

                        <!-- DELETE MODAL -->
                        <a href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            onclick="setDeleteId(<?= $compte['id'] ?>)">
                            <i class="lni lni-trash-can"></i>
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- ================= MODAL DELETE ================= -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Confirmation suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="deleteCompte.php">

                <div class="modal-body">
                    Voulez-vous vraiment supprimer ce compte ?
                </div>

                <input type="hidden" name="id" id="delete_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Supprimer
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- JS -->
<script>
    function setDeleteId(id) {
        document.getElementById('delete_id').value = id;
    }
</script>

<?php include 'layout/footer.php'; ?>