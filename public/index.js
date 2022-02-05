
function updatePosition() {
    const latLng = { lat: 13.736717, lng: 100.523186 };
    marker.setPosition(latLng);
    map.setCenter(latLng);
}

let map;
function initMap() {
    const bongkok = { lat: 13.736717, lng: 100.523186 };
    map = new google.maps.Map(document.getElementById("map"), {
        center: bongkok,
        zoom: 8,
        scrollwheel: true,
    });

    let marker = new google.maps.Marker({
        position: bongkok,
        map: map,
        draggable: true,
        title: "Hello World!",
    });

    google.maps.event.addListener(marker, 'position_changed',
        function () {
            let lat = marker.position.lat()
            let lng = marker.position.lng()
            $('#lat').val(lat)
            $('#lng').val(lng)
        })

    google.maps.event.addListener(map, 'click',
        function (event) {
            pos = event.latLng
            marker.setPosition(pos)
        })
}

