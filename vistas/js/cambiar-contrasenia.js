const input1 = document.querySelector(".txt1");
const input2 = document.querySelector(".txt2");
const input3 = document.querySelector(".txt3");
const botones = document.querySelectorAll(".botones");



botones.forEach(boton =>{
    boton.addEventListener("click", ()=>{
        if(boton.classList.contains("ojo1") && boton.getAttribute("src") === "img/iconos/ojo-cerrado.png"){
            boton.src = "img/iconos/ojo-abierto.png";
            input1.type = "text";
        } else if(boton.classList.contains("ojo1") && boton.getAttribute("src") === "img/iconos/ojo-abierto.png"){
            boton.src = "img/iconos/ojo-cerrado.png";
            input1.type = "password";
        }

        else if(boton.classList.contains("ojo2") && boton.getAttribute("src") === "img/iconos/ojo-cerrado.png"){
            boton.src = "img/iconos/ojo-abierto.png";
            input2.type = "text";
        } else if(boton.classList.contains("ojo2") && boton.getAttribute("src") === "img/iconos/ojo-abierto.png"){
            boton.src = "img/iconos/ojo-cerrado.png";
            input2.type = "password";
        }

        else if(boton.classList.contains("ojo3") && boton.getAttribute("src") === "img/iconos/ojo-cerrado.png"){
            boton.src = "img/iconos/ojo-abierto.png";
            input3.type = "text";
        } else if(boton.classList.contains("ojo3") && boton.getAttribute("src") === "img/iconos/ojo-abierto.png"){
            boton.src = "img/iconos/ojo-cerrado.png";
            input3.type = "password";
        }
    });
});

const legend = document.querySelector("#legend");
const divConfirmar = document.querySelector(".div-confirmar");
const divCambiar = document.querySelector("#div-cambiar-contrasenia");
if(legend.textContent == "Estas seguro de que quieres cambiar la contraseña"){
    divConfirmar.style.display = "flex";
    divCambiar.style.display = "none";
    const botonCancelar = document.querySelector(".boton-cancelar");
    botonCancelar.addEventListener("click", ()=>{
        divConfirmar.style.display = "none";
    divCambiar.style.display = "flex";
    });
}