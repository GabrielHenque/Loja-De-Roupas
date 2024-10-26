-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_loja
CREATE DATABASE IF NOT EXISTS `db_loja` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_loja`;

-- Copiando estrutura para tabela db_loja.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `tamanho` varchar(5) DEFAULT NULL,
  `cor` varchar(30) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja.produtos: ~20 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `estoque`, `categoria`, `tamanho`, `cor`, `marca`, `imagem`) VALUES
	(1, 'Camiseta Básica', 'Camiseta de algodão, básica e confortável.', 29.90, 50, 'Camisetas', 'M', 'Branca', 'Hering', 'produto_001.jpg'),
	(2, 'Calça Jeans', 'Calça jeans de alta qualidade, ajustada ao corpo.', 119.90, 30, 'Calças', '42', 'Azul', 'K2B', 'produto_002.jpg'),
	(3, 'Jaqueta de Couro', 'Jaqueta de couro sintético, moderna e estilosa.', 199.90, 10, 'Jaquetas', 'G', 'Preta', 'Revanche', 'produto_003.jpg'),
	(4, 'Vestido Floral', 'Vestido leve e solto, com estampa floral.', 89.90, 25, 'Vestidos', 'M', 'Rosa', 'Hope', 'produto_004.jpg'),
	(5, 'Saia Lápis', 'Saia lápis, ideal para o ambiente de trabalho.', 69.90, 20, 'Saias', 'P', 'Preta', 'Hering', 'produto_005.jpg'),
	(6, 'Blusa de Tricot', 'Blusa de tricot, ideal para dias frios.', 49.90, 40, 'Blusas', 'G', 'Cinza', 'K2B', 'produto_006.jpg'),
	(7, 'Camisa Social', 'Camisa social de manga longa, corte slim.', 79.90, 35, 'Camisas', 'M', 'Azul', 'Revanche', 'produto_007.jpg'),
	(8, 'Shorts Jeans', 'Shorts jeans com barra dobrada.', 59.90, 45, 'Shorts', '38', 'Azul Claro', 'Hope', 'produto_008.jpg'),
	(9, 'Calça Legging', 'Calça legging de alta elasticidade, confortável.', 39.90, 60, 'Calças', 'G', 'Preta', 'Hering', 'produto_009.jpg'),
	(10, 'Moletom Canguru', 'Moletom canguru com capuz e bolso frontal.', 99.90, 15, 'Moletons', 'G', 'Vermelho', 'K2B', 'produto_010.jpg'),
	(11, 'Casaco de Lã', 'Casaco de lã, ideal para o inverno.', 149.90, 8, 'Casacos', 'GG', 'Marrom', 'Revanche', 'produto_011.jpg'),
	(12, 'Regata Básica', 'Regata básica de algodão.', 19.90, 100, 'Regatas', 'M', 'Branca', 'Hope', 'produto_012.jpg'),
	(13, 'Blazer Feminino', 'Blazer feminino de alfaiataria.', 129.90, 12, 'Blazers', 'P', 'Preto', 'Hering', 'produto_013.jpg'),
	(14, 'Bermuda de Sarja', 'Bermuda de sarja, ideal para o verão.', 69.90, 30, 'Bermudas', '42', 'Bege', 'K2B', 'produto_014.jpg'),
	(15, 'Macacão Jeans', 'Macacão jeans com alças ajustáveis.', 109.90, 22, 'Macacões', 'M', 'Azul', 'Revanche', 'produto_015.jpg'),
	(16, 'Camiseta Polo', 'Camiseta polo, confortável e elegante.', 49.90, 50, 'Camisetas', 'G', 'Verde', 'Hope', 'produto_016.jpg'),
	(17, 'Polo Listrada', 'Camiseta polo listrada, estilo clássico.', 59.90, 40, 'Camisetas', 'M', 'Azul e Branco', 'Hering', 'produto_017.jpg'),
	(18, 'Cropped de Malha', 'Cropped de malha, perfeito para o verão.', 29.90, 60, 'Blusas', 'P', 'Amarelo', 'K2B', 'produto_018.jpg'),
	(19, 'Suéter de Lã', 'Suéter de lã, ideal para o inverno.', 89.90, 18, 'Suéteres', 'M', 'Verde Escuro', 'Revanche', 'produto_019.jpg'),
	(20, 'Camisa Xadrez', 'Camisa xadrez de flanela, confortável e estilosa.', 69.90, 25, 'Camisas', 'G', 'Vermelho', 'Hope', 'produto_020.jpg');

-- Copiando estrutura para tabela db_loja.tb_categoria
CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `data_cad` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela db_loja.tb_categoria: ~4 rows (aproximadamente)
INSERT INTO `tb_categoria` (`id`, `categoria`, `data_cad`) VALUES
	(3, 'seu jorge', '2024-10-22 21:32:22'),
	(7, 'seu jorge', '2024-10-22 21:44:02'),
	(8, 'Calça', '2024-10-22 21:46:01'),
	(9, 'Calça', '2024-10-22 21:50:03');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
