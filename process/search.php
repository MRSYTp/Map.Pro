<?php 
include "../bootstrap/init.php";


if (isAjaxRequest()) {
     if (isset($_POST['TitleSearch']) && !empty($_POST['TitleSearch'])) {

        if (getLocations($_POST)) {
            $locations = getLocations($_POST);
            foreach($locations as $location){
                echo '<a href="' . MAP_URL . '?loc=' . $location->id . '">
                <div class="result-item" data-lat="' . $location->lat . '" data-lng="' . $location->lng . '">
                    <span class="loc-type">' . locationTypes[$location->type] . '</span>
                    <span class="loc-title">' . $location->title . '</span>
                </div>
              </a>';
            }
            
        }else {
            echo "نتیجه ای یافت نشد ...";
        }

     }else {
        echo "نتیجه ای یافت نشد ...";
     }


}