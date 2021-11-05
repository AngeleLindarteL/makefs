let btnLAT = document.getElementById("latamCate");
let btnASI = document.getElementById("asiaCate");
let btnNA = document.getElementById("norteamericaCate");
let btnEUW = document.getElementById("europaCate");
let btnAF = document.getElementById("africaCate");
let btnClose = document.querySelector(".returnBtn");

let submenu = document.querySelector(".subcategories-down");
let menuCATE = document.getElementById("menuCATE");
let menuLAT = document.getElementById("latinoamerica");
let menuASI = document.getElementById("asia");
let menuNA = document.getElementById("norteamerica");
let menuEUW = document.getElementById("europa");
let menuAF = document.getElementById("africa");

btnClose.addEventListener("click",(e)=>{

    submenu.style.opacity="0";
    setTimeout(()=>{
        submenu.style.display="none";
    },300);

    menuCATE.style.display="flex";
    setTimeout(()=>{
        menuCATE.style.opacity="100%"
    },300);
})

btnLAT.addEventListener("click",(e)=>{

    menuCATE.style.opacity="0";
    setTimeout(()=>{
        menuCATE.style.display="none";
    },300);

    menuLAT.style.display="flex";
    setTimeout(()=>{
        menuLAT.style.opacity="100%"
    },300);
})

btnASI.addEventListener("click",(e)=>{

    menuCATE.style.opacity="0";
    setTimeout(()=>{
        menuCATE.style.display="none";
    },300);

    menuASI.style.display="flex";
    setTimeout(()=>{
        menuASI.style.opacity="100%"
    },300);
})

btnNA.addEventListener("click",(e)=>{

    menuCATE.style.opacity="0";
    setTimeout(()=>{
        menuCATE.style.display="none";
    },300);

    menuNA.style.display="flex";
    setTimeout(()=>{
        menuNA.style.opacity="100%"
    },300);
})

btnEUW.addEventListener("click",(e)=>{

    menuCATE.style.opacity="0";
    setTimeout(()=>{
        menuCATE.style.display="none";
    },300);

    menuEUW.style.display="flex";
    setTimeout(()=>{
        menuEUW.style.opacity="100%"
    },300);
})

btnAF.addEventListener("click",(e)=>{

    menuCATE.style.opacity="0";
    setTimeout(()=>{
        menuCATE.style.display="none";
    },300);

    menuAF.style.display="flex";
    setTimeout(()=>{
        menuAF.style.opacity="100%"
    },300);
})