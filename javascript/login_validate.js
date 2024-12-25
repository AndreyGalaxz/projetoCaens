document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Seleciona os campos
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');

    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    // Regex para validar o e-mail
    const emailRegex = /^[a-zA-Z]+@ifba\.edu\.br$/;

    // Limpa mensagens de erro
    emailError.textContent = '';
    passwordError.textContent = '';
    
    emailError.style.display = 'none';
    passwordError.style.display = 'none';

    let isValid = true;

    // Validação do e-mail
    if (!emailRegex.test(emailField.value)) {
        emailError.textContent = 'O e-mail deve estar no formato nomePessoa@ifba.edu.br';
        emailError.style.display = 'block';
        isValid = false;
    }

    // Validação da senha (apenas exemplo, pode ser personalizada)
    if (passwordField.value.length < 6) {
        passwordError.textContent = 'A senha deve ter pelo menos 6 caracteres.';
        passwordError.style.display = 'block';
        isValid = false;
    }

    // Se tudo for válido, submete o formulário (aqui simulamos o sucesso)
    if (isValid) {
        alert('Login realizado com sucesso!');
    }
});                                                                                                                           