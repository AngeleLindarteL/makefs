/*--Elements--*/
let bodyddr = document.querySelector('body');
let modoOscuro = document.querySelector('#tb');
let imagentb = document.querySelector('#imgtb');
let pselector = document.querySelectorAll('.next-text-recipe');
let titlevideo = document.querySelector('.makefs-video-info-title');
let username = document.querySelector('#usernameSection');
let followdark = document.querySelector('#followersSection');
let pseg = document.querySelector('.seguidoresp');
let whitep = document.querySelector('.viewp');
let videoview = document.querySelector('#makefs-video-views');
let star = document.querySelectorAll('.star-template');
let notifdes = document.querySelector('.bookshelf-notification');
let BannersubDown = document.querySelectorAll('.subcategories-down');
let categoriesregion = document.querySelectorAll('.categoryDiv');
let BannerDown = document.querySelector('.categories-down');
let btndisplay = document.querySelector('#btnCategoriesShow');
/*--Code--*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        bodyddr.classList.replace('White', 'DarkModeBody');
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
        })
        titlevideo.classList.replace('Whitetitlevideo','Darktitlevideo');
        username.classList.replace('Whiteusername','Darkusername');
        followdark.classList.replace('Whitefollow','Darkfollow');
        pseg.classList.replace('whitepseg','darkpseg');
        whitep.classList.replace('Whiteviewp','Darkviewp');
        videoview.classList.replace('Whiteview','Darkview');
        star.forEach(calif => {
            calif.classList.replace('WhiteStar', 'DarkStar');
        })
        notifdes.classList.replace('WhiteNotif','DarkNotif');
        BannerDown.classList.replace('WhiteModeCategories','DarkModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('WhiteModesubCategories','DarkModesubCategories');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Whiteindice','Darkindice');
        })
        btndisplay.classList.replace('WhiteBtnDown','DarkBtnDown');
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src="./iconos/clear.svg";
        bodyddr.classList.replace('White', 'DarkModeBody');
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
        })
        titlevideo.classList.replace('Whitetitlevideo','Darktitlevideo');
        username.classList.replace('Whiteusername','Darkusername');
        followdark.classList.replace('Whitefollow','Darkfollow');
        pseg.classList.replace('whitepseg','darkpseg');
        whitep.classList.replace('Whiteviewp','Darkviewp');
        videoview.classList.replace('Whiteview','Darkview');
        star.forEach(calif => {
            calif.classList.replace('WhiteStar', 'DarkStar');
        })
        notifdes.classList.replace('WhiteNotif','DarkNotif');
        BannerDown.classList.replace('WhiteModeCategories','DarkModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('WhiteModesubCategories','DarkModesubCategories');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Whiteindice','Darkindice');
        })
        btndisplay.classList.replace('WhiteBtnDown','DarkBtnDown');

    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src="./iconos/moon.svg";
        bodyddr.classList.replace('DarkModeBody','White');
        pselector.forEach(parrafo => {
            parrafo.classList.replace('DarkModeP','WhiteModeP');
        })
        titlevideo.classList.replace('Darktitlevideo','Whitetitlevideo');
        username.classList.replace('Darkusername','Whiteusername');
        followdark.classList.replace('Darkfollow','Whitefollow');
        pseg.classList.replace('darkpseg','whitepseg');
        whitep.classList.replace('Darkviewp','Whiteviewp');
        videoview.classList.replace('Darkview','Whiteview');
        star.forEach(calif => {
            calif.classList.replace('DarkStar','WhiteStar');
        })
        notifdes.classList.replace('DarkNotif','WhiteNotif');
        BannerDown.classList.replace('DarkModeCategories','WhiteModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('DarkModesubCategories','WhiteModesubCategories');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Darkindice','Whiteindice');
        })
        btndisplay.classList.replace('DarkBtnDown','WhiteBtnDown');
    }
})