/*----Elemnts----*/
let Menu = document.querySelector('#nav-bar');
let menuup = document.querySelector('.searchNav');
let homesave = document.querySelectorAll('.btndesp');
let textinputs = document.querySelector('#busqueda');
let submitinputs = document.querySelector('#sendBusqueda');
if (modoOscuro === undefined){
    let modoOscuro = document.querySelector('#tb');
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
    }
    
}
modoOscuro.addEventListener("click", ()  =>{
    if(localStorage.getItem("Theme") == "oscuro"){
        imagentb.src="./iconos/clear.svg";
        Menu.classList.replace('WhiteMenu','DarkMenu');
        menuup.classList.replace('WhiteSearch','DarkSearch');
        homesave.forEach(desp =>{
            desp.classList.replace('WhiteDesp','DarkDesp');
        })
        textinputs.classList.replace('WhiteInput','DarkInput');
        submitinputs.classList.replace('WhiteInput','DarkInput');
        
    }else{
        imagentb.src="./iconos/moon.svg";
        Menu.classList.replace('DarkMenu','WhiteMenu');
        menuup.classList.replace('DarkSearch','WhiteSearch');
        homesave.forEach(desp =>{
            desp.classList.replace('DarkDesp','WhiteDesp');
        })
        textinputs.classList.replace('DarkInput','WhiteInput');
        submitinputs.classList.replace('DarkInput','WhiteInput');

        

    }
})