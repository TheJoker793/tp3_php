<?php
session_start();

if (isset($_SESSION["user_session"])) {
    header('Location: index.php');
    exit();
}

require('./config/connexion.php');

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$userName = $userEmail = $userPassword = "";

if (!empty($_POST)) {
    $userName     = test_input($_POST['user_name']);
    $userEmail    = test_input($_POST['user_email']);
    $userPassword = test_input($_POST['user_password']);

    $errors = [];
    $valid  = true;

    if ($userName == "") {
        $errors[] = "Vous devez saisir un nom d'utilisateur !";
        $valid = false;
    }

    if ($userEmail == "") {
        $errors[] = "Vous devez saisir un email !";
        $valid = false;
    } elseif (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Vous devez saisir un email valide !";
        $valid = false;
    }

    if ($userPassword == "") {
        $errors[] = "Vous devez saisir un mot de passe !";
        $valid = false;
    } elseif (strlen($userPassword) < 6) {
        $errors[] = "Le mot de passe doit avoir au moins 6 caractères !";
        $valid = false;
    }

    if ($valid) {
        $sql = "SELECT * FROM users WHERE user_name = ? OR user_email = ?";
        $reponse = $con->prepare($sql);
        $reponse->execute([$userName, $userEmail]);
        $user = $reponse->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['user_name'] == $userName) {
            $errors[] = "Désolé, le nom d'utilisateur existe déjà !";
        } elseif ($user && $user['user_email'] == $userEmail) {
            $errors[] = "Désolé, l'email existe déjà !";
        } else {
            $new_password = password_hash($userPassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(user_name, user_email, user_password) VALUES (?, ?, ?)";
            $req = $con->prepare($sql);
            $res = $req->execute([$userName, $userEmail, $new_password]);

            if ($res) {
                header('Location: login.php');
                exit();
            }
        }
    }
}

$title = "Inscription";
include 'layout/header.php';
?>

    <div class="container">
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Inscription</h2>
            <hr>

            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <p><i class="lni lni-warning"></i> <?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="row mb-1">
                <input type="text" value="<?= $userName ?>" class="form-control"
                       name="user_name" placeholder="Votre nom d'utilisateur" required />
            </div>

            <div class="row mb-1">
                <input type="email" value="<?= $userEmail ?>" class="form-control"
                       name="user_email" placeholder="Votre E-Mail" required />
            </div>

            <div class="row mb-3">
                <input type="password" class="form-control"
                       name="user_password" placeholder="Votre mot de passe" required />
            </div>

            <div class="row mb-1">
                <button type="submit" class="btn btn-primary" name="btn-signup">
                    <i class="lni lni-users"></i> S'inscrire
                </button>
            </div>

            <br>
            <label>
                Déjà inscrit !
                <a href="login.php">Connexion</a>
            </label>
        </form>
    </div>

<?php include 'layout/footer.php'; ?>