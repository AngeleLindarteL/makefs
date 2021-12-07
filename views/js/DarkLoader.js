/*--Elements--*/
let sectionloader = document.querySelector('#ContImgLoader');
/*--Code--*/
if (localStorage.getItem("Theme") == "claro"){
    sectionloader.classList.add("White");
}else{
    if (localStorage.getItem("Theme") == "oscuro"){
        sectionloader.classList.replace('White','Dark');
    }
}