import inicializaCadastro from "./componentes/cadastro/componente-cadastro";
import inicializaFormEdicao from "./componentes/edita/form-edicao";
import inicializaTabela from "./componentes/listagem/listagem-cliente";


const rotas = {
    "/": inicializaTabela,
    "/cadastro": inicializaCadastro,
    "/edita": inicializaFormEdicao,
}

const rootDiv = document.querySelector('[data-container]')

const navegacao = (pathname) => {
    window.history.pushState({}, pathname, window.location.origin + pathname)

    rootDiv.innerHTML = ""
    const iniciarRota = rotas[window.location.pathname]

    rootDiv.appendChild(iniciarRota())
};

window.navegacao = navegacao

window.onpopstate = () => {
    rootDiv.innerHTML = ""

    rootDiv.appendChild(rotas[window.location.pathname]())
}
export { navegacao }