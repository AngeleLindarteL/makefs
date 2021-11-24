let imagentb = document.querySelector('#imgtb');
let modoOscuro = document.querySelector('#tb');
if (localStorage.getItem("Theme") == null){
    localStorage.setItem("Theme", "claro");
}
modoOscuro.addEventListener("click", (e)  =>{
    e.preventDefault();
    if(localStorage.getItem("Theme") == "claro"){
        localStorage.setItem("Theme", "oscuro");
        imagentb.src="./iconos/clear.svg"
    }else{
        localStorage.setItem("Theme", "claro");
        imagentb.src="./iconos/moon.svg";
    }
    
    
})