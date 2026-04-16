<?php
require('./config/session.php'); 

require_once './config/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idClient = $_POST['id'];

    $sql = "DELETE FROM client WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$idClient]);

    header("Location: clients.php");
    exit;
}