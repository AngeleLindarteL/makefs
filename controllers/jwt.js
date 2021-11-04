const sendBtn = document.querySelector("#send");
const appUrl = "localhost/makefs/"
const axiosAuth = axios.create({
    baseURL: appUrl,
    timeout: 1000,
})
if(localStorage.getItem["sessionToken"]){
    axiosAuth.defaults.headers.common['Authorizartion'] = localStorage.getItem["sessionToken"];
}

sendBtn.addEventListener("click", async () =>{
    let response;
    let data = {
        "user": document.querySelector("#user").value,
        "password": document.querySelector("#password").value
    };
    console.log(data.user);
    console.log(data.password);
    await axios.post("./controllers/testlogin.php", data)
        .then(res => console.log(res))
    // document.querySelector("#info").textContent = response;
})