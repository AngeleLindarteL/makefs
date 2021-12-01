let notification = document.querySelector(".makefs-notification");

notification.style.right="0";
setTimeout(()=>{
    notification.style.opacity="0";
    setTimeout(()=>{
        notification.style.display="none"
    },400);
},5000);