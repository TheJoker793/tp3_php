<?php
// config/session.php
session_start();
require 'connexion.php'; 

if (!isset($_SESSION["user_session"])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_session'];

$sql = "SELECT * FROM users WHERE user_id = ?";
$reponse = $con->prepare($sql);
$reponse->execute([$user_id]);
$connected_user = $reponse->fetch(PDO::FETCH_ASSOC);