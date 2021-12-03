/*--Elements--*/
let body = document.querySelector('body');
let modoOscuro = document.querySelector('#tb');
let imagentb = document.querySelector('#imgtb');
let star = document.querySelectorAll('.star-template');
let titlevideo = document.querySelectorAll('.next-text-recipe');
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
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src="./iconos/clear.svg";
        body.classList.replace('White', 'DarkModeBody');
        star.forEach(sta => {
            sta.classList.replace('WhiteStar', 'DarkStar');
            
        })
        titlevideo.forEach(ttl => {
            ttl.classList.replace('Whiterecipe', 'Darkrecipe');
            
        })
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src="./iconos/moon.svg";
        body.classList.replace('DarkModeBody','White');
        star.forEach(sta => {
            sta.classList.replace('DarkStar','WhiteStar');
            
        })
        titlevideo.forEach(ttl => {
            ttl.classList.replace('Darkrecipe','Whiterecipe');
            
        })
    }
})