let changeInfoBtn = document.getElementById("profile-edit");
let changeInfoSection = document.getElementById("changeInfoChef");
let closeChangeInfo = document.getElementById("profile-edit-close");

changeInfoBtn.addEventListener("click",()=>{
    changeInfoSection.style.display="flex";
    setTimeout(()=>{
        changeInfoSection.style.opacity="100%";
    },300)
})

closeChangeInfo.addEventListener("click",()=>{
    changeInfoSection.style.opacity="0";
    setTimeout(()=>{
        changeInfoSection.style.display="none";
    },300)
})

let btnActivateInputsChef = document.getElementById("profile-edit-chef");
let inputsToEnableChef = document.querySelectorAll(".infoInputsChef");
let btnSendActualizationChef = document.getElementById("socialUpdateChef");
let isEnabledInputChef = false;

btnActivateInputsChef.addEventListener("click",(e)=>{
    
    if(isEnabledInputChef){

        for(i=0;i<inputsToEnableChef.length;i++){
            inputsToEnableChef[i].setAttribute("disabled","true");
        }
        btnSendActualizationChef.style.display="none";
        isEnabledInputChef = false;

    }else{
        e.preventDefault();
        for(i=0;i<inputsToEnableChef.length;i++){
            inputsToEnableChef[i].removeAttribute("disabled");
        }
        btnSendActualizationChef.style.display="block";
        isEnabledInputChef = true;
    }
    
})

let btnChangeFotoChef = document.querySelector("#profile-edit-photo");
let sectionChangeFotoChef = document.querySelector("#cambiarFoto-chef");
let closeChangeFotoChef = document.querySelector("#profile-edit-close-chef2");

btnChangeFotoChef.addEventListener("click",()=>{
        sectionChangeFotoChef.style.display="flex";
        setTimeout(()=>{
            sectionChangeFotoChef.style.opacity="100%";
        },300);   
})

closeChangeFotoChef.addEventListener("click",()=>{
    sectionChangeFotoChef.style.opacity="0";
    setTimeout(()=>{
        sectionChangeFotoChef.style.display="none";
    },300);
})

let btnChangePassChef = document.querySelector("#pass-change");
let sectionChangePassChef = document.querySelector("#cambiarPass-chef");
let closeChangePassChef = document.querySelector("#profile-close-passChange-chef");

btnChangePassChef.addEventListener("click",()=>{
        sectionChangePassChef.style.display="flex";
        setTimeout(()=>{
            sectionChangePassChef.style.opacity="100%";
        },300);   
})

closeChangePassChef.addEventListener("click",()=>{
    sectionChangePassChef.style.opacity="0";
    setTimeout(()=>{
        sectionChangePassChef.style.display="none";
    },300);
})

let btnDeleteAccount = document.querySelector("#profile-delete-account-chef");
let sectionDeleteAccount = document.querySelector("#deleteAccountContainer-chef");
let closeDeleteAccount = document.querySelector("#profile-close-deleteAccount-chef");

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
