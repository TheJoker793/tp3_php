<?php
require_once './config/connexion.php';

$sql = "SELECT * FROM client";
$stmt = $con->prepare($sql);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = "Liste des clients";

include 'layout/header.php';
?>

<div class="container">
    <hr>

    <div class="row">
        <a href="createClient.php">
            <button class="btn btn-primary">
                <i class="lni lni-user"></i> Nouveau client
            </button>
        </a>
    </div>

    <hr>

    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= $client["id"] ?></td>
                <td><?= $client["nom"] ?></td>
                <td><?= $client["prenom"] ?></td>
                <td><?= $client["datenaissance"] ?></td>
                <td><?= $client["adresse"] ?></td>
                <td><?= $client["tel"] ?></td>
                <td>

                    <!-- UPDATE -->
                    <a href="updateClient.php?id=<?= $client['id'] ?>">
                        <i class="lni lni-pencil"></i>
                    </a>

                    <!-- DELETE MODAL -->
                    <a href="#"
                       data-bs-toggle="modal"
                       data-bs-target="#deleteModal"
                       onclick="setDeleteId(<?= $client['id'] ?>)">
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

      <form method="POST" action="deleteClient.php">

        <div class="modal-body">
            Voulez-vous vraiment supprimer ce client ?
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