let updateUser = document.querySelector("#updateSocial");
let namem = document.querySelector("#namem");
let username = document.querySelector("#username");
let email = document.querySelector("#email");
let descript = document.querySelector("#descript");
let updateStatus = document.querySelector("#status");

updateUser.addEventListener("click", (e)=>{
    e.preventDefault();
    let info = {
        "id": 15,
        "nombre": namem.value,
        "username": username.value,
        "email": email.value,
        "descript": descript.value,
    }
    info = JSON.stringify(info);
    try{
        axios.post("../../controllers/updateDataUsers/updateUser.php",info).then(
            res => {
                console.log(res);
            }
        )
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})