<?php
session_start();

if (isset($_SESSION['loggedIN'])) {
    header('Location: ../public/index.php');
    exit();
}

if (isset($_POST['login'])) {
    $storage = "database/data.json";
    $stored_users = json_decode(file_get_contents($storage), true);

    //Traitement d'une connexion
    if (htmlspecialchars(trim($_POST['login'] == 1), ENT_QUOTES)) {
        $email = filter_var(htmlspecialchars(trim($_POST['emailPHP']), ENT_QUOTES), FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars(trim($_POST['passwordPHP']), ENT_QUOTES);

        foreach ($stored_users as $user) {
            if ($email == $user['email']) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['loggedIN'] = '1';
                    $_SESSION['email'] = $email;
                    exit("success");
                } else {
                    exit("<span class='form-error'>Mot de passe incorrect</span>");
                }
            }
        }
        exit("<span class='form-error'>Email incorrect</span>");
    } //Fin Traitement d'une connexion

    //Traitement d'une création de compte
    elseif (htmlspecialchars(trim($_POST['login'] == 2), ENT_QUOTES)) {
        $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES);

        $emailR = filter_var(htmlspecialchars(trim($_POST['emailR']), ENT_QUOTES), FILTER_SANITIZE_EMAIL);
        // Validation email
        if (!filter_var($emailR, FILTER_VALIDATE_EMAIL)) {
            exit("<span class='form-error'>Veuillez renseigner un email valide x@x.x</span>");
        }

        $passwordR = htmlspecialchars(trim($_POST['passwordR']), ENT_QUOTES);
        // Validation password
        if (strlen($passwordR) > 4) {
            $passwordR = password_hash(htmlspecialchars(trim($_POST['passwordR']), ENT_QUOTES), PASSWORD_DEFAULT);
        } else {
            exit("<span class='form-error'>Veuillez renseigner un mot de passe d'au moins cinq(5) caractères</span>");
        }

        $new_user = [
            "name" => $name,
            "email" => $emailR,
            "password" => $passwordR,
        ];

        // On vérifie si l'email n'existait pas déjà
        foreach ($stored_users as $user) {
            if ($emailR == $user['email']) {
                exit("<span class='form-error'>Un compte existe déjà avec cet email</span>");
            }
        }

        // On ajoute le nouvel utilisateur au tableau puis au fichier data.json
        array_push($stored_users, $new_user);
        if (file_put_contents($storage, json_encode($stored_users, JSON_PRETTY_PRINT))) {
            exit("success");
        } else {
            exit("<span class='form-error'>Une erreur s'est produite, veuillez réessayer</span>");
        }
    } //Fin Traitement d'une création de compte
}
