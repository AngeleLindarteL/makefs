/*--Elements--*/
let body = document.querySelector('#ContImgLoader');
/*--Code--*/
if (localStorage.getItem("Theme") == "claro"){
    body.classList.add("White");
}else{
    if (localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White','Dark');
    }
}