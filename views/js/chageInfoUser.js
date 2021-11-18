let btnActivateInputs = document.getElementById("profile-edit-user");
let inputsToEnable = document.querySelectorAll(".inputsToEnable");
let btnSendActualization = document.getElementById("updateSocial");
let isEnabledInput = false;

btnActivateInputs.addEventListener("click",(e)=>{
    
    if(isEnabledInput){

        for(i=0;i<inputsToEnable.length;i++){
            inputsToEnable[i].setAttribute("disabled","true");
        }
        btnSendActualization.style.display="none";
        isEnabledInput = false;

    }else{
        e.preventDefault();
        for(i=0;i<inputsToEnable.length;i++){
            inputsToEnable[i].removeAttribute("disabled");
        }
        btnSendActualization.style.display="block";
        isEnabledInput = true;
    }
    
})

btnSendActualization.addEventListener("click",(e)=>{
    e.preventDefault();
    for(i=0;i<inputsToEnable.length;i++){
        inputsToEnable[i].setAttribute("disabled","true");
    }
    btnSendActualization.style.display="none";
    isEnabledInput = false;
})

let btnChangeFoto = document.querySelector("#profile-edit");
let sectionChangeFoto = document.querySelector("#cambiarFoto");
let closeChangeFoto = document.querySelector("#profile-edit-close-chef");

btnChangeFoto.addEventListener("click",()=>{
        sectionChangeFoto.style.display="flex";
        setTimeout(()=>{
            sectionChangeFoto.style.opacity="100%";
        },300);   
})

closeChangeFoto.addEventListener("click",()=>{
    sectionChangeFoto.style.opacity="0";
    setTimeout(()=>{
        sectionChangeFoto.style.display="none";
    },300);
})

let btnChangePass = document.querySelector("#btnChangePass");
let sectionChangePass = document.querySelector("#cambiarPass");
let closeChangePass = document.querySelector("#profile-close-passChange");

btnChangePass.addEventListener("click",()=>{
    sectionChangePass.style.display="flex";
    setTimeout(()=>{
        sectionChangePass.style.opacity="100%";
    },300);   
})

closeChangePass.addEventListener("click",()=>{
sectionChangePass.style.opacity="0";
setTimeout(()=>{
    sectionChangePass.style.display="none";
},300);
})

let btnDeleteAccount = document.querySelector("#profile-delete-account");
let sectionDeleteAccount = document.querySelector("#deleteAccountContainer");
let closeDeleteAccount = document.querySelector("#profile-close-deleteAccount");

btnDeleteAccount.addEventListener("click",(e)=>{
    e.preventDefault();
    sectionDeleteAccount.style.display="flex";
    setTimeout(()=>{
        sectionDeleteAccount.style.opacity="100%";
    },300);   
})

closeDeleteAccount.addEventListener("click",(e)=>{
    e.preventDefault();
    sectionDeleteAccount.style.opacity="0";
setTimeout(()=>{
    sectionDeleteAccount.style.display="none";
},300);
})

/*-----------------------------------------------------------Become a Chef*/

let btnBeChef = document.querySelector("#beChefOpenBtn");
let sectionBeChef = document.querySelector("#beaChef");
let btnCloseBeChef = document.querySelector("#profile-close-bechef");

btnBeChef.addEventListener("click",(e)=>{
    e.preventDefault();
    sectionBeChef.style.display="flex";
    setTimeout(()=>{
        sectionBeChef.style.opacity="100%";
    },300);   
})

btnCloseBeChef.addEventListener("click",(e)=>{
    e.preventDefault();
    sectionBeChef.style.opacity="0";
setTimeout(()=>{
    sectionBeChef.style.display="none";
},300);
})