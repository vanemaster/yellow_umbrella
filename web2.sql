DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE `fornecedor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `fornecedor` (`id`, `nome`, `descricao`, `email`, `telefone`) VALUES
(1,	'Fornecedor 134',	'teste353refdc\\sf',	'teste@teste123',	'(54) 54654-6464');

DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `fornecedor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fornecedor_id` (`fornecedor_id`),
  CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `produto` (`id`, `nome`, `descricao`, `foto`, `fornecedor_id`) VALUES
(5,	'Teste',	'erere',	'',	1),
(6,	'Guarda Chuva Rainbow',	'teste',	'',	1);

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantidade` int NOT NULL,
  `preco` decimal(12,2) NOT NULL,
  `produto_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `estoque` (`id`, `quantidade`, `preco`, `produto_id`) VALUES
(1,	20,	56.23,	5),
(5,	30,	89.90,	6);

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`) VALUES
(3,	'vafranca@gmail.com',	'25c1c47fa6224632c6dc07137ea6089a',	'Vanessa'),
(4,	'doug@doug.com',	'b8c5fa008715b53b95c874d73b4dcc02',	'Douglas');

-- 2021-05-02 16:23:18
