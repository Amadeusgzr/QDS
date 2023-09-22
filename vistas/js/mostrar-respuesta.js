
const divError = document.querySelector(".div-error");
let url = window.location.href;
console.log(url);
if(url.includes("datos")){
    divError.style.visibility = "visible";
    divError.style.animationName = "grande";
    divError.style.animationDuration = "1s";
    setTimeout(()=>{
        divError.style.animationName = "chico";
        divError.style.animationDuration = "1s";
        setTimeout(()=>{
            divError.style.visibility = "hidden";
        }, 900);
    }, 3000);
}
