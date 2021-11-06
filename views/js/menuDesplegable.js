let btnLAT2 = document.getElementById("latamCate2");
let btnASI2 = document.getElementById("asiaCate2");
let btnNA2 = document.getElementById("norteamericaCate2");
let btnEUW2 = document.getElementById("europaCate2");
let btnAF2 = document.getElementById("africaCate2");
let btnOC2 = document.getElementById("oceaniaCate2");

let btnClose2 = document.querySelectorAll(".returnBtn-despegable");
let submenus2 = document.querySelectorAll(".subcategories-down-desplegable");

let menuCATE2 = document.getElementById("menuCATE-despegable");
let menuLAT2 = document.getElementById("latinoamerica2");
let menuASI2 = document.getElementById("asia2");
let menuNA2 = document.getElementById("norteamerica2");
let menuEUW2 = document.getElementById("europa2");
let menuAF2 = document.getElementById("africa2");
let menuOC2 = document.getElementById("oceania2");

function changeSubcategory(btn,submenu,menu) {
    btn.addEventListener("click",(e)=>{

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

changeSubcategory(btnLAT2,menuLAT2,menuCATE2);
changeSubcategory(btnASI2,menuASI2,menuCATE2);
changeSubcategory(btnNA2,menuNA2,menuCATE2);
changeSubcategory(btnEUW2,menuEUW2,menuCATE2); 
changeSubcategory(btnAF2,menuAF2,menuCATE2);
changeSubcategory(btnOC2,menuOC2,menuCATE2);

for(let i=0;i<btnClose2.length;i++){
    btnTemp= btnClose2[i];
    btnTemp.addEventListener("click",()=>{
        submenus2.item(i).style.opacity="0";
        setTimeout(()=>{
            submenus2.item(i).style.display="none";
        },300);
    
        menuCATE2.style.display="flex";
        setTimeout(()=>{
            menuCATE2.style.opacity="100%";
        },300);
    })
}