-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20-Jun-2023 às 12:41
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `l_v`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  `icone` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `tipo`, `icone`, `data_cadastro`, `data_alteracao`) VALUES
(1, 'Sedan', 'icone_sedan.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(2, 'Hatch', 'icone_hatch.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(3, 'Perua', 'icone_perua.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(4, 'SUVs', 'icone_suvs.png', '2023-04-26 16:35:16', '2023-04-26 16:51:52'),
(5, 'Conversível', 'icone_conversivel.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(6, 'Esport', 'logo_esport.png', '2023-05-04 01:28:10', '2023-05-04 01:30:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `montadora`
--

DROP TABLE IF EXISTS `montadora`;
CREATE TABLE IF NOT EXISTS `montadora` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `logotipo` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `montadora`
--

INSERT INTO `montadora` (`id`, `nome`, `logotipo`, `data_cadastro`, `data_alteracao`) VALUES
(1, 'Volkswagen', 'logo_volkswagen.png', '2023-04-26 16:35:16', '2023-05-04 01:17:47'),
(2, 'Toyota', 'logo_toyota.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(3, 'Honda', 'logo_honda.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(4, 'Ford', 'logo_ford.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(5, 'Chevrolet', 'logo_chevrolet.png', '2023-04-26 16:35:16', '2023-04-26 16:35:16'),
(6, 'BMW', 'logo_bmw.png', '2023-04-26 16:57:20', '2023-04-26 16:57:20'),
(7, 'Fiat', 'logo_fiat.png', '2023-04-26 17:01:35', '2023-04-26 17:01:35'),
(8, 'Chrysler', 'logo_chrysler.png', '2023-05-04 00:39:20', '2023-05-04 00:39:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

DROP TABLE IF EXISTS `veiculo`;
CREATE TABLE IF NOT EXISTS `veiculo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `modelo` varchar(100) DEFAULT NULL,
  `ano_fabricacao` int DEFAULT NULL,
  `ano_modelo` int DEFAULT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `num_portas` int DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `montadora_id` int DEFAULT NULL,
  `tipo_cambio` varchar(50) DEFAULT NULL,
  `tipo_direcao` varchar(50) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `montadora_id` (`montadora_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`id`, `modelo`, `ano_fabricacao`, `ano_modelo`, `cor`, `num_portas`, `foto`, `categoria_id`, `montadora_id`, `tipo_cambio`, `tipo_direcao`, `data_cadastro`, `data_alteracao`) VALUES
(1, 'golf variant', 2019, 2020, 'Preto', 4, 'foto_golf_var.png', 3, 1, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(2, 'Gol', 2021, 2022, 'Prata', 4, 'foto_gol.png', 2, 1, 'Manual', 'Hidráulica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(3, 'Corolla', 2021, 2022, 'Preto', 4, 'foto_corolla.png', 1, 2, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(4, 'Yaris', 2021, 2022, 'Prata', 4, 'foto_yaris.png', 2, 2, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(5, 'Etios', 2021, 2022, 'Cinza', 4, 'foto_etios.png', 2, 2, 'Manual', 'Hidráulica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(6, 'Civic', 2021, 2022, 'Branco', 4, 'foto_civic.png', 1, 3, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(7, 'City', 2020, 2021, 'Marrom', 4, 'foto_city.png', 1, 3, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(8, 'Fusion', 2019, 2020, 'Preto', 4, 'foto_fusion.png', 1, 4, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(9, 'Focus', 2019, 2020, 'Preto', 4, 'foto_focus.png', 1, 4, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(10, 'Fiesta', 2020, 2021, 'Vermelho', 4, 'foto_fiesta.png', 2, 4, 'Manual', 'Mecânica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(11, 'Cruze', 2020, 2021, 'Azul', 4, 'foto_cruze.png', 1, 5, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(12, 'Onix', 2021, 2022, 'Vermelho', 4, 'foto_onix.png', 2, 5, 'Manual', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(13, 'Tracker', 2020, 2021, 'Branco', 4, 'foto_tracker.png', 4, 5, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(14, 'BMW M4    ', 2020, 2020, 'Prata', 2, 'foto_bmw_m4.png', 5, 6, 'Automático', 'Elétrica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(15, 'Uno', 2020, 2021, 'Azul', 2, 'foto_uno.png', 2, 7, 'Manual', 'Mecânica', '2023-04-26 17:03:00', '2023-04-26 17:03:00'),
(16, 'Palio', 2019, 2020, 'Amarelo', 2, 'foto_palio.png', 2, 7, 'Manual', 'Mecânica', '2023-04-26 17:03:00', '2023-04-26 17:03:00');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `veiculo`
--
ALTER TABLE `veiculo`
  ADD CONSTRAINT `veiculo_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `veiculo_ibfk_2` FOREIGN KEY (`montadora_id`) REFERENCES `montadora` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
