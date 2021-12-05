/*--Elements--*/
let body = document.querySelector('body');
let modoOscuro = document.querySelector('#tb');
let imagentb = document.querySelector('#imgtb');
let seccion = document.querySelector('#newRecipeSection');
let manyinputs = document.querySelectorAll('.Whiterecipetit');
let maintt = document.querySelectorAll('.Whitemaintt');
let wimg = document.querySelectorAll('.Whiteimgr');
let btn = document.querySelector('#addStepBtn');
let line = document.querySelector('#tittlePasos');
/*--Code--*/
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}else{
    if(localStorage.getItem("Theme") == "oscuro"){
        body.classList.replace('White', 'DarkModeBody');
        seccion.classList.replace('WhiteSection','DarkSection');
        manyinputs.forEach(inpu => {
            inpu.classList.replace('Whiterecipetit', 'Darkrecipetit');
        })
        maintt.forEach(tt =>{
            tt.classList.replace('Whitemaintt','Darkmaintt');
        })
        wimg.forEach(img =>{
            img.classList.replace('Whiteimgr','Darkimgr');
        })
        btn.classList.replace('Whitebtn','Darkbtn');
        line.classList.replace('Whiteline','Darkline');
    }
    
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src="./iconos/clear.svg";
        body.classList.replace('White', 'DarkModeBody');
        seccion.classList.replace('WhiteSection','DarkSection');
        manyinputs.forEach(inpu => {
            inpu.classList.replace('Whiterecipetit', 'Darkrecipetit'); 
        })
        maintt.forEach(tt =>{
            tt.classList.replace('Whitemaintt','Darkmaintt');
        })
        wimg.forEach(img =>{
            img.classList.replace('Whiteimgr','Darkimgr');
        })
        btn.classList.replace('Whitebtn','Darkbtn');
        line.classList.replace('Whiteline','Darkline');

    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src="./iconos/moon.svg";
        body.classList.replace('DarkModeBody','White');
        seccion.classList.replace('DarkSection','WhiteSection');
        manyinputs.forEach(inpu => {
            inpu.classList.replace('Darkrecipetit','Whiterecipetit');
        })
        maintt.forEach(tt =>{
            tt.classList.replace('Darkmaintt','Whitemaintt');
        })
        wimg.forEach(img =>{
            img.classList.replace('Darkimgr','Whiteimgr');
        })
        btn.classList.replace('Darkbtn','Whitebtn');
        line.classList.replace('Darkline','Whiteline');
    }
})