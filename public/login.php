<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>login</title>
</head>

<body class="login-body">
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" method="post">
                <div class="logo-container">
                    <a href="#"><img src="assets/images/logo.png" width="250px" height="auto" alt="OLEAN GROUP" id="logo"></a>
                </div>
                <h1>Créer un compte</h1>
                <Input type="text" placeholder="Nom" id="name"></Input>
                <Input type="email" placeholder="Email" id="emailR"></Input>
                <Input type="password" placeholder="Mot de passe" id="passwordR"></Input>
                <input type="button" value="Créer le compte" id="registerBtn"></input>
                <p id="sign-up-message"></p><br>
            </form>
        </div>
        <div class="form-container login-container">
            <form action="#" method="post">
                <div class="logo-container">
                    <a href="#"><img src="assets/images/logo.png" width="250px" height="auto" alt="OLEAN GROUP" id="logo"></a>
                </div>
                <h1>Se connecter</h1>
                <Input type="email" placeholder="Email" id="email"></Input>
                <Input type="password" placeholder="Mot de passe" id="password"></Input>
                <input type="button" id="loginBtn" value="Se connecter"></input>
                <p id="login-message"></p><br>
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>La synergie de l'expérience client et de l'innovation digitale en immobilier.</h1>
                    <p>OLEAN Group repense le concept de commercialisation immobilière grâce à la digitalisation des parcours d’achat.
                    </p>
                    <button class="ghost" id="login">Se connecter</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>La synergie de l'expérience client et de l'innovation digitale en immobilier.</h1>
                    <p>OLEAN Group repense le concept de commercialisation immobilière grâce à la digitalisation des parcours d’achat.
                    </p>
                    <button class="ghost" id="signup">Créer un compte</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/script.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#loginBtn").on('click', function() {
                var email = $("#email").val();
                var password = $("#password").val();

                if (email == "" || password == "") {
                    alert('Veuillez renseigner tous les champs');
                } else {
                    $.ajax({
                        url: '../private/authenticate.php',
                        method: 'POST',
                        data: {
                            login: 1,
                            emailPHP: email,
                            passwordPHP: password
                        },
                        success: function(response) {
                            if (response == "success") {
                                window.location = 'index.php';
                            } else {
                                $("#login-message").html(response);
                            }
                        },
                        dataType: 'text'
                    });
                }
            });

            $("#registerBtn").on('click', function() {
                var name = $("#name").val();
                var emailR = $("#emailR").val();
                var passwordR = $("#passwordR").val();

                if (name == "" || emailR == "" || passwordR == "") {
                    alert('Veuillez renseigner tous les champs');
                } else {
                    $.ajax({
                        url: '../private/authenticate.php',
                        method: 'POST',
                        data: {
                            login: 2,
                            name: name,
                            emailR: emailR,
                            passwordR: passwordR
                        },
                        success: function(response) {
                            if (response == "success") {
                                $("#sign-up-message").html("<span class='form-success'>Enregistrement effectué</span>");
                                clearFields();
                            } else {
                                $("#sign-up-message").html(response);
                            }
                        },
                        dataType: 'text'
                    });
                }
            });

            function clearFields() {
                $("#name").val("");
                $("#emailR").val("");
                $("#passwordR").val("");
            }
        });
    </script>
</body>

</html>