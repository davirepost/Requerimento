-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/10/2023 às 00:07
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `login`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `cod_adm` bigint(11) NOT NULL,
  `senha` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `coordenacao`
--

CREATE TABLE `coordenacao` (
  `cod_siape` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `coordenacao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `nome_curso` varchar(50) NOT NULL,
  `departamento_cod_siape` int(11) NOT NULL,
  `discente_matricula` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `discente`
--

CREATE TABLE `discente` (
  `matricula` bigint(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nome_aluno` varchar(100) NOT NULL,
  `endereco` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `docente`
--

CREATE TABLE `docente` (
  `email` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `requerimento_idrequerimento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `requerimento`
--

CREATE TABLE `requerimento` (
  `idrequerimento` int(11) NOT NULL,
  `objeto` varchar(200) NOT NULL,
  `data_inicial` date NOT NULL,
  `data_final` date NOT NULL,
  `data/hora_regis` datetime(6) NOT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `anexos` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  `turma` varchar(10) NOT NULL,
  `discente_matricula` bigint(15) NOT NULL,
  `idcurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`cod_adm`);

--
-- Índices de tabela `coordenacao`
--
ALTER TABLE `coordenacao`
  ADD PRIMARY KEY (`cod_siape`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `fk_curso_departamento_idx` (`departamento_cod_siape`),
  ADD KEY `fk_curso_discente1_idx` (`discente_matricula`);

--
-- Índices de tabela `discente`
--
ALTER TABLE `discente`
  ADD PRIMARY KEY (`matricula`);

--
-- Índices de tabela `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`requerimento_idrequerimento`);

--
-- Índices de tabela `requerimento`
--
ALTER TABLE `requerimento`
  ADD PRIMARY KEY (`idrequerimento`),
  ADD KEY `fk_requerimento_discente1_idx` (`discente_matricula`),
  ADD KEY `fk_requerimento_curso1_idx` (`idcurso`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_departamento` FOREIGN KEY (`departamento_cod_siape`) REFERENCES `coordenacao` (`cod_siape`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_curso_discente1` FOREIGN KEY (`discente_matricula`) REFERENCES `discente` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `fk_docente_requerimento1` FOREIGN KEY (`requerimento_idrequerimento`) REFERENCES `requerimento` (`idrequerimento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `requerimento`
--
ALTER TABLE `requerimento`
  ADD CONSTRAINT `fk_requerimento_curso1` FOREIGN KEY (`idcurso`) REFERENCES `curso` (`idcurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requerimento_discente1` FOREIGN KEY (`discente_matricula`) REFERENCES `discente` (`matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
