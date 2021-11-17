/*--------------------------------Update data*/

let updateUser = document.querySelector("#updateSocial");
let namem = document.querySelector("#namem");
let username = document.querySelector("#username");
let email = document.querySelector("#email");
let descript = document.querySelector("#descript");
let updateStatus = document.querySelector("#status");
let facebook = document.querySelector("#fbinput");
let instagram = document.querySelector("#iginput");
let youtube = document.querySelector("#ytinput");

let nameTxt = document.querySelector("#user-name");
let descriptTxt = document.querySelector("#descript-space");
let contactTxt = document.querySelector("#contact-space");
let usernameTxt = document.querySelector("#username-space");
let fbTxtUser = document.querySelector("#fbTxT-user");
let igTxTUser = document.querySelector("#igTxT-user");
let ytTxTUser = document.querySelector("#ytTxT-user");

updateUser.addEventListener("click", (e)=>{
    e.preventDefault();
    let info = {
        "id": id,
        "nombre": namem.value,
        "username": username.value,
        "email": email.value,
        "descript": descript.value,
        "facebook": facebook.value,
        "instagram": instagram.value,
        "youtube": youtube.value,
    }
    info = JSON.stringify(info);
    try{
        
        axios.post("../controllers/updateDataUsers/updateUser.php",info).then(
            res => {
                console.log(res);
                if(res.status==200){
                    nameTxt.textContent=namem.value;
                    descriptTxt.textContent=descript.value;
                    contactTxt.textContent="Contacto:"+email.value;
                    usernameTxt.textContent="@"+username.value;
                    fbTxtUser.setAttribute("href",facebook.value);
                    igTxTUser.setAttribute("href",instagram.value);
                    ytTxTUser.setAttribute("href",youtube.value);
                }
            }
        )
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})

/*-------------------------------------------------------Update Pass*/
let updatePassBtn = document.querySelector("#changePassSend");
let passAntigua = document.querySelector("#passAntigua");
let passNew = document.querySelector("#passNew");

updatePassBtn.addEventListener("click",(e)=>{
    e.preventDefault();
    let infoPass = {
        "passAntigua" : passAntigua.value,
        "passNew" : passNew.value,
    }
    infoPass = JSON.stringify(infoPass);
    try{
        axios.post("../controllers/updateDataUsers/updatePass.php",infoPass).then(
            res=> {
                console.log(res);
                window.location.href="../views/login.php";
            }
        )
        
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})