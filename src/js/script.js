// Botones
const botonNuevo = document.getElementById("nuevo");
const botonVer = document.getElementById("ver");
const botonBorrar = document.getElementById("borrar");
const botonOpcionesNuevos = document.getElementById("opciones-nuevos");
const botonOpcionesVer = document.getElementById("opciones-ver");
const botonOpcionesBorrar = document.getElementById("opciones-borrar");
const formularioBuscar = document.querySelector(".formulario-buscar")
const inputBuscar = document.querySelector(".input-buscar");

// let alertaAccion;

// if (document.querySelecetor(".alerta-id")) {

//     alertaAccion = document.querySelecetor(".alerta-id")

// }
// const main = document.querySelector(".main");


// document.addEventListener("DOMContentLoaded", function() {




// })


botonNuevo.addEventListener("click", function() {

    if (!botonOpcionesBorrar.classList.contains("oculto")) {
        botonOpcionesBorrar.classList.add("oculto")
    }
    if (!botonOpcionesVer.classList.contains("oculto")) {
        botonOpcionesVer.classList.add("oculto")
    }


    if (botonOpcionesNuevos.classList.contains("oculto")) {
        botonOpcionesNuevos.classList.remove("oculto")
    } else {
        botonOpcionesNuevos.classList.add("oculto")
    }

})
botonVer.addEventListener("click", function() {


    if (!botonOpcionesBorrar.classList.contains("oculto")) {
        botonOpcionesBorrar.classList.add("oculto")
    }
    if (!botonOpcionesNuevos.classList.contains("oculto")) {
        botonOpcionesNuevos.classList.add("oculto")
    }

    if (botonOpcionesVer.classList.contains("oculto")) {
        botonOpcionesVer.classList.remove("oculto")
    } else {
        botonOpcionesVer.classList.add("oculto")
    }
    // if (formularioBuscar.classList.contains("oculto")) {
    //     formularioBuscar.classList.remove("oculto");
    // } else {
    //     formularioBuscar.classList.add("oculto");

    // }



})
botonBorrar.addEventListener("click", function() {


    if (!botonOpcionesVer.classList.contains("oculto")) {
        botonOpcionesVer.classList.add("oculto")
    }
    if (!botonOpcionesNuevos.classList.contains("oculto")) {
        botonOpcionesNuevos.classList.add("oculto")
    }

    if (botonOpcionesBorrar.classList.contains("oculto")) {
        botonOpcionesBorrar.classList.remove("oculto")
    } else {
        botonOpcionesBorrar.classList.add("oculto")
    }
})

// Opciones Botones

const botonCrearTemplado = document.querySelector(".crear-templado");
const botonStockearTemplado = document.querySelector(".stockear-templado");
const botonElegirMarca = document.querySelector(".elegir-marca");
const botonEliminarStock = document.querySelector(".eliminar-stock");
const formularioCrearTemplado = document.querySelector(".formulario-templados")

botonCrearTemplado.addEventListener("click", function() {

    if (formularioCrearTemplado.classList.contains("oculto")) {

        formularioCrearTemplado.classList.remove("oculto");

    } else {


        formularioCrearTemplado.classList.add("oculto");

    }


})
botonStockearTemplado.addEventListener("click", function() {




})
botonElegirMarca.addEventListener("click", function() {




})
botonEliminarStock.addEventListener("click", function() {




})


// Buscador

const modelos = document.querySelectorAll(".templado h3");


listaModelos = [];

modelos.forEach(function(model) {
        const modelo = model.textContent.split(":");
        listaModelos.push(modelo[1]);
    })
    // const modelito = listaModelos[2]
    // console.log(modelito[1]);

// //Arreglo Resultado Buscar


// //Buscar cada ves que pone letra
let modelosCoincidentes = [];
inputBuscar.addEventListener("change", function(e) {
    modelosCoincidentes = [];
    listaModelos.forEach(function(modelo) {

        if (modelo.search(e.target.value) === 1) {
            modelosCoincidentes.push("Modelo:" + modelo);
        }

    })


    console.log(modelosCoincidentes);



    modelos.forEach(function(modelo) {

        modelo.parentElement.classList.add("oculto")

        if (modelosCoincidentes.includes(modelo.textContent)) {
            console.log(modelo)
            modelo.parentElement.classList.remove("oculto")

        }

    })



})




// function buscarCoincidencia(e, modelo) {

//     for (let i = 0; i < e.lenght; i++) {

//         if (e === modelo.slice(1, e.lenght);

//         }

//     }
//     let resultadoBuscado = [];


//     listaModelos.forEach(function(modelo) {

//         $buscado = retornaModeloBuscado(e, modelo);

//         if ($buscado) {

//             resultadoBuscado.push(modelo);

//         } else {

//             console.log("no existe");

//         }

//     })
//     console.log(resultadoBuscado)

// })

// function retornaModeloBuscado(e, modelo) {


//     for (let i = 0; i <= e.target.value.length; i++) {

//         if (e.target.value === modelo[i]) {
//             console.log(e.target.value[i]);
//             console.log(modelo[i]);
//             return true;


//     }

// }