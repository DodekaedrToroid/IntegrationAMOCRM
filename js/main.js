let popupBg = document.querySelector(".popup_bg");
let popup = document.querySelector(".popup");
let popupClose = document.querySelector(".close-popup");
let openPopupButtons = document.querySelector(".open-popup");

openPopupButtons.onclick = function(e){
    e.preventDefault();
    popupBg.classList.add("active");
    popup.classList.add("active");
};
popupClose.onclick = function(e){
    e.preventDefault();
    popupBg.classList.remove("active");
    popup.classList.remove("active");
};
document.addEventListener("click", (e) =>{
    if(e.target === popupBg){
        popupBg.classList.remove("active");
        popup.classList.remove("active");
    }
});
