/*---Elements---*/
let imagentb = document.querySelector('#imgtb');
let modoOscuro = document.querySelector('#tb');
let body = document.querySelector('body');
let pselector = document.querySelectorAll('.next-text-recipe');
let BannerDown = document.querySelector('.categories-down');
let star = document.querySelectorAll('.star-template');
let BannersubDown = document.querySelector('.subcategories-down');
/*---Code---*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White', 'DarkModeBody');
        BannerDown.classList.replace('WhiteModeCategories','DarkModeCategories');
        BannersubDown.classList.replace('.WhiteModesubCategories','DarkModesubCategories');
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('WhiteStar','DarkStar');
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
        BannersubDown.classList.replace('.WhiteModesubCategories','DarkModesubCategories');
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('WhiteStar','DarkStar');
        })
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src="./iconos/moon.svg";
        body.classList.replace('DarkModeBody','White');
        BannerDown.classList.replace('DarkModeCategories','WhiteModeCategories');
        BannersubDown.classList.replace('DarkModesubCategories','.WhiteModesubCategories');
        pselector.forEach(parrafo => {
            parrafo.classList.replace('DarkModeP','WhiteModeP');
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('DarkStar','WhiteStar');
        })
    }
})