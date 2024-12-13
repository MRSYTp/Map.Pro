<?php 



function insertLocation($data){
    global $conn;
    if (isset($data["title"]) && !empty($data["title"])) {


        if (array_key_exists($data["type"], locationTypes)) {


            if (!islocation($data['title'])) {

                if (!isUser($data['email'])){

                    return insertUser($data['name'],$data['email']) ? "یوزر شما ثیت نشده بود پنجره رو ببندید و دوباره امتحان کنید." : '';

                }else {
                    $user = isUser($data['email']);
                    $query = "INSERT INTO `locations` ( `user_id`,`title`, `lng`, `lat`, `type`) VALUES (:user_idL,:titleL, :lngL, :latL , :typeL)";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([":titleL" => $data["title"] ,":lngL" => $data["lng"],":latL" => $data["lat"],":typeL" => $data["type"],":user_idL" => $user->id]);
                    return $stmt->rowCount();
                }


            }else {
                return "مکان از قبل ثبت شده است یک نام دیگر وارد کنید.";
            }


        }else {
            return "تایپ مکانی که انتخاب کردین وجود ندارد.";
        }


    }else{
        return "اسم مکان موررد نظر را بنویسید.";    
    }

}


function islocation($title){
    global $conn;

    $query = "SELECT * FROM `locations` WHERE title = :TITLE ";
    $stmt = $conn->prepare($query);
    $stmt->execute([":TITLE" => $title]);
    return $stmt->fetch(PDO::FETCH_OBJ) ?true : false;
}




function getLocations($params = []){
    global $conn;
    $condition = '';
    if(isset($params['verified'])  &&  in_array($params['verified'],["0","1"])){
        $condition = "WHERE verified={$params['verified']}";
    }else if (isset($params['TitleSearch'])) {
        $condition = "WHERE verified = 1 AND title LIKE '%{$params['TitleSearch']}%'";
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


function getLocationsInBounds($north, $south, $east, $west) {
    global $conn;

    // SQL query to fetch locations within bounds
    $query = "
        SELECT title, lat, lng 
        FROM locations 
        WHERE lat BETWEEN :south AND :north 
          AND lng BETWEEN :west AND :east
    ";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':north', $north);
    $stmt->bindParam(':south', $south);
    $stmt->bindParam(':east', $east);
    $stmt->bindParam(':west', $west);

    $stmt->execute();

    return $stmt->fetchAll();
}



function getNearbyLocations($latitude, $longitude, $radius) {
    global $conn;

    // کوئری برای جستجوی مکان‌ها در شعاع مشخص
    $query = "
        SELECT title, lat, lng,
               (6371 * ACOS(
                   COS(RADIANS(:latitude)) * COS(RADIANS(lat)) *
                   COS(RADIANS(lng) - RADIANS(:longitude)) +
                   SIN(RADIANS(:latitude)) * SIN(RADIANS(lat))
               )) AS distance
        FROM locations
        HAVING distance <= :radius
        ORDER BY distance ASC
    ";

    // اجرای کوئری
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':latitude', $latitude);
    $stmt->bindValue(':longitude', $longitude);
    $stmt->bindValue(':radius', $radius);
    $stmt->execute();

    // دریافت نتایج
    return $stmt->fetchAll();
}