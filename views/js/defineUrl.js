const url = window.location.pathname.split("/");
url.shift();
let viewsUrl;

if(url.length > 1 && url.length < 3){
    viewsUrl = "../views";
    console.log(window.location.pathname.split("/").length)
}else if(url.length > 2){
    viewsUrl = "../../views";
}else{
    viewsUrl = "views";
}