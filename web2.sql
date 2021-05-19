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
(2,	'Fornecedor Teste',	'Teste',	'teste@testeguardachuva.com',	'(65) 46465-4646'),
(3,	'Fornecedor Guarda Chuva',	'tese',	'teste@testeguarda.com',	'(87) 98797-8979');

DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fornecedor_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fornecedor_id` (`fornecedor_id`),
  CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `produto` (`id`, `nome`, `descricao`, `imagem`, `fornecedor_id`) VALUES
(9,	'Guarda Chuva Rainbow',	'teste',	'rainbow_umbrella_05-19-2021_103146.jpg',	3),
(10,	'Melancia',	'Modelo melancia',	'watermellon_umprella_05-19-2021_101920.jpg',	2),
(13,	'Umbrella Mondo',	'teste',	'umbrella_mondo_05-19-2021_103549.jpg',	2);

DROP TABLE IF EXISTS `estoque`;
CREATE TABLE `estoque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantidade` int NOT NULL,
  `preco` decimal(12,2) NOT NULL,
  `produto_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `estoque` (`id`, `quantidade`, `preco`, `produto_id`) VALUES
(8,	20,	45.23,	9);

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`) VALUES
(3,	'vafranca@gmail.com',	'25c1c47fa6224632c6dc07137ea6089a',	'Vanessa');

-- 2021-05-19 13:37:13
