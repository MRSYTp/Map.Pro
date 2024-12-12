var defaultZoomMax = 15;
var defaultSetView = [35.7181638,51.3498455];

const map = L.map('map').setView(defaultSetView, defaultZoomMax);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.linkedin.com/in/mohammadreza-salehi-5681a2339/">Create BY Mohammadreza-Salehi</a>'
}).addTo(map);




var current_position,current_accuracy;
map.on("locationfound",function(e){
    if(current_position){
        map.removeLayer(current_position);
        map.removeLayer(current_accuracy);
    }
    var radius = e.accuracy / 2;
    current_position = L.marker(e.latlng).addTo(map)
        .bindPopup("مکان تقریبی شما :" + radius + "متر").openPopup();
    current_accuracy = L.circle(e.latlng, radius).addTo(map);
    // alert("ok");
});

map.on("locationerror",function(e){
    alert(e.message);
});

function locate(){

    map.locate({setView : true , maxZoom : defaultZoomMax});

}

// setInterval(locate,22000);

map.on("dblclick",function(event){

    L.marker(event.latlng).addTo(map);

    $(".modal-overlay").fadeIn();

    $("#lat-display").val(event.latlng.lat);
    $("#lng-display").val(event.latlng.lng);
    $("#l-type").val(0);
    $("#l-title").val('');
    $('.ajax-result').html("");

});

$(document).ready(function(){

    $(".modal-overlay .close").click(function(){
        $(".modal-overlay").fadeOut();
    });

    $("form#addLocationForm").submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url : form.attr("action"),
            method : form.attr("method"),
            data : form.serialize(),
            success : function(response){
                if (response == 1) {
                    form.find(".ajax-result").html("مکان مورد نظر با موفقیت ثبت شد منتظر تایید باشید.");
                }else{
                    alert(response);
                }
            }
        });
    });
});



