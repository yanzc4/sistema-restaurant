create database boomerang;
use boomerang;
-- crear la tabla usuarios 
create table usuarios
(cod_user char(4) primary key not null,
nombre varchar (30) not null,
apellido varchar (30) not null,
celular varchar (9) not null,
users varchar(25) not null,
passwords varchar(25) not null,
nivel varchar(20) not null,
f_nacimiento date
);

-- CREAR TABLA CATEGORIA PLATO
create table categoria_p
(id_categoria int primary key not null auto_increment,
nombre varchar (100) not null
);

-- CREAR TABLA PLATOS
create table platos
(id int primary key not null auto_increment,
nombre varchar (100) not null,
id_categoria int not null,
precio decimal (10,2) not null,
FOREIGN KEY (id_categoria) REFERENCES categoria_p(id_categoria)
);

-- crear tabla ventas
create table ventas
(id_ventas int primary key auto_increment,
cod_user char (4) not null,
fecha date,
cliente varchar(80),
FOREIGN KEY (cod_user) REFERENCES usuarios(cod_user)
);

-- crear tabla detalles
create table venta_detalle
(id_venta int not null,
id_plato int not null,
cantidad int not null,
precio decimal (10,2) not null,
descuento decimal (10,2) not null,
FOREIGN KEY (id_venta) REFERENCES ventas(id_ventas),
FOREIGN KEY (id_plato) REFERENCES platos(id)
);

-- crear tabla de noticias
CREATE table noticias(
    id INT PRIMARY KEY not null auto_increment,
    titulo VARCHAR (100),
    fecha date,
    imagen varchar (300),
    cuerpo varchar (550)
);

-- procedimientos almacenados
------------------------------------------------------------- 
-- listar platos
create procedure _wlistarplatos(_bus varchar (50))
select p.id as CODIGO, p.nombre as MENU, p.precio as PRECIO from platos p where p.nombre LIKE LOWER(_bus) order by p.id desc limit 3;
--------------------------------------------------------------
-- crear ventas drop procedure _crearventas select version()
DELIMITER $$
create procedure _crearventas
(ecod char (4),
vfecha date,
vcliente varchar (50)
)
begin
if length(vcliente)>0 then
insert into ventas(cod_user,fecha,cliente) values (ecod,vfecha,vcliente);
else
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'campo vacio', MYSQL_ERRNO = 3002;
end if;
end $$
DELIMITER ;
--------------------------------------------------------------
-- para eliminar venta
create procedure _eliminarventa(
vcod int
)
delete from ventas where id_ventas = vcod;
--------------------------------------------------------------
-- para editar venta
create procedure _modificarventa(
vcod int,
ecod char (4),
vfecha date,
vcliente varchar (50)
)
update ventas set cod_user = ecod, fecha =vfecha, cliente = vcliente where id_ventas = vcod;
---------------------------------------------------------------
-- para listar detalles de venta
CREATE procedure _listardetalleventa(
vcod int
)
select p.id Cod, p.nombre Menu, sum(vd.cantidad) Cantidad, vd.precio Precio, sum(vd.descuento) dsc
from venta_detalle vd join platos p on vd.id_plato=p.id
where vd.id_venta=vcod group by p.id, p.nombre, vd.precio;
---------------------------------------------------------------
-- para agregar detalle
create procedure _creardetalleventa(
vcod int,
pcod int,
cantidad int,
pprecio decimal (10,2),
descuento decimal (10,2)
)
insert into venta_detalle(id_venta,id_plato,cantidad,precio,descuento) values (vcod, pcod, cantidad, pprecio, descuento);
----------------------------------------------------------------
-- para calcular total a pagar
CREATE procedure _totalventa(
vcod int
)
select sum(vd.descuento) dsc, sum((vd.cantidad*vd.precio)-vd.descuento) total, v.fecha
from venta_detalle vd
join ventas v on vd.id_venta=v.id_ventas
where id_venta=vcod group by vd.id_venta, v.fecha;
---------------------------------------------------------------
-- eliminar detalle
create procedure _eliminardetalleventa(
vcod int,
pcod int
)
delete from venta_detalle where id_venta = vcod and id_plato=pcod;
---------------------------------------------------------------
-- para agregar noticia 
create Procedure _agregarnoticia(
titulo varchar(100),
imagen varchar(300),
cuerpo varchar(550)
)
insert into noticias(titulo,fecha,imagen,cuerpo) values(titulo,curdate(),imagen,cuerpo);
---------------------------------------------------------------
-- para grafico 
CREATE procedure _topbebidas()
select p.nombre, sum(vd.cantidad) from venta_detalle vd join platos p on vd.id_plato=p.id
join ventas v on vd.id_venta=v.id_ventas
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate())
group by p.nombre order by sum(vd.cantidad) desc limit 5;
----------------------------------------------------------------
CREATE procedure _topcategorias()
select cp.nombre, sum(vd.cantidad) from venta_detalle vd join platos p on vd.id_plato=p.id
join categoria_p cp on p.id_categoria=cp.id_categoria
join ventas v on vd.id_venta=v.id_ventas
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate())
group by cp.nombre order by sum(vd.cantidad) desc limit 5;
-----------------------------------------------------------------
CREATE procedure _ventasempleado()
select u.nombre, sum(vd.precio*vd.cantidad)-sum(vd.descuento) ventas from usuarios u join ventas v on u.cod_user=v.cod_user
join venta_detalle vd on v.id_ventas=vd.id_venta
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate())
group by u.nombre order by count(v.id_ventas) desc limit 4;
----------------------------------------------------------------
CREATE procedure _ventasmes()
select month(v.fecha) mes, sum(vd.precio*vd.cantidad)-sum(vd.descuento) total
from venta_detalle vd join ventas v on vd.id_venta=v.id_ventas
where year(v.fecha)=year(curdate())
group by month(v.fecha) order by month(v.fecha) asc limit 6;
----------------------------------------------------------------
-- para cards del dashboard
CREATE procedure _infoventas()
select sum(vd.precio*vd.cantidad)-sum(vd.descuento) total, count(v.id_ventas) ventas,
sum(vd.descuento) descuento
from ventas v join venta_detalle vd on v.id_ventas=vd.id_venta
where month(v.fecha)=month(curdate()) and year(v.fecha)=year(curdate());

----------------------------------------------------------------
-- para agregar usuarios
create procedure _agregarusuario(
xcod char(4),
nombre varchar (30),
apellido varchar (30),
celular varchar (9),
users varchar (25),
pass varchar (25),
nivel varchar (20),
nacimiento date
)
insert into usuarios(cod_user,nombre,apellido,celular,users,passwords,nivel,f_nacimiento)
values(xcod, nombre, apellido, celular, users, pass, nivel, nacimiento);
--------------------------------------------------------------------------
-- para editar usuario 
create procedure _modificarusuario(
xcod char(4),
nombre varchar (30),
apellido varchar (30),
celular varchar (9),
users varchar (25),
pass varchar (25),
nivel varchar (20),
fecha date
)
update usuarios
set nombre=nombre, apellido=apellido, celular=celular, users=users, passwords=pass, nivel=nivel, f_nacimiento=fecha
where cod_user = xcod;
---------------------------------------------------------------------------
-- para agregar platos
create procedure _agregarplato(
nombre varchar (100),
id_cate int,
precio decimal (10,2)
)
insert into platos(nombre,id_categoria,precio) values (nombre, id_cate, precio);
---------------------------------------------------------------------
-- para agregar categorias
CREATE procedure _agregarcategoria(
nombre varchar (100)
)
insert into categoria_p(nombre) values(nombre);
-----------------------------------------------------------------------
-- para eliminar usuario
create procedure _eliminarusuario(
cod char (4)
)
delete from usuarios where cod_user = cod;
----------------------------------------------------------------------
-- para editar categoria
create procedure _modificarcategoria(
ccod int,
nombre varchar(100)
)
update categoria_p
set nombre=nombre where id_categoria = ccod;
-----------------------------------------------------------------------
-- para eliminar categoria
create procedure _eliminarcategoria(
cod int
)
delete from categoria_p where id_categoria = cod;
--------------------------------------------------------------------------
-- listar platos 
create procedure _listarplatos(_bus varchar (100))
select p.id cod, p.nombre plato, p.id_categoria idcate, c.nombre categoria, p.precio precio from platos p join categoria_p c 
on p.id_categoria=c.id_categoria
where p.nombre LIKE LOWER(_bus) order by p.id desc;
----------------------------------------------------------------------
-- para modificar plato drop procedure _modificarplato
create procedure _modificarplato(
codp int,
nombre varchar (100),
cate int,
precio decimal (10,2)
)
update platos set nombre=nombre, id_categoria=cate, precio=precio where id=codp;
-----------------------------------------------------------------------------------
-- para eliminar plato
create procedure _eliminarplato(
cod int
)
delete from platos where id = cod;

----------------------------------------------------------------------------------------
-- insertar datos
call _agregarusuario ('E001', 'Yan', 'Zapata', '910500683', 'yan', '1234', 'Empleado', '2000-10-29');

call _modificarusuario ('A001', 'Admin', 'Admin', '999999999', 'admin', 'admin', 'Administrador');

call _agregarcategoria ('Menus');

call _agregarplato ('Lomo Saltado',1,12.00);

call _topbebidas;

select * from usuarios order by nombre asc;

call _eliminarusuario ('A003');

select * from categoria_p order by id_categoria desc limit 3;

call _listarplatos ('%%');

select * from categoria_p;

select * from platos;

call _agregarplato ('nombre',1,6.00);

call _modificarplato (3,'Bum Bum',7,9.00);

---------------------------------------------------------------------------------------------------------------
-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-++
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- NUEVAS FUNCIONES 03-03-2023
-- crear tabla lista
create table listapedido
(id int primary key not null auto_increment,
id_venta int not null,
id_plato int not null,
cantidad int not null,
estado boolean not null,
color boolean not null,
FOREIGN KEY (id_venta) REFERENCES ventas(id_ventas),
FOREIGN KEY (id_plato) REFERENCES platos(id)
);

-------------------------------------------------------------------------------------------------------------
-- triger drop trigger _listarpedidos
--------------------------------------------------------------------
create trigger _listarpedidos
after insert
on venta_detalle
for each row
insert into listapedido(id_venta, id_plato, cantidad, estado, color)
values(
new.id_venta,new.id_plato,new.cantidad,1,0
);
----------------------------------------------------------------------
-- para eliminar si se elimina
create trigger _eliminarlista
after delete
on venta_detalle
for each row
delete from listapedido where id_venta= old.id_venta and id_plato=old.id_plato;
------------------------------------------------------------------------
select * from listapedido;
-------------------------------------------------------------------------
insert into venta_detalle(id_venta, id_plato, cantidad, precio, descuento)
values(
7,4,2,13.00,0.00
);
----------------------------------------------------------------------------
-- sp nuevo
-- para la lista de los pedidos drop procedure _listaplatospedidos
create procedure _listaplatospedidos(buscador varchar (100))
select l.id, v.cliente, p.nombre, l.cantidad, l.estado, l.color
from listapedido l join ventas v on l.id_venta=v.id_ventas
join platos p on  l.id_plato = p.id where l.estado=1
and p.nombre LIKE LOWER(buscador)
order by l.id_venta asc, l.id desc;
-----------------------------------------------------------------------
-- para desactivar pedido de la lista
create procedure _cambiaestadolista(cod int)
update listapedido set estado=0 where id=cod;
----------------------------------------------------------------------
-- para cambiar color de fondo drop procedure _cambiarfondo
delimiter //
create procedure _cambiarfondo(cod int)
begin
if (select color from listapedido where id=cod)=0 then
update listapedido set color=1 where id=cod;
elseif (select color from listapedido where id=cod)=1 then
update listapedido set color=0 where id=cod;
end if;
end //
delimiter ;
-- -------------------------------------------------------------------------
call _listaplatospedidos('%%');

call _cambiaestadolista(5);

update listapedido set estado=1 where id=5;

select * from listapedido;

call _cambiarfondo(6);

update listapedido set color=1 where id=cod;

select u.nombre, v.cliente, sum(vd.cantidad*vd.precio) subtotal, sum(vd.descuento) descuento,
(sum(vd.cantidad*vd.precio))-(sum(vd.descuento)) total, v.fecha from venta_detalle vd
join ventas v on vd.id_venta=v.id_ventas join usuarios u on v.cod_user=u.cod_user
where v.fecha between '2023-3-1' and '2023-3-31'
group by vd.id_venta;

------------------------------------------------------------------------------------
-- para reporte drop procedure _reporteventas
create procedure _reporteventas(
fecha1 date,
fecha2 date
)
select u.nombre, v.cliente, sum(vd.cantidad*vd.precio) subtotal, sum(vd.descuento) descuento,
(sum(vd.cantidad*vd.precio))-(sum(vd.descuento)) total, v.fecha from venta_detalle vd
join ventas v on vd.id_venta=v.id_ventas join usuarios u on v.cod_user=u.cod_user
where v.fecha between fecha1 and fecha2
group by vd.id_venta;
---------------------------------------------------------------------------------------
call _reporteventas ('2023-2-1','2023-2-28');
---------------------------------------------------------------------------------------
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- tablas de inventario drop table productos
create table productos
(id_producto int(5) primary key not null auto_increment,
nombre varchar(100) not null,
stock int
);
----------------------------------------------------------
create table entrada
(id_entrada int(5) primary key not null auto_increment,
factura varchar(30) default null,
id_producto int not null,
ent_fecha date,
ent_cantidad int(4) not null,
precio decimal(10,2),
id_usuario char(4),
FOREIGN KEY (id_usuario) REFERENCES usuarios(cod_user),
FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE ON UPDATE CASCADE
);
--------------------------------------------------------- drop table salida
create table salida
(id_salida int(5) primary key not null auto_increment,
id_producto int not null,
sal_fecha date,
sal_cantidad int(4) not null,
id_usuario char(4),
precio decimal(10,2),
FOREIGN KEY (id_usuario) REFERENCES usuarios(cod_user),
FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE ON UPDATE CASCADE
);
----------------------------------------------------------
-- triggers
-- para entrada
CREATE TRIGGER _productosaumento
AFTER INSERT ON entrada
FOR EACH ROW UPDATE productos
SET stock = stock+NEW.ent_cantidad
where id_producto = NEW.id_producto;
-------------------------------------------------------------
-- para salida
CREATE TRIGGER _productoresta
AFTER INSERT ON salida
FOR EACH ROW UPDATE productos
SET stock = stock-NEW.sal_cantidad
where id_producto = NEW.id_producto;
------------------------------------------------------------
-- sp para agregar entrada de producto
create procedure _addentrada
(product int,
fecha date,
cant int,
pre decimal(10,2),
codu char(4)
)
insert into entrada(id_producto,ent_fecha,ent_cantidad,precio,id_usuario)
values(product,fecha,cant,pre,codu);
------------------------------------------------------------
-- sp para restar salida de producto
-- prueba salida drop procedure _addsalida
DELIMITER $$
create procedure _addsalida
(product int,
fecha date,
cant int,
codu char(4)
)
BEGIN
if (select stock from productos where id_producto=product)>=cant then
insert into salida(id_producto,sal_fecha,sal_cantidad,id_usuario,precio)
values(product,fecha,cant,codu,(select precio from entrada where id_producto=product order by ent_fecha desc, precio desc limit 1));
else
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Excede la cantidad del stock', MYSQL_ERRNO = 3002;
end if;
end $$
DELIMITER ;
---------------------------------------------------------------
-- sp para agregar producto drop procedure _agregarnuevoproducto
DELIMITER $$
create procedure _agregarnuevoproducto
(nom varchar (100),
cant int
)
begin
if length(nom)>0 then
insert into productos(nombre, stock) values (nom, cant);
else
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'campo vacio', MYSQL_ERRNO = 3002;
end if;
end $$
DELIMITER ;

-------------------------------------------------------------
-- agregar producto
call _agregarnuevoproducto ('Papa',0);
-- entrada
insert into entrada(id_producto,ent_fecha,ent_cantidad,precio,id_usuario)
values(2,'2023-03-10',3,3.80,'A001');
-- salida
insert into salida(id_producto,sal_fecha,sal_cantidad,id_usuario)
values(2,'2023-03-10',1,'A001');

delete from productos where id_producto=8;

select * from productos;
select * from entrada;
select * from salida;

---------------------------------------------------------------------
-- sp listar inventario
CREATE PROCEDURE _listarinventario (_bus varchar (50))
select * from productos where nombre LIKE LOWER(_bus) order by id_producto desc;
-----------------------------------------------------------------------
call _listarinventario ('%%');

select * from usuarios;

call _addentrada (2,'2023-03-10',1,3.80,'A001');

-- para probar
call _addsalida (4,'2023-03-20',1,'A001');

call _eliminarventa (12)
---------------------------------------------------------------------------
-- sp para reporte de platos drop procedure _reporteplatos
create procedure _reporteplatos(
fecha1 date,
fecha2 date
)
select p.nombre, sum(vd.cantidad) vendidos, sum(vd.descuento) dsc, sum(vd.cantidad*vd.precio) subtotal,
sum((vd.cantidad*vd.precio)-vd.descuento) total from venta_detalle vd join platos p on vd.id_plato=p.id
join ventas v on vd.id_venta=v.id_ventas where v.fecha between fecha1 and fecha2
group by vd.id_plato;
---------------------------------------------------------------------------
-- para reporte de platos
select p.nombre, sum(vd.cantidad) vendidos, sum(vd.descuento) dsc, sum(vd.cantidad*vd.precio) subtotal,
sum((vd.cantidad*vd.precio)-vd.descuento) total from venta_detalle vd join platos p on vd.id_plato=p.id
join ventas v on vd.id_venta=v.id_ventas where v.fecha between '2023-3-01' and '2023-3-31'
group by vd.id_plato;

-- reporte para inventarios
select sum(s.sal_cantidad*s.precio) from salida s
join productos p on s.id_producto=p.id_producto
where s.sal_fecha between '2023-3-01' and '2023-3-31';

select s.id_salida, p.nombre, s.sal_cantidad, s.precio, s.sal_cantidad*s.precio from salida s
join productos p on s.id_producto=p.id_producto
where s.sal_fecha between '2023-3-01' and '2023-3-31'
group by s.id_salida;

select p.nombre, sum(s.sal_cantidad),sum(s.sal_cantidad*s.precio) from salida s
join productos p on s.id_producto=p.id_producto
where s.sal_fecha between '2023-3-01' and '2023-3-31'
group by p.nombre;

-- para tabla de datos call _listardetalleventa(1)
select p.nombre menu, sum(vd.cantidad) cantidad,
vd.precio precio, sum(vd.descuento) dsc from venta_detalle vd join platos p on vd.id_plato=p.id 
where vd.id_venta=20 group by p.id, p.nombre, vd.precio;

---------------------------------------------------------------------------------------
-- para nombre de vendedor drop procedure _nombrevendedor
create procedure _nombrevendedor
(vid int)
select concat(u.nombre,' ',u.apellido) vendedor, v.cliente from ventas v join usuarios u on v.cod_user=u.cod_user
where v.id_ventas=vid; 
------------------------------------------------------------
call _nombrevendedor (20)


