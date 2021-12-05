let updateUser = document.querySelector("#socialUpdateChef");
let namem = document.querySelector("#name-chef");
let username = document.querySelector("#username-chef");
let email = document.querySelector("#email-chef");
let facebook = document.querySelector("#fbinput-Chef");
let instagram = document.querySelector("#iginput-Chef");
let youtube = document.querySelector("#ytinput-Chef");
let twitter = document.querySelector("#twinput-chef");
let descript = document.querySelector("#descript-chef");
let updateStatus = document.querySelector("#status-chef");

let nameTxt = document.querySelector("#chef-name");
let descriptTxt = document.querySelector("#description-space-chef");
let contactTxt = document.querySelector("#contact-space-chef");
let usernameTxt = document.querySelector("#username-space-chef");
let fbTxt = document.querySelector("#fbTxT");
let igTxT = document.querySelector("#igTxT");
let ytTxT = document.querySelector("#ytTxT");
let twTxt = document.querySelector("#twTxt");

let nameTxt2 = document.querySelector("#chef-name-changing");
let usernameTxt2 = document.querySelector("#username-space-chef-changing");
let descriptTxt2 = document.querySelector("#description-space-chef-changing");
let contactTxt2 = document.querySelector("#contact-space-chef-changing");

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
                console.log(res);
                if(res.status==200){
                    nameTxt.textContent=namem.value;
                    descriptTxt.textContent=descript.value;
                    contactTxt.textContent="Contacto:"+email.value;
                    usernameTxt.textContent="@"+username.value;
                    nameTxt2.textContent=namem.value;
                    descriptTxt2.textContent=descript.value;
                    contactTxt2.textContent="Contacto:"+email.value;
                    usernameTxt2.textContent="@"+username.value;
                    fbTxT.setAttribute("href",facebook.value);
                    igTxT.setAttribute("href",instagram.value);
                    ytTxT.setAttribute("href",youtube.value);
                    twTxt.setAttribute("href",twitter.value);
                }
            }
        )
    }catch(e){
        updateStatus.textContent = "Error al actualizar datos, Detalles" + e;
    }
})

/*-------------------------------------------------------Update Pass*/
let updatePassBtn = document.querySelector("#changePassSend-chef");
let passAntigua = document.querySelector("#passAntiguaChef");
let passNew = document.querySelector("#passNewChef");

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