<?php

if (isset($_GET['call_type'])) {
    $call_type = $_GET['call_type'];

    if ($call_type == "index") {
        $html = file_get_contents("../public/index.php");
        preg_match('/<div class="content">(.*?)<\/div>/s', $html, $matches);
        $div_content = $matches[1];
        echo json_encode(array(
            'status' => 'success',
            'title' => 'Accueil',
            'url' => 'index.php',
            'data' => $div_content,
        ));
    } elseif ($call_type == "pageOne") {
        $html = file_get_contents("../public/pageOne.php");
        preg_match('/<div class="content">(.*?)<\/div>/s', $html, $matches);
        $div_content = $matches[1];
        echo json_encode(array(
            'status' => 'success',
            'title' => 'Page 1',
            'url' => 'pageOne.php',
            'data' => $div_content,
        ));
    } elseif ($call_type == "pageTwo") {
        $html = file_get_contents("../public/pageTwo.php");
        preg_match('/<div class="content">(.*?)<\/div>/s', $html, $matches);
        $div_content = $matches[1];
        echo json_encode(array(
            'status' => 'success',
            'title' => 'Accueil',
            'url' => 'pageTwo.php',
            'data' => $div_content,
        ));
    }
}
