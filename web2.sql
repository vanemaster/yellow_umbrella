DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cartao_credito` varchar(255) NOT NULL,
  `endereco_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `endereco_id` (`endereco_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `cliente_ibfk_4` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `cliente` (`id`, `nome`, `telefone`, `email`, `cartao_credito`, `endereco_id`, `usuario_id`) VALUES
(1,	'Cliente 1',	'(56) 4654-646',	'teste@testecliente',	'8979878979',	5,	NULL),
(3,	'Cliente Externo 123',	'(98) 78979-7998',	'teste@testeclienteexterno',	'564654646',	8,	7),
(4,	'João',	'(65) 46546-4646',	'teste@joao',	'654564646',	9,	8),
(5,	'Maria',	'(23) 13213-1313',	'teste@testemaria',	'9797979',	10,	9);

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE `endereco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rua` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numero` int NOT NULL,
  `complemento` varchar(255) NOT NULL,
  `bairro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_id` (`estado_id`),
  CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `endereco` (`id`, `rua`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `estado_id`) VALUES
(5,	'Rua das Camélias teste',	588,	'apto 13',	'',	'',	'Caxias do Sul',	21),
(8,	'Rua das Bromélias',	987,	'ap 33',	'Rio Branco',	'95099330',	'Caxias do Sul',	21),
(9,	'Rua das Bromélias',	32132,	'apto 13',	'',	'',	'Caxias do Sul',	21),
(10,	'Rua das Bromélias',	9879,	'ap 33',	'',	'',	'Caxias do Sul',	21),
(11,	'Rua das Bromélias',	353,	'ap 33',	'',	'',	'Caxias do Sul',	21);

DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sigla` varchar(25) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `estados` (`id`, `sigla`, `estado`) VALUES
(1,	'AC',	'Acre'),
(2,	'AL',	'Alagoas'),
(3,	'AP',	'Amapá'),
(4,	'AM',	'Amazonas'),
(5,	'BA',	'Bahia'),
(6,	'CE',	'Ceará'),
(7,	'DF',	'Distrito Federal'),
(8,	'ES',	'Espírito Santo'),
(9,	'GO',	'Goiás'),
(10,	'MA',	'Maranhão'),
(11,	'MS',	'Mato Grosso do Sul'),
(12,	'MT',	'Mato Grosso'),
(13,	'MG',	'Minas Gerais'),
(14,	'PA',	'Pará'),
(15,	'PB',	'Paraíba'),
(16,	'PR',	'Paraná'),
(17,	'PE',	'Pernambuco'),
(18,	'PI',	'Piauí'),
(19,	'RJ',	'Rio de Janeiro'),
(20,	'RN',	'Rio Grande do Norte'),
(21,	'RS',	'Rio Grande do Sul'),
(22,	'RO',	'Rondônia'),
(23,	'RR',	'Roraima'),
(24,	'SC',	'Santa Catarina'),
(25,	'SP',	'São Paulo'),
(26,	'SE',	'Sergipe'),
(27,	'TO',	'Tocantins');

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
(8,	1,	45.23,	9),
(9,	8,	20.00,	10);

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE `fornecedor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `endereco_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `endereco_id` (`endereco_id`),
  CONSTRAINT `fornecedor_ibfk_2` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `fornecedor` (`id`, `nome`, `descricao`, `email`, `telefone`, `endereco_id`) VALUES
(2,	'Fornecedor Teste',	'Teste',	'teste@testeguardachuva.com',	'(65) 46465-4646',	NULL),
(3,	'Fornecedor Guarda Chuva',	'tese',	'teste@testeguarda.com',	'(87) 98797-8979',	NULL);

DROP TABLE IF EXISTS `item_pedido`;
CREATE TABLE `item_pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantidade` int NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `pedido_id` int NOT NULL,
  `produto_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_id` (`pedido_id`),
  KEY `produto_id` (`produto_id`),
  CONSTRAINT `item_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  CONSTRAINT `item_pedido_ibfk_3` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `item_pedido` (`id`, `quantidade`, `preco`, `pedido_id`, `produto_id`) VALUES
(3,	1,	45,	18,	9),
(4,	1,	45,	19,	9),
(5,	1,	20,	19,	10),
(6,	1,	20,	20,	10);

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int NOT NULL,
  `data_pedido` datetime NOT NULL,
  `data_entrega` datetime NOT NULL,
  `situacao` varchar(255) NOT NULL,
  `cliente_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pedido` (`id`, `numero`, `data_pedido`, `data_entrega`, `situacao`, `cliente_id`) VALUES
(18,	8,	'2021-06-13 18:11:37',	'2021-06-23 18:11:37',	'1',	3),
(19,	9,	'2021-06-13 18:50:53',	'2021-06-23 18:50:53',	'1',	3),
(20,	10,	'2021-06-13 22:20:53',	'2021-06-23 22:20:53',	'1',	3);

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `perfil` (`id`, `nome`) VALUES
(1,	'Admin'),
(2,	'Cliente');

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

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `perfil_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`email`),
  KEY `perfil_id` (`perfil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO `usuario` (`id`, `email`, `senha`, `nome`, `perfil_id`) VALUES
(3,	'vafranca@gmail.com',	'25c1c47fa6224632c6dc07137ea6089a',	'Vanessa',	1),
(7,	'teste@testeclienteexterno',	'698dc19d489c4e4db73e28a713eab07b',	'Cliente Externo 123',	2),
(8,	'teste@joao',	'698dc19d489c4e4db73e28a713eab07b',	'João',	2),
(9,	'teste@testemaria',	'698dc19d489c4e4db73e28a713eab07b',	'Maria',	2),
(10,	'teste@testecliente',	'698dc19d489c4e4db73e28a713eab07b',	'Vanessa Admin',	2);

-- 2021-06-14 01:30:19
