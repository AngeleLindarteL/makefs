let updateUser = document.querySelector("#updateSocial");
let namem = document.querySelector("#namem");
let username = document.querySelector("#username");
let email = document.querySelector("#email");
let descript = document.querySelector("#descript");
let updateStatus = document.querySelector("#status");

let nameTxt = document.querySelector("#user-name");
let descriptTxt = document.querySelector("#descript-space");
let contactTxt = document.querySelector("#contact-space");
let usernameTxt = document.querySelector("#username-space");

updateUser.addEventListener("click", (e)=>{
    e.preventDefault();
    let info = {
        "id": id,
        "nombre": namem.value,
        "username": username.value,
        "email": email.value,
        "descript": descript.value,
    }
    info = JSON.stringify(info);
    try{
        
        axios.post("../controllers/updateDataUsers/updateUser.php",info).then(
            res => {
                console.log(res);
                if(res.status==200){
                    console.log("viva el porno"+namem.value)
                    nameTxt.textContent=namem.value;
                    descriptTxt.textContent=descript.value;
                    contactTxt.textContent="Contacto:"+email.value;
                    usernameTxt.textContent="@"+username.value;
                }
            }
        )
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})