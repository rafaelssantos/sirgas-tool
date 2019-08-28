function generateChart(elemId, jsonData){
    console.log(jsonData);
    chart = c3.generate({
        bindTo: '${elemId}',
        data: {
            json: jsonData,
            keys: {
                x: 'datetime', // it's possible to specify 'x' when category axis
                value: ['north', 'east', 'up'],
            }
        }
        // },
        // axis: {
        //     x: {
        //         type: 'categories',
        //         tick: {
        //             fit: false,
        //             rotate: -45,
        //             multiline: false
        //         },
        //     }
        // }
    });
}




function updateMap(map){
    /* Coordenadas centrais do estado de SP */
    var latSP = -22.3154;               //latitude centro de SP (Bauru)
    var longSP = -49.0615;      //longitude centro de SP (Bauru)

    if(map === null){
        map = L.map('stations-map').setView([latSP, longSP], 6.75);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' + '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox.streets'
        }).addTo(map);

        L.control.scale().addTo(map);
    }

    var layer = L.layerGroup();
    layer.addTo(map);

    var CustomIcon = L.Icon.extend({});
    // var suitableStIcon = new CustomIcon({iconUrl: 'images/marker-suitable.png'});
    // var notSuitableStIcon = new CustomIcon({iconUrl: 'images/marker-not-suitable.png'});

    var suitableStIcon= new L.icon({
        iconUrl: 'images/marker-suitable.png',
        iconAnchor: [10, 41]
        // popupAnchor: [0, -41]
    });


    var notSuitableStIcon= new L.icon({
        iconUrl: 'images/marker-not-suitable.png',
        iconAnchor: [10, 41]
        // popupAnchor: [0, -41]
    });




    $.ajax({
        type: "GET", 
        url: 'retrieve-stations.php',
        timeout: 3000,
        datatype: 'json',
        contentType: "application/json; charset=utf-8",
        cache: false,
        success: function(data) {
            var stations = JSON.parse(data);

            // Listando cada cliente encontrado na lista...

            if(stations[localStorage['stationLabel']] != undefined){
                generateChart("#neu-chart", stations[localStorage['stationLabel']]);
            }
            else{
                console.log("Data unavailable");
            }

            $.each(stations, function(i, station){
                
                last_epoch = station[station.length - 1];
                if(last_epoch.status === 1){
                    L.marker([last_epoch.lat, last_epoch.long], {icon: suitableStIcon}).bindPopup(last_epoch.label).addTo(layer);
                }
                else{
                    L.marker([last_epoch.lat, last_epoch.long], {icon: notSuitableStIcon}).bindPopup(last_epoch.label).addTo(layer);
                }
            });

    


            setTimeout(function(){
                layer.remove();
                updateMap(map);
            }, 5000);
        } 
    });
}



$(document).ready(function(){
    if(localStorage['stationLabel'] == undefined){
        localStorage['stationLabel'] = "PPTE0";
    }

    $("#cbStation").val(localStorage['stationLabel']);

    $("#cbStation").change(function(){
        localStorage['stationLabel'] = $(this).children("option:selected").val();
    });

    updateMap(null);

});




// $(function () {
//     updateMap(null);
// });