console.log(document.querySelector('.btn-agregar-almacen-cliente'));
const select = document.createElement('SELECT');
select.name = "id_almacen_cliente[]";
select.classList.add("estilo-select");

const divBotones = document.querySelector(".div-btn-doble");


if (document.querySelector('.btn-agregar-almacen-cliente')) {
    const form = document.querySelector('.form-alta-horario');

    document.querySelector('.btn-agregar-almacen-cliente').addEventListener('click', () => {
        const selectUno = document.querySelector(".select-uno");
        const cloneSelect = selectUno.cloneNode(true);
        form.insertBefore(cloneSelect, document.querySelector('.div-btn-doble'));
    });

    document.querySelector(".btn-remover-almacen-cliente").addEventListener("click", () => {
        const selects = document.querySelectorAll(".select-almacen");
        if (selects.length > 1) {
            selects[selects.length - 1].remove();
        }
    });
}
