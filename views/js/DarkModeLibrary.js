/*--Elements--*/
let bodylib = document.querySelector('body');
let imagentb = document.querySelector('#imgtb');
let modoOscuro = document.querySelector('#tb');
let welcome = document.querySelector('.WhiteWellib');
let recipetitle = document.querySelector('.WhiteRecipelib');
let vidsav = document.querySelector('.Whitevidsav');
let star = document.querySelectorAll('.star-template');
let trecipe = document.querySelectorAll('.next-text-recipe');
/*--Code--*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        bodylib.classList.replace('White', 'DarkModeBody');
        welcome.classList.replace('WhiteWellib','DarkWellib');
        recipetitle.classList.replace('WhiteRecipelib','DarkRecipelib');
        vidsav.classList.replace('Whitevidsav','Darkvidsav');
        star.forEach(estre => {
            estre.classList.replace('WhiteStar', 'DarkStar');
            
        })
        trecipe.forEach(recipe => {
            recipe.classList.replace('whiterecipet','darkrecipet');
        })
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src= viewsUrl+"./iconos/clear.svg";
        bodylib.classList.replace('White', 'DarkModeBody');
        welcome.classList.replace('WhiteWellib','DarkWellib');
        recipetitle.classList.replace('WhiteRecipelib','DarkRecipelib');
        vidsav.classList.replace('Whitevidsav','Darkvidsav');
        star.forEach(estre => {
            estre.classList.replace('WhiteStar', 'DarkStar');
            
        })
        trecipe.forEach(recipe => {
            recipe.classList.replace('whiterecipet','darkrecipet');
        })
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src=viewsUrl+"./iconos/moon.svg";
        bodylib.classList.replace('DarkModeBody','White');
        welcome.classList.replace('DarkWellib','WhiteWellib');
        recipetitle.classList.replace('DarkRecipelib','WhiteRecipelib');
        vidsav.classList.replace('Darkvidsav','Whitevidsav');
        star.forEach(estre => {
            estre.classList.replace('DarkStar','WhiteStar');
            
        })
        trecipe.forEach(recipe => {
            recipe.classList.replace('darkrecipet','whiterecipet');
        })
    }
})