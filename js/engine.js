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

function filtra_fornecedor(caso) {

    let alvo = "input_filtro_fornecedor"

    // Filtro utilizado para itens de pedidos
    if (caso) alvo = "filtro_tipo_item_pedido"

    alvo = (document.getElementById(alvo).value).toLowerCase()
    let item_fornecedor = document.getElementsByClassName("item_fornecedor")
    let filtros = 0


    // Filtrando os fornecedores com a pesquisa ativa
    for (let i = 0; i < item_fornecedor.length; i++) {
        if ((item_fornecedor[i].classList.value).includes(alvo)) {

            // Verificando o tipo de display do card que está sendo filtrado
            let caso = (item_fornecedor[i].classList.value).includes("selecionar_lista_pedido") || ((item_fornecedor[i].classList.value).includes("item_lista_conferir_empenho")) ? "Grid" : "Block"

            item_fornecedor[i].style.display = caso
        } else {
            filtros++
            item_fornecedor[i].style.display = "None"
        }
    }

    // Card com retorno para sem resultados no filtro
    if (filtros === item_fornecedor.length) document.getElementsByClassName("sem_resultados")[0].style.display = "Block"
    else document.getElementsByClassName("sem_resultados")[0].style.display = "None"
}

function abrir_popup(alvo) {

    if (alvo) $(`.${alvo}`).fadeIn()
    else $(".cadastro_popup").fadeIn()
}

function fechar_popup(alvo) {
    if (alvo) $(`.${alvo}`).fadeToggle()
    else $(".cadastro_popup").fadeToggle()
}

function pop_up_login() {
    $("#formulario_login_empenho").fadeToggle()
}

function confirmar_exclusao(alvo, id) {

    if (confirm("Confirma a exclusão?"))
        window.location.href = `../../php/functions/excluir_${alvo}.php?input_id=${id}`
}