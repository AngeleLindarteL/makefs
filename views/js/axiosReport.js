let reportTrigger = document.querySelector("#sendReport");
let notification = document.querySelector(".ddr-in-notification");
let notificationmsg = document.querySelector("#notification-msg");
let reportSection = document.querySelector("#reportSection");
let statesNotification = {
    loading_state: "Estamos subiendo tú reporte, espera un momento porfavor",
    success_state: "Tú reporte se envió con éxito, el equipo de moderación atenderá tu reporte",
    error_state: "Hubo un error con el reporte, porfavor verifica que los campos esta bien o contacta con soporte",
    empty_detail: "El campo de detalle esta vacío, llenalo porfavor",
    empty_reason: "Selecciona una razón valida para reportar porfavor",
    notificationActualTimeOut: null,
    fadeTimeOut: null,
}

const setFormError = (text_error) => {
    notification.classList.contains("error") ? notification.classList.replace("error","loading") : true;
    clearTimeout(statesNotification.notificationActualTimeOut);

    reportSection.style.display = "flex";
    reportSection.style.opacity = "1";
    notification.classList.replace("loading","error");
    notificationmsg.textContent = text_error;

    statesNotification.notificationActualTimeOut = setTimeout(() => {
        notification.style.opacity = "0";
        statesNotification.fadeTimeOut = setTimeout(() => {
            notification.style.display = "none";
            notification.classList.remove("error")
        },200)
    },4000)
    return;
}


reportTrigger.addEventListener("click", (e) => {
    notification.classList.contains("error") ? notification.classList.remove("error") : true;
    notification.classList.contains("success") ? notification.classList.remove("success") : true;
    notification.classList.contains("error") ? notification.classList.remove("error") : true;
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
        setFormError(statesNotification.empty_reason);
        return;
    }
    if (details === '') {
        setFormError(statesNotification.empty_detail);
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
        clearTimeout(statesNotification.notificationActualTimeOut);

        notification.classList.replace("loading","success");
        notificationmsg.textContent = statesNotification.success_state;
        statesNotification.notificationActualTimeOut = setTimeout(() => {
            notification.style.opacity = "0";
            statesNotification.fadeTimeOut = setTimeout(() => {
                notification.classList.remove("success")
                notification.style.display = "none";
            },200)
        },3000)
    })
    .catch(err => {
        notification.classList.replace("loading","error");
        clearTimeout(statesNotification.notificationActualTimeOut);
        notificationmsg.textContent = statesNotification.error_state;
        statesNotification.notificationActualTimeOut = setTimeout(() => {
            notification.style.opacity = "0";
            statesNotification.fadeTimeOut = setTimeout(() => {
                notification.classList.remove("error")
                notification.style.display = "none";
            },200)
        },3000)
    })
})