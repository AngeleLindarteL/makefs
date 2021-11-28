let reportTrigger = document.querySelector("#sendReport");
let notification = document.querySelector(".ddr-in-notification");
let notificationmsg = document.querySelector("#notification-msg");
let reportSection = document.querySelector("#reportSection");
let statesNotification = {
    loading_state: "Estamos subiendo tu reporte, espera un momento porfavor",
    success_state: "Tu reporte se envió con éxito, el equipo de moderación atenderá tu reporte",
    error_state: "Hubo un error con el reporte, porfavor verifica que los campos esta bien o contacta con soporte",
    empty_detail: "El campo de detalle esta vacío",
    empty_reason: "Selecciona una razón valida para reportar porfavor",
    notificationActualTimeOut: null,
}

reportTrigger.addEventListener("click", (e) => {
    reportSection.style.display = "none";
    reportSection.style.opacity = "0";
    notificationmsg.textContent = statesNotification.loading_state;
    notification.classList.add("loading");
    notification.style.display = "flex";
    setTimeout(() => {
        notification.style.opacity = "1";
    },10)

    e.preventDefault();
    let reasonReport = document.querySelector("#reasonSelect").value;
    let details = document.querySelector("#detailReport").value;
    if (reasonReport === 'Escoge la razón del reporte') {
        reportSection.style.display = "flex";
        reportSection.style.opacity = "1";
        notification.classList.replace("loading","error");
        notificationmsg.textContent = statesNotification.empty_reason;
        statesNotification.notificationActualTimeOut = setTimeout(() => {
            notification.style.opacity = "0";
            setTimeout(() => {
                notification.style.display = "none";
                notification.classList.remove("error");
            },200)
        },4000)
        return;
    }
    if (details === '') {
        reportSection.style.display = "flex";
        reportSection.style.opacity = "1";
        notification.classList.replace("loading","error");
        notificationmsg.textContent = statesNotification.empty_detail;
        statesNotification.notificationActualTimeOut = setTimeout(() => {
            notification.style.opacity = "0";
            setTimeout(() => {
                notification.style.display = "none";
                notification.classList.remove("error")
            },200)
        },4000)
        console.log("Detalles vacios");
        return;
    }
    const data = {
        reason: reasonReport,
        details: details,
        userid: followerid,
        recipeid: videoID,
    }
    axios.post("../controllers/reportRecipe.php", JSON.stringify(data))
    .then(res => {
        console.log(res);
        clearTimeout(statesNotification.notificationActualTimeOut);
        notification.classList.replace("loading","success");
        notificationmsg.textContent = statesNotification.success_state;
        setTimeout(() => {
            notification.style.opacity = "0";
            setTimeout(() => {
                notification.style.display = "none";
            },200)
        },3000)
    })
    .catch(err => {
        notification.classList.replace("loading","error");
        clearTimeout(statesNotification.notificationActualTimeOut);
        notificationmsg.textContent = statesNotification.error_state;
        setTimeout(() => {
            notification.style.opacity = "0";
            setTimeout(() => {
                notification.style.display = "none";
                notification.classList.remove("error")
            },200)
        },3000)
    })
})