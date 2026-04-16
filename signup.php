<?php require('./config/connexion.php') ?>*
<?php include 'layout/header.php'; ?>

<?php 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



?>


    <?php
    $userName = $userEmail = $userPassword = "";
    // Récupérer le contenu du formulaire d'inscription
    if (!empty($_POST)) {
        //récupération des informations du formulaire
        // la fonctio  trim() permet de supprimer les espaces avant et après un texte
        $userName = test_input($_POST['user_name']);
        $userEmail = test_input($_POST['user_email']);
        $userPassword = test_input($_POST['user_password']); 

        //Remplissage des messages d'erreurs dans un tableau
        $errors = [];
        $valid = true;

        if ($userName == "") {    // Vérifier username
            array_push($errors, "Vous devez saisir un nom d'utilisateur!");
            $valid = false;
        }

        if ($userEmail == "") {   // Vérifier email
            array_push($errors, "Vous devez saisir un email");
            $valid = false;
        } else if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Vous devez saisir un email valide");
            $valid = false;
        }

        if ($userPassword == "") {    // Vérifier mot de passe
            array_push($errors, "Vous devez saisir un mot de passe");
            $valid = false;
        } else if (strlen($userPassword) < 6) {
            array_push($errors, "Le mot de passe doit avoir au moins 6 caractères");
            $valid = false;
        }

        // Il n'y a pas d'erreurs
        // ON recherche si l'utilisateur existe déjà dans la base
        // La recherche se fait par username ou email
        if ($valid) {
            // Requête SQL
            $sql = "SELECT * FROM users WHERE user_name = ? OR user_email = ?";
            // Envoyer la requête au serveur et récupérer le résultat
            $reponse = $con->prepare($sql);
            // Envoyer la requête au serveur et récupérer le résultat
            // le résultat peut être null si la requête est erronée
            $reponse->execute([$userName, $userEmail]);
            
            //On récupère le résultat
            $user = $reponse->fetch(PDO::FETCH_ASSOC);

            //Si l'utilisateur existe on prépare les messages d'erreurs
            if ($user['user_name'] == $userName) {
                array_push($errors, "Désolé, le nom d'utilisateur existe déjà !");
            } else if ($user['user_email'] == $userEmail) {
                $errors[] = "Désolé, l'email existe déjà !";
            } else {
                //si l'utilisateur n'existe pas alors on l'enregistre dans la BD
                // Hashage du mot de passe
                $new_password = password_hash($userPassword, PASSWORD_DEFAULT);

                // On prépare la requête
                $sql = "INSERT INTO users(user_name,user_email,user_password) VALUES (?, ?, ?)";
                $req = $con->prepare($sql);

                // Envoi et exécution de la requête
                $res = $req->execute([$userName, $userEmail, $new_password]);
                // Si l'insertion est effectuée avec succès
                // On redérige l'utilisateur vers la page de login (connexion)

                if ($res) {
                    header('Location:login.php');
                }
            }
        }
    }
    ?>

    <div class="signin-form">
        <div class="container">
            <form method="post" class="form-signin">
                <h2 class="form-signin-heading">Inscription</h2>
                <hr />
                <?php
                // S'il existe des messages d'erreurs, on les affiches
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger">';
                    foreach ($errors as $error) {
                        echo '<p><i class="lni lni-warning"></i> ' . $error . '</p>';
                    }
                    echo '</div>';
                }
                ?>
                <div class="row mb-1">
                    <input type="text" value="<?= $userName ?>" class="form-control" name="user_name" placeholder="Votre nom d'utilisateur"  />
                </div>
                <div class="row mb-1">
                    <input type="email" class="form-control" name="user_email" placeholder="Votre E-Mail"  />
                </div>
                <div class="row mb-3">
                    <input type="password" class="form-control" name="user_password" placeholder="Votre mot de passe"     />
                </div>
                <div class="clearfix"></div>
                <div class="row mb-1">
                    <button type="submit" class="btn btn-primary" name="btn-signup">
                        <i class="lni lni-users"></i> S'inscrire
                    </button>
                </div>
                <br />
                <label>Déjà inscrit ! <a href="index.php">Connexion</a></label>
            </form>
        </div>
    </div>


<?php include 'layout/footer.php'; ?>