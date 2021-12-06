let footer = document.querySelector(".footer");

function esVisible(elem){
    var posTopView = window.scrollY;
    var posButView = posTopView + window.innerHeight;
    var elemTop = elem.offsetTop;
    var elemBottom = elemTop + elem.offsetHeight;
    return ((elemBottom < posButView && elemBottom > posTopView) || (elemTop >posTopView && elemTop< posButView));
}

window.onscroll = function (e) {
    if(esVisible(footer)){
        menuCATE.style.bottom='-100%';
        btnArrowMenu.style.bottom="2vh";
        btnArrowMenu.style.right="2vh";
        btnArrowMenu.style.transform="rotate(270deg)";
        isUpMenu=true;
    }else{
        
    }
};



    


