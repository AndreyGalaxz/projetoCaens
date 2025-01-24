CREATE TABLE produtos (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,  -- Identificador único e chave primária
    descricao VARCHAR(255) NOT NULL,    -- Descrição do produto (até 255 caracteres)
    datahora DATETIME NOT NULL,         -- Data e hora do registro
    tipo INT NOT NULL,                  -- Tipo (1 = Achado, 2 = Perdido, por exemplo)
    status INT NOT NULL                 -- Status (exemplo: 0 = Inativo, 1 = Ativo)
);
