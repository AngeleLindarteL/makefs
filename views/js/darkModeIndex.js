/*---Elements---*/
let imagentb = document.querySelector('#imgtb');
let modoOscuro = document.querySelector('#tb');
let body = document.querySelector('body');
let pselector = document.querySelectorAll('.next-text-recipe');
let BannerDown = document.querySelector('.categories-down');
let star = document.querySelectorAll('.star-template');
let BannersubDown = document.querySelectorAll('.subcategories-down');
let categoriesregion = document.querySelectorAll('.categoryDiv');
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
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src="./iconos/clear.svg";
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
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src="./iconos/moon.svg";
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
    }
})