<?php
session_start();

if (!isset($_SESSION['loggedIN'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Page 1</title>
</head>

<body>
    <div class="banner">
        <div class="navbar">
            <img src="assets/images/logo.png" alt="logo" class="logo">
            <ul>
                <li> <span class="btn_load_screen" call_type="index">Accueil</span></li>
                <li> <span class="btn_load_screen" call_type="pageOne">Page 1</span></li>
                <li> <span class="btn_load_screen" call_type="pageTwo">Page 2</span></li>
                <button> <a href="logout.php">Se déconnecter</a></button>
            </ul>
        </div>

        <div class="content">
            <h1>Je suis sur la page 1, j'ai ce petit test en plus</h1>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".btn_load_screen").on('click', function() {
                var current_url = location.href;
                var call_type = $(this).attr('call_type');

                $.getJSON('../private/ajax.php', {
                    call_type: call_type
                }, function(data, textStatus, xhr) {
                    console.log(data);

                    document.title = data.title;
                    $(document).find('.content').html(data.data);
                    history.pushState('new', 'title', data.url);
                });
            });
        });
    </script>
</body>

</html>