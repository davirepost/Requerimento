CREATE DATABASE Discentes;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `discentes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estudante`
--

CREATE TABLE `coordenacao` (
  `matricula` int(15) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `curso` varchar(40) NOT NULL,
  `telefone` int(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estudante`
--

INSERT INTO `estudante` (`matricula`, `nome`, `curso`, `telefone`, `email`, `senha`) VALUES
(9, 'jota', 'C.I Técnico em Informática', 451, 'juntosnomcpe@gmail.com', 'v', '1111'),
(10, '', '1', 0, '', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `estudante`
--
ALTER TABLE `estudante`
  ADD PRIMARY KEY (`matricula`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

