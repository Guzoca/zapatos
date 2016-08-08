-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 07, 2016 at 10:27 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zapatos`
--
CREATE DATABASE IF NOT EXISTS `zapatos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `zapatos`;

-- --------------------------------------------------------

--
-- Table structure for table `tblcarrito`
--

DROP TABLE IF EXISTS `tblcarrito`;
CREATE TABLE `tblcarrito` (
  `intContador` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `intCantidad` int(11) NOT NULL,
  `intTransaccionEfectuada` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcarrito`
--

INSERT INTO `tblcarrito` (`intContador`, `idUsuario`, `idProducto`, `intCantidad`, `intTransaccionEfectuada`) VALUES
(1, 2, 2, 1, 0),
(2, 2, 2, 1, 0),
(3, 2, 3, 1, 0),
(4, 3, 2, 1, 0),
(5, 3, 1, 1, 0),
(6, 15, 1, 1, 0),
(7, 15, 2, 1, 0),
(8, 2, 1, 1, 0),
(9, 2, 2, 1, 0),
(10, 17, 1, 1, 0),
(11, 17, 3, 1, 0),
(12, 17, 2, 1, 0),
(13, 2, 2, 1, 0),
(14, 2, 2, 1, 0),
(15, 2, 3, 1, 0),
(16, 2, 2, 1, 0),
(17, 2, 2, 1, 0),
(18, 2, 3, 1, 0),
(19, 2, 3, 1, 0),
(20, 2, 3, 1, 0),
(21, 2, 3, 1, 0),
(22, 21, 1, 1, 0),
(23, 2, 1, 1, 0),
(24, 2, 1, 1, 0),
(25, 2, 1, 1, 0),
(26, 22, 1, 1, 0),
(27, 22, 3, 1, 0),
(28, 23, 1, 1, 0),
(29, 23, 2, 1, 0),
(30, 39, 2, 1, 0),
(31, 41, 2, 1, 0),
(32, 41, 5, 1, 0),
(33, 41, 1, 1, 0),
(34, 42, 3, 1, 0),
(35, 42, 2, 1, 0),
(36, 42, 5, 1, 0),
(37, 42, 3, 1, 0),
(38, 42, 1, 1, 0),
(39, 44, 14, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategoria`
--

DROP TABLE IF EXISTS `tblcategoria`;
CREATE TABLE `tblcategoria` (
  `idCategoria` int(11) NOT NULL,
  `strDescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategoria`
--

INSERT INTO `tblcategoria` (`idCategoria`, `strDescripcion`) VALUES
(1, 'Apps Health'),
(2, 'Apps Games'),
(3, 'Apps home');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompra`
--

DROP TABLE IF EXISTS `tblcompra`;
CREATE TABLE `tblcompra` (
  `idCompra` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fchCompra` datetime NOT NULL,
  `intTipoPago` int(11) NOT NULL,
  `dblTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblproducto`
--

DROP TABLE IF EXISTS `tblproducto`;
CREATE TABLE `tblproducto` (
  `idProducto` int(11) NOT NULL,
  `strNombre` varchar(100) NOT NULL,
  `strSEO` varchar(100) NOT NULL,
  `dblPrecio` decimal(2,0) NOT NULL,
  `intEstado` int(11) NOT NULL,
  `intCategoria` int(11) NOT NULL,
  `strImagen` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproducto`
--

INSERT INTO `tblproducto` (`idProducto`, `strNombre`, `strSEO`, `dblPrecio`, `intEstado`, `intCategoria`, `strImagen`) VALUES
(2, 'App GUSTAVO', 'application', '40', 1, 2, 'whatsapp-logo_318-49685.jpg'),
(14, 'APP for Healht', 're', '67', 1, 1, 'starapp.png'),
(17, 'ROLO', 'r', '45', 1, 1, 'elefanteapp.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblusuario`
--

DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE `tblusuario` (
  `IdUsuario` int(11) NOT NULL,
  `strNombre` varchar(50) NOT NULL,
  `strApellido` varchar(100) NOT NULL,
  `strEmail` varchar(100) NOT NULL,
  `intActivo` int(11) NOT NULL,
  `strPassword` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusuario`
--

INSERT INTO `tblusuario` (`IdUsuario`, `strNombre`, `strApellido`, `strEmail`, `intActivo`, `strPassword`) VALUES
(27, 'BRUNO', 'CONT', 'royal@gmail.com', 1, '12345GUS'),
(33, 'tito', 'puente', 'timbal@hgmail.com', 1, '1234567BG'),
(34, 'TEST2', 'TES', 'TES@hmail.com', 1, '1234567QW'),
(35, 'TEST3', 'TES', 'tes@gmail.com', 1, '1234567ASR'),
(37, 'we', 'wrt', 'er@gmail.com', 1, '1234567QWE'),
(38, 'Gus', 'Cas', 'gus@gmail.com', 1, '1234567GUS'),
(42, 'pepe', 'pio', 'pepe@gmail.com', 1, '123456PEPE'),
(45, 'GUSTAVO2', 'CASTRO', 'guzoca@gmail.com', 1, '1234567A');

-- --------------------------------------------------------

--
-- Table structure for table `tblvariables`
--

DROP TABLE IF EXISTS `tblvariables`;
CREATE TABLE `tblvariables` (
  `idContador` int(11) NOT NULL,
  `intIVA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcarrito`
--
ALTER TABLE `tblcarrito`
  ADD PRIMARY KEY (`intContador`);

--
-- Indexes for table `tblcategoria`
--
ALTER TABLE `tblcategoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `tblcompra`
--
ALTER TABLE `tblcompra`
  ADD PRIMARY KEY (`idCompra`);

--
-- Indexes for table `tblproducto`
--
ALTER TABLE `tblproducto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indexes for table `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- Indexes for table `tblvariables`
--
ALTER TABLE `tblvariables`
  ADD PRIMARY KEY (`idContador`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcarrito`
--
ALTER TABLE `tblcarrito`
  MODIFY `intContador` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tblcategoria`
--
ALTER TABLE `tblcategoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcompra`
--
ALTER TABLE `tblcompra`
  MODIFY `idCompra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblproducto`
--
ALTER TABLE `tblproducto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tblvariables`
--
ALTER TABLE `tblvariables`
  MODIFY `idContador` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
