<?php 
include "bootstrap/init.php";
if(isset($_GET["logout"]) && $_GET["logout"] == 1){
    logout();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        if (isset($_POST["password"]) && !empty($_POST["password"])) {
            if (login($_POST["username"],$_POST["password"])){

            }else{
                showErrorMessage("رمز یا یوزر نیم اشتباه است.");
            }
        }else{
            showErrorMessage("رمز را وارد کنید.");
        }
    }else{
        showErrorMessage("نام را وارد کنید.");
    }
}



if (isLogedIn()) {
    $params = $_GET ?? [];
    $locations = getLocations($params);
    include MAP_PATH . "template/tpl-adm.php";
}else {
    include MAP_PATH . "template/tpl-adm-form.php";
}
