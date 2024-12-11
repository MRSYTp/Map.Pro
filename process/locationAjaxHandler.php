<?php 

include "../bootstrap/init.php";

if (isAjaxRequest()) {
    // var_dump($_POST);

    echo insertLocation($_POST);

}
