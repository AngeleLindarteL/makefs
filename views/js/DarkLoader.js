/*--Elements--*/
let body = document.querySelector('body');
/*--Code--*/
if (localStorage.getItem("Theme") == "claro"){
    body.classList.add("White");
}else{
    if (localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White','Dark');
    }
}