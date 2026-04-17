<?php
session_start();


require('./config/connexion.php');

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (!empty($_POST)) {
    $login        = test_input($_POST['user_name']);
    $userPassword = test_input($_POST['user_password']);

    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $sql    = "SELECT * FROM users WHERE user_email = ?";
        $params = [$login];
    } else {
        $sql    = "SELECT * FROM users WHERE user_name = ?";
        $params = [$login];
    }

    $reponse = $con->prepare($sql);
    $reponse->execute($params);
    $user = $reponse->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($userPassword, $user['user_password'])) {
        $_SESSION["user_session"] = $user['user_id'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Login ou mot de passe incorrect !";
    }
}

$title = "Connexion";
include 'layout/header.php';
?>

    <div class="container">
        <form class="form-signin" method="post" id="login-form">
            <h2 class="form-signin-heading">Connexion</h2>
            <hr>

            <div id="error">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <i class="lni lni-warning"></i> <?= $error ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row mb-1">
                <input type="text" class="form-control" name="user_name"
                       placeholder="Login ou E-mail" required />
            </div>

            <div class="row mb-3">
                <input type="password" class="form-control" name="user_password"
                       placeholder="Mot de passe" required />
            </div>

            <div class="row mb-1">
                <button type="submit" name="btn-login" class="btn btn-primary">
                    <i class="lni lni-enter"></i> Connexion
                </button>
            </div>

            <br>
            <label>
                Vous n'avez pas un compte !
                <a href="signup.php">Inscription</a>
            </label>
        </form>
    </div>

<?php include 'layout/footer.php'; ?>