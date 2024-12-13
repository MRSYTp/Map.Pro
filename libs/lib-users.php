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


function insertUser($name,$email){

    global $conn;
    $query = "INSERT INTO `users` ( `name`, `email`) VALUES (:nameU, :emailU)";
    $stmt = $conn->prepare($query);
    $stmt->execute([":nameU" => $name,":emailU" => $email]);
    return $stmt->rowCount();

}

function isUser($email){

    global $conn;
    $query = "SELECT * FROM `users` WHERE email = :EMAIL ";
    $stmt = $conn->prepare($query);
    $stmt->execute([":EMAIL" => $email]);
    return $stmt->fetch(PDO::FETCH_OBJ);


}