-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jan-2019 às 18:21
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
  `fone` varchar(250) DEFAULT NULL,
  `municipio` varchar(250) NOT NULL,
  `UF` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `CNPJ`, `endereco`, `numero`, `complemento`, `bairro`, `CEP`, `fone`, `municipio`, `UF`) VALUES
(20, 'Pedro Saldanha', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(21, 'Pedro Carvalho', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(22, 'Olavo de Carvalho', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(23, 'Pedro Queiroz', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(24, 'Jesus Paulo', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(25, 'Geison Carlos', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(26, 'Benedito', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(27, 'Pedro', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(31, 'Paulo Guedes', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(32, 'General Hamilton Mourao', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(33, 'Sergio Moro', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(34, 'Fernando Haddad', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(35, 'Pedro Henrique', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(36, 'Pedro Henrique', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(37, 'Henrique Castro', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(38, 'Pedro Carvalho', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(39, 'Olavo de Carvalho', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(40, 'Jesus Paulo', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(41, 'Geison Carlos', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(42, 'Benedito', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(43, 'Pedro', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(44, 'Pedro Neto ', '0195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(45, 'Geiso', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(46, 'Jair Bolsonaro', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(47, 'Paulo Guedes', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(48, 'General Hamilton Mourao', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(49, 'Sergio Moro', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(50, 'Fernando Haddad', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS'),
(51, 'Pedro Queiroz', '30195969000126', 'RUA DO CLIENTE', '122', 'COMPLEMENTO DO CLIENTE', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'RS');

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
(1, '12291758000105', 'BGC Automatize', 'RUA', 'SyS', '115', 'BAIRRO', '4314902', 'Guaiba', 'RS', '92500000', '1058', 'Brasil', '51999688986', '0963376802', '14018', '1', '6202300');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ide`
--

CREATE TABLE `ide` (
  `cUF` int(2) NOT NULL,
  `natOp` varchar(250) NOT NULL,
  `mod` int(2) NOT NULL,
  `serie` varchar(3) NOT NULL,
  `tpNF` varchar(250) NOT NULL,
  `idDest` int(1) NOT NULL,
  `cMunFG` varchar(250) NOT NULL,
  `tpImp` int(1) NOT NULL,
  `tpEmis` int(1) NOT NULL,
  `tpAmb` int(1) NOT NULL,
  `finNFe` int(1) NOT NULL,
  `indFinal` int(1) NOT NULL,
  `indPres` int(1) NOT NULL,
  `procEmi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inutilizado`
--

CREATE TABLE `inutilizado` (
  `id` int(11) NOT NULL,
  `xml` varchar(250) NOT NULL,
  `inicio` varchar(250) NOT NULL,
  `fim` varchar(250) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `inutilizado`
--

INSERT INTO `inutilizado` (`id`, `xml`, `inicio`, `fim`, `data`) VALUES
(0, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/43191229175800010565001100000045100000045-procInutNFe.xml', '100000045', '100000045', '2019-01-15 01:05:38'),
(0, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/43191229175800010565001100000047100000047-procInutNFe.xml', '100000047', '100000047', '2019-01-15 01:21:51'),
(0, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/43191229175800010565001100000049100000049-procInutNFe.xml', '100000049', '100000049', '2019-01-15 01:27:29');

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
  `protocolo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nf`
--

INSERT INTO `nf` (`id`, `chave`, `cNF`, `nNF`, `dhEmi`, `protocolo`) VALUES
(727, 'NFe43190112291758000105650011000000291100000299', '10000029', '100000029', 'START', 'START'),
(793, 'NFe43190112291758000105650011000001051100001057', '10000105', '100000105', '2019-01-15T15:22:08-02:00', '143190000724467'),
(794, 'NFe43190112291758000105650011000001061100001062', '10000106', '100000106', '2019-01-16T16:20:59-02:00', '143190000780033');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nfcancelada`
--

CREATE TABLE `nfcancelada` (
  `id` int(11) NOT NULL,
  `xml` varchar(250) NOT NULL,
  `nf` varchar(250) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `nfcancelada`
--

INSERT INTO `nfcancelada` (`id`, `xml`, `nf`, `data`) VALUES
(7, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/NFe43190112291758000105650011000000341100000340-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190112291758000105650011000000341100000340|2|2|1|587D7149221CFC8FAD9698155EDBF4C1F0D8810E', '2019-01-14 21:18:04'),
(8, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/NFe43190112291758000105650011000000351100000356-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190112291758000105650011000000351100000356|2|2|1|1250C6E7A25FEE2A0311B873B7E0539EAD271C9D', '2019-01-14 21:57:13'),
(9, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/NFe43190112291758000105650011000000461100000465-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190112291758000105650011000000461100000465|2|2|1|5195CDAEDC43606CE9391B5F1A5D7BDA45A6E6CE', '2019-01-15 01:16:36'),
(10, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/NFe43190112291758000105650011000000481100000486-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190112291758000105650011000000481100000486|2|2|1|9FF0B20C84FA277F9C56B169651020B15E14D912', '2019-01-15 01:26:07'),
(11, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/NFe43190112291758000105650011000000501100000506-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190112291758000105650011000000501100000506|2|2|1|753A4A8BF5032A4263AD5DFA9596A50DA67D52FE', '2019-01-15 11:37:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `ncm` int(11) DEFAULT NULL,
  `preco_custo` varchar(250) DEFAULT NULL,
  `CFOP` int(11) DEFAULT NULL,
  `cEAN` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `descricao`, `ncm`, `preco_custo`, `CFOP`, `cEAN`) VALUES
(111111112, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '185.37', 5103, 12345670),
(111111113, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '184.38', 5103, 76543210),
(111111114, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '10.78', 5103, 14785238),
(111111115, 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', 84714900, '96.28', 5103, 65425411),
(111111118, 'Abacaxi', 84714900, '185.37', 5103, 98321469),
(111111119, 'Tomate', 84714900, '185.37', 5103, 98311460),
(111111120, 'Feijao', 84714900, '185.37', 5103, 93311465),
(111111121, 'LasanhaCaseira', 84714900, '185.37', 5103, 98311484);

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
-- Indexes for table `emissor`
--
ALTER TABLE `emissor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nfcancelada`
--
ALTER TABLE `nfcancelada`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `emissor`
--
ALTER TABLE `emissor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nfcancelada`
--
ALTER TABLE `nfcancelada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111111122;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
