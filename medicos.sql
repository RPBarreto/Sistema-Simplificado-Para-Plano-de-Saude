-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Mar-2021 às 20:39
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `medicos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consultas`
--

CREATE TABLE `consultas` (
  `medico` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `paciente` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `presc` varchar(50) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `consultas`
--

INSERT INTO `consultas` (`medico`, `id`, `paciente`, `data`, `presc`, `notes`) VALUES
('testemed@email.com', 2, 'renanparedesbarreto@gmail.com', '2021-03-17', 'aaaaaaaaaa', 'aaaaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exames`
--

CREATE TABLE `exames` (
  `laboratorio` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `paciente` varchar(50) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `result` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `exames`
--

INSERT INTO `exames` (`laboratorio`, `id`, `paciente`, `data`, `type`, `result`) VALUES
('testelab@email.com', 1, 'renanparedesbarreto@gmail.com', '2021-03-17', 'oi', 'oi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios`
--

CREATE TABLE `laboratorios` (
  `name` varchar(50) DEFAULT NULL,
  `cnpj` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `expertise` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `laboratorios`
--

INSERT INTO `laboratorios` (`name`, `cnpj`, `email`, `address`, `phone`, `expertise`) VALUES
('testelab', '123456789', 'testelab@email.com', 'testelab', '1111111111', 'umai'),
('test2', '444444', '88888@mail.com', '222222', '22222222', '222222222');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `crm` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `expertise` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`name`, `lastname`, `crm`, `email`, `address`, `phone`, `expertise`) VALUES
('teste2', 'teste2', '1111111', 'teste2@email.com', 'teste2', '11111', '111111'),
('teste', 'medico', '12345', 'testemed@email.com', 'testemd', '555555', '555555'),
('rogerinho', 'jubileu', '123456', 'regerinhojubileu@email.com.br', 'umai', '4002-8922', 'umai');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `name` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`name`, `lastname`, `cpf`, `email`, `address`, `phone`, `genero`) VALUES
('RENAN', 'BARRETO', '5445545', 'renanparedesbarreto@gmail.com', 'Rua Rio São Francisco, 105', '53991871675', 'feminino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`email`, `pass`, `type`) VALUES
('88888@mail.com', '444444', 3),
('RENAN', '654321', 2),
('renan.barretoo@hotmail.com', 'testingshit', 1),
('renanparedesbarreto@gmail.com', '5445545', 4),
('teste2@email.com', '1111111', 2),
('testelab@email.com', '123456789', 3),
('testemed@email.com', '12345', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `exames`
--
ALTER TABLE `exames`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `laboratorios`
--
ALTER TABLE `laboratorios`
  ADD PRIMARY KEY (`cnpj`);

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`crm`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `exames`
--
ALTER TABLE `exames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
