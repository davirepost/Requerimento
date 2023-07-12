-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jul-2023 às 00:40
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `requerimento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `Nome` varchar(30) NOT NULL,
  `E-mail` varchar(20) NOT NULL,
  `Turma` varchar(10) NOT NULL,
  `Curso` varchar(15) NOT NULL,
  `Matricula` int(20) NOT NULL,
  `Telefone` int(20) NOT NULL,
  `Usuario` int(12) NOT NULL,
  `Senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`Nome`, `E-mail`, `Turma`, `Curso`, `Matricula`, `Telefone`, `Usuario`, `Senha`) VALUES
('Jennifer', 'jennifer260106@gmail', 'Ei-31', 'Informática ', 976543, 345567, 34567, '123'),
('Jennifer', 'jennifer260106@gmail', 'Ei-31', 'Informática ', 976543, 345567, 34567, '123'),
('Jennifer Gomes de Souza Santos', 'jennifer260106@gmail', 'Ei-31', 'Informática ', 9988765, 234567, 34567, '1234'),
('João', '3456', 'Ei-31', 'Informática ', 9988765, 987, 34567, '1234'),
('Jennifer Gomes de Souza Santos', 'jennifer260106@gmail', 'Ei-31', 'Informática ', 9988765, 2147483647, 34567, '1234'),
('ABC', 'jennifer260106@gmail', 'Ei-31', 'Informática ', 9988765, 2147483647, 34567, '1234'),
('Jennifer', '202013600024@ifba.ed', 'Ei-31', 'Informática ', 9988765, 2147483647, 34567, '123'),
('Felipe', 'euio', 'Ei-31', 'Informática ', 9988765, 123455, 0, '1'),
('Jennifer', 'jennifer260106@gmail', 'Ei-31', 'Informática ', 9988765, 2147483647, 23, '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
