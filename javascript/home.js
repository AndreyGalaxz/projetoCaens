/* 

 faz o direcionamento do valor que corresponde a um botão clicado
para filtrar os tipos de item que serão exibidos na página inicial

*/

const botaoAchado = document.getElementById("achados"); 
const botaoPerdido = document.getElementById("perdidos");
const botaoTodos = document.getElementById("todos");

const redirecionarComValor = (valor) => {
    const urlAtual = new URL(window.location.href);
    const valorAtual = urlAtual.searchParams.get("valor");

    if (valorAtual !== String(valor)) {
        urlAtual.searchParams.set("valor", valor);
        window.location.href = urlAtual.toString();
    }
};

botaoTodos.addEventListener("click", () => {
    console.log("Todos");
    redirecionarComValor(3);
});

botaoAchado.addEventListener("click", () => {
    console.log("Achado");
    redirecionarComValor(1);
});

botaoPerdido.addEventListener("click", () => {
    console.log("Perdido");
    redirecionarComValor(2);
});
