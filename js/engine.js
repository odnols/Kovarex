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

function filtra_fornecedor() {

    const alvo = (document.getElementById("input_filtro_fornecedor").value).toUpperCase()
    let item_fornecedor = document.getElementsByClassName("item_fornecedor")
    let filtros = 0

    // Filtrando os fornecedores com a pesquisa ativa
    for (let i = 0; i < item_fornecedor.length; i++)
        if ((item_fornecedor[i].classList.value).includes(alvo)) item_fornecedor[i].style.display = "Block"
        else {
            filtros++
            item_fornecedor[i].style.display = "None"
        }

    // Card com retorno para sem resultados no filtro
    if (filtros === item_fornecedor.length) document.getElementsByClassName("sem_resultados")[0].style.display = "Block"
    else document.getElementsByClassName("sem_resultados")[0].style.display = "None"
}

function abrir_popup() {
    $(".cadastro_popup").fadeIn()
}

function fechar_popup() {
    $(".cadastro_popup").fadeToggle()
}