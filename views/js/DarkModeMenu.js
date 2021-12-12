/*----Elemnts----*/
let Menu = document.querySelector('#nav-bar');
let menuup = document.querySelector('.searchNav');
let homesave = document.querySelectorAll('.btndesp');
let textinputs = document.querySelector('#busqueda');
let submitinputs = document.querySelector('#sendBusqueda');
if (modoOscuro === undefined){
    let modoOscuro = document.querySelector('#tb');
}
let Name = document.querySelectorAll('#followedName');
const url = window.location.pathname.split("/");
url.shift();
let viewsUrl;

if(url.length > 1 && url.length < 3){
    viewsUrl = "../views";
    console.log(window.location.pathname.split("/").length)
}else if(url.length > 2){
    viewsUrl = "../../views";
}else{
    viewsUrl = "views";
}
/*--Code--*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        Menu.classList.replace('WhiteMenu','DarkMenu');
        menuup.classList.replace('WhiteSearch','DarkSearch');
        homesave.forEach(desp =>{
            desp.classList.replace('WhiteDesp','DarkDesp');
        })
        textinputs.classList.replace('WhiteInput','DarkInput');
        submitinputs.classList.replace('WhiteInput','DarkInput');
        Name.forEach(suscri =>{
            suscri.classList.replace('Whitename','Darkname');
        })
    }
    
}
modoOscuro.addEventListener("click", ()  =>{
    if(localStorage.getItem("Theme") == "oscuro"){
        imagentb.src= viewsUrl+"./iconos/clear.svg";
        Menu.classList.replace('WhiteMenu','DarkMenu');
        menuup.classList.replace('WhiteSearch','DarkSearch');
        homesave.forEach(desp =>{
            desp.classList.replace('WhiteDesp','DarkDesp');
        })
        textinputs.classList.replace('WhiteInput','DarkInput');
        submitinputs.classList.replace('WhiteInput','DarkInput');
        Name.forEach(suscri =>{
            suscri.classList.replace('Whitename','Darkname');
        })
        
    }else{
        imagentb.src=viewsUrl+"./iconos/moon.svg";
        Menu.classList.replace('DarkMenu','WhiteMenu');
        menuup.classList.replace('DarkSearch','WhiteSearch');
        homesave.forEach(desp =>{
            desp.classList.replace('DarkDesp','WhiteDesp');
        })
        textinputs.classList.replace('DarkInput','WhiteInput');
        submitinputs.classList.replace('DarkInput','WhiteInput');
        Name.forEach(suscri =>{
            suscri.classList.replace('Darkname','Whitename');
        })

        

    }
})