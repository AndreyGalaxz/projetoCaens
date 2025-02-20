CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo INT NOT NULL DEFAULT 1
);


CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    datahora DATETIME NOT NULL,
    tipo INT NOT NULL,
    status_produto INT NOT NULL,
    email VARCHAR(100) NOT NULL
    imagem VARCHAR(255)
);

