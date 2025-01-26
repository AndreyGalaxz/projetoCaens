const botaoAchado = document.getElementById("achados"); 
const botaoPerdido = document.getElementById("perdidos");
const botaoTodos = document.getElementById("todos");

// Função para redirecionar com o valor apropriado
const redirecionarComValor = (valor) => {
    const urlAtual = new URL(window.location.href);
    const valorAtual = urlAtual.searchParams.get("valor");

    // Evitar redirecionamento se o valor já estiver na URL
    if (valorAtual !== String(valor)) {
        urlAtual.searchParams.set("valor", valor);
        window.location.href = urlAtual.toString();
    }
};

// Adicionando eventos de clique aos botões
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
