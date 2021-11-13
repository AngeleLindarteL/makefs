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


