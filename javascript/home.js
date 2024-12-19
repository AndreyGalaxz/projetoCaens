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


        const popup = document.getElementById('filterPopup');
        const popupButton = document.getElementById('openPopup');

        popupButton.addEventListener('click', function (event) {
            event.preventDefault(); // evita redirecionamento
            if (popup.style.display === 'none' || popup.style.display === '') {
                popup.style.display = 'block'; // mostra o pop-up
            } else {
                popup.style.display = 'none'; // esconde o pop-up
            }
        });

        // fecha o pop-up ao clicar fora dele
        window.addEventListener('click', function (event) {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });

