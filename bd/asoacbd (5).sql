-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-11-2018 a las 11:16:22
-- Versión del servidor: 10.3.10-MariaDB-1:10.3.10+maria~stretch
-- Versión de PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asoacbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nombre`) VALUES
(2, 'Cat 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_pago`
--

CREATE TABLE `comprobante_pago` (
  `idComprobantePago` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` double DEFAULT NULL,
  `tipoPago` int(11) DEFAULT NULL,
  `num_comprobante` varchar(100) DEFAULT NULL,
  `entrega_productos_identrega_detalle` int(11) DEFAULT NULL,
  `socias_idsocias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_entrega`
--

CREATE TABLE `detalle_entrega` (
  `iddetalle_compra` int(11) NOT NULL,
  `cantidad_producto` int(11) DEFAULT NULL,
  `total_detalle` double DEFAULT NULL,
  `producto_idProducto` int(11) DEFAULT NULL,
  `entrega_productos_identrega_detalle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega_productos`
--

CREATE TABLE `entrega_productos` (
  `identrega_detalle` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `no_comprobante` varchar(200) NOT NULL,
  `total_comprobante` double DEFAULT NULL,
  `saldo_socias` double NOT NULL,
  `estado_entrega` int(11) NOT NULL,
  `Usuarios_idUsuarios` int(11) DEFAULT NULL,
  `socias_idsocias` int(11) DEFAULT NULL,
  `direccionenvio` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `pro_nombre` varchar(45) DEFAULT NULL,
  `pro_stock` int(11) DEFAULT NULL,
  `pro_stock_minimo` int(11) DEFAULT NULL,
  `pro_preciocompra` double DEFAULT NULL,
  `pro_precioventa` double DEFAULT NULL,
  `img` varchar(200) NOT NULL,
  `Categoria_idCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `pro_nombre`, `pro_stock`, `pro_stock_minimo`, `pro_preciocompra`, `pro_precioventa`, `img`, `Categoria_idCategoria`) VALUES
(3565, 'Producto 1', 0, 88, 78, 98, 'https://www.grandespymes.com.ar/wp-content/uploads/2015/10/producto.jpg', 2),
(3566, 'Producto 2', 0, 10, 20, 30, 'https://www.grandespymes.com.ar/wp-content/uploads/2015/10/producto.jpg', 2),
(3567, 'Producto 3', 0, 10, 20, 30, 'https://www.grandespymes.com.ar/wp-content/uploads/2015/10/producto.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socias`
--

CREATE TABLE `socias` (
  `idsocias` int(11) NOT NULL,
  `soc_datos` varchar(45) DEFAULT NULL,
  `soc_direccion` varchar(45) DEFAULT NULL,
  `soc_telefono` varchar(45) DEFAULT NULL,
  `saldo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuarios` int(11) NOT NULL,
  `us_nombre` varchar(45) DEFAULT NULL,
  `us_direccion` varchar(45) DEFAULT NULL,
  `us_telefono` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuarios`, `us_nombre`, `us_direccion`, `us_telefono`, `username`, `password`, `estado`, `rol`) VALUES
(5, 'recepcion', 'ciuad', '98798', 'recepcion', '$2a$04$IyOPXdiz0LV2ekoBpeyFpOyhK3Z56jSXLkk2SNqneo/OVlXdg.HPK', 1, 'Recepcion'),
(6, 'cliente', 'ciudad', '98798', 'cliente', '$2a$04$kRgoU2p6CZaQ7Z4J6EBIUu3TABvECmK2ZC3WeQkLlEo8CeZZEK4fi', 1, 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `comprobante_pago`
--
ALTER TABLE `comprobante_pago`
  ADD PRIMARY KEY (`idComprobantePago`),
  ADD KEY `fk_comprobante_pago_entrega_productos1_idx` (`entrega_productos_identrega_detalle`),
  ADD KEY `fk_comprobante_pago_socias1_idx` (`socias_idsocias`);

--
-- Indices de la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD PRIMARY KEY (`iddetalle_compra`),
  ADD KEY `fk_detalle_compra_productos1_idx` (`producto_idProducto`),
  ADD KEY `fk_detalle_entrega_entrega_productos1_idx` (`entrega_productos_identrega_detalle`);

--
-- Indices de la tabla `entrega_productos`
--
ALTER TABLE `entrega_productos`
  ADD PRIMARY KEY (`identrega_detalle`),
  ADD KEY `fk_CompraFactura_Usuarios1_idx` (`Usuarios_idUsuarios`),
  ADD KEY `fk_entrega_productos_socias1_idx` (`socias_idsocias`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_productos_Categoria1_idx` (`Categoria_idCategoria`);

--
-- Indices de la tabla `socias`
--
ALTER TABLE `socias`
  ADD PRIMARY KEY (`idsocias`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comprobante_pago`
--
ALTER TABLE `comprobante_pago`
  MODIFY `idComprobantePago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  MODIFY `iddetalle_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `entrega_productos`
--
ALTER TABLE `entrega_productos`
  MODIFY `identrega_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3568;
--
-- AUTO_INCREMENT de la tabla `socias`
--
ALTER TABLE `socias`
  MODIFY `idsocias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprobante_pago`
--
ALTER TABLE `comprobante_pago`
  ADD CONSTRAINT `fk_comprobante_pago_entrega_productos1` FOREIGN KEY (`entrega_productos_identrega_detalle`) REFERENCES `entrega_productos` (`identrega_detalle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comprobante_pago_socias1` FOREIGN KEY (`socias_idsocias`) REFERENCES `socias` (`idsocias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_entrega`
--
ALTER TABLE `detalle_entrega`
  ADD CONSTRAINT `fk_detalle_compra_productos1` FOREIGN KEY (`producto_idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_entrega_entrega_productos1` FOREIGN KEY (`entrega_productos_identrega_detalle`) REFERENCES `entrega_productos` (`identrega_detalle`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entrega_productos`
--
ALTER TABLE `entrega_productos`
  ADD CONSTRAINT `fk_CompraFactura_Usuarios1` FOREIGN KEY (`Usuarios_idUsuarios`) REFERENCES `usuario` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entrega_productos_socias1` FOREIGN KEY (`socias_idsocias`) REFERENCES `socias` (`idsocias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_Categoria1` FOREIGN KEY (`Categoria_idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
