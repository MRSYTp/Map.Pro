<?php
include "bootstrap/init.php";

$location = false;

if (isset($_GET["loc"]) && is_numeric($_GET["loc"])) {
    $location = (getLocationByID($_GET["loc"]));
}

include MAP_PATH . "template/tpl-index.php";