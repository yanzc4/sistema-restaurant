-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-08-2023 a las 07:08:57
-- Versión del servidor: 5.5.62-log
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boomerang`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `_addentrada` (`product` INT, `fecha` DATE, `cant` INT, `pre` DECIMAL(10,2), `codu` CHAR(4))  insert into entrada(id_producto,ent_fecha,ent_cantidad,precio,id_usuario)
values(product,fecha,cant,pre,codu)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_addsalida` (`product` INT, `fecha` DATE, `cant` INT, `codu` CHAR(4))  BEGIN
if (select stock from productos where id_producto=product)>=cant then
insert into salida(id_producto,sal_fecha,sal_cantidad,id_usuario,precio)
values(product,fecha,cant,codu,(select precio from entrada where id_producto=product order by ent_fecha desc, precio desc limit 1));
else
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Excede la cantidad del stock', MYSQL_ERRNO = 3002;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_agregarcategoria` (`nombre` VARCHAR(100))  insert into categoria_p(nombre) values(nombre)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_agregarnoticia` (`titulo` VARCHAR(100), `imagen` VARCHAR(300), `cuerpo` VARCHAR(550))  insert into noticias(titulo,fecha,imagen,cuerpo) values(titulo,curdate(),imagen,cuerpo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_agregarnuevoproducto` (`nom` VARCHAR(100), `cant` INT)  begin
if length(nom)>0 then
insert into productos(nombre, stock) values (nom, cant);
else
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'campo vacio', MYSQL_ERRNO = 3002;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_agregarplato` (`nombre` VARCHAR(100), `id_cate` INT, `precio` DECIMAL(10,2))  insert into platos(nombre,id_categoria,precio) values (nombre, id_cate, precio)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_agregarusuario` (`xcod` CHAR(4), `nombre` VARCHAR(30), `apellido` VARCHAR(30), `celular` VARCHAR(9), `users` VARCHAR(25), `pass` VARCHAR(25), `nivel` VARCHAR(20), `nacimiento` DATE)  insert into usuarios(cod_user,nombre,apellido,celular,users,passwords,nivel,f_nacimiento)
values(xcod, nombre, apellido, celular, users, pass, nivel, nacimiento)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_cambiaestadolista` (`cod` INT)  update listapedido set estado=0 where id=cod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_cambiarfondo` (`cod` INT)  begin
if (select color from listapedido where id=cod)=0 then
update listapedido set color=1 where id=cod;
elseif (select color from listapedido where id=cod)=1 then
update listapedido set color=0 where id=cod;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_creardetalleventa` (`vcod` INT, `pcod` INT, `cantidad` INT, `pprecio` DECIMAL(10,2), `descuento` DECIMAL(10,2))  insert into venta_detalle(id_venta,id_plato,cantidad,precio,descuento) values (vcod, pcod, cantidad, pprecio, descuento)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_crearventas` (`ecod` CHAR(4), `vfecha` DATE, `vcliente` VARCHAR(50))  begin
if length(vcliente)>0 then
insert into ventas(cod_user,fecha,cliente) values (ecod,vfecha,vcliente);
else
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'campo vacio', MYSQL_ERRNO = 3002;
end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_eliminarcategoria` (`cod` INT)  delete from categoria_p where id_categoria = cod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_eliminardetalleventa` (`vcod` INT, `pcod` INT)  delete from venta_detalle where id_venta = vcod and id_plato=pcod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_eliminarplato` (`cod` INT)  delete from platos where id = cod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_eliminarusuario` (`cod` CHAR(4))  delete from usuarios where cod_user = cod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_eliminarventa` (`vcod` INT)  delete from ventas where id_ventas = vcod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_infoventas` ()  select sum(vd.precio*vd.cantidad)-sum(vd.descuento) total, count(v.id_ventas) ventas,
sum(vd.descuento) descuento
from ventas v join venta_detalle vd on v.id_ventas=vd.id_venta
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_listaplatospedidos` (`buscador` VARCHAR(100))  select l.id, v.cliente, p.nombre, l.cantidad, l.estado, l.color
from listapedido l join ventas v on l.id_venta=v.id_ventas
join platos p on  l.id_plato = p.id where l.estado=1
and p.nombre LIKE LOWER(buscador)
order by l.id_venta asc, l.id desc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_listardetalleventa` (`vcod` INT)  select p.id Cod, p.nombre Menu, sum(vd.cantidad) Cantidad, vd.precio Precio, sum(vd.descuento) dsc
from venta_detalle vd join platos p on vd.id_plato=p.id
where vd.id_venta=vcod group by p.id, p.nombre, vd.precio$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_listarinventario` (`_bus` VARCHAR(50))  select * from productos where nombre LIKE LOWER(_bus) order by id_producto desc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_listarplatos` (`_bus` VARCHAR(100))  select p.id cod, p.nombre plato, p.id_categoria idcate, c.nombre categoria, p.precio precio from platos p join categoria_p c 
on p.id_categoria=c.id_categoria
where p.nombre LIKE LOWER(_bus) order by p.id desc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_modificarcategoria` (`ccod` INT, `nombre` VARCHAR(100))  update categoria_p
set nombre=nombre where id_categoria = ccod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_modificarplato` (`codp` INT, `nombre` VARCHAR(100), `cate` INT, `precio` DECIMAL(10,2))  update platos set nombre=nombre, id_categoria=cate, precio=precio where id=codp$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_modificarusuario` (`xcod` CHAR(4), `nombre` VARCHAR(30), `apellido` VARCHAR(30), `celular` VARCHAR(9), `users` VARCHAR(25), `pass` VARCHAR(25), `nivel` VARCHAR(20), `fecha` DATE)  update usuarios
set nombre=nombre, apellido=apellido, celular=celular, users=users, passwords=pass, nivel=nivel, f_nacimiento=fecha
where cod_user = xcod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_modificarventa` (`vcod` INT, `ecod` CHAR(4), `vfecha` DATE, `vcliente` VARCHAR(50))  update ventas set cod_user = ecod, fecha =vfecha, cliente = vcliente where id_ventas = vcod$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_nombrevendedor` (`vid` INT)  select concat(u.nombre,' ',u.apellido) vendedor, v.cliente from ventas v join usuarios u on v.cod_user=u.cod_user
where v.id_ventas=vid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_reporteplatos` (`fecha1` DATE, `fecha2` DATE)  select p.nombre, sum(vd.cantidad) vendidos, sum(vd.descuento) dsc, sum(vd.cantidad*vd.precio) subtotal,
sum((vd.cantidad*vd.precio)-vd.descuento) total from venta_detalle vd join platos p on vd.id_plato=p.id
join ventas v on vd.id_venta=v.id_ventas where v.fecha between fecha1 and fecha2
group by vd.id_plato$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_reporteventas` (`fecha1` DATE, `fecha2` DATE)  select u.nombre, v.cliente, sum(vd.cantidad*vd.precio) subtotal, sum(vd.descuento) descuento,
(sum(vd.cantidad*vd.precio))-(sum(vd.descuento)) total, v.fecha from venta_detalle vd
join ventas v on vd.id_venta=v.id_ventas join usuarios u on v.cod_user=u.cod_user
where v.fecha between fecha1 and fecha2
group by vd.id_venta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_topbebidas` ()  select p.nombre, sum(vd.cantidad) from venta_detalle vd join platos p on vd.id_plato=p.id
join ventas v on vd.id_venta=v.id_ventas
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate())
group by p.nombre order by sum(vd.cantidad) desc limit 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_topcategorias` ()  select cp.nombre, sum(vd.cantidad) from venta_detalle vd join platos p on vd.id_plato=p.id
join categoria_p cp on p.id_categoria=cp.id_categoria
join ventas v on vd.id_venta=v.id_ventas
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate())
group by cp.nombre order by sum(vd.cantidad) desc limit 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_totalventa` (`vcod` INT)  select sum(vd.descuento) dsc, sum((vd.cantidad*vd.precio)-vd.descuento) total, v.fecha
from venta_detalle vd
join ventas v on vd.id_venta=v.id_ventas
where id_venta=vcod group by vd.id_venta, v.fecha$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_ventasempleado` ()  select u.nombre, sum(vd.precio*vd.cantidad)-sum(vd.descuento) ventas from usuarios u join ventas v on u.cod_user=v.cod_user
join venta_detalle vd on v.id_ventas=vd.id_venta
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate())
group by u.nombre order by count(v.id_ventas) desc limit 4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_ventasmes` ()  select month(v.fecha) mes, sum(vd.precio*vd.cantidad)-sum(vd.descuento) total
from venta_detalle vd join ventas v on vd.id_venta=v.id_ventas
where year(v.fecha)=year(curdate())
group by month(v.fecha) order by month(v.fecha) asc limit 6$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `_wlistarplatos` (`_bus` VARCHAR(50))  select p.id as CODIGO, p.nombre as MENU, p.precio as PRECIO from platos p where p.nombre LIKE LOWER(_bus) order by p.id desc limit 3$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_p`
--

CREATE TABLE `categoria_p` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_p`
--

INSERT INTO `categoria_p` (`id_categoria`, `nombre`) VALUES
(1, 'Jugos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id_entrada` int(5) NOT NULL,
  `factura` varchar(30) DEFAULT NULL,
  `id_producto` int(11) NOT NULL,
  `ent_fecha` date DEFAULT NULL,
  `ent_cantidad` int(4) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_usuario` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrada`
--

INSERT INTO `entrada` (`id_entrada`, `factura`, `id_producto`, `ent_fecha`, `ent_cantidad`, `precio`, `id_usuario`) VALUES
(1, NULL, 1, '2023-03-23', 2, '5.00', 'A001'),
(2, NULL, 2, '2023-04-06', 4, '3.80', 'A001'),
(3, NULL, 1, '2023-04-06', 3, '5.00', 'A001');

--
-- Disparadores `entrada`
--
DELIMITER $$
CREATE TRIGGER `_productosaumento` AFTER INSERT ON `entrada` FOR EACH ROW UPDATE productos
SET stock = stock+NEW.ent_cantidad
where id_producto = NEW.id_producto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listapedido`
--

CREATE TABLE `listapedido` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_plato` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` int(1) NOT NULL,
  `color` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `listapedido`
--

INSERT INTO `listapedido` (`id`, `id_venta`, `id_plato`, `cantidad`, `estado`, `color`) VALUES
(1, 1, 1, 1, 0, 0),
(3, 2, 1, 1, 0, 0),
(4, 3, 1, 1, 0, 1),
(5, 4, 1, 1, 0, 1),
(6, 5, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `imagen` varchar(300) DEFAULT NULL,
  `cuerpo` varchar(550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `nombre`, `id_categoria`, `precio`) VALUES
(1, 'Papaya', 1, '7.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(5) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `stock`) VALUES
(1, 'Papaya', 1),
(2, 'Azucar', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `id_salida` int(5) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `sal_fecha` date DEFAULT NULL,
  `sal_cantidad` int(4) NOT NULL,
  `id_usuario` char(4) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `salida`
--

INSERT INTO `salida` (`id_salida`, `id_producto`, `sal_fecha`, `sal_cantidad`, `id_usuario`, `precio`) VALUES
(1, 1, '2023-04-06', 2, 'A001', '5.00'),
(2, 1, '2023-04-06', 2, 'A001', '5.00');

--
-- Disparadores `salida`
--
DELIMITER $$
CREATE TRIGGER `_productoresta` AFTER INSERT ON `salida` FOR EACH ROW UPDATE productos
SET stock = stock-NEW.sal_cantidad
where id_producto = NEW.id_producto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_user` char(4) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `celular` varchar(9) NOT NULL,
  `users` varchar(25) NOT NULL,
  `passwords` varchar(25) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `f_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_user`, `nombre`, `apellido`, `celular`, `users`, `passwords`, `nivel`, `f_nacimiento`) VALUES
('A001', 'Admin', 'Admin', '999765768', 'admin', 'admin', 'Administrador', '2000-10-30'),
('E001', 'Yan', 'Zapata', '910500683', 'yan', '1234', 'Empleado', '2000-10-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `cod_user` char(4) NOT NULL,
  `fecha` date DEFAULT NULL,
  `cliente` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `cod_user`, `fecha`, `cliente`) VALUES
(1, 'A001', '2023-03-23', 'Mariana'),
(2, 'E001', '2023-03-23', 'Lucia'),
(3, 'A001', '2023-03-23', 'Juan'),
(4, 'A001', '2023-03-26', 'Ana'),
(5, 'A001', '2023-04-06', 'Julia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id_venta` int(11) NOT NULL,
  `id_plato` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`id_venta`, `id_plato`, `cantidad`, `precio`, `descuento`) VALUES
(1, 1, 1, '7.00', '0.00'),
(2, 1, 1, '7.00', '0.00'),
(3, 1, 1, '7.00', '0.00'),
(4, 1, 1, '7.00', '0.00'),
(5, 1, 1, '7.00', '0.00');

--
-- Disparadores `venta_detalle`
--
DELIMITER $$
CREATE TRIGGER `_eliminarlista` AFTER DELETE ON `venta_detalle` FOR EACH ROW delete from listapedido where id_venta= old.id_venta and id_plato=old.id_plato
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `_listarpedidos` AFTER INSERT ON `venta_detalle` FOR EACH ROW insert into listapedido(id_venta, id_plato, cantidad, estado, color)
values(
new.id_venta,new.id_plato,new.cantidad,1,0
)
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_p`
--
ALTER TABLE `categoria_p`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `listapedido`
--
ALTER TABLE `listapedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_plato` (`id_plato`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_user`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `cod_user` (`cod_user`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_plato` (`id_plato`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_p`
--
ALTER TABLE `categoria_p`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id_entrada` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `listapedido`
--
ALTER TABLE `listapedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `id_salida` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`cod_user`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `listapedido`
--
ALTER TABLE `listapedido`
  ADD CONSTRAINT `listapedido_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_ventas`),
  ADD CONSTRAINT `listapedido_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `platos` (`id`);

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_p` (`id_categoria`);

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`cod_user`),
  ADD CONSTRAINT `salida_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cod_user`) REFERENCES `usuarios` (`cod_user`);

--
-- Filtros para la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `venta_detalle_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_ventas`),
  ADD CONSTRAINT `venta_detalle_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `platos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
