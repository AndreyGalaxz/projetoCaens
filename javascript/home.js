function alterarBotao() {
    const botao = document.querySelector('.lost-item');
    const caixaTexto = document.getElementById('caixaTexto');
    
    // Verifica o estado atual e muda a cor e o texto
    if (botao.textContent === "ITEM PERDIDO") {
        botao.textContent = "ITEM ACHADO";
        botao.style.backgroundColor = "#FF6347";  // Altere a cor como desejar
        botao.style.color = "#FFFFFF";            // Altere a cor do texto como desejar
        caixaTexto.placeholder = "Digite aqui o que você encontrou...";
    } else {
        botao.textContent = "ITEM PERDIDO";
        botao.style.backgroundColor = "";         // Reseta para a cor padrão do botão
        botao.style.color = "";
        caixaTexto.placeholder = "Digite aqui o que você perdeu...";                   
    }
}

