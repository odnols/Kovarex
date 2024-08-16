function login() {
    $("#formulario_login").fadeToggle()
}

function filtra_itens(alvo) {

    const itens = document.getElementsByClassName("categoria_item")
    let caso = "Block"

    if (alvo) caso = "None"

    for (let i = 0; i < itens.length; i++)
        itens[i].style.display = caso

    if (alvo) {
        const alvos = document.getElementsByClassName(alvo)

        for (let i = 0; i < alvos.length; i++)
            alvos[i].style.display = "Block"
    }
}

function btn_login(caso) {

    document.getElementById("formularios_lg").style.display = "None"
    document.getElementById("formularios_cad").style.display = "None"

    if (caso)
        document.getElementById("formularios_cad").style.display = "Block"
    else
        document.getElementById("formularios_lg").style.display = "Block"
}

$("#perfil_sm").click(() => {
    $("#float_menu").fadeToggle()
})