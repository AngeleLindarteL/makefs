let btnArrowMenu = document.querySelector("#btnCategoriesShow");
let isUpMenu = false;


let btnLAT = document.getElementById("latamCate");
let btnASI = document.getElementById("asiaCate");
let btnNA = document.getElementById("norteamericaCate");
let btnEUW = document.getElementById("europaCate");
let btnAF = document.getElementById("africaCate");
let btnOC = document.getElementById("oceaniaCate");

let btnClose = document.querySelectorAll(".returnBtn");
let submenus = document.querySelectorAll(".subcategories-down");

let menuCATE = document.getElementById("menuCATE");
let menuLAT = document.getElementById("latinoamerica");
let menuASI = document.getElementById("asia");
let menuNA = document.getElementById("norteamerica");
let menuEUW = document.getElementById("europa");
let menuAF = document.getElementById("africa");
let menuOC = document.getElementById("oceania");


btnArrowMenu.addEventListener("click",(e)=>{
    if(isUpMenu){
        menuCATE.style.bottom='0%';
        btnArrowMenu.style.bottom="11vh";
        btnArrowMenu.style.right="50%";
        btnArrowMenu.style.transform="rotate(90deg)";
        isUpMenu=false;
    }else{
        menuCATE.style.bottom='-100%';
        btnArrowMenu.style.bottom="2vh";
        btnArrowMenu.style.right="2vh";
        btnArrowMenu.style.transform="rotate(270deg)";
        isUpMenu=true;
    }
})

function changeSubcategory(btn,submenu,menu) {
    btn.addEventListener("click",(e)=>{
        btnArrowMenu.style.display="none";
        btnArrowMenu.style.opacity="0";
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

changeSubcategory(btnLAT,menuLAT,menuCATE);
changeSubcategory(btnASI,menuASI,menuCATE);
changeSubcategory(btnNA,menuNA,menuCATE);
changeSubcategory(btnEUW,menuEUW,menuCATE); 
changeSubcategory(btnAF,menuAF,menuCATE);
changeSubcategory(btnOC,menuOC,menuCATE);

for(let i=0;i<btnClose.length;i++){
    btnTemp= btnClose[i];
    btnTemp.addEventListener("click",()=>{
        btnArrowMenu.style.display="block";
        submenus.item(i).style.opacity="0";
        setTimeout(()=>{
            submenus.item(i).style.display="none";
        },300);
    
        menuCATE.style.display="flex";
        setTimeout(()=>{
            menuCATE.style.opacity="100%";
            btnArrowMenu.style.opacity="100%";
        },300);
    })
}