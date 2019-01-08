-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jan-2019 às 22:24
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geradorxml`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `CNPJ` varchar(250) DEFAULT NULL,
  `endereco` varchar(250) DEFAULT NULL,
  `numero` varchar(250) DEFAULT NULL,
  `complemento` varchar(250) DEFAULT NULL,
  `bairro` varchar(250) DEFAULT NULL,
  `CEP` varchar(250) DEFAULT NULL,
  `fone` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `CNPJ`, `endereco`, `numero`, `complemento`, `bairro`, `CEP`, `fone`) VALUES
(15, 'Pedro Paulo', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986'),
(16, 'Carlos Eduardo', '30195969000126', 'RUA DO CLIENTE', '1995', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emissor`
--

CREATE TABLE `emissor` (
  `id` int(11) NOT NULL,
  `CNPJ` varchar(250) DEFAULT NULL,
  `xNome` varchar(250) DEFAULT NULL,
  `xLgr` varchar(250) DEFAULT NULL,
  `xFant` varchar(250) DEFAULT NULL,
  `nro` varchar(250) DEFAULT NULL,
  `xBairro` varchar(250) DEFAULT NULL,
  `cMun` varchar(250) DEFAULT NULL,
  `xMun` varchar(250) DEFAULT NULL,
  `UF` varchar(250) DEFAULT NULL,
  `CEP` varchar(250) DEFAULT NULL,
  `cPais` varchar(250) DEFAULT NULL,
  `xPais` varchar(250) DEFAULT NULL,
  `fone` varchar(250) DEFAULT NULL,
  `IE` varchar(250) DEFAULT NULL,
  `IM` varchar(250) DEFAULT NULL,
  `CRT` varchar(250) DEFAULT NULL,
  `CNAE` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `emissor`
--

INSERT INTO `emissor` (`id`, `CNPJ`, `xNome`, `xLgr`, `xFant`, `nro`, `xBairro`, `cMun`, `xMun`, `UF`, `CEP`, `cPais`, `xPais`, `fone`, `IE`, `IM`, `CRT`, `CNAE`) VALUES
(1, '12291758000105', 'SyS Automatize', 'Endereco da Empresa', 'SyS', '1234', 'Bairro da Empresa', '4314902', 'Guaiba', 'RS', '92500000', '1058', 'Brasil', '51999688986', '0963376802', '14018', '1', '6202300'),
(2, '12291758000105', 'SyS Automatize', 'Endereco da Empresa', 'SyS', '1234', 'Bairro da Empresa', '4314902', 'Guaiba', 'RS', '92500000', '1058', 'Brasil', '51999688986', '0963376802', '14018', '1', '6202300'),
(3, '12291758000105', 'SyS Automatize', 'Endereco da Empresa', 'SyS', '1234', 'Bairro da Empresa', '4314902', 'Guaiba', 'RS', '92500000', '1058', 'Brasil', '51999688986', '0963376802', '14018', '1', '6202300'),
(4, '12291758000105', 'SyS Automatize', 'Endereco da Empresa', 'SyS', '1234', 'Bairro da Empresa', '4314902', 'Guaiba', 'RS', '92500000', '1058', 'Brasil', '51999688986', '0963376802', '14018', '1', '6202300');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nf`
--

CREATE TABLE `nf` (
  `id` int(11) NOT NULL,
  `chave` varchar(47) DEFAULT NULL,
  `cNF` varchar(250) DEFAULT NULL,
  `nNF` varchar(250) DEFAULT NULL,
  `dhEmi` varchar(250) DEFAULT NULL,
  `CNPJDestinatario` varchar(250) DEFAULT NULL,
  `xNomeDestinatario` varchar(250) DEFAULT NULL,
  `protocolo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nf`
--

INSERT INTO `nf` (`id`, `chave`, `cNF`, `nNF`, `dhEmi`, `CNPJDestinatario`, `xNomeDestinatario`, `protocolo`) VALUES
(600, 'NFe43190112291758000105650004444444481444444483', '44444448', '444444448', '2019-01-04T20:31:22-02:00', '30195969000126', 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', '143190000076441'),
(601, 'NFe43190112291758000105650004444444491444444499', '44444449', '444444449', '2019-01-04T20:44:16-02:00', '30195969000126', 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', '143190000076456'),
(602, 'NFe43190112291758000105650004444444501444444503', '44444450', '444444450', '2019-01-04T20:46:10-02:00', '30195969000126', 'NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', '143190000076459');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `ncm` int(11) DEFAULT NULL,
  `preco_custo` varchar(250) DEFAULT NULL,
  `CFOP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `descricao`, `ncm`, `preco_custo`, `CFOP`) VALUES
(14, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '185.37', 5103),
(15, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '184.38', 5103),
(16, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '10.78', 5103),
(17, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '96.28', 5103);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidaproduto`
--

CREATE TABLE `saidaproduto` (
  `id` int(11) NOT NULL,
  `idproduto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `saidaproduto`
--

INSERT INTO `saidaproduto` (`id`, `idproduto`, `quantidade`) VALUES
(74, 15, 1),
(75, 16, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `vendedor` int(11) NOT NULL,
  `produtos` varchar(250) NOT NULL,
  `quantidades` varchar(250) NOT NULL,
  `valorTotal` int(250) NOT NULL,
  `dataVenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `formaPagamento` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saidaproduto`
--
ALTER TABLE `saidaproduto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idproduto` (`idproduto`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `saidaproduto`
--
ALTER TABLE `saidaproduto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `saidaproduto`
--
ALTER TABLE `saidaproduto`
  ADD CONSTRAINT `saidaproduto_ibfk_1` FOREIGN KEY (`idproduto`) REFERENCES `produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
