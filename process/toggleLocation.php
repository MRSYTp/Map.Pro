<?php 
include "../bootstrap/init.php";


if (isAjaxRequest()) {
    if(isset($_POST["locid"]) && is_numeric($_POST["locid"])){
        // echo $_POST["locid"];
        echo toggleVerifiedLocation($_POST['locid']);
    }else {
        echo "آی‌دی لوکیشن یافت نشد!";
    }
}else {
    diePage("Request Invalid!");
}

