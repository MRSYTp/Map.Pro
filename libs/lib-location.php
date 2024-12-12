<?php 



function insertLocation($data){
    global $conn;
    if (isset($data["title"]) && !empty($data["title"])) {
        if (array_key_exists($data["type"], locationTypes)) {

            $query = "INSERT INTO `locations` ( `title`, `lng`, `lat`, `type`) VALUES (:titleL, :lngL, :latL , :typeL)";
            $stmt = $conn->prepare($query);
            $stmt->execute([":titleL" => $data["title"] ,":lngL" => $data["lng"],":latL" => $data["lat"],":typeL" => $data["type"]]);
            return $stmt->rowCount();
            // return "OK";
        }else {
            return "تایپ مکانی که انتخاب کردین وجود ندارد.";
        }
    }else{
        return "اسم مکان موررد نظر را بنویسید.";
    }

}


function getLocations($params = []){
    global $conn;
    $condition = '';
    if(isset($params['verified'])  &&  in_array($params['verified'],["0","1"])){
        $condition = "WHERE verified={$params['verified']}";
    }
    $query = "SELECT * FROM `locations` $condition";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}



function getLocationByID($id){
    global $conn;
    $query = "SELECT * FROM `locations` WHERE id = :ID ";
    $stmt = $conn->prepare($query);
    $stmt->execute([":ID" => $id]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

function toggleVerifiedLocation($id){
    global $conn;
    $query = "UPDATE locations SET verified = 1 - verified WHERE id = :ID ";
    $stmt = $conn->prepare($query);
    $stmt->execute([":ID" => $id]);
    return $stmt->rowCount();
}