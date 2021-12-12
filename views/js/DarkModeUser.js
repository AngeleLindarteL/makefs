/*--Elements--*/
let body = document.querySelector('body');
let modoOscuro = document.querySelector('#tb');
let imagentb = document.querySelector('#imgtb');
let Chefcont = document.querySelector('#userNoChefContainer');
let labeluser = document.querySelectorAll('.Whitelabel');
let formuser = document.querySelector('#passChange');
let formlabel = document.querySelector('#changePassSend');
let PhotoUser = document.querySelector('#fotoChange');
let InputPhoto = document.querySelector('.updateFotoInput');
let Whitetext = document.querySelectorAll('.inputsToEnable');
/*--Code--*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White', 'DarkModeBody');
        Chefcont.classList.replace('WhiteChefcont','DarkChefcont');
        labeluser.forEach(label => {
            label.classList.replace('Whitelabel','Darklabel');
        })
        formuser.classList.replace('Whiteform','Darkform');
        formlabel.classList.replace('Whiteinput','Darkinput');
        PhotoUser.classList.replace('WhitePhoto','DarkPhoto');
        InputPhoto.classList.replace('WhiteInPho','DarkInPho');
        Whitetext.forEach(texti => {
            texti.classList.replace('WhiteTexti','DarkTexti');
        })
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src= viewsUrl+"./iconos/clear.svg";
        body.classList.replace('White', 'DarkModeBody');
        Chefcont.classList.replace('WhiteChefcont','DarkChefcont');
        labeluser.forEach(label => {
            label.classList.replace('Whitelabel','Darklabel');
        })
        formuser.classList.replace('Whiteform','Darkform');
        formlabel.classList.replace('Whiteinput','Darkinput');
        PhotoUser.classList.replace('WhitePhoto','DarkPhoto');
        InputPhoto.classList.replace('WhiteInPho','DarkInPho');
        Whitetext.forEach(texti => {
            texti.classList.replace('WhiteTexti','DarkTexti');
        })
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src= viewsUrl+"./iconos/moon.svg";
        body.classList.replace('DarkModeBody','White');
        Chefcont.classList.replace('DarkChefcont','WhiteChefcont');
        labeluser.forEach(label => {
            label.classList.replace('Darklabel','Whitelabel');
        })
        formuser.classList.replace('Darkform','Whiteform');
        formlabel.classList.replace('Darkinput','Whiteinput');
        PhotoUser.classList.replace('DarkPhoto','WhitePhoto');
        InputPhoto.classList.replace('DarkInPho','WhiteInPho');
        Whitetext.forEach(texti => {
            texti.classList.replace('DarkTexti','WhiteTexti');
        })
    }
})