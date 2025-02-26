
-- use os scripts abaixo para iniciar o banco corretamente

-- Tabela `sits_usuarios`
CREATE TABLE IF NOT EXISTS `sits_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_situacao` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sits_usuarios` (`id`, `nome_situacao`) VALUES
(1, 'Ativo'),
(2, 'Inativo'),
(3, 'Aguardando Confirmação');

-- Tabela `usuario`
CREATE TABLE IF NOT EXISTS `usuarios` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo INT NOT NULL DEFAULT 1,
    chave varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    sits_usuario_id INT NOT NULL DEFAULT 3, -- Relacionamento com `sits_usuarios`
    FOREIGN KEY (sits_usuario_id) REFERENCES sits_usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela `produtos` (sem alterações)
CREATE TABLE IF NOT EXISTS `produtos` (
    id_produto INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    datahora DATE NOT NULL,
    tipo INT NOT NULL,
    status_produto INT NOT NULL,
    email VARCHAR(100) NOT NULL,
    imagem VARCHAR(255)
);
