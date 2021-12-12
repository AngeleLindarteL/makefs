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
let twitter = document.querySelector("#twinput");

let nameTxt = document.querySelector("#user-name");
let descriptTxt = document.querySelector("#descript-space");
let contactTxt = document.querySelector("#contact-space");
let usernameTxt = document.querySelector("#username-space");
let fbTxtUser = document.querySelector("#fbTxT-user");
let igTxTUser = document.querySelector("#igTxT-user");
let ytTxTUser = document.querySelector("#ytTxT-user");
let twTxTUser = document.querySelector("#twTxt-user");

let msgErorr;

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
        "twitter": twitter.value
    }
    info = JSON.stringify(info);
    try{
        
        axios.post("../controllers/updateDataUsers/updateUser.php",info).then(
            res => {
                let msgNotifi = res.data.msg.errorInfo[2];
                if(res.status==200 && !msgNotifi){
                    nameTxt.textContent=namem.value;
                    descriptTxt.textContent=descript.value;
                    contactTxt.textContent="Contacto:"+email.value;
                    usernameTxt.textContent="@"+username.value;
                    fbTxtUser.setAttribute("href",facebook.value);
                    igTxTUser.setAttribute("href",instagram.value);
                    ytTxTUser.setAttribute("href",youtube.value);
                    twTxTUser.setAttribute("href",twitter.value)
                }else{
                    notification_container.classList.add("error");
                    notification_container.style.display = "flex";
                    setTimeout(() => {
                        notification_container.style.top = "11vh";
                        notification_container.style.opacity = "100%";
                        setTimeout(() => {
                            notification_container.style.opacity = "0";
                            setTimeout(()=>{
                                notification_container.style.display = "none";
                            },1000)
                        }, 5000);
                    }, 1000);
                    if((msgNotifi.indexOf('userm_username_key')) !== -1){
                        msgErorr = "Nombre de usuario ya en uso, intenta con otro ya que no se modificó.";
                        notification_msg.textContent = msgErorr;
                    }else if((msgNotifi.indexOf('userm_email_key')) !== -1){
                        msgErorr = "Email en uso, Intenta con otro ya que no fue modificado."
                        notification_msg.textContent = msgErorr;
                    }
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
                let msgNotifiPass = res.data.msg;
                console.log(msgNotifiPass)
                if(res.status==200 && !msgNotifiPass){
                    window.location.href="/login";
                }else{
                    notification_container.classList.add("error");
                    notification_container.style.display = "flex";
                    setTimeout(() => {
                        notification_container.style.top = "11vh";
                        notification_container.style.opacity = "100%";
                        setTimeout(() => {
                            notification_container.style.opacity = "0";
                            setTimeout(()=>{
                                notification_container.style.display = "none";
                            },1000)
                        }, 5000);
                    }, 1000);
                    notification_msg.textContent = msgNotifiPass;
                }
            }
        )
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})

/*--------------------------------------------------------Be Chef*/
let beChefbtn = document.querySelector("#wantBeChefBtn");

beChefbtn.addEventListener("click",(e)=>{
    e.preventDefault();
    let infoBeChef = {
        "btnChef" : true,
    }
    infoPass = JSON.stringify(infoBeChef);
    try{
        axios.post("../controllers/updateDataUsers/beChefController.php",infoBeChef).then(
            res=> {
                window.location.href=`/chef/${res.data}`;
            }
            
        )
        
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})