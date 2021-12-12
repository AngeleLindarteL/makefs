/*--Elements--*/
let body = document.querySelector('body');
let modoOscuro = document.querySelector('#tb');
let imagentb = document.querySelector('#imgtb');
let star = document.querySelectorAll('.star-template');
let titlevideo = document.querySelectorAll('.next-text-recipe');
let cookie = document.querySelector('#notFoundRecipes');
let btndisplay = document.querySelector('#btnCategoriesShow');
let BannersubDown = document.querySelectorAll('.subcategories-down');
let categoriesregion = document.querySelectorAll('.categoryDiv');
let BannerDown = document.querySelector('.categories-down');
/*--Code--*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White', 'DarkModeBody');
        star.forEach(sta => {
            sta.classList.replace('WhiteStar', 'DarkStar');
            
        })
        titlevideo.forEach(ttl => {
            ttl.classList.replace('Whiterecipe', 'Darkrecipe');
            
        })
        if(cookie){
        cookie.classList.replace('Whitecookie','Darkcookie');
        }
        btndisplay.classList.replace('WhiteBtnDown','DarkBtnDown');
        BannerDown.classList.replace('WhiteModeCategories','DarkModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('WhiteModesubCategories','DarkModesubCategories');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Whiteindice','Darkindice');
        })
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src= viewsUrl+"./iconos/clear.svg";
        body.classList.replace('White', 'DarkModeBody');
        star.forEach(sta => {
            sta.classList.replace('WhiteStar', 'DarkStar');
            
        })
        titlevideo.forEach(ttl => {
            ttl.classList.replace('Whiterecipe', 'Darkrecipe');
            
        })
        if (cookie){
        cookie.classList.replace('Whitecookie','Darkcookie');
        }
        btndisplay.classList.replace('WhiteBtnDown','DarkBtnDown');
        BannerDown.classList.replace('WhiteModeCategories','DarkModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('WhiteModesubCategories','DarkModesubCategories');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Whiteindice','Darkindice');
        })
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src= viewsUrl+"./iconos/moon.svg";
        body.classList.replace('DarkModeBody','White');
        star.forEach(sta => {
            sta.classList.replace('DarkStar','WhiteStar');
            
        })
        titlevideo.forEach(ttl => {
            ttl.classList.replace('Darkrecipe','Whiterecipe');
            
        })
        if(cookie){
        cookie.classList.replace('Darkcookie','Whitecookie');
        }
        btndisplay.classList.replace('DarkBtnDown','WhiteBtnDown');
        BannerDown.classList.replace('DarkModeCategories','WhiteModeCategories');
        BannersubDown.forEach(subcategories=>{
            subcategories.classList.replace('DarkModesubCategories','WhiteModesubCategories');
        })
        categoriesregion.forEach(subindice=>{
            subindice.classList.replace('Darkindice','Whiteindice');
        })
    }
})