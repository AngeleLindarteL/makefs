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