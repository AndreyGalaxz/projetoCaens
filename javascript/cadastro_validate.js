document.getElementById('cadastroForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Seleciona os campos
    const nomeField = document.getElementById('nome');
    const emailField = document.getElementById('email');
    const senhaField = document.getElementById('senha');
    const confirmarSenhaField = document.getElementById('confirmarSenha');

    const nomeError = document.getElementById('nomeError');
    const emailError = document.getElementById('emailError');
    const senhaError = document.getElementById('senhaError');
    const confirmarSenhaError = document.getElementById('confirmarSenhaError');

    // Regex para validar o e-mail
    const emailRegex = /^[a-zA-Z]+@ifba\.edu\.br$/;

    // Limpa mensagens de erro
    nomeError.textContent = '';
    emailError.textContent = '';
    senhaError.textContent = '';
    confirmarSenhaError.textContent = '';

    nomeError.style.display = 'none';
    emailError.style.display = 'none';
    senhaError.style.display = 'none';
    confirmarSenhaError.style.display = 'none';

    let isValid = true;

    // Validação do nome
    if (nomeField.value.trim().length == 0) {
        nomeError.textContent = 'O nome é obrigatório.';
        nomeError.style.display = 'block';
        isValid = false;
    }

    // Validação do e-mail
    if (!emailRegex.test(emailField.value)) {
        emailError.textContent = 'O e-mail deve estar no formato nomePessoa@ifba.edu.br.';
        emailError.style.display = 'block';
        isValid = false;
    }

    // Validação da senha
    if (senhaField.value.length < 6) {
        senhaError.textContent = 'A senha deve ter pelo menos 6 caracteres.';
        senhaError.style.display = 'block';
        isValid = false;
    }

    // Validação da confirmação de senha
    if (senhaField.value !== confirmarSenhaField.value) {
        confirmarSenhaError.textContent = 'As senhas não correspondem.';
        confirmarSenhaError.style.display = 'block';
        isValid = false;
    }

    // Se tudo for válido, simula o sucesso do cadastro
    if (isValid) {
        alert('Cadastro realizado com sucesso!');
    }
});
