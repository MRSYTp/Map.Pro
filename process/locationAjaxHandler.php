<?php 

include "../bootstrap/init.php";

if (isAjaxRequest()) {
    
    if (isset($_POST['email'],$_POST['name']) && !empty($_POST['email'])) {
        echo insertLocation($_POST);
    }else {
        echo "نام و ایمیل را وارد کنید.";
    }


}
