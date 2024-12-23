// Alterna entre "ITEM PERDIDO" e "ITEM ACHADO"
function alterarBotao() {
    const botao = document.querySelector('.lost-item');
    const caixaTexto = document.getElementById('caixaTexto');
    
    if (botao.textContent === "ITEM PERDIDO") {
        botao.textContent = "ITEM ACHADO";
        botao.style.backgroundColor = "#FF6347"; // Altere a cor
        botao.style.color = "#FFFFFF";          // Altere a cor do texto
        caixaTexto.placeholder = "Digite aqui o que você encontrou...";
    } else {
        botao.textContent = "ITEM PERDIDO";
        botao.style.backgroundColor = "";       // Reseta para a cor padrão
        botao.style.color = "";
        caixaTexto.placeholder = "Digite aqui o que você perdeu...";
    }
}

// Abre e fecha o popup
const popup = document.getElementById('filterPopup');
const popupButton = document.getElementById('openPopup');
popupButton.addEventListener('click', function (event) {
    event.preventDefault();
    popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
    console.log("clicacado")
});

// Fecha o popup ao clicar fora dele
window.addEventListener('click', function (event) {
    if (event.target === popup) {
        popup.style.display = 'none';
    }
});

// Seleciona as tags
function tagSelect() {
    const botoesTag = document.querySelectorAll('.tagButton');

    botoesTag.forEach((botao) => {
        botao.addEventListener('click', () => {
            botao.classList.toggle('selected');
        });
    });
}

// Inicializa eventos ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    tagSelect();
});

