-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Fev-2019 às 14:45
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
  `bairro` varchar(250) DEFAULT NULL,
  `CEP` varchar(250) DEFAULT NULL,
  `fone` varchar(250) DEFAULT NULL,
  `municipio` varchar(250) NOT NULL,
  `UF` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `CNPJ`, `endereco`, `numero`, `bairro`, `CEP`, `fone`, `municipio`, `UF`) VALUES
(20, 'Augusto Pedro', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Guaiba', 'Rio Grande do Sul'),
(21, 'Pedro Carvalho', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Esteio', 'Rio Grande do Sul'),
(22, 'Carlos Henrique', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Canoas', 'Rio Grande do Sul'),
(23, 'Pedro Marinho', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Sao Leopoldo', 'Rio Grande do Sul'),
(24, 'Jesus Paulo', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Esteio', 'Rio Grande do Sul'),
(25, 'Geison Carlos', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Monte Negro', 'Rio Grande do Sul'),
(26, 'Benedito', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Lajeado', 'Rio Grande do Sul'),
(27, 'Pedro', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Caxias do Sul', 'Rio Grande do Sul'),
(31, 'Paulo Cardoso', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '5134448522', 'Caxias do Sul', 'Rio Grande do Sul'),
(32, 'Fernando Carlos', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Eldorado do Sul', 'Rio Grande do Sul'),
(33, 'Sergio Augusto', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(34, 'Pedro de Lara', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(35, 'Pedro Henrique', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(36, 'Pedro Henrique', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(37, 'Henrique Castro', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(38, 'Benito de Paula', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(39, 'Edgard', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '4732587410', 'Balneario Camboriu', 'Santa Catarina'),
(40, 'Vinicius Abreu', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '4748484125', 'Itajai', 'Santa Catarina'),
(41, 'Geison Carlos', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '4736985214', 'Penha', 'Santa Catarina'),
(42, 'Benedito', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '4138456123', 'Foz do Iguacu', 'Parana'),
(43, 'Pedro', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '4739874510', 'Florianopolis', 'Santa Catarina'),
(44, 'Pedro Neto', '0195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '4732587410', 'Florianopolis ', 'Santa Catarina'),
(45, 'Geiso', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(46, 'Renato Alberto', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(47, 'Paulo Carlos', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(48, 'Hamilton da Silva', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(49, 'Amanda Cardoso', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(50, 'Carla Antunes', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(51, 'Betina Ferreira', '30195969000126', 'RUA DO CLIENTE', '122', 'BAIRRO DO CLIENTE', '92500000', '51999688986', 'Porto Alegre', 'Rio Grande do Sul'),
(112, 'Betina Augusta', '23078134032', 'Rua Santa Catarina 271', '177', 'Centro', '92500972', '5136987451', 'GuaÃ­ba', 'RS');

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
(2, '12291758000105', 'Razao Social', 'Rua Lucas Quadros', 'Nome Fantasia', '885', 'Colina', '4314902', 'GuaÃ­ba', 'RS', '92700130', '1058', 'Brasil', '5138962118', '0963376802', '14018', '1', '6202300');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ide`
--

CREATE TABLE `ide` (
  `cUF` varchar(250) DEFAULT NULL,
  `natOp` varchar(250) DEFAULT NULL,
  `modelo` varchar(250) DEFAULT NULL,
  `serie` varchar(250) DEFAULT NULL,
  `tpNF` varchar(250) DEFAULT NULL,
  `idDest` varchar(250) DEFAULT NULL,
  `cMunFG` varchar(250) DEFAULT NULL,
  `tpImp` varchar(250) DEFAULT NULL,
  `tpEmis` varchar(250) DEFAULT NULL,
  `tpAmb` varchar(250) DEFAULT NULL,
  `finNFe` varchar(250) DEFAULT NULL,
  `indFinal` varchar(250) DEFAULT NULL,
  `indPres` varchar(250) DEFAULT NULL,
  `procEmi` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ide`
--

INSERT INTO `ide` (`cUF`, `natOp`, `modelo`, `serie`, `tpNF`, `idDest`, `cMunFG`, `tpImp`, `tpEmis`, `tpAmb`, `finNFe`, `indFinal`, `indPres`, `procEmi`) VALUES
('43', 'Venda de mercadorias', '65', '001', '1', '1', '4314902', '5', '1', '2', '1', '1', '1', '0');

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
(1, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/43191229175800010565001100000045100000045-procInutNFe.xml', '100000045', '100000045', '2019-01-15 01:05:38'),
(2, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/43191229175800010565001100000047100000047-procInutNFe.xml', '100000047', '100000047', '2019-01-15 01:21:51'),
(3, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/43191229175800010565001100000049100000049-procInutNFe.xml', '100000049', '100000049', '2019-01-15 01:27:29'),
(4, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000205106000205-procInutNFe.xml', '106000205', '106000205', '2019-02-07 05:49:14'),
(5, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000206106000206-procInutNFe.xml', '106000206', '106000206', '2019-02-07 05:55:04'),
(6, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000208106000208-procInutNFe.xml', '106000208', '106000208', '2019-02-07 06:10:34'),
(7, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000219106000219-procInutNFe.xml', '106000219', '106000219', '2019-02-07 18:49:40'),
(8, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000428106000428-procInutNFe.xml', '106000428', '106000428', '2019-02-12 00:53:04'),
(9, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000437106000437-procInutNFe.xml', '106000437', '106000437', '2019-02-12 04:31:24'),
(10, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000438106000438-procInutNFe.xml', '106000438', '106000438', '2019-02-12 04:32:06'),
(11, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000439106000439-procInutNFe.xml', '106000439', '106000439', '2019-02-12 04:32:24'),
(12, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000448106000448-procInutNFe.xml', '106000448', '106000448', '2019-02-12 13:27:39'),
(13, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/43191229175800010565001106000449106000449-procInutNFe.xml', '106000449', '106000449', '2019-02-12 13:29:30');

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
(939, 'NFe43190212291758000105650011060004401106004406', '10600440', '106000440', '2019-02-12T11:09:37-02:00', '143190001974237'),
(940, 'NFe43190212291758000105650011060004411106004411', '10600441', '106000441', '2019-02-12T11:11:42-02:00', '143190001974371'),
(941, 'NFe43190212291758000105650011060004421106004427', '10600442', '106000442', '2019-02-12T11:15:37-02:00', '143190001974594');

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
(11, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201901/NFe43190112291758000105650011000000501100000506-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190112291758000105650011000000501100000506|2|2|1|753A4A8BF5032A4263AD5DFA9596A50DA67D52FE', '2019-01-15 11:37:07'),
(12, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060002011106002013-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060002011106002013|2|2|1|A54AF0BD9FEAAA6CFD71BB117DA4592FCC1E3138', '2019-02-07 03:17:26'),
(13, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060002091106002046-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060002091106002046|2|2|1|E4A2CAC3C775E9A747E093F010EA996E13B7F4A0', '2019-02-07 06:24:06'),
(14, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060002101106002055-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060002101106002055|2|2|1|3A0E15E05568BA071ADE77F201FA7A4723735956', '2019-02-07 06:33:09'),
(15, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060002111106002060-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060002111106002060|2|2|1|90D0C70E86434B4B07DC279310204EF80EB27F7E', '2019-02-07 06:35:06'),
(16, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060004291106004298-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004291106004298|2|2|1|BEAC09E1F7AE5C562A029928F0DECAF61F9B5D3A', '2019-02-12 01:17:20'),
(17, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060004301106004302-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004301106004302|2|2|1|C38C0B7E3A2AD332D39BB49BCF535EE0C35FFA78', '2019-02-12 01:19:48'),
(18, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060004341106004344-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004341106004344|2|2|1|E5F98BBFDA8CE522263024E8F13B106832BF6CFF', '2019-02-12 04:21:17'),
(19, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060004351106004350-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004351106004350|2|2|1|47C52D44B6AC0A63E6689A8F4F7783D7E5FEF5D9', '2019-02-12 04:26:24'),
(20, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060004411106004411-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004411106004411|2|2|1|E4CE4427C98071C53B2B44BFCDCECD513B7D3085', '2019-02-12 13:15:05'),
(21, 'file:///C:/Unimake/UniNFe/12291758000105/nfce/Enviado/Autorizados/201902/NFe43190212291758000105650011060004421106004427-procNFe.xml', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004421106004427|2|2|1|903228080F6F323A2AC38BBBF5CB8346DE7B2C9C', '2019-02-12 13:16:51');

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
(111111121, 'LasanhaCaseira', 84714900, '185.37', 5103, 98311484),
(111111123, 'Computador', 84714900, '2000', 5103, 78451203),
(111111124, 'Computador', 84714900, '2000.99', 5103, 87965412);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `email`, `senha`, `data`, `status`) VALUES
(1, 'bruno', 'bruno.cardosof@gmail.com', 'bruno', '2019-02-04 19:05:59', 'admin'),
(2, 'Ze Alberto', 'zealberto@hotmail.com', 'zezinho', '2019-02-06 21:10:27', 'usuario'),
(11, 'admin', 'admin@admin.com', 'admin', '2019-02-09 05:00:47', 'Admin'),
(12, 'usuario', 'usuario@usuario.com', 'usuario', '2019-02-09 05:01:01', 'Usuario'),
(13, 'Pedro Henrique', 'pedrohenrique1991@hotmail.com', 'mae123', '2019-02-09 05:11:10', 'Admin'),
(14, '', '', '', '2019-02-11 04:01:29', '...'),
(15, '', '', '', '2019-02-11 04:05:51', '...');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `vendedor` varchar(250) DEFAULT NULL,
  `produtos` varchar(250) NOT NULL,
  `quantidades` varchar(250) NOT NULL,
  `valorTotal` varchar(250) DEFAULT NULL,
  `formaPagamento` varchar(250) DEFAULT NULL,
  `NFCe` varchar(250) NOT NULL,
  `dataVenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `vendedor`, `produtos`, `quantidades`, `valorTotal`, `formaPagamento`, `NFCe`, `dataVenda`) VALUES
(60, 'bruno', 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', '10', '1853.7', 'dinheiro,cheque', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004401106004406|2|2|1|C0E7964E720FE4A36BC345BA314C4C933E165AD2', '2019-02-12 13:09:37'),
(61, 'bruno', 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', '10', '1853.7', 'dinheiro,cheque', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004411106004411|2|2|1|E4CE4427C98071C53B2B44BFCDCECD513B7D3085', '2019-02-12 13:11:42'),
(62, 'bruno', 'NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL', '10', '1853.7', 'dinheiro,cheque', 'https://www.sefaz.rs.gov.br/NFCE/NFCE-COM.aspx?p=43190212291758000105650011060004421106004427|2|2|1|903228080F6F323A2AC38BBBF5CB8346DE7B2C9C', '2019-02-12 13:15:37');

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
-- Indexes for table `inutilizado`
--
ALTER TABLE `inutilizado`
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
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `emissor`
--
ALTER TABLE `emissor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inutilizado`
--
ALTER TABLE `inutilizado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nfcancelada`
--
ALTER TABLE `nfcancelada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111111125;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
