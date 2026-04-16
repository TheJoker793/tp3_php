<?php
require('./config/session.php'); 

require_once './config/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idCompte = $_POST['id'];

    $sql = "DELETE FROM compte WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$idCompte]);

    header("Location: comptes.php");
    exit;
}