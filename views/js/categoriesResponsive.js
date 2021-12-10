let btnArrowMenuu = document.querySelector("#btnCategoriesShow");

let isUpMenuu = false;

let btnLATT = document.getElementById("latamCate");
let btnASII = document.getElementById("asiaCate");
let btnNAA = document.getElementById("norteamericaCate");
let btnEUWW = document.getElementById("europaCate");
let btnAFF = document.getElementById("africaCate");
let btnOCC = document.getElementById("oceaniaCate");

let btnCloseE = document.querySelectorAll(".returnBtn");
let submenusS = document.querySelectorAll(".subcategories-down");

let menuCATEE = document.getElementById("menuCATE");
let menuLATT = document.getElementById("latinoamerica");
let menuASII = document.getElementById("asia");
let menuNAA = document.getElementById("norteamerica");
let menuEUWW = document.getElementById("europa");
let menuAFF = document.getElementById("africa");
let menuOCC = document.getElementById("oceania");


btnArrowMenuu.addEventListener("click",(e)=>{
    if(isUpMenuu){
        menuCATEE.style.bottom='10%';
        btnArrowMenuu.style.transform="rotate(90deg)";
        isUpMenuu=false;
    }else{
        menuCATEE.style.bottom='-200%';
        btnArrowMenuu.style.transform="rotate(270deg)";
        isUpMenuu=true;
    }
})

function changeSubcategory(btn,submenu,menu) {
    btn.addEventListener("click",(e)=>{
        btnArrowMenuu.style.display="none";
        btnArrowMenuu.style.opacity="0";
        menu.style.opacity="0";
        setTimeout(()=>{
            menu.style.display="none";
        },300);
    
        submenu.style.display="flex";
        setTimeout(()=>{
            submenu.style.opacity="100%"
        },300);
    })
}

changeSubcategory(btnLATT,menuLATT,menuCATEE);
changeSubcategory(btnASII,menuASII,menuCATEE);
changeSubcategory(btnNAA,menuNAA,menuCATEE);
changeSubcategory(btnEUWW,menuEUWW,menuCATEE); 
changeSubcategory(btnAFF,menuAFF,menuCATEE);
changeSubcategory(btnOCC,menuOCC,menuCATEE);

for(let i=0;i<btnCloseE.length;i++){
    btnTemp= btnCloseE[i];
    btnTemp.addEventListener("click",()=>{
        btnArrowMenuu.style.display="block";
        submenusS.item(i).style.opacity="0";
        setTimeout(()=>{
            submenusS.item(i).style.display="none";
        },300);
    
        menuCATEE.style.display="flex";
        setTimeout(()=>{
            menuCATEE.style.opacity="100%";
            btnArrowMenuu.style.opacity="100%";
        },300);
    })
}