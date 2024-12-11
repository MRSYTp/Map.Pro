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