let sendButton = document.querySelector("#send");
let nombre = document.querySelector("#nombre");
let updateStatus = document.querySelector("#status");

sendButton.addEventListener("click", ()=>{
    let info = {
        "id": 15,
        "nombre": nombre.value,
    }
    info = JSON.stringify(info);
    try{
        axios.post("./modificar.php",info).then(
            res => {
                console.log(res);
                updateStatus.textContent = res.data;
            }
        )
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})