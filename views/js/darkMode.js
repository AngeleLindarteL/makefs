/*---Elements---*/
let imagentb = document.querySelector('#imgtb');
let modoOscuro = document.querySelector('#tb');
let body = document.querySelector('body');
let pselector = document.querySelectorAll('.next-text-recipe');
let star = document.querySelectorAll('.star-template');
let ChefCont = document.querySelector('#chefContainer');
let inputTitle = document.querySelectorAll('.infodelchef');
let deleteForm = document.querySelector('#deleteAccount-chef');
let PhotoForm = document.querySelector('#fotoChange-chef');
let InputPhotoForm = document.querySelector('.updateFotoInput-chef');
let logomachefs = document.querySelector('#notFoundRecipes');
/*---Code---*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White', 'DarkModeBody');
        ChefCont.classList.replace('WhiteChefCont','DarkChefCont');
        deleteForm.classList.replace('WhiteDelete','DarkDelete');
        PhotoForm.classList.replace('WhitePhoto','DarkPhoto');
        InputPhotoForm.classList.replace('WhiteInputPhoto','DarkInputPhoto');
        if (logomachefs){
            logomachefs.classList.replace('WhiteBannerNone','DarkBannerNone');
        }
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('WhiteStar','DarkStar');
        })
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
            
        })
        inputTitle.forEach(colorinput => {
            colorinput.classList.replace('whiteTitleInput', 'darkTitleInput');   
        })
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src="./iconos/clear.svg";
        body.classList.replace('White', 'DarkModeBody');
        ChefCont.classList.replace('WhiteChefCont','DarkChefCont');
        deleteForm.classList.replace('WhiteDelete','DarkDelete');
        PhotoForm.classList.replace('WhitePhoto','DarkPhoto');
        InputPhotoForm.classList.replace('WhiteInputPhoto','DarkInputPhoto');
        if (logomachefs){
            logomachefs.classList.replace('WhiteBannerNone','DarkBannerNone');
        }
        inputTitle.forEach(colorinput => {
            colorinput.classList.replace('whiteTitleInput', 'darkTitleInput');     
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('WhiteStar','DarkStar');
        })
        pselector.forEach(parrafo => {
            parrafo.classList.replace('WhiteModeP', 'DarkModeP');
            
        }) 
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src="./iconos/moon.svg";
        body.classList.replace('DarkModeBody','White');
        ChefCont.classList.replace('DarkChefCont','WhiteChefCont');
        deleteForm.classList.replace('DarkDelete','WhiteDelete');
        PhotoForm.classList.replace('DarkPhoto','WhitePhoto');
        InputPhotoForm.classList.replace('DarkInputPhoto','WhiteInputPhoto');
        if (logomachefs){
            logomachefs.classList.replace('DarkBannerNone','WhiteBannerNone');
        }
        inputTitle.forEach(colorinput => {
            colorinput.classList.replace('darkTitleInput','whiteTitleInput');
            
        })
        star.forEach(fondoStar =>{
            fondoStar.classList.replace('DarkStar','WhiteStar');
        })
        pselector.forEach(parrafo => {
            parrafo.classList.replace('DarkModeP','WhiteModeP' );
            
        }) 
    }
})