/*---Elements---*/
let imagentb = document.querySelector('#imgtb');
let modoOscuro = document.querySelector('#tb');
let body = document.querySelector('body');
let pselector = document.querySelectorAll('.next-text-recipe');
let BannerDown = document.querySelector('.categories-down');
let star = document.querySelectorAll('.star-template');
let BannersubDown = document.querySelectorAll('.subcategories-down');
let categoriesregion = document.querySelectorAll('.categoryDiv');
let btndisplay = document.querySelector('#btnCategoriesShow');
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
/*---Code---*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White', 'DarkModeBody');
        BannerDown.classList.replace('WhiteModeCategories','DarkModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('WhiteModesubCategories','DarkModesubCategories');
        })
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('WhiteStar','DarkStar');
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
        imagentb.src= viewsUrl+"./iconos/clear.svg";
        body.classList.replace('White', 'DarkModeBody');
        BannerDown.classList.replace('WhiteModeCategories','DarkModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('WhiteModesubCategories','DarkModesubCategories');
        })
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('WhiteStar','DarkStar');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Whiteindice','Darkindice');
        })
        btndisplay.classList.replace('WhiteBtnDown','DarkBtnDown');
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src=viewsUrl+"./iconos/moon.svg";
        body.classList.replace('DarkModeBody','White');
        BannerDown.classList.replace('DarkModeCategories','WhiteModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('DarkModesubCategories','WhiteModesubCategories');
        })
        pselector.forEach(parrafo => {
            parrafo.classList.replace('DarkModeP','WhiteModeP');
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('DarkStar','WhiteStar');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Darkindice','Whiteindice');
        })
        btndisplay.classList.replace('DarkBtnDown','WhiteBtnDown');
    }
})