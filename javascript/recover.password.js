document.addEventListener("DOMContentLoaded", () => {
    const recoverPasswordLink = document.getElementById("recoverPasswordLink");

    recoverPasswordLink.addEventListener("click", (event) => {
        event.preventDefault(); // Evita o redirecionamento padrão do link

        const emailInput = document.getElementById("email");
        const emailError = document.getElementById("emailError");
        const email = emailInput.value.trim();

        // Validação básica do e-mail
        if (!email) {
            emailError.textContent = "Por favor, insira seu e-mail.";
            emailInput.focus();
            return;
        }

        if (!/^[a-zA-Z]+@ifba\.edu\.br$/.test(email)) {
            emailError.textContent = "E-mail inválido. Use um e-mail do domínio ifba.edu.br.";
            emailInput.focus();
            return;
        }

        emailError.textContent = ""; // Limpa mensagens de erro anteriores

        // Configuração do corpo da requisição
        const payload = {
            email: email
        };

        // Faz a requisição ao servidor
        fetch("http://localhost/projetoCaens/recover_password.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(payload),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    alert(`Erro: ${data.error}`);
                } else if (data.message) {
                    alert("E-mail de recuperação enviado com sucesso! Verifique sua caixa de entrada.");
                }
            })
            .catch((error) => {
                console.error("Erro na solicitação:", error);
                alert("Ocorreu um erro ao tentar enviar o e-mail de recuperação.");
            });
    });
});
