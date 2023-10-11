const divCuenta = document.getElementById("div-cuenta");
const aNombre = document.getElementById("a-nombre");
const opsCuenta = document.getElementById("div-op-cuenta");
const btnCerrar = document.getElementById("btn-cerrar-menu");

divCuenta.addEventListener("click",()=>{
    opsCuenta.style.animationName = "desplegar-menu";
    opsCuenta.style.animationDuration = ".3s";
    setTimeout(()=>{
        opsCuenta.style.zIndex = "10";
    },300);
});

btnCerrar.addEventListener("click",()=>{
    opsCuenta.style.animationName = "none";
    opsCuenta.style.zIndex = "-10";
});