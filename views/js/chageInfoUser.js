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