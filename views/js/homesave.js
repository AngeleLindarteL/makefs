/*Primera imagen*/ 
let a = document.createElement("A");
let img = document.createElement("IMG");
img.setAttribute("src", "./iconos/home6.png");
img.classList.add("homewhite");
a.setAttribute("href", "./index.php");
a.appendChild(img);
let container = document.querySelector(".header_icons");
container.appendChild(a);
/*Segunda imagen*/
let ados = document.createElement("A");
let imgdos = document.createElement("IMG");
imgdos.setAttribute("src", "./iconos/save6.png");
imgdos.classList.add("savewhite");
ados.setAttribute("href", "./index.php");
ados.appendChild(imgdos);
container.appendChild(ados);

let dispatchBtn = document.querySelector("#cerrarstyle");
let sendBtn = document.querySelector("#close_session");
let sendEvent = new MouseEvent("click",{
    bubbles: false,
    cancelable: false,
});

dispatchBtn.addEventListener("click", () => {
    sendBtn.dispatchEvent(sendEvent);
})