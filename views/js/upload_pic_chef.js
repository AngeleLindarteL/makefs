const uploadBtn = document.querySelector("#submitFoto-chef");
const photoInput= document.querySelector(".updateFotoInput-chef");
const notifiactionStates = {
    loading_photo: "Se esta actualizando tu foto, espera un momento porfavor",
    updated_photo: "¡Tu foto se actualizo con exito!",
    error_photo_size: "La imagen que subiste es muy pesada, intenta con otra más ligera (limite: 2MB)",
    error_photo_aspect_ratio: "La imagen que subiste tiene una gran desporporcion, porfavor intenta con otra",
    error_photo_server_error: "El servidor ha tenido problemas para actualizar tu imagen, intentalo de nuevo más tarde",
}
// const notification_container = document.querySelector(".makefs-notification");
// const notification_msg = document.querySelector(".makefs-notification-info");


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
    .then(res => console.log(res));
}

uploadBtn.addEventListener("click", (e) => {
    e.preventDefault();
    upload(photoInput)
})