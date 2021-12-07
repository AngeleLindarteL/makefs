/*--Elements--*/
let Lobody = document.querySelector('body');
let form = document.querySelector('.form-done');
let logoback = document.querySelector('.Whiteimg');
let backtit = document.querySelector('.Whiteback');
let wordform = document.querySelectorAll('.Whiteform');
let inpo = document.querySelectorAll('.Whiteinp');
/*--Code--*/
if (localStorage.getItem("Theme") == "claro"){
    Lobody.classList.add("White");
    form.classList.add('WhiteForm');
    logoback.classList.add('Whiteimg');
    backtit.classList.add('Whiteback');
    wordform.forEach(form =>{
        form.classList.add('Whiteform');
    })
    inpo.forEach(inpu =>{
        inpu.classList.add('Whiteinp');
    })
}else{
    if (localStorage.getItem("Theme") == "oscuro"){
        Lobody.classList.replace('White','Dark');
        form.classList.replace('WhiteForm','DarkForm');
        logoback.classList.replace('Whiteimg','Darkimg');
        backtit.classList.replace('Whiteback','Darkback');
        wordform.forEach(form =>{
            form.classList.replace('Whiteform','Darkform');
        })
        inpo.forEach(inpu =>{
            inpu.classList.replace('Whiteinp','Darkinp');
        })
    }
}