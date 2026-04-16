<?php 
session_start(); 

require('./config/connexion.php'); 
include 'layout/header.php'; 

// Fonction de nettoyage
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (!empty($_POST)) {

    $login = test_input($_POST['user_name']); // login ou email
    $userPassword = test_input($_POST['user_password']);

    // Vérifier si c'est un email ou un username
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $params = [$login];
    } else {
        $sql = "SELECT * FROM users WHERE user_name = ?";
        $params = [$login];
    }

    // Préparer et exécuter la requête
    $reponse = $con->prepare($sql);
    $reponse->execute($params);

    // Récupérer l'utilisateur
    $user = $reponse->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($user && password_verify($userPassword, $user['user_password'])) {

        // Création session
        $_SESSION["user_session"] = $user['user_id']; 

        // Redirection
        header('Location:index.php');
        exit();

    } else {
        $error = "Login ou mot de passe incorrect !";
    }
}
?>

<div class="signin-form">
    <div class="container">
        <form class="form-signin" method="post" id="login-form">
            <h2 class="form-signin-heading">Connexion</h2>
            <hr>

            <!-- Message d'erreur -->
            <div id="error">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger">
                        <i class="lni lni-warning"></i> <?php echo $error ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Login ou Email -->
            <div class="row mb-1">
                <input type="text" 
                       class="form-control" 
                       name="user_name" 
                       placeholder="Login ou E-mail" 
                       required />
            </div>

            <!-- Mot de passe -->
            <div class="row mb-3">
                <input type="password" 
                       class="form-control" 
                       name="user_password" 
                       placeholder="Mot de passe" 
                       required />
            </div>

            <!-- Bouton -->
            <div class="row mb-1">
                <button type="submit" name="btn-login" class="btn btn-primary">
                    <i class="lni lni-enter"></i> Connexion
                </button>
            </div>

            <br>
            <label>
                Vous n'avez pas un compte ! 
                <a href="sign-up.php">Inscription</a>
            </label>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>