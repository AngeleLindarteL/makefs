let btnSeeUsers = document.querySelector("#seeUsers");
let btnSeeChefs = document.querySelector("#seeChefs");
let seeUsers = document.querySelector("#tablaUsuarios");
let seeChefs = document.querySelector("#tablaChefs");

let openUsers = false;
let openChefs = false;

btnSeeUsers.addEventListener("click",()=>{
    if(openUsers){
        seeUsers.style.opacity = "0";
        setTimeout(()=>{
            seeUsers.style.display = "none";
        },300);
        openUsers=false;
    }else{
        seeChefs.style.opacity = "0";
        setTimeout(()=>{
            seeChefs.style.display = "none";
        },200);
        openChefs=false;
        seeUsers.style.display = "flex";
        setTimeout(()=>{
            seeUsers.style.opacity = "100%";
        },300);
        openUsers=true;
    }
})

btnSeeChefs.addEventListener("click",()=>{
    if(openChefs){
        seeChefs.style.opacity = "0";
        setTimeout(()=>{
            seeChefs.style.display = "none";
        },300);
        openChefs=false;
    }else{
        seeUsers.style.opacity = "0";
        setTimeout(()=>{
            seeUsers.style.display = "none";
        },200);
        openUsers=false;
        seeChefs.style.display = "flex";
        setTimeout(()=>{
            seeChefs.style.opacity = "100%";
        },300)
        openChefs=true;
    }
})