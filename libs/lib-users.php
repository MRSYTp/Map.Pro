<?php 



function login($username,$password){
    global $admins;
    if (array_key_exists($username,$admins) && $admins[$username] == $password) {
        $_SESSION["login"] = 1;
        return true;
    }else {
        return false;
    }

}

function isLogedIn(){

    if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
        return true;
    }
    return false;
}

function logout(){
    unset($_SESSION["login"]);
}