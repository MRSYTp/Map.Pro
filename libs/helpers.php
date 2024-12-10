<?php 

if(!defined('MAP_PATH')){
    echo "permision denid!";
    die();
}

function redirect($url){
    header("Location: $url");
    die();
}

function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}

function diePage($msg){
    echo "<div style='padding: 30px; width: 80%; margin: 50px auto; background: #f9dede; border: 1px solid #cca4a4; color: #521717; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
    die();
}

function dd($var){
    echo "<pre style='color: #9c4100; background: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #c56705;'>";
    var_dump($var);
    echo "</pre>";
}

function site_url($ur = ''){
    return MAP_URL . $ur;
}

function message($msg,$cssClass = 'info'){
    echo "<div class='$cssClass' style='padding: 20px; width: 80%; margin: 10px auto; background: #f9dede; border: 1px solid #cca4a4; color: #521717; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
}
function showErrorMessage($message) {
    echo "
    <div class='error-message'>
        $message
    </div>
    ";
}

function showSuccessMessage($message) {
    echo "
    <div class='success-message'>
        $message
    </div>
    ";
}

