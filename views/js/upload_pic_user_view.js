const uploadBtn = document.querySelector("#submitFoto");
const photoInput= document.querySelector(".updateFotoInput");
const notifiactionStates = {
    loading_photo: "Se esta actualizando tu foto, espera un momento porfavor",
    updated_photo: "¡Esta Hecho! Tu foto se actualizo con éxito.",
    error_photo_size: "La imagen que subiste es muy pesada, intenta con otra más ligera (limite: 3MB)",
    error_photo_unsupported: "El archivo que subiste esta dañado o el tipo de archivo que subiste no esta soportado",
    error_photo_aspect_ratio: "La imagen que subiste tiene una gran desporporcion, porfavor intenta con otra",
    error_photo_server_error: "El servidor ha tenido problemas para actualizar tu imagen, intentalo de nuevo más tarde",
}
const notification_container = document.querySelector(".makefs-notification");
const updatePhotoContainer = document.querySelector("#cambiarFoto");
const notification_msg = document.querySelector("#notification-msg");
const userImg = document.querySelector(".profile-pic-img-user");
const headerUserImg = document.querySelector("#userlog").children[0];
const miniInfoImg = document.querySelector(".userMiniInfo").children[0];

if (localStorage.getItem("token") === null){
    location.reload();    
}

const axiosImage = axios.create({
    headers: {
        "Content-Type":"multipart/form-data",
        "Authorization":localStorage.getItem("token")
    }
})

const upload = (inputTypeFile) => {
    let image = inputTypeFile.files[0];
    let imageFormated = new FormData();
    if (inputTypeFile.files.length > 1) {
        console.log("Hay más de un archivo, bruh")
        return;
    }
    if(!image.type.match(/image.*/)) {
        console.log("El archivo elegido no es una imagen ._.")
        return;
    }
    imageFormated.append("photo",image);
    axiosImage.post("../controllers/updatePhoto.php", imageFormated)
    .then(res =>{
        console.log(res)
        if (res.data.msg == "success_200") {
            notification_container.classList.replace("loading","success");
            notification_msg.textContent = notifiactionStates.updated_photo;
            userImg.src = res.data.newMidImg;
            headerUserImg.src = res.data.newMinImg;
            miniInfoImg.src = res.data.newMinImg;
            setTimeout(() => {
                notification_container.style.opacity = "0";
                notification_container.style.top = "11vh";
                setTimeout(() => {
                    notification_container.style.display = "none";
                    notification_container.classList.replace("success","loading");
                    notification_container.style.top = "8vh";
                }, 100);
            }, 3000);
        }else{
            notification_container.classList.replace("loading","error");
            setTimeout(() => {
                notification_container.style.opacity = "0";
                notification_container.style.top = "11vh";
                setTimeout(() => {
                    notification_container.style.display = "none";
                    notification_container.classList.replace("error","loading");
                    notification_container.style.top = "8vh";
                }, 100);
            }, 3000);
            switch (res.data.msg) {
                case "error_server":
                    notification_msg.textContent = notifiactionStates.error_photo_server_error;
                    break;
                case "error_unsuported_type":
                    notification_msg.textContent = notifiactionStates.error_photo_unsupported;
                    break;
                case "error_too_large":
                    notification_msg.textContent = notifiactionStates.error_photo_size;
                    break;
                case "error_unsuported_ratio":
                    notification_msg.textContent = notifiactionStates.error_photo_aspect_ratio;
                    break;
                default:
                    notification_msg.textContent = "Error desconocido, porfavor comparte a soporte el error";
                    break;
            }
        }
    })
}

uploadBtn.addEventListener("click", (e) => {
    e.preventDefault();
    updatePhotoContainer.style.display = "none";
    updatePhotoContainer.style.opacity = "0";
    notification_container.style.display = "flex";
    notification_msg.textContent = notifiactionStates.loading_photo;
    setTimeout(() => {
        notification_container.style.opacity = "100%";
    }, 10);
    notification_container.classList.add("loading");
    upload(photoInput)
})