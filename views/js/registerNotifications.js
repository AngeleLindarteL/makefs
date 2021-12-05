let notification = document.querySelector(".makefs-notification");
let msgSpace = document.querySelector("#notification-msg");

let errorUser = errorR.indexOf('userm_username_key');
let errorEmail = errorR.indexOf('userm_email_key');
let mensajeError;

if(errorUser !== -1){
    mensajeError = "Nombre de usuario existente, intenta con otro username."
}

if(errorEmail !== -1){
    mensajeError = "Email en uso, intenta con otro."
}

if(errorR == 'contrasNoCoinciden'){
    mensajeError = "La verificacion de tu contraseña no coincide."
}


msgSpace.textContent=mensajeError;
setTimeout(()=>{

    notification.style.right="0";
},200)
setTimeout(()=>{
    notification.style.opacity="0";
    setTimeout(()=>{
        notification.style.display="none"
    },400);
},5000);