-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2015 a las 16:02:02
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `olympo`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `pa_acceso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_acceso`(
    paperfil int,
    paurl varchar(50)
    )
begin
select  p.estado,p.id_perfil_usuario 
from permisos as p 
	INNER JOIN modulo as m ON m.id_modulo=p.id_modulo 
where p.id_perfil_usuario=paperfil and m.url=paurl and m.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_d_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_almacen`(
paid_almacen int
)
begin
update almacen set estado='0'  where id_almacen=paid_almacen;
end$$

DROP PROCEDURE IF EXISTS `pa_d_ambiente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_ambiente`(
paid_ambiente int
)
begin
update ambiente set estado='0'  where id_ambiente=paid_ambiente;
end$$

DROP PROCEDURE IF EXISTS `pa_d_caej`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_caej`(
paid_categoria_ejercicio int
)
begin
update categoria_ejercicio set estado=0
where id_categoria_ejercicio=paid_categoria_ejercicio;
end$$

DROP PROCEDURE IF EXISTS `pa_d_caem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_caem`(
paid_categoria_empleado int
)
begin
update categoria_empleado set estado=0
where id_categoria_empleado=paid_categoria_empleado;
end$$

DROP PROCEDURE IF EXISTS `pa_d_caev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_caev`(
paid_categoria_evento int
)
begin
update categoria_evento set estado=0
where id_categoria_evento=paid_categoria_evento;
end$$

DROP PROCEDURE IF EXISTS `pa_d_capr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_capr`(
paid_categoria_producto int
)
begin
update categoria_producto set estado=0
where id_categoria_producto=paid_categoria_producto;
end$$

DROP PROCEDURE IF EXISTS `pa_d_como`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_como`(
paid_concepto_movimiento int(11)
)
begin
delete from concepto_movimiento
where id_concepto_movimiento=paid_concepto_movimiento;
end$$

DROP PROCEDURE IF EXISTS `pa_d_cotr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_cotr`(
paid_concepto_triaje int
)
begin
delete from concepto_triaje  
where id_concepto_triaje=paid_concepto_triaje ;
end$$

DROP PROCEDURE IF EXISTS `pa_d_ejercicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_ejercicio`(

paid_ejercicio int

)
begin

delete from ejercicio  
where id_ejercicio=paid_ejercicio;

end$$

DROP PROCEDURE IF EXISTS `pa_d_evento`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_evento`(
paid_evento int
)
begin

update evento set estado='0'  
where id_evento=paid_evento;

end$$

DROP PROCEDURE IF EXISTS `pa_d_marca`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_marca`(
paid_marca int
)
begin
delete from marca
where id_marca=paid_marca;
end$$

DROP PROCEDURE IF EXISTS `pa_d_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_modulo`(IN `paid_modulo` INT)
begin
update modulo set estado='0' 
where id_modulo=paid_modulo;
end$$

DROP PROCEDURE IF EXISTS `pa_d_param`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_param`(p_id_param VARCHAR(100))
BEGIN

UPDATE param SET estado = 0
WHERE id_param = p_id_param;

END$$

DROP PROCEDURE IF EXISTS `pa_d_peus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_peus`(
paid_perfil_usuario int
)
begin
update perfil_usuario set estado='0'
where id_perfil_usuario=paid_perfil_usuario ;
end$$

DROP PROCEDURE IF EXISTS `pa_d_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_producto`(
paid_producto int
)
begin
update producto set estado=0
where id_producto=paid_producto;
end$$

DROP PROCEDURE IF EXISTS `pa_d_proveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_proveedor`(
paid_proveedor int
)
begin
delete from proveedor
where id_proveedor=paid_proveedor;
end$$

DROP PROCEDURE IF EXISTS `pa_d_time`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_time`(
paid_tipo_membresia int(11)
)
begin
update tipo_membresia set estado='0'
where id_tipo_membresia=paid_tipo_membresia;
end$$

DROP PROCEDURE IF EXISTS `pa_d_tiso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_tiso`(
paid_tipo_socio int
)
begin
delete
from tipo_socio
where id_tipo_socio=paid_tipo_socio;
end$$

DROP PROCEDURE IF EXISTS `pa_d_vigencia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_d_vigencia`(
paid_vigencia int(11)
)
begin
delete from vigencia
where id_vigencia=paid_vigencia;
end$$

DROP PROCEDURE IF EXISTS `pa_i_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_almacen`(
padescripcion varchar(30)
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_almacen) from almacen);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into almacen(id_almacen,descripcion,estado) values
(_nuevo,padescripcion,'1') ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_ambiente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_ambiente`(
padescripcion varchar(30)
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_ambiente) from ambiente);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into ambiente(id_ambiente,descripcion,estado) values
(_nuevo,padescripcion,'1') ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_caej`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_caej`(
padescripcion varchar(30)
)
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_categoria_ejercicio) from categoria_ejercicio);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
insert into categoria_ejercicio (id_categoria_ejercicio,descripcion,estado) 
values
(_nuevo,padescripcion,'1') ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_caem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_caem`(
padescripcion varchar(30)
)
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_categoria_empleado) from categoria_empleado);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
insert into categoria_empleado (id_categoria_empleado,descripcion,estado) 
values
(_nuevo,padescripcion,'1') ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_caev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_caev`(
padescripcion varchar(30)
)
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_categoria_evento) from categoria_evento);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
insert into categoria_evento (id_categoria_evento,descripcion,estado) 
values
(_nuevo,padescripcion,'1') ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_capr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_capr`(
padescripcion varchar(30)
)
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_categoria_producto) from categoria_producto);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
insert into categoria_producto (id_categoria_producto,descripcion,estado) 
values
(_nuevo,padescripcion,'1') ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_como`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_como`(
  paid_tipo_movimiento int(11),
  padescripcion varchar(60)
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_concepto_movimiento) from concepto_movimiento);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into concepto_movimiento(id_concepto_movimiento,id_tipo_movimiento,descripcion) 
values
(_nuevo,paid_tipo_movimiento,padescripcion) ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_compra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_compra`(
	paid_proveedor int,
	paid_empleado int,
	paid_modalidad_transaccion int,
	pafecha date,
	pamonto decimal(18,2),
	panumero varchar(20),
	paigv decimal(10,2)

)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_compra) from compra);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
INSERT INTO `compra`(`id_compra`, `id_proveedor`, `id_empleado`, `id_modalidad_transaccion`, `fecha`, `monto`, `estado`, `num_documento`, `estado_pago`, `igv`)
 VALUES 		(_nuevo,paid_proveedor,paid_empleado,paid_modalidad_transaccion,pafecha,pamonto,'1',panumero,'0',paigv);

select max(id_compra) as max_compra FROM compra;

end$$

DROP PROCEDURE IF EXISTS `pa_i_copr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_copr`(IN `paid_compra` INT, IN `paid_producto` INT, IN `paid_almacen` INT, IN `pacantidad` INT, IN `paprecio_uni` DECIMAL(18,2))
begin


INSERT INTO `compra_producto`(`id_compra`, `id_producto`, `id_almacen`, `cantidad`, `precio_uni`)
 VALUES 		(paid_compra,paid_producto,paid_almacen,pacantidad,paprecio_uni);

select max(id_compra) as max_compra FROM compra;

end$$

DROP PROCEDURE IF EXISTS `pa_i_cotr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_cotr`(
padescripcion varchar(30)
)
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_concepto_triaje) from concepto_triaje);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
insert into concepto_triaje(id_concepto_triaje,descripcion) values
(_nuevo,padescripcion) ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_ejercicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_ejercicio`(

paid_servicio int,

paid_categoria_ejercicio int,

padescripcion varchar(30)

)
begin


declare _actual int;

declare _nuevo int ;

set _actual=(select max(id_ejercicio) 
from ejercicio);

set _nuevo =(_actual+1);


if (_nuevo IS NULL or _nuevo<1) then
	
set _nuevo =1;

end if;


insert into ejercicio(id_ejercicio,id_servicio,id_categoria_ejercicio,descripcion) 

values
(_nuevo,paid_servicio,paid_categoria_ejercicio,padescripcion) ;

end$$

DROP PROCEDURE IF EXISTS `pa_i_evento`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_evento`(

paid_categoria_evento int,

panombre varchar(60),

padescripcion varchar(100),

pafecha_inicio date,

pafecha_fin date,

palugar varchar(50)

)
begin


declare  _actual int;

declare _nuevo int ;

set _actual=(select max(id_evento) from evento);

set _nuevo =(_actual+1);


if (_nuevo IS NULL or _nuevo<1) then
	
set _nuevo =1;
end if;


insert into evento(id_evento,id_categoria_evento,nombre,descripcion,fecha_inicio,fecha_fin,lugar,estado) 
values
(_nuevo,paid_categoria_evento,panombre,padescripcion,pafecha_inicio,pafecha_fin,palugar,'1') ;

end$$

DROP PROCEDURE IF EXISTS `pa_i_marca`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_marca`(IN `padescripcion` VARCHAR(30))
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_marca) from marca);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
insert into marca (id_marca,descripcion) 
values
(_nuevo,padescripcion) ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_modulo`(IN `panombre` VARCHAR(30), IN `paurl` VARCHAR(50), IN `paorden` INT, IN `paid_padre` INT, IN `pamodulo_padre` VARCHAR(30), IN `paicono` VARCHAR(50))
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_modulo) from modulo);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into modulo(id_modulo,nombre,url,orden,estado,id_padre,modulo_padre,icono) 
values
(_nuevo,panombre,paurl,paorden,'1',paid_padre,pamodulo_padre,paicono) ;

insert into permisos (estado,id_perfil_usuario,id_modulo)
values ('1','1',_nuevo);

end$$

DROP PROCEDURE IF EXISTS `pa_i_param`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_param`(p_id_param varchar(100), p_valor varchar(100), p_descripcion varchar(100))
BEGIN

INSERT INTO param (id_param, valor, descripcion, estado )
VALUES (p_id_param, p_valor, p_descripcion, 1);

end$$

DROP PROCEDURE IF EXISTS `pa_i_peus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_peus`(
padescripcion varchar(50)
)
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_perfil_usuario) from perfil_usuario);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
INSERT INTO `perfil_usuario`(`id_perfil_usuario`, `descripcion`, `estado`) VALUES (_nuevo,_descripcion,1);
end$$

DROP PROCEDURE IF EXISTS `pa_i_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_producto`(

paid_categoria_producto int,
paid_marca int,
papresentacion varchar(30),
panombre varchar(30),
pastock_min int,
pastock_max int,
paprecio float
)
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_producto) from producto);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
insert into producto(id_producto,id_categoria_producto,id_marca,presentacion,stock,precio,nombre,stock_min,stock_max,estado) values
(_nuevo,paid_categoria_producto,paid_marca,papresentacion,0,paprecio,panombre,pastock_min,pastock_max,'1') ;


end$$

DROP PROCEDURE IF EXISTS `pa_i_proveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_proveedor`(
parazon_social varchar(50),
paruc varchar(11),
patelefono varchar(15),
paemail varchar(50),
padireccion varchar(50),
paid_ubigeo int
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_proveedor) from proveedor);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into proveedor(id_proveedor,razon_social,ruc,telefono,email,direccion,id_ubigeo) values
(_nuevo,parazon_social,paruc,patelefono,paemail,padireccion,paid_ubigeo) ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_time`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_time`(
   padescripcion varchar(30),
   panumero_servicios int(11)
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_tipo_membresia) from tipo_membresia);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
INSERT INTO `tipo_membresia`(`id_tipo_membresia`, `descripcion`, `numero_servicios`, `estado`) 
VALUES (_nuevo,padescripcion,panumero_servicios,'1');

end$$

DROP PROCEDURE IF EXISTS `pa_i_tiso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_tiso`(
padescripcion varchar(30)
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_tipo_socio) from tipo_socio);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into tipo_socio(id_tipo_socio,descripcion) 
values
(_nuevo,padescripcion) ;
end$$

DROP PROCEDURE IF EXISTS `pa_i_u_daem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_u_daem`(IN `parazon` VARCHAR(40), IN `paruc` CHAR(11), IN `patelefono` VARCHAR(15), IN `padireccion` VARCHAR(50), IN `pacelular` VARCHAR(15), IN `pamision` VARCHAR(500), IN `pavision` VARCHAR(500), IN `pahistoria` VARCHAR(1000))
begin
	IF NOT EXISTS (select * from datos_empresa where id_datos_empresa=1) 
	THEN 
		INSERT INTO `datos_empresa`(`id_datos_empresa`, `razon_social`, `ruc`, `telefono`, `direccion`, `celular`, `mision`, `vision`, `historia`) 
		VALUES (1,parazon,paruc ,patelefono ,padireccion ,pacelular ,pamision ,pavision ,pahistoria );	
	ELSE
		UPDATE `datos_empresa` SET `razon_social`=parazon,`ruc`=paruc,`telefono`=patelefono,`direccion`=padireccion,
		`celular`=pacelular,`mision`=pamision,`vision`=pavision,`historia`=pahistoria WHERE id_datos_empresa=1;
	END IF;

end$$

DROP PROCEDURE IF EXISTS `pa_i_vigencia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_vigencia`(
  padescripcion varchar(30),
  padias int(11)
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_vigencia) from vigencia);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into vigencia(id_vigencia,descripcion,dias) 
values
(_nuevo,padescripcion,padias) ;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_alerta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_alerta`()
begin
SELECT `id_alerta`, `descripcion`, `id_modulo`, `cantidad` 
from alertas ;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_almacen`()
begin
select id_almacen,descripcion,estado from almacen 
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_ambiente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_ambiente`()
begin
select id_ambiente,descripcion,estado from ambiente 
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_caej`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_caej`()
begin
select id_categoria_ejercicio,descripcion,estado  
from categoria_ejercicio
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_caem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_caem`()
begin
select id_categoria_empleado,descripcion,estado  
from categoria_empleado
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_caev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_caev`()
begin
select id_categoria_evento,descripcion,estado  
from categoria_evento
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_capr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_capr`()
begin
select id_categoria_producto,descripcion,estado  
from categoria_producto
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_como`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_como`()
begin
select  cm.id_concepto_movimiento,tm.descripcion as descripcion_tipo_movimiento ,cm.descripcion
from concepto_movimiento as cm
inner join tipo_movimiento as tm on tm.id_tipo_movimiento=cm.id_tipo_movimiento;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_compra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_compra`()
begin

SELECT c.*, p.razon_social as 'RAZON_SOCIAL', mt.descripcion as 'MODALIDAD_TRANSACCION', CONCAT(emp.nombre,' ',emp.apellido_paterno) as 'EMPLEADO'
	FROM compra c 
		inner join proveedor p ON c.id_proveedor=p.id_proveedor
		inner join modalidad_transaccion mt ON c.id_modalidad_transaccion=mt.id_modalidad_transaccion
		inner join empleado emp ON c.id_empleado=emp.id_empleado

	WHERE c.estado = 1 
		order by c.id_compra desc;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_cotr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_cotr`()
begin
select id_concepto_triaje,descripcion 
from concepto_triaje;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_daem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_daem`()
begin
select * from  datos_empresa
where id_datos_empresa=1;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_ejercicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_ejercicio`()
begin

SELECT e.id_ejercicio, s.nombre as servicio, ct.descripcion as categoria_ejercicio, e.descripcion
FROM `ejercicio` e 
inner join servicio s on (e.id_servicio = s.id_servicio)
inner join categoria_ejercicio ct on (e.id_categoria_ejercicio = ct.id_categoria_ejercicio);
end$$

DROP PROCEDURE IF EXISTS `pa_m1_evento`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_evento`()
begin
 
SELECT e.id_evento, ct.descripcion as categoria_evento, e.nombre, e.descripcion, e.fecha_inicio, e.fecha_fin, e.lugar, e.estado
 
FROM `evento` e inner join categoria_evento ct on (e.id_categoria_evento = ct.id_categoria_evento) 

where e.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_marca`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_marca`()
begin
select id_marca,descripcion 
from marca;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_modulo`()
begin
select m.*
from modulo as m
where m.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_param`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_param`(p_id_param varchar(100))
BEGIN

	IF (p_id_param = '')
		THEN
		SELECT * FROM param where estado = 1;

	END if;
	IF (p_id_param <> '')
		THEN
		SELECT * FROM param where id_param = p_id_param and estado = 1;
	
	END if;
END$$

DROP PROCEDURE IF EXISTS `pa_m1_permisos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_permisos`(
    paperfil int
    )
begin
select  id_modulo
from permisos 
where id_perfil_usuario=paperfil and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_peus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_peus`()
begin
select id_perfil_usuario, descripcion, estado 
from perfil_usuario
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_producto`()
begin
select pr.id_producto, pr.id_categoria_producto, pr.id_marca, pr.presentacion, pr.stock, pr.precio, pr.nombre, pr.stock_min, pr.stock_max,
	 capr.descripcion as 'descripcion_capr' , mar.descripcion as 'descripcion_mar'
from producto  as pr
 INNER JOIN categoria_producto as capr ON capr.id_categoria_producto=pr.id_categoria_producto
 INNER JOIN marca as mar ON mar.id_marca=pr.id_marca
where pr.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_proveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_proveedor`()
begin
select  p.id_proveedor,p.razon_social,p.ruc,p.telefono,p.email,p.direccion,p.id_ubigeo,u.descripcion 
from proveedor as p
INNER JOIN ubigeos as u ON u.idubigeo =p.id_ubigeo ;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_servicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_servicio`()
begin
select ser.id_servicio,amb.descripcion as ambiente,ser.nombre,ser.descripcion,ser.estado  
from servicio as ser
 INNER JOIN ambiente as amb ON amb.id_ambiente=ser.id_ambiente
where ser.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_socio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_socio`()
begin
select 
  s.id_socio, 
  pu.descripcion as 'perfil',
  ts.descripcion as 'tipo_socio',
  u.idubigeo,
  s.dni,
  s.aliass,
  s.nombre,
  s.apellido_paterno,
  s.apellido_materno,
  s.email,
  s.telefono,
  s.celular,
  s.direccion,
  s.fecha_nacimiento,
  s.sexo,
  s.estado_civil,
  s.ocupacion,
  s.estado,
  s.grupo_sanguineo,
  s.hobby,
  s.nacionalidad,
  s.seguro_medico,
  s.observacion,
  s.antecedente_medico,
  s.codigo_postal,
  s.fax,
  s.numero_hijo,
  s.sector,
  s.grado_estudio,
  s.ingresos 
from socio as s 
inner join tipo_socio as ts on ts.id_tipo_socio=s.id_tipo_socio
inner join perfil_usuario as pu on pu.id_perfil_usuario=s.id_perfil_usuario
inner join ubigeos as u on u.idubigeo=s.idubigeo
where s.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_time`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_time`()
begin
SELECT `id_tipo_membresia`, `descripcion`, `numero_servicios`, `estado` 
FROM `tipo_membresia`
where estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m1_timo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_timo`()
begin
select 
  id_tipo_movimiento,descripcion
from tipo_movimiento;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_tiso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_tiso`()
begin
select id_tipo_socio,descripcion 
from tipo_socio;
end$$

DROP PROCEDURE IF EXISTS `pa_m1_vigencia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m1_vigencia`()
begin
SELECT `id_vigencia`, `descripcion`, `dias` 
FROM `vigencia`;
end$$

DROP PROCEDURE IF EXISTS `pa_m2_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_almacen`(
paid_almacen int
)
begin
select  id_almacen,descripcion,estado from almacen
 where id_almacen=paid_almacen  and estado='1';

end$$

DROP PROCEDURE IF EXISTS `pa_m2_ambiente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_ambiente`(
paid_ambiente int
)
begin
select  id_ambiente,descripcion,estado from ambiente
 where (id_ambiente=paid_ambiente) and estado='1';

end$$

DROP PROCEDURE IF EXISTS `pa_m2_caej`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_caej`(
paid_categoria_ejercicio int
)
begin
select id_categoria_ejercicio,descripcion,estado 
from categoria_ejercicio
where (id_categoria_ejercicio=paid_categoria_ejercicio) and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_caem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_caem`(
paid_categoria_empleado int
)
begin
select id_categoria_empleado,descripcion,estado 
from categoria_empleado
where id_categoria_empleado=paid_categoria_empleado and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_caev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_caev`(
paid_categoria_evento int
)
begin
select id_categoria_evento,descripcion,estado 
from categoria_evento
where (id_categoria_evento=paid_categoria_evento) and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_capr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_capr`(
paid_categoria_producto int
)
begin
select id_categoria_producto,descripcion,estado 
from categoria_producto
where id_categoria_producto=paid_categoria_producto and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_como`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_como`(
 paid_concepto_movimiento int(11)
)
begin
select id_concepto_movimiento,id_tipo_movimiento,descripcion
from concepto_movimiento 
where id_concepto_movimiento=paid_concepto_movimiento;
end$$

DROP PROCEDURE IF EXISTS `pa_m2_compra`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_compra`(IN `paid_compra` INT)
begin


SELECT c.*, p.razon_social as 'RAZON_SOCIAL', mt.descripcion as 'MODALIDAD_TRANSACCION', CONCAT(emp.nombre,' ',emp.apellido_paterno) as 'EMPLEADO',
	pro.nombre as producto, alm.descripcion as almacen , copr.cantidad as cantidad_pro , copr.precio_uni as precio_pro
	FROM compra c 
		inner join proveedor p ON c.id_proveedor=p.id_proveedor
		inner join modalidad_transaccion mt ON c.id_modalidad_transaccion=mt.id_modalidad_transaccion
		inner join empleado emp ON c.id_empleado=emp.id_empleado
		inner join compra_producto copr ON c.id_compra=copr.id_compra 
		inner join producto pro ON pro.id_producto=copr.id_producto 
		inner join almacen alm ON alm.id_almacen=copr.id_almacen
		

	WHERE c.estado = 1 and c.id_compra=paid_compra 
	order by c.id_compra desc;

end$$

DROP PROCEDURE IF EXISTS `pa_m2_cotr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_cotr`(
paid_concepto_triaje int
)
begin
select id_concepto_triaje,descripcion  
from concepto_triaje
where (id_concepto_triaje=paid_concepto_triaje);
end$$

DROP PROCEDURE IF EXISTS `pa_m2_ejercicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_ejercicio`(

paid_ejercicio int
)
begin

SELECT `id_ejercicio`, `id_servicio`, `id_categoria_ejercicio`, `descripcion` 

FROM `ejercicio`
 
where (id_ejercicio=paid_ejercicio) 
        ;


end$$

DROP PROCEDURE IF EXISTS `pa_m2_evento`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_evento`(

	paid_evento int

)
begin 

SELECT `id_evento`, `id_categoria_evento`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `lugar`, `estado`
 
FROM `evento`
 
where (id_evento=paid_evento) and estado='1';


end$$

DROP PROCEDURE IF EXISTS `pa_m2_marca`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_marca`(
paid_marca int
)
begin
select id_marca,descripcion 
from marca
where (id_marca=paid_marca) ;
end$$

DROP PROCEDURE IF EXISTS `pa_m2_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_modulo`(IN `papadre` INT)
begin
select m.* 
from modulo as m
where m.id_padre=papadre and m.estado='1' ;
end$$

DROP PROCEDURE IF EXISTS `pa_m2_peus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_peus`(
paid_perfil int
)
begin
select id_perfil_usuario, descripcion, estado 
from perfil_usuario
where (id_perfil_usuario=paid_perfil) and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_producto`(IN `paid_producto` INT, IN `paid_categoria_producto` INT, IN `paid_marca` INT)
begin
select pr.id_producto, pr.id_categoria_producto, pr.id_marca, pr.presentacion, pr.stock, pr.precio, pr.nombre, pr.stock_min, pr.stock_max  
	, capr.descripcion , mar.descripcion
from producto  as pr
 INNER JOIN categoria_producto as capr ON capr.id_categoria_producto=pr.id_categoria_producto
 INNER JOIN marca as mar ON mar.id_marca=pr.id_marca
 where (pr.id_producto=paid_producto 
	or pr.id_categoria_producto=paid_categoria_producto 
	or pr.id_marca=paid_marca ) and pr.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_proveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_proveedor`(
paid_proveedor  int
)
begin
select  id_proveedor,razon_social,ruc,telefono,email,direccion,id_ubigeo from proveedor
 where (id_proveedor=paid_proveedor);

end$$

DROP PROCEDURE IF EXISTS `pa_m2_servicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_servicio`(
paid_servicio int
)
begin
SELECT `id_servicio`, `id_ambiente`, `nombre`, `descripcion`, `estado` 
FROM `servicio`
where (id_servicio=paid_servicio) and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_time`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_time`(
  paid_tipo_membresia int
)
begin
SELECT `id_tipo_membresia`, `descripcion`, `numero_servicios`, `estado` 
FROM `tipo_membresia`
where (id_tipo_membresia=paid_tipo_membresia) and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_timo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_timo`(
  paid_tipo_movimiento int(11) 
)
begin
select  id_tipo_movimiento,descripcion 
from tipo_movimiento
where id_tipo_movimiento=paid_tipo_movimiento ;
end$$

DROP PROCEDURE IF EXISTS `pa_m2_tiso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_tiso`(
paid_tipo_socio int
)
begin

SELECT `id_tipo_socio`, `descripcion` 
FROM `tipo_socio` 
WHERE id_tipo_socio=paid_tipo_socio;

end$$

DROP PROCEDURE IF EXISTS `pa_m2_vigencia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_vigencia`(
  paid_vigencia int(11)
)
begin
SELECT `id_vigencia`, `descripcion`, `dias` 
FROM `vigencia`
WHERE (id_vigencia=paid_vigencia);
end$$

DROP PROCEDURE IF EXISTS `pa_m3_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m3_modulo`(IN `paurl` VARCHAR(50))
begin
	SELECT * FROM modulo where url=paurl and estado = '1';
end$$

DROP PROCEDURE IF EXISTS `pa_m3_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m3_producto`(IN `paid_almacen` INT)
begin

select pr.id_producto, pr.id_categoria_producto, pr.id_marca, pr.presentacion, pr.stock, pr.precio, pr.nombre, capr.descripcion as categoria, mar.descripcion as marca, alm.stock stock_almacen 
from producto  as pr
 INNER JOIN categoria_producto as capr ON capr.id_categoria_producto=pr.id_categoria_producto
 INNER JOIN marca as mar ON mar.id_marca=pr.id_marca
 INNER JOIN almacen_producto as alm ON alm.id_producto=pr.id_producto 
 where alm.id_almacen=paid_almacen  and pr.estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m4_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m4_modulo`(IN `paid_modulo` INT)
begin
	SELECT * FROM modulo where id_modulo=paid_modulo and estado = '1';
end$$

DROP PROCEDURE IF EXISTS `pa_menu`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_menu`(IN `paperfil` INT)
begin
select m.id_modulo,m.id_padre,m.url,m.estado,m.nombre ,mp.nombre as 'modulo_padre',mp.icono as 'icono_padre' 
from modulo as m
	INNER JOIN modulo as mp ON mp.id_modulo=m.id_padre 
	INNER JOIN permisos as p ON m.id_modulo=p.id_modulo 
where 	p.id_perfil_usuario=paperfil and 
		m.id_padre<>0 and m.estado='1' and 
        p.estado='1'
order by m.id_padre;
end$$

DROP PROCEDURE IF EXISTS `pa_usuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_usuario`(IN `pausuario` VARCHAR(50), IN `paclave` VARCHAR(250))
begin
SELECT em.id_empleado, em.nombre, em.apellido_paterno, em.apellido_materno, em.id_perfil_usuario , em.usuario, em.clave, peus.descripcion
FROM empleado as em 
INNER JOIN categoria_empleado as caem ON caem.id_categoria_empleado=em.id_categoria_empleado
INNER JOIN perfil_usuario as peus ON peus.id_perfil_usuario=em.id_perfil_usuario
where  em.usuario=pausuario and em.clave=paclave;
end$$

DROP PROCEDURE IF EXISTS `pa_u_almacen`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_almacen`(
paid_almacen int,
padescripcion varchar(30)
)
begin
update almacen set descripcion=padescripcion
where id_almacen=paid_almacen;
end$$

DROP PROCEDURE IF EXISTS `pa_u_ambiente`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_ambiente`(
paid_ambiente int,
padescripcion varchar(30)
)
begin
update ambiente set descripcion=padescripcion
where id_ambiente=paid_ambiente;
end$$

DROP PROCEDURE IF EXISTS `pa_u_caej`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_caej`(
paid_categoria_ejercicio int,
padescripcion varchar(30)
)
begin
update categoria_ejercicio set descripcion=padescripcion
where id_categoria_ejercicio=paid_categoria_ejercicio;
end$$

DROP PROCEDURE IF EXISTS `pa_u_caem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_caem`(
paid_categoria_empleado int,
padescripcion varchar(30)
)
begin
update categoria_empleado set descripcion=padescripcion
where id_categoria_empleado=paid_categoria_empleado ;
end$$

DROP PROCEDURE IF EXISTS `pa_u_caev`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_caev`(
paid_categoria_evento int,
padescripcion varchar(30)
)
begin
update categoria_evento set descripcion=padescripcion
where id_categoria_evento=paid_categoria_evento;
end$$

DROP PROCEDURE IF EXISTS `pa_u_capr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_capr`(
paid_categoria_producto int,
padescripcion varchar(30)
)
begin
update categoria_producto set descripcion=padescripcion
where id_categoria_producto=paid_categoria_producto;
end$$

DROP PROCEDURE IF EXISTS `pa_u_como`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_como`(
  paid_concepto_movimiento int(11),
  paid_tipo_movimiento int(11),
  padescripcion varchar(60)
)
begin
update concepto_movimiento set id_tipo_movimiento=paid_tipo_movimiento,descripcion=padescripcion
where id_concepto_movimiento=paid_concepto_movimiento;
end$$

DROP PROCEDURE IF EXISTS `pa_u_cotr`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_cotr`(
paid_concepto_triaje int,
padescripcion varchar(30)
)
begin
update concepto_triaje set descripcion=padescripcion
where id_concepto_triaje=paid_concepto_triaje ;
end$$

DROP PROCEDURE IF EXISTS `pa_u_ejercicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_ejercicio`(

paid_ejercicio int,

paid_servicio int,

paid_categoria_ejercicio int,

padescripcion varchar(30)

)
begin

update ejercicio set id_servicio=paid_servicio,id_categoria_ejercicio=paid_categoria_ejercicio,
                     
                      descripcion=padescripcion

where id_ejercicio=paid_ejercicio;

end$$

DROP PROCEDURE IF EXISTS `pa_u_evento`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_evento`(

paid_evento int,

paid_categoria_evento int,

panombre varchar(60),

padescripcion varchar(100),

pafecha_inicio date,

pafecha_fin date,

palugar varchar(50)

)
begin
update evento set id_categoria_evento=paid_categoria_evento,nombre=panombre,descripcion=padescripcion,
                   
                        fecha_inicio=pafecha_inicio,fecha_fin=pafecha_fin,lugar=palugar

where id_evento=paid_evento;

end$$

DROP PROCEDURE IF EXISTS `pa_u_marca`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_marca`(IN `paid_marca` INT, IN `padescripcion` VARCHAR(30))
begin
update marca set descripcion=padescripcion
where id_marca=paid_marca;
end$$

DROP PROCEDURE IF EXISTS `pa_u_modulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_modulo`(IN `paid_modulo` INT, IN `panombre` VARCHAR(30), IN `paurl` VARCHAR(50), IN `paorden` INT, IN `paid_padre` INT, IN `pamodulo_padre` VARCHAR(30), IN `paicono` VARCHAR(50))
begin
update modulo set nombre=panombre,url=paurl,orden=paorden,
                  id_padre=paid_padre,modulo_padre=pamodulo_padre,
                  icono=paicono
where id_modulo=paid_modulo ;

IF (paid_padre=0) THEN
 update modulo set modulo_padre=panombre 
 where id_padre=paid_modulo;
END if;

end$$

DROP PROCEDURE IF EXISTS `pa_u_param`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_param`(p_id_param varchar(100), p_valor varchar(100), p_descripcion varchar(100))
BEGIN

UPDATE param SET valor = p_valor, descripcion = p_descripcion
WHERE id_param = p_id_param;
END$$

DROP PROCEDURE IF EXISTS `pa_u_permisos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_permisos`(IN `paid_perfil` INT, IN `paid_modulo` INT, IN `paestado` CHAR(1))
begin
	IF NOT EXISTS (select * from permisos where id_perfil_usuario=paid_perfil and id_modulo=paid_modulo) 
	THEN 
		INSERT into permisos(id_perfil_usuario, id_modulo, estado) VALUES(paid_perfil,paid_modulo,paestado);	
	ELSE
		UPDATE permisos SET estado=paestado WHERE id_perfil_usuario=paid_perfil and id_modulo=paid_modulo;
	END if;
end$$

DROP PROCEDURE IF EXISTS `pa_u_peus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_peus`(
paid_perfil_usuario int,
padescripcion varchar(30)
)
begin
update perfil_usuario set descripcion=padescripcion 
where id_perfil_usuario=paid_perfil_usuario ;
end$$

DROP PROCEDURE IF EXISTS `pa_u_producto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_producto`(
paid_producto int,
paid_categoria_producto int,
paid_marca int,
papresentacion varchar(30),
paprecio float,
panombre varchar(30),
pastock_min int,
pastock_max int
)
begin
update producto set  id_categoria_producto=paid_categoria_producto,
			id_marca=paid_marca,presentacion=papresentacion,
			precio=paprecio,
			nombre=panombre,stock_min=pastock_min,stock_max=pastock_max
where id_producto=paid_producto;
end$$

DROP PROCEDURE IF EXISTS `pa_u_proveedor`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_proveedor`(
paid_proveedor int,
parazon_social varchar(50),
paruc varchar(11),
patelefono varchar(15),
paemail varchar(50),
padireccion varchar(50),
paid_ubigeo int
)
begin
update proveedor set razon_social=parazon_social,ruc=paruc,telefono=patelefono,email=paemail,
direccion=padireccion,id_ubigeo=paid_ubigeo
where id_proveedor=paid_proveedor;
end$$

DROP PROCEDURE IF EXISTS `pa_u_time`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_time`(
  paid_tipo_membresia int(11),
  padescripcion varchar(30),
  panumero_servicios int(11)
)
begin
update tipo_membresia set descripcion=padescripcion,numero_servicios=panumero_servicios 
where id_tipo_membresia=paid_tipo_membresia;
end$$

DROP PROCEDURE IF EXISTS `pa_u_tiso`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_tiso`(
paid_tipo_socio int(11),
padescripcion varchar(30)
)
begin
update tipo_socio set descripcion=padescripcion
where id_tipo_socio=paid_tipo_socio ;
end$$

DROP PROCEDURE IF EXISTS `pa_u_vigencia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_vigencia`(
  paid_vigencia int(11),
  padescripcion varchar(30),
  padias int(11)
)
begin
update vigencia set descripcion=padescripcion,dias=padias 
where id_vigencia=paid_vigencia;
end$$

DROP PROCEDURE IF EXISTS `sel_departamento`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_departamento`()
begin
SELECT * 
FROM ubigeos
where 
	codigo_region<>'00' 
	and codigo_provincia='00' 
	and codigo_distrito='00';

end$$

DROP PROCEDURE IF EXISTS `sel_distrito`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_distrito`(
   pacod_region varchar(5),
   pacod_provincia varchar(5)
)
begin
SELECT * 
FROM ubigeos
where 
	codigo_region=pacod_region 
	and codigo_provincia=pacod_provincia 
	and codigo_distrito<>'00';

end$$

DROP PROCEDURE IF EXISTS `sel_provincia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_provincia`(
   pacod_region varchar(5)
)
begin
SELECT * 
FROM ubigeos
where 
	codigo_region=pacod_region 
	and codigo_provincia<>'00' 
	and codigo_distrito='00';

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

DROP TABLE IF EXISTS `alertas`;
CREATE TABLE IF NOT EXISTS `alertas` (
  `id_alerta` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `id_almacen` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `descripcion`, `estado`) VALUES
(1, 'Almacen Principal', '1'),
(2, 'Almacen Piso 3', '1'),
(3, 'nuevo', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_producto`
--

DROP TABLE IF EXISTS `almacen_producto`;
CREATE TABLE IF NOT EXISTS `almacen_producto` (
  `id_almacen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen_producto`
--

INSERT INTO `almacen_producto` (`id_almacen`, `id_producto`, `stock`) VALUES
(1, 1, 5),
(1, 2, 10),
(2, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

DROP TABLE IF EXISTS `ambiente`;
CREATE TABLE IF NOT EXISTS `ambiente` (
  `id_ambiente` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ambiente`
--

INSERT INTO `ambiente` (`id_ambiente`, `descripcion`, `estado`) VALUES
(1, 'Planta', '0'),
(2, 'Planta1', '1'),
(3, 'Planta4', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amortizacion_compra`
--

DROP TABLE IF EXISTS `amortizacion_compra`;
CREATE TABLE IF NOT EXISTS `amortizacion_compra` (
  `id_amortizacion_compra` int(11) NOT NULL,
  `id_cuota_compra` int(11) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `monto` float NOT NULL,
  `fecha` date NOT NULL,
  `num_cuota` int(11) NOT NULL,
  `monto_pagado` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amortizacion_matricula`
--

DROP TABLE IF EXISTS `amortizacion_matricula`;
CREATE TABLE IF NOT EXISTS `amortizacion_matricula` (
  `id_amortizacion_matricula` int(11) NOT NULL,
  `id_cuota_matricula` int(11) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amortizacion_venta`
--

DROP TABLE IF EXISTS `amortizacion_venta`;
CREATE TABLE IF NOT EXISTS `amortizacion_venta` (
  `id_amortizacion_venta` int(11) NOT NULL,
  `id_cuota_venta` int(11) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_empleado`
--

DROP TABLE IF EXISTS `asistencia_empleado`;
CREATE TABLE IF NOT EXISTS `asistencia_empleado` (
  `id_asistencia_empleado` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_socio`
--

DROP TABLE IF EXISTS `asistencia_socio`;
CREATE TABLE IF NOT EXISTS `asistencia_socio` (
  `id_asistencia_socio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `id_turno` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_ejercicio`
--

DROP TABLE IF EXISTS `categoria_ejercicio`;
CREATE TABLE IF NOT EXISTS `categoria_ejercicio` (
  `id_categoria_ejercicio` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_ejercicio`
--

INSERT INTO `categoria_ejercicio` (`id_categoria_ejercicio`, `descripcion`, `estado`) VALUES
(1, 'RESISTENCIA4', '1'),
(2, 'Fuerza', '0'),
(3, 'Tonificacion', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_empleado`
--

DROP TABLE IF EXISTS `categoria_empleado`;
CREATE TABLE IF NOT EXISTS `categoria_empleado` (
  `id_categoria_empleado` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_empleado`
--

INSERT INTO `categoria_empleado` (`id_categoria_empleado`, `descripcion`, `estado`) VALUES
(1, 'Gerentes', '1'),
(2, 'Instructor', '0'),
(3, 'Secretaria', '1'),
(4, 'Instructor', '0'),
(5, 'Instructor', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_evento`
--

DROP TABLE IF EXISTS `categoria_evento`;
CREATE TABLE IF NOT EXISTS `categoria_evento` (
  `id_categoria_evento` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_evento`
--

INSERT INTO `categoria_evento` (`id_categoria_evento`, `descripcion`, `estado`) VALUES
(1, 'BAILE', '1'),
(2, 'Caminata2', '0'),
(3, 'Caminata3', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

DROP TABLE IF EXISTS `categoria_producto`;
CREATE TABLE IF NOT EXISTS `categoria_producto` (
  `id_categoria_producto` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`id_categoria_producto`, `descripcion`, `estado`) VALUES
(1, 'Aumento Masa', '1'),
(2, 'Vitaminas & Minerales', '1'),
(3, 'Incremento Masa corporal', '1'),
(4, 'Dieta', '1'),
(5, 'Proteinas', '1'),
(6, 'Aminoacidos', '1'),
(7, 'Energia', '1'),
(8, 'Ã±ojÃ±lkjpoiupo iupoi uopiu op', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_modalidad_transaccion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(18,2) NOT NULL,
  `estado` char(1) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `estado_pago` char(1) NOT NULL,
  `igv` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `id_proveedor`, `id_empleado`, `id_modalidad_transaccion`, `fecha`, `monto`, `estado`, `num_documento`, `estado_pago`, `igv`) VALUES
(1, 1, 1, 1, '2015-10-28', '12.50', '1', '123456-12', '0', '0.00'),
(2, 1, 1, 1, '2015-10-30', '4.50', '1', '', '0', '0.19'),
(3, 1, 1, 1, '2015-10-30', '4.50', '1', '', '0', '0.19'),
(4, 1, 1, 1, '2015-10-30', '4.50', '1', '', '0', '0.19'),
(5, 1, 1, 1, '2015-10-30', '4.50', '1', '', '0', '0.19'),
(6, 1, 1, 1, '2015-10-30', '39.30', '1', '', '0', '0.19'),
(7, 1, 1, 1, '2015-10-30', '4.50', '1', '', '0', '0.19'),
(8, 1, 1, 1, '2015-10-30', '4.50', '1', '', '0', '0.00'),
(9, 1, 1, 1, '2015-10-29', '4.50', '1', '', '0', '0.19'),
(10, 1, 1, 1, '2015-10-28', '19.10', '1', 'nuevo', '0', '0.19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

DROP TABLE IF EXISTS `compra_producto`;
CREATE TABLE IF NOT EXISTS `compra_producto` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_uni` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`id_compra`, `id_producto`, `id_almacen`, `cantidad`, `precio_uni`) VALUES
(7, 1, 0, 1, '4.50'),
(8, 1, 0, 1, '4.50'),
(9, 1, 0, 1, '4.50'),
(10, 1, 1, 2, '4.50'),
(10, 2, 1, 1, '10.10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto_movimiento`
--

DROP TABLE IF EXISTS `concepto_movimiento`;
CREATE TABLE IF NOT EXISTS `concepto_movimiento` (
  `id_concepto_movimiento` int(11) NOT NULL,
  `id_tipo_movimiento` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `concepto_movimiento`
--

INSERT INTO `concepto_movimiento` (`id_concepto_movimiento`, `id_tipo_movimiento`, `descripcion`) VALUES
(2, 0, 'reidratante'),
(3, 1, 'PAGO DE LUZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto_triaje`
--

DROP TABLE IF EXISTS `concepto_triaje`;
CREATE TABLE IF NOT EXISTS `concepto_triaje` (
  `id_concepto_triaje` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `concepto_triaje`
--

INSERT INTO `concepto_triaje` (`id_concepto_triaje`, `descripcion`) VALUES
(1, 'Brazo3'),
(2, 'Deltoides');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota_compra`
--

DROP TABLE IF EXISTS `cuota_compra`;
CREATE TABLE IF NOT EXISTS `cuota_compra` (
  `id_cuota_compra` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `numero_cuota` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota_matricula`
--

DROP TABLE IF EXISTS `cuota_matricula`;
CREATE TABLE IF NOT EXISTS `cuota_matricula` (
  `id_cuota_matricula` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `numero_cuota` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota_venta`
--

DROP TABLE IF EXISTS `cuota_venta`;
CREATE TABLE IF NOT EXISTS `cuota_venta` (
  `id_cuota_venta` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `numero_cuota` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_empresa`
--

DROP TABLE IF EXISTS `datos_empresa`;
CREATE TABLE IF NOT EXISTS `datos_empresa` (
  `id_datos_empresa` int(11) NOT NULL,
  `razon_social` varchar(40) NOT NULL,
  `ruc` char(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `facebook` varchar(500) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `twiter` varchar(500) NOT NULL,
  `instagram` varchar(500) NOT NULL,
  `google_maps` varchar(500) NOT NULL,
  `google_mas` varchar(500) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `mision` varchar(500) NOT NULL,
  `vision` varchar(500) NOT NULL,
  `historia` varchar(1000) NOT NULL,
  `id_ubigeo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_empresa`
--

INSERT INTO `datos_empresa` (`id_datos_empresa`, `razon_social`, `ruc`, `telefono`, `direccion`, `facebook`, `celular`, `twiter`, `instagram`, `google_maps`, `google_mas`, `logo`, `mision`, `vision`, `historia`, `id_ubigeo`) VALUES
(1, 'Olympo Fitnes', '10412117803', '#466268', 'Jr. San Martin N# 422 ', '', '942886594', '', '', '', '', '', '                                                         Inspirar a nuestros miembros inconparable energia para ayudarles a alcanzar sus objetivos individuales; con nuestra amplia experiencia les preeveemos bienestar en base a un esmerado servicio, a un ambiente agradabre y con un personal entrenado en los ultimos conocimientos disponibles.                                                                                                                                                ', '                                                        Ser el mejor Gimnasio de la Region brindando bienestar a nuestos mienbros y en general a la poblacion, generando valor a nuestra empresa, a nuestros colaboradores y a nuestra comunidad                                                                                                                                                ', '                                                        OLYMPO FITNESS es una empresa familiar con grandes aspiraciones de fomentar la salud fÃ­sica y mental, otorgando beneficios a su vida diaria; contamos con instructores capacitados, con aÃ±os de experiencia en la materia, brindamos tambiÃ©n orientaciÃ³n y atenciÃ³n de mÃ©dicos generales, especialistas en traumatologÃ­a c y servicio nutricional. Estamos comprometidos con mejorar la calidad de vida de las personas a travÃ©s de la filosofÃ­a del ejercicio, infraestructura, programas, productos y de inculcar en la vida de toda la comunidad el valor de la salud y el ejercicio.                                                                                                                                                ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

DROP TABLE IF EXISTS `ejercicio`;
CREATE TABLE IF NOT EXISTS `ejercicio` (
  `id_ejercicio` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_categoria_ejercicio` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL,
  `id_categoria_empleado` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido_paterno` varchar(30) NOT NULL,
  `apellido_materno` varchar(30) NOT NULL,
  `dni` char(8) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `grupo_sanguineo` varchar(10) DEFAULT NULL,
  `hobby` varchar(30) DEFAULT NULL,
  `aliass` varchar(30) DEFAULT NULL,
  `nacionalidad` varchar(30) DEFAULT NULL,
  `seguro_medico` varchar(30) DEFAULT NULL,
  `observacion` varchar(250) DEFAULT NULL,
  `antecedente_medico` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `numero_hijo` int(11) DEFAULT NULL,
  `sector` varchar(30) DEFAULT NULL,
  `grado_estudio` varchar(30) DEFAULT NULL,
  `tipo_vivienda` varchar(30) DEFAULT NULL,
  `anio_contratacion` date DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `id_perfil_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `id_categoria_empleado`, `nombre`, `apellido_paterno`, `apellido_materno`, `dni`, `email`, `telefono`, `celular`, `sexo`, `direccion`, `fecha_nacimiento`, `estado_civil`, `estado`, `grupo_sanguineo`, `hobby`, `aliass`, `nacionalidad`, `seguro_medico`, `observacion`, `antecedente_medico`, `codigo_postal`, `numero_hijo`, `sector`, `grado_estudio`, `tipo_vivienda`, `anio_contratacion`, `usuario`, `clave`, `id_perfil_usuario`) VALUES
(1, 1, 'Colbert', 'Calampa', 'Tantachuco', '73031934', '', '', '', '', '', '0000-00-00', '', '1', '', '', '', '', '', '', '', '', 0, '', '', '', '0000-00-00', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(2, 1, 'Javier', 'Melendez', 'Tello', '73031935', '', '', '', '', '', '0000-00-00', '', '1', '', '', '', '', '', '', '', '', 0, '', '', '', '0000-00-00', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

DROP TABLE IF EXISTS `evento`;
CREATE TABLE IF NOT EXISTS `evento` (
  `id_evento` int(11) NOT NULL,
  `id_categoria_evento` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma_pago`
--

DROP TABLE IF EXISTS `forma_pago`;
CREATE TABLE IF NOT EXISTS `forma_pago` (
  `id_forma_pago` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_categoria_empleado`
--

DROP TABLE IF EXISTS `imagen_categoria_empleado`;
CREATE TABLE IF NOT EXISTS `imagen_categoria_empleado` (
  `id_imagen_categoria_empleado` int(11) NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `id_categoria_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_producto`
--

DROP TABLE IF EXISTS `imagen_producto`;
CREATE TABLE IF NOT EXISTS `imagen_producto` (
  `id_imagen_producto` int(11) NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_servicio`
--

DROP TABLE IF EXISTS `imagen_servicio`;
CREATE TABLE IF NOT EXISTS `imagen_servicio` (
  `id_imagen_servicio` int(11) NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `descripcion`) VALUES
(1, 'ON - Optimum Nutrition'),
(2, 'Nutrex'),
(3, 'Ultimate Nutrition'),
(4, 'Musclemeds'),
(5, 'Muscletech'),
(6, 'BPI sports'),
(7, 'Dymatize'),
(8, 'BSN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE IF NOT EXISTS `matricula` (
  `id_matricula` int(11) NOT NULL,
  `id_membresia` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` char(1) DEFAULT NULL,
  `costo` float NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia`
--

DROP TABLE IF EXISTS `membresia`;
CREATE TABLE IF NOT EXISTS `membresia` (
  `id_membresia` int(11) NOT NULL,
  `id_tipo_membresia` int(11) NOT NULL,
  `id_vigencia` int(11) NOT NULL,
  `costo` float NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad_transaccion`
--

DROP TABLE IF EXISTS `modalidad_transaccion`;
CREATE TABLE IF NOT EXISTS `modalidad_transaccion` (
  `id_modalidad_transaccion` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modalidad_transaccion`
--

INSERT INTO `modalidad_transaccion` (`id_modalidad_transaccion`, `descripcion`) VALUES
(1, 'CONTADO'),
(2, 'CREDITO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE IF NOT EXISTS `modulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `modulo_padre` varchar(30) DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `nombre`, `url`, `orden`, `estado`, `id_padre`, `modulo_padre`, `icono`) VALUES
(1, 'Caja', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-MONEY'),
(2, 'Almacen', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-ARCHIVE'),
(3, 'Seguridad', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-LOCK'),
(4, 'Reporte', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-SIGNAL'),
(5, 'Web', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-PUZZLE-PIECE'),
(6, 'Compra', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-SHOPPING-CART'),
(7, 'Venta', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-EXTERNAL-LINK'),
(8, 'Socio', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-GROUP'),
(9, 'Empleado', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-MALE'),
(10, 'Administracion', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-GEARS'),
(11, 'Modulos', 'modulos', NULL, '1', 3, 'Seguridad', NULL),
(12, 'Movimiento', 'movimiento', NULL, '1', 1, 'Caja', ''),
(13, 'Caja', 'caja', NULL, '1', 1, 'Caja', ''),
(14, 'Concepto Movimiento', 'concepto_movimiento', NULL, '1', 1, 'Caja', ''),
(15, 'Cronograma De Pagos', 'cronograma_pago', NULL, '0', 1, 'Caja', ''),
(16, 'Cronograma De Pagos', 'cronograma_pago', NULL, '1', 1, 'Caja', ''),
(17, 'Administracion Caja', 'administracion_caja', NULL, '1', 1, 'Caja', ''),
(18, 'Almacen', 'almacen', NULL, '1', 2, 'Almacen', ''),
(19, 'Producto', 'producto', NULL, '1', 2, 'Almacen', ''),
(20, 'Marca', 'marca', NULL, '1', 2, 'Almacen', ''),
(21, 'Categoria De Producto', 'categoria_producto', NULL, '1', 2, 'Almacen', ''),
(22, 'Configurar Base Datos', 'configurarbd', NULL, '1', 3, 'Seguridad', ''),
(23, 'Perfiles De Usuarios', 'perfiles', NULL, '1', 3, 'Seguridad', ''),
(24, 'Permisos', 'permisos', NULL, '1', 3, 'Seguridad', ''),
(26, 'Ir Web', 'web', NULL, '0', 5, 'Web', ''),
(27, 'Informacion General', 'informacion', NULL, '1', 5, 'Web', ''),
(28, 'Servicios Web', 'servicios_web', NULL, '1', 5, 'Web', ''),
(29, 'Productos Web', 'productos_web', NULL, '1', 5, 'Web', ''),
(30, 'Proveedor', 'proveedor', NULL, '1', 6, 'Compra', ''),
(31, 'Compra', 'compra', NULL, '1', 6, 'Compra', ''),
(32, 'Venta Productos', 'venta_producto', NULL, '1', 7, 'Venta', ''),
(33, 'Servicios', 'servicio', NULL, '1', 7, 'Venta', ''),
(34, 'Membresias', 'membresias', NULL, '1', 7, 'Venta', ''),
(35, 'Socio', 'socio', NULL, '1', 8, 'Socio', ''),
(36, 'Rutina', 'rutina', NULL, '1', 8, 'Socio', ''),
(37, 'Triaje', 'triaje', NULL, '1', 8, 'Socio', ''),
(38, 'Tipo Socio', 'tipo_socio', NULL, '1', 8, 'Socio', ''),
(39, 'Ambientes', 'ambiente', NULL, '1', 10, 'Administracion', ''),
(40, 'Turno', 'turno', NULL, '0', 10, 'Administracion', ''),
(41, 'Forma De Pago', 'forma_pago', NULL, '0', 10, 'Administracion', ''),
(42, 'Categoria Evento', 'categoria_evento', NULL, '1', 52, 'Evento', ''),
(43, 'Categoria De Empleado', 'categoria_empleado', NULL, '1', 9, 'Empleado', ''),
(44, 'Concepto De Triaje', 'concepto_triaje', NULL, '1', 8, 'Socio', ''),
(45, 'Evento', 'evento', NULL, '1', 52, 'Evento', ''),
(46, 'Categoria De Ejercicio', 'categoria_ejercicio', NULL, '1', 10, 'Administracion', ''),
(47, 'Ejercicios', 'ejercicio', NULL, '1', 10, 'Administracion', ''),
(48, 'Tipo De Membresia', 'tipo_membresia', NULL, '1', 7, 'Venta', ''),
(49, 'Vigencia', 'vigencia', NULL, '1', 10, 'Administracion', ''),
(50, 'Ubigeo', 'ubigeo', NULL, '0', 10, 'Administracion', ''),
(51, 'Tipo De Documento', 'tipo_documento', NULL, '1', 1, 'Caja', ''),
(52, 'Evento', '#', NULL, '1', 0, 'MODULO PADRE', 'ICON-SIGNAL'),
(53, 'Empleado', 'empleado', NULL, '1', 9, 'Empleado', ''),
(54, 'Parametros', 'param', NULL, '1', 3, 'Seguridad', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

DROP TABLE IF EXISTS `movimiento`;
CREATE TABLE IF NOT EXISTS `movimiento` (
  `id_movimiento` int(11) NOT NULL,
  `id_sesion_caja` int(11) NOT NULL,
  `id_concepto_movimiento` int(11) NOT NULL,
  `id_forma_pago` int(11) NOT NULL,
  `id_serie_documento` int(11) NOT NULL,
  `monto` float NOT NULL,
  `extornado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param`
--

DROP TABLE IF EXISTS `param`;
CREATE TABLE IF NOT EXISTS `param` (
  `id_param` varchar(30) NOT NULL,
  `valor` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param`
--

INSERT INTO `param` (`id_param`, `valor`, `descripcion`, `estado`) VALUES
('AUTOR', 'FISI', 'c d s e r i', 1),
('CODIGO', 'VALORS', 'DESCRIPCIONS', 0),
('IGV', '0.19', 'CONTROL DEL IGV', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_usuario`
--

DROP TABLE IF EXISTS `perfil_usuario`;
CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `id_perfil_usuario` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`id_perfil_usuario`, `descripcion`, `estado`) VALUES
(0, 'otros', '0'),
(1, 'Admin', '1'),
(2, 'User', '1'),
(3, 'Cajeros', '1'),
(4, 'Gerente', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `estado` char(1) DEFAULT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_perfil_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`estado`, `id_modulo`, `id_perfil_usuario`) VALUES
('1', 11, 1),
('1', 12, 1),
('0', 12, 2),
('1', 13, 1),
('1', 14, 1),
('1', 15, 1),
('1', 16, 1),
('1', 17, 1),
('1', 18, 1),
('1', 19, 1),
('1', 20, 1),
('1', 21, 1),
('1', 22, 1),
('1', 23, 1),
('1', 24, 1),
('1', 25, 1),
('1', 26, 1),
('1', 27, 1),
('1', 28, 1),
('1', 29, 1),
('1', 30, 1),
('1', 31, 1),
('1', 32, 1),
('1', 33, 1),
('1', 34, 1),
('1', 35, 1),
('1', 36, 1),
('1', 37, 1),
('1', 38, 1),
('1', 39, 1),
('1', 40, 1),
('1', 41, 1),
('1', 42, 1),
('1', 43, 1),
('1', 44, 1),
('1', 45, 1),
('1', 46, 1),
('1', 47, 1),
('1', 48, 1),
('1', 49, 1),
('1', 50, 1),
('1', 51, 1),
('1', 52, 1),
('1', 53, 1),
('1', 54, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL,
  `id_categoria_producto` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `presentacion` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` float NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `stock_max` int(11) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_categoria_producto`, `id_marca`, `presentacion`, `stock`, `precio`, `nombre`, `stock_min`, `stock_max`, `estado`) VALUES
(1, 2, 1, 'Frasco', 0, 4.5, 'vit 12', 5, 100, '1'),
(2, 1, 1, 'Unidad', 0, 10.1, 'Gold Whey', 5, 55, '1'),
(3, 1, 1, 'Frasco', 0, 10.1, 'Gold Standard', 5, 55, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `ruc` varchar(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `id_ubigeo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `razon_social`, `ruc`, `telefono`, `email`, `direccion`, `id_ubigeo`) VALUES
(1, 'Master', '12121312312', 'asasas', 'asas', 'asas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

DROP TABLE IF EXISTS `rutina`;
CREATE TABLE IF NOT EXISTS `rutina` (
  `id_rutina` int(11) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `id_categoria_ejercicio` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serie_documento`
--

DROP TABLE IF EXISTS `serie_documento`;
CREATE TABLE IF NOT EXISTS `serie_documento` (
  `id_serie_documento` int(11) NOT NULL,
  `id_tipo_documento` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `numero` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `id_servicio` int(11) NOT NULL,
  `id_ambiente` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_ambiente`, `nombre`, `descripcion`, `estado`) VALUES
(1, 1, 'Maquina', 'tonificacion del cuerpo', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_x_matricula`
--

DROP TABLE IF EXISTS `servicio_x_matricula`;
CREATE TABLE IF NOT EXISTS `servicio_x_matricula` (
  `id_servicio_x_matricula` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion_caja`
--

DROP TABLE IF EXISTS `sesion_caja`;
CREATE TABLE IF NOT EXISTS `sesion_caja` (
  `id_sesion_caja` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL,
  `fecha_entrada` datetime NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `monto_inicio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio`
--

DROP TABLE IF EXISTS `socio`;
CREATE TABLE IF NOT EXISTS `socio` (
  `id_socio` int(11) NOT NULL,
  `id_tipo_socio` int(11) NOT NULL,
  `idubigeo` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `aliass` varchar(50) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido_paterno` varchar(30) NOT NULL,
  `apellido_materno` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `estado_civil` varchar(20) DEFAULT NULL,
  `ocupacion` varchar(50) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `grupo_sanguineo` varchar(10) DEFAULT NULL,
  `hobby` varchar(30) DEFAULT NULL,
  `nacionalidad` varchar(30) DEFAULT NULL,
  `seguro_medico` varchar(30) DEFAULT NULL,
  `observacion` varchar(250) DEFAULT NULL,
  `antecedente_medico` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `numero_hijo` int(11) DEFAULT NULL,
  `sector` varchar(30) DEFAULT NULL,
  `grado_estudio` varchar(30) DEFAULT NULL,
  `ingresos` varchar(30) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `id_perfil_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `socio`
--

INSERT INTO `socio` (`id_socio`, `id_tipo_socio`, `idubigeo`, `dni`, `aliass`, `nombre`, `apellido_paterno`, `apellido_materno`, `email`, `telefono`, `celular`, `direccion`, `fecha_nacimiento`, `sexo`, `estado_civil`, `ocupacion`, `estado`, `grupo_sanguineo`, `hobby`, `nacionalidad`, `seguro_medico`, `observacion`, `antecedente_medico`, `codigo_postal`, `fax`, `numero_hijo`, `sector`, `grado_estudio`, `ingresos`, `usuario`, `clave`, `id_perfil_usuario`) VALUES
(1, 1, 1, '1', 'Col', 'luis', 'fernando', 'aguila', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio_x_evento`
--

DROP TABLE IF EXISTS `socio_x_evento`;
CREATE TABLE IF NOT EXISTS `socio_x_evento` (
  `id_socio_x_evento` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `asistencia` varchar(1) NOT NULL,
  `condicion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `descripcion`) VALUES
(1, 'NUEVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_membresia`
--

DROP TABLE IF EXISTS `tipo_membresia`;
CREATE TABLE IF NOT EXISTS `tipo_membresia` (
  `id_tipo_membresia` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `estado` char(1) NOT NULL,
  `numero_servicios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_membresia`
--

INSERT INTO `tipo_membresia` (`id_tipo_membresia`, `descripcion`, `estado`, `numero_servicios`) VALUES
(1, 'full membresia', '', 0),
(2, 'nuevo', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

DROP TABLE IF EXISTS `tipo_movimiento`;
CREATE TABLE IF NOT EXISTS `tipo_movimiento` (
  `id_tipo_movimiento` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_tipo_movimiento`, `descripcion`) VALUES
(1, 'EGRESO'),
(2, 'INGRESO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_socio`
--

DROP TABLE IF EXISTS `tipo_socio`;
CREATE TABLE IF NOT EXISTS `tipo_socio` (
  `id_tipo_socio` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `triaje`
--

DROP TABLE IF EXISTS `triaje`;
CREATE TABLE IF NOT EXISTS `triaje` (
  `id_triaje` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `id_concepto_triaje` int(11) NOT NULL,
  `unidad_medida` varchar(10) NOT NULL,
  `valor` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `id_turno` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `hora_entrada` datetime NOT NULL,
  `hora_salida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeos`
--

DROP TABLE IF EXISTS `ubigeos`;
CREATE TABLE IF NOT EXISTS `ubigeos` (
`idubigeo` int(6) unsigned NOT NULL,
  `codigo_region` varchar(5) NOT NULL,
  `codigo_provincia` varchar(5) NOT NULL,
  `codigo_distrito` varchar(5) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2060 ;

--
-- Volcado de datos para la tabla `ubigeos`
--

INSERT INTO `ubigeos` (`idubigeo`, `codigo_region`, `codigo_provincia`, `codigo_distrito`, `descripcion`) VALUES
(1, '01', '00', '00', 'AMAZONAS'),
(2, '01', '01', '00', 'CHACHAPOYAS'),
(3, '01', '01', '01', 'CHACHAPOYAS'),
(4, '01', '01', '02', 'ASUNCION'),
(5, '01', '01', '03', 'BALSAS'),
(6, '01', '01', '04', 'CHETO'),
(7, '01', '01', '05', 'CHILIQUIN'),
(8, '01', '01', '06', 'CHUQUIBAMBA'),
(9, '01', '01', '07', 'GRANADA'),
(10, '01', '01', '08', 'HUANCAS'),
(11, '01', '01', '09', 'LA JALCA'),
(12, '01', '01', '10', 'LEIMEBAMBA'),
(13, '01', '01', '11', 'LEVANTO'),
(14, '01', '01', '12', 'MAGDALENA'),
(15, '01', '01', '13', 'MARISCAL CASTILLA'),
(16, '01', '01', '14', 'MOLINOPAMPA'),
(17, '01', '01', '15', 'MONTEVIDEO'),
(18, '01', '01', '16', 'OLLEROS'),
(19, '01', '01', '17', 'QUINJALCA'),
(20, '01', '01', '18', 'SAN FRANCISCO DE DAGUAS'),
(21, '01', '01', '19', 'SAN ISIDRO DE MAINO'),
(22, '01', '01', '20', 'SOLOCO'),
(23, '01', '01', '21', 'SONCHE'),
(24, '01', '02', '00', 'BAGUA'),
(25, '01', '02', '01', 'LA PECA'),
(26, '01', '02', '02', 'ARAMANGO'),
(27, '01', '02', '03', 'COPALLIN'),
(28, '01', '02', '04', 'EL PARCO'),
(29, '01', '02', '05', 'BAGUA'),
(30, '01', '02', '06', 'IMAZA'),
(31, '01', '03', '00', 'BONGARA'),
(32, '01', '03', '01', 'JUMBILLA'),
(33, '01', '03', '02', 'COROSHA'),
(34, '01', '03', '03', 'CUISPES'),
(35, '01', '03', '04', 'CHISQUILLA'),
(36, '01', '03', '05', 'CHURUJA'),
(37, '01', '03', '06', 'FLORIDA'),
(38, '01', '03', '07', 'RECTA'),
(39, '01', '03', '08', 'SAN CARLOS'),
(40, '01', '03', '09', 'SHIPASBAMBA'),
(41, '01', '03', '10', 'VALERA'),
(42, '01', '03', '11', 'YAMBRASBAMBA'),
(43, '01', '03', '12', 'JAZAN'),
(44, '01', '04', '00', 'LUYA'),
(45, '01', '04', '01', 'LAMUD'),
(46, '01', '04', '02', 'CAMPORREDONDO'),
(47, '01', '04', '03', 'COCABAMBA'),
(48, '01', '04', '04', 'COLCAMAR'),
(49, '01', '04', '05', 'CONILA'),
(50, '01', '04', '06', 'INGUILPATA'),
(51, '01', '04', '07', 'LONGUITA'),
(52, '01', '04', '08', 'LONYA CHICO'),
(53, '01', '04', '09', 'LUYA'),
(54, '01', '04', '10', 'LUYA VIEJO'),
(55, '01', '04', '11', 'MARIA'),
(56, '01', '04', '12', 'OCALLI'),
(57, '01', '04', '13', 'OCUMAL'),
(58, '01', '04', '14', 'PISUQUIA'),
(59, '01', '04', '15', 'SAN CRISTOBAL'),
(60, '01', '04', '16', 'SAN FRANCISCO DE YESO'),
(61, '01', '04', '17', 'SAN JERONIMO'),
(62, '01', '04', '18', 'SAN JUAN DE LOPECANCHA'),
(63, '01', '04', '19', 'SANTA CATALINA'),
(64, '01', '04', '20', 'SANTO TOMAS'),
(65, '01', '04', '21', 'TINGO'),
(66, '01', '04', '22', 'TRITA'),
(67, '01', '04', '23', 'PROVIDENCIA'),
(68, '01', '05', '00', 'RODRIGUEZ DE MENDOZA'),
(69, '01', '05', '01', 'SAN NICOLAS'),
(70, '01', '05', '02', 'COCHAMAL'),
(71, '01', '05', '03', 'CHIRIMOTO'),
(72, '01', '05', '04', 'HUAMBO'),
(73, '01', '05', '05', 'LIMABAMBA'),
(74, '01', '05', '06', 'LONGAR'),
(75, '01', '05', '07', 'MILPUCC'),
(76, '01', '05', '08', 'MARISCAL BENAVIDES'),
(77, '01', '05', '09', 'OMIA'),
(78, '01', '05', '10', 'SANTA ROSA'),
(79, '01', '05', '11', 'TOTORA'),
(80, '01', '05', '12', 'VISTA ALEGRE'),
(81, '01', '06', '00', 'CONDORCANQUI'),
(82, '01', '06', '01', 'NIEVA'),
(83, '01', '06', '02', 'RIO SANTIAGO'),
(84, '01', '06', '03', 'EL CENEPA'),
(85, '01', '07', '00', 'UTCUBAMBA'),
(86, '01', '07', '01', 'BAGUA GRANDE'),
(87, '01', '07', '02', 'CAJARURO'),
(88, '01', '07', '03', 'CUMBA'),
(89, '01', '07', '04', 'EL MILAGRO'),
(90, '01', '07', '05', 'JAMALCA'),
(91, '01', '07', '06', 'LONYA GRANDE'),
(92, '01', '07', '07', 'YAMON'),
(93, '02', '00', '00', 'ANCASH'),
(94, '02', '01', '00', 'HUARAZ'),
(95, '02', '01', '01', 'HUARAZ'),
(96, '02', '01', '02', 'INDEPENDENCIA'),
(97, '02', '01', '03', 'COCHABAMBA'),
(98, '02', '01', '04', 'COLCABAMBA'),
(99, '02', '01', '05', 'HUANCHAY'),
(100, '02', '01', '06', 'JANGAS'),
(101, '02', '01', '07', 'LA LIBERTAD'),
(102, '02', '01', '08', 'OLLEROS'),
(103, '02', '01', '09', 'PAMPAS GRANDE'),
(104, '02', '01', '10', 'PARIACOTO'),
(105, '02', '01', '11', 'PIRA'),
(106, '02', '01', '12', 'TARICA'),
(107, '02', '02', '00', 'AIJA'),
(108, '02', '02', '01', 'AIJA'),
(109, '02', '02', '03', 'CORIS'),
(110, '02', '02', '05', 'HUACLLAN'),
(111, '02', '02', '06', 'LA MERCED'),
(112, '02', '02', '08', 'SUCCHA'),
(113, '02', '03', '00', 'BOLOGNESI'),
(114, '02', '03', '01', 'CHIQUIAN'),
(115, '02', '03', '02', 'ABELARDO PARDO LEZAMETA'),
(116, '02', '03', '04', 'AQUIA'),
(117, '02', '03', '05', 'CAJACAY'),
(118, '02', '03', '10', 'HUAYLLACAYAN'),
(119, '02', '03', '11', 'HUASTA'),
(120, '02', '03', '13', 'MANGAS'),
(121, '02', '03', '15', 'PACLLON'),
(122, '02', '03', '17', 'SAN MIGUEL DE CORPANQUI'),
(123, '02', '03', '20', 'TICLLOS'),
(124, '02', '03', '21', 'ANTONIO RAIMONDI'),
(125, '02', '03', '22', 'CANIS'),
(126, '02', '03', '23', 'COLQUIOC'),
(127, '02', '03', '24', 'LA PRIMAVERA'),
(128, '02', '03', '25', 'HUALLANCA'),
(129, '02', '04', '00', 'CARHUAZ'),
(130, '02', '04', '01', 'CARHUAZ'),
(131, '02', '04', '02', 'ACOPAMPA'),
(132, '02', '04', '03', 'AMASHCA'),
(133, '02', '04', '04', 'ANTA'),
(134, '02', '04', '05', 'ATAQUERO'),
(135, '02', '04', '06', 'MARCARA'),
(136, '02', '04', '07', 'PARIAHUANCA'),
(137, '02', '04', '08', 'SAN MIGUEL DE ACO'),
(138, '02', '04', '09', 'SHILLA'),
(139, '02', '04', '10', 'TINCO'),
(140, '02', '04', '11', 'YUNGAR'),
(141, '02', '05', '00', 'CASMA'),
(142, '02', '05', '01', 'CASMA'),
(143, '02', '05', '02', 'BUENA VISTA ALTA'),
(144, '02', '05', '03', 'COMANDANTE NOEL'),
(145, '02', '05', '05', 'YAUTAN'),
(146, '02', '06', '00', 'CORONGO'),
(147, '02', '06', '01', 'CORONGO'),
(148, '02', '06', '02', 'ACO'),
(149, '02', '06', '03', 'BAMBAS'),
(150, '02', '06', '04', 'CUSCA'),
(151, '02', '06', '05', 'LA PAMPA'),
(152, '02', '06', '06', 'YANAC'),
(153, '02', '06', '07', 'YUPAN'),
(154, '02', '07', '00', 'HUAYLAS'),
(155, '02', '07', '01', 'CARAZ'),
(156, '02', '07', '02', 'HUALLANCA'),
(157, '02', '07', '03', 'HUATA'),
(158, '02', '07', '04', 'HUAYLAS'),
(159, '02', '07', '05', 'MATO'),
(160, '02', '07', '06', 'PAMPAROMAS'),
(161, '02', '07', '07', 'PUEBLO LIBRE'),
(162, '02', '07', '08', 'SANTA CRUZ'),
(163, '02', '07', '09', 'YURACMARCA'),
(164, '02', '07', '10', 'SANTO TORIBIO'),
(165, '02', '08', '00', 'HUARI'),
(166, '02', '08', '01', 'HUARI'),
(167, '02', '08', '02', 'CAJAY'),
(168, '02', '08', '03', 'CHAVIN DE HUANTAR'),
(169, '02', '08', '04', 'HUACACHI'),
(170, '02', '08', '05', 'HUACHIS'),
(171, '02', '08', '06', 'HUACCHIS'),
(172, '02', '08', '07', 'HUANTAR'),
(173, '02', '08', '08', 'MASIN'),
(174, '02', '08', '09', 'PAUCAS'),
(175, '02', '08', '10', 'PONTO'),
(176, '02', '08', '11', 'RAHUAPAMPA'),
(177, '02', '08', '12', 'RAPAYAN'),
(178, '02', '08', '13', 'SAN MARCOS'),
(179, '02', '08', '14', 'SAN PEDRO DE CHANA'),
(180, '02', '08', '15', 'UCO'),
(181, '02', '08', '16', 'ANRA'),
(182, '02', '09', '00', 'MARISCAL LUZURIAGA'),
(183, '02', '09', '01', 'PISCOBAMBA'),
(184, '02', '09', '02', 'CASCA'),
(185, '02', '09', '03', 'LUCMA'),
(186, '02', '09', '04', 'FIDEL OLIVAS ESCUDERO'),
(187, '02', '09', '05', 'LLAMA'),
(188, '02', '09', '06', 'LLUMPA'),
(189, '02', '09', '07', 'MUSGA'),
(190, '02', '09', '08', 'ELEAZAR GUZMAN BARRON'),
(191, '02', '10', '00', 'PALLASCA'),
(192, '02', '10', '01', 'CABANA'),
(193, '02', '10', '02', 'BOLOGNESI'),
(194, '02', '10', '03', 'CONCHUCOS'),
(195, '02', '10', '04', 'HUACASCHUQUE'),
(196, '02', '10', '05', 'HUANDOVAL'),
(197, '02', '10', '06', 'LACABAMBA'),
(198, '02', '10', '07', 'LLAPO'),
(199, '02', '10', '08', 'PALLASCA'),
(200, '02', '10', '09', 'PAMPAS'),
(201, '02', '10', '10', 'SANTA ROSA'),
(202, '02', '10', '11', 'TAUCA'),
(203, '02', '11', '00', 'POMABAMBA'),
(204, '02', '11', '01', 'POMABAMBA'),
(205, '02', '11', '02', 'HUAYLLAN'),
(206, '02', '11', '03', 'PAROBAMBA'),
(207, '02', '11', '04', 'QUINUABAMBA'),
(208, '02', '12', '00', 'RECUAY'),
(209, '02', '12', '01', 'RECUAY'),
(210, '02', '12', '02', 'COTAPARACO'),
(211, '02', '12', '03', 'HUAYLLAPAMPA'),
(212, '02', '12', '04', 'MARCA'),
(213, '02', '12', '05', 'PAMPAS CHICO'),
(214, '02', '12', '06', 'PARARIN'),
(215, '02', '12', '07', 'TAPACOCHA'),
(216, '02', '12', '08', 'TICAPAMPA'),
(217, '02', '12', '09', 'LLACLLIN'),
(218, '02', '12', '10', 'CATAC'),
(219, '02', '13', '00', 'SANTA'),
(220, '02', '13', '01', 'CHIMBOTE'),
(221, '02', '13', '02', 'CACERES DEL PERU'),
(222, '02', '13', '03', 'MACATE'),
(223, '02', '13', '04', 'MORO'),
(224, '02', '13', '05', 'NEPEÑA'),
(225, '02', '13', '06', 'SAMANCO'),
(226, '02', '13', '07', 'SANTA'),
(227, '02', '13', '08', 'COISHCO'),
(228, '02', '13', '09', 'NUEVO CHIMBOTE'),
(229, '02', '14', '00', 'SIHUAS'),
(230, '02', '14', '01', 'SIHUAS'),
(231, '02', '14', '02', 'ALFONSO UGARTE'),
(232, '02', '14', '03', 'CHINGALPO'),
(233, '02', '14', '04', 'HUAYLLABAMBA'),
(234, '02', '14', '05', 'QUICHES'),
(235, '02', '14', '06', 'SICSIBAMBA'),
(236, '02', '14', '07', 'ACOBAMBA'),
(237, '02', '14', '08', 'CASHAPAMPA'),
(238, '02', '14', '09', 'RAGASH'),
(239, '02', '14', '10', 'SAN JUAN'),
(240, '02', '15', '00', 'YUNGAY'),
(241, '02', '15', '01', 'YUNGAY'),
(242, '02', '15', '02', 'CASCAPARA'),
(243, '02', '15', '03', 'MANCOS'),
(244, '02', '15', '04', 'MATACOTO'),
(245, '02', '15', '05', 'QUILLO'),
(246, '02', '15', '06', 'RANRAHIRCA'),
(247, '02', '15', '07', 'SHUPLUY'),
(248, '02', '15', '08', 'YANAMA'),
(249, '02', '16', '00', 'ANTONIO RAIMONDI'),
(250, '02', '16', '01', 'LLAMELLIN'),
(251, '02', '16', '02', 'ACZO'),
(252, '02', '16', '03', 'CHACCHO'),
(253, '02', '16', '04', 'CHINGAS'),
(254, '02', '16', '05', 'MIRGAS'),
(255, '02', '16', '06', 'SAN JUAN DE RONTOY'),
(256, '02', '17', '00', 'CARLOS FERMIN FITZCARRALD'),
(257, '02', '17', '01', 'SAN LUIS'),
(258, '02', '17', '02', 'YAUYA'),
(259, '02', '17', '03', 'SAN NICOLAS'),
(260, '02', '18', '00', 'ASUNCION'),
(261, '02', '18', '01', 'CHACAS'),
(262, '02', '18', '02', 'ACOCHACA'),
(263, '02', '19', '00', 'HUARMEY'),
(264, '02', '19', '01', 'HUARMEY'),
(265, '02', '19', '02', 'COCHAPETI'),
(266, '02', '19', '03', 'HUAYAN'),
(267, '02', '19', '04', 'MALVAS'),
(268, '02', '19', '05', 'CULEBRAS'),
(269, '02', '20', '00', 'OCROS'),
(270, '02', '20', '01', 'ACAS'),
(271, '02', '20', '02', 'CAJAMARQUILLA'),
(272, '02', '20', '03', 'CARHUAPAMPA'),
(273, '02', '20', '04', 'COCHAS'),
(274, '02', '20', '05', 'CONGAS'),
(275, '02', '20', '06', 'LLIPA'),
(276, '02', '20', '07', 'OCROS'),
(277, '02', '20', '08', 'SAN CRISTOBAL DE RAJAN'),
(278, '02', '20', '09', 'SAN PEDRO'),
(279, '02', '20', '10', 'SANTIAGO DE CHILCAS'),
(280, '03', '00', '00', 'APURIMAC'),
(281, '03', '01', '00', 'ABANCAY'),
(282, '03', '01', '01', 'ABANCAY'),
(283, '03', '01', '02', 'CIRCA'),
(284, '03', '01', '03', 'CURAHUASI'),
(285, '03', '01', '04', 'CHACOCHE'),
(286, '03', '01', '05', 'HUANIPACA'),
(287, '03', '01', '06', 'LAMBRAMA'),
(288, '03', '01', '07', 'PICHIRHUA'),
(289, '03', '01', '08', 'SAN PEDRO DE CACHORA'),
(290, '03', '01', '09', 'TAMBURCO'),
(291, '03', '02', '00', 'AYMARAES'),
(292, '03', '02', '01', 'CHALHUANCA'),
(293, '03', '02', '02', 'CAPAYA'),
(294, '03', '02', '03', 'CARAYBAMBA'),
(295, '03', '02', '04', 'COLCABAMBA'),
(296, '03', '02', '05', 'COTARUSE'),
(297, '03', '02', '06', 'CHAPIMARCA'),
(298, '03', '02', '07', 'HUAYLLO'),
(299, '03', '02', '08', 'LUCRE'),
(300, '03', '02', '09', 'POCOHUANCA'),
(301, '03', '02', '10', 'SAÑAYCA'),
(302, '03', '02', '11', 'SORAYA'),
(303, '03', '02', '12', 'TAPAIRIHUA'),
(304, '03', '02', '13', 'TINTAY'),
(305, '03', '02', '14', 'TORAYA'),
(306, '03', '02', '15', 'YANACA'),
(307, '03', '02', '16', 'SAN JUAN DE CHACÑA'),
(308, '03', '02', '17', 'JUSTO APU SAHUARAURA'),
(309, '03', '03', '00', 'ANDAHUAYLAS'),
(310, '03', '03', '01', 'ANDAHUAYLAS'),
(311, '03', '03', '02', 'ANDARAPA'),
(312, '03', '03', '03', 'CHIARA'),
(313, '03', '03', '04', 'HUANCARAMA'),
(314, '03', '03', '05', 'HUANCARAY'),
(315, '03', '03', '06', 'KISHUARA'),
(316, '03', '03', '07', 'PACOBAMBA'),
(317, '03', '03', '08', 'PAMPACHIRI'),
(318, '03', '03', '09', 'SAN ANTONIO DE CACHI'),
(319, '03', '03', '10', 'SAN JERONIMO'),
(320, '03', '03', '11', 'TALAVERA'),
(321, '03', '03', '12', 'TURPO'),
(322, '03', '03', '13', 'PACUCHA'),
(323, '03', '03', '14', 'POMACOCHA'),
(324, '03', '03', '15', 'SANTA MARIA DE CHICMO'),
(325, '03', '03', '16', 'TUMAY HUARACA'),
(326, '03', '03', '17', 'HUAYANA'),
(327, '03', '03', '18', 'SAN MIGUEL DE CHACCRAMPA'),
(328, '03', '03', '19', 'KAQUIABAMBA'),
(329, '03', '04', '00', 'ANTABAMBA'),
(330, '03', '04', '01', 'ANTABAMBA'),
(331, '03', '04', '02', 'EL ORO'),
(332, '03', '04', '03', 'HUAQUIRCA'),
(333, '03', '04', '04', 'JUAN ESPINOZA MEDRANO'),
(334, '03', '04', '05', 'OROPESA'),
(335, '03', '04', '06', 'PACHACONAS'),
(336, '03', '04', '07', 'SABAINO'),
(337, '03', '05', '00', 'COTABAMBAS'),
(338, '03', '05', '01', 'TAMBOBAMBA'),
(339, '03', '05', '02', 'COYLLURQUI'),
(340, '03', '05', '03', 'COTABAMBAS'),
(341, '03', '05', '04', 'HAQUIRA'),
(342, '03', '05', '05', 'MARA'),
(343, '03', '05', '06', 'CHALLHUAHUACHO'),
(344, '03', '06', '00', 'GRAU'),
(345, '03', '06', '01', 'CHUQUIBAMBILLA'),
(346, '03', '06', '02', 'CURPAHUASI'),
(347, '03', '06', '03', 'HUAILLATI'),
(348, '03', '06', '04', 'MAMARA'),
(349, '03', '06', '05', 'MARISCAL GAMARRA'),
(350, '03', '06', '06', 'MICAELA BASTIDAS'),
(351, '03', '06', '07', 'PROGRESO'),
(352, '03', '06', '08', 'PATAYPAMPA'),
(353, '03', '06', '09', 'SAN ANTONIO'),
(354, '03', '06', '10', 'TURPAY'),
(355, '03', '06', '11', 'VILCABAMBA'),
(356, '03', '06', '12', 'VIRUNDO'),
(357, '03', '06', '13', 'SANTA ROSA'),
(358, '03', '06', '14', 'CURASCO'),
(359, '03', '07', '00', 'CHINCHEROS'),
(360, '03', '07', '01', 'CHINCHEROS'),
(361, '03', '07', '02', 'ONGOY'),
(362, '03', '07', '03', 'OCOBAMBA'),
(363, '03', '07', '04', 'COCHARCAS'),
(364, '03', '07', '05', 'ANCO HUALLO'),
(365, '03', '07', '06', 'HUACCANA'),
(366, '03', '07', '07', 'URANMARCA'),
(367, '03', '07', '08', 'RANRACANCHA'),
(368, '04', '00', '00', 'AREQUIPA'),
(369, '04', '01', '00', 'AREQUIPA'),
(370, '04', '01', '01', 'AREQUIPA'),
(371, '04', '01', '02', 'CAYMA'),
(372, '04', '01', '03', 'CERRO COLORADO'),
(373, '04', '01', '04', 'CHARACATO'),
(374, '04', '01', '05', 'CHIGUATA'),
(375, '04', '01', '06', 'LA JOYA'),
(376, '04', '01', '07', 'MIRAFLORES'),
(377, '04', '01', '08', 'MOLLEBAYA'),
(378, '04', '01', '09', 'PAUCARPATA'),
(379, '04', '01', '10', 'POCSI'),
(380, '04', '01', '11', 'POLOBAYA'),
(381, '04', '01', '12', 'QUEQUEÑA'),
(382, '04', '01', '13', 'SABANDIA'),
(383, '04', '01', '14', 'SACHACA'),
(384, '04', '01', '15', 'SAN JUAN DE SIGUAS'),
(385, '04', '01', '16', 'SAN JUAN DE TARUCANI'),
(386, '04', '01', '17', 'SANTA ISABEL DE SIGUAS'),
(387, '04', '01', '18', 'SANTA RITA DE SIHUAS'),
(388, '04', '01', '19', 'SOCABAYA'),
(389, '04', '01', '20', 'TIABAYA'),
(390, '04', '01', '21', 'UCHUMAYO'),
(391, '04', '01', '22', 'VITOR'),
(392, '04', '01', '23', 'YANAHUARA'),
(393, '04', '01', '24', 'YARABAMBA'),
(394, '04', '01', '25', 'YURA'),
(395, '04', '01', '26', 'MARIANO MELGAR'),
(396, '04', '01', '27', 'JACOBO HUNTER'),
(397, '04', '01', '28', 'ALTO SELVA ALEGRE'),
(398, '04', '01', '29', 'JOSE LUIS BUSTAMANTE Y RIVERO'),
(399, '04', '02', '00', 'CAYLLOMA'),
(400, '04', '02', '01', 'CHIVAY'),
(401, '04', '02', '02', 'ACHOMA'),
(402, '04', '02', '03', 'CABANACONDE'),
(403, '04', '02', '04', 'CAYLLOMA'),
(404, '04', '02', '05', 'CALLALLI'),
(405, '04', '02', '06', 'COPORAQUE'),
(406, '04', '02', '07', 'HUAMBO'),
(407, '04', '02', '08', 'HUANCA'),
(408, '04', '02', '09', 'ICHUPAMPA'),
(409, '04', '02', '10', 'LARI'),
(410, '04', '02', '11', 'LLUTA'),
(411, '04', '02', '12', 'MACA'),
(412, '04', '02', '13', 'MADRIGAL'),
(413, '04', '02', '14', 'SAN ANTONIO DE CHUCA'),
(414, '04', '02', '15', 'SIBAYO'),
(415, '04', '02', '16', 'TAPAY'),
(416, '04', '02', '17', 'TISCO'),
(417, '04', '02', '18', 'TUTI'),
(418, '04', '02', '19', 'YANQUE'),
(419, '04', '02', '20', 'MAJES'),
(420, '04', '03', '00', 'CAMANA'),
(421, '04', '03', '01', 'CAMANA'),
(422, '04', '03', '02', 'JOSE MARIA QUIMPER'),
(423, '04', '03', '03', 'MARIANO NICOLAS VALCARCEL'),
(424, '04', '03', '04', 'MARISCAL CACERES'),
(425, '04', '03', '05', 'NICOLAS DE PIEROLA'),
(426, '04', '03', '06', 'OCOÑA'),
(427, '04', '03', '07', 'QUILCA'),
(428, '04', '03', '08', 'SAMUEL PASTOR'),
(429, '04', '04', '00', 'CARAVELI'),
(430, '04', '04', '01', 'CARAVELI'),
(431, '04', '04', '02', 'ACARI'),
(432, '04', '04', '03', 'ATICO'),
(433, '04', '04', '04', 'ATIQUIPA'),
(434, '04', '04', '05', 'BELLA UNION'),
(435, '04', '04', '06', 'CAHUACHO'),
(436, '04', '04', '07', 'CHALA'),
(437, '04', '04', '08', 'CHAPARRA'),
(438, '04', '04', '09', 'HUANUHUANU'),
(439, '04', '04', '10', 'JAQUI'),
(440, '04', '04', '11', 'LOMAS'),
(441, '04', '04', '12', 'QUICACHA'),
(442, '04', '04', '13', 'YAUCA'),
(443, '04', '05', '00', 'CASTILLA'),
(444, '04', '05', '01', 'APLAO'),
(445, '04', '05', '02', 'ANDAGUA'),
(446, '04', '05', '03', 'AYO'),
(447, '04', '05', '04', 'CHACHAS'),
(448, '04', '05', '05', 'CHILCAYMARCA'),
(449, '04', '05', '06', 'CHOCO'),
(450, '04', '05', '07', 'HUANCARQUI'),
(451, '04', '05', '08', 'MACHAGUAY'),
(452, '04', '05', '09', 'ORCOPAMPA'),
(453, '04', '05', '10', 'PAMPACOLCA'),
(454, '04', '05', '11', 'TIPAN'),
(455, '04', '05', '12', 'URACA'),
(456, '04', '05', '13', 'UÑON'),
(457, '04', '05', '14', 'VIRACO'),
(458, '04', '06', '00', 'CONDESUYOS'),
(459, '04', '06', '01', 'CHUQUIBAMBA'),
(460, '04', '06', '02', 'ANDARAY'),
(461, '04', '06', '03', 'CAYARANI'),
(462, '04', '06', '04', 'CHICHAS'),
(463, '04', '06', '05', 'IRAY'),
(464, '04', '06', '06', 'SALAMANCA'),
(465, '04', '06', '07', 'YANAQUIHUA'),
(466, '04', '06', '08', 'RIO GRANDE'),
(467, '04', '07', '00', 'ISLAY'),
(468, '04', '07', '01', 'MOLLENDO'),
(469, '04', '07', '02', 'COCACHACRA'),
(470, '04', '07', '03', 'DEAN VALDIVIA'),
(471, '04', '07', '04', 'ISLAY'),
(472, '04', '07', '05', 'MEJIA'),
(473, '04', '07', '06', 'PUNTA DE BOMBON'),
(474, '04', '08', '00', 'LA UNION'),
(475, '04', '08', '01', 'COTAHUASI'),
(476, '04', '08', '02', 'ALCA'),
(477, '04', '08', '03', 'CHARCANA'),
(478, '04', '08', '04', 'HUAYNACOTAS'),
(479, '04', '08', '05', 'PAMPAMARCA'),
(480, '04', '08', '06', 'PUYCA'),
(481, '04', '08', '07', 'QUECHUALLA'),
(482, '04', '08', '08', 'SAYLA'),
(483, '04', '08', '09', 'TAURIA'),
(484, '04', '08', '10', 'TOMEPAMPA'),
(485, '04', '08', '11', 'TORO'),
(486, '05', '00', '00', 'AYACUCHO'),
(487, '05', '01', '00', 'HUAMANGA'),
(488, '05', '01', '01', 'AYACUCHO'),
(489, '05', '01', '02', 'ACOS VINCHOS'),
(490, '05', '01', '03', 'CARMEN ALTO'),
(491, '05', '01', '04', 'CHIARA'),
(492, '05', '01', '05', 'QUINUA'),
(493, '05', '01', '06', 'SAN JOSE DE TICLLAS'),
(494, '05', '01', '07', 'SAN JUAN BAUTISTA'),
(495, '05', '01', '08', 'SANTIAGO DE PISCHA'),
(496, '05', '01', '09', 'VINCHOS'),
(497, '05', '01', '10', 'TAMBILLO'),
(498, '05', '01', '11', 'ACOCRO'),
(499, '05', '01', '12', 'SOCOS'),
(500, '05', '01', '13', 'OCROS'),
(501, '05', '01', '14', 'PACAYCASA'),
(502, '05', '01', '15', 'JESUS NAZARENO'),
(503, '05', '02', '00', 'CANGALLO'),
(504, '05', '02', '01', 'CANGALLO'),
(505, '05', '02', '04', 'CHUSCHI'),
(506, '05', '02', '06', 'LOS MOROCHUCOS'),
(507, '05', '02', '07', 'PARAS'),
(508, '05', '02', '08', 'TOTOS'),
(509, '05', '02', '11', 'MARIA PARADO DE BELLIDO'),
(510, '05', '03', '00', 'HUANTA'),
(511, '05', '03', '01', 'HUANTA'),
(512, '05', '03', '02', 'AYAHUANCO'),
(513, '05', '03', '03', 'HUAMANGUILLA'),
(514, '05', '03', '04', 'IGUAIN'),
(515, '05', '03', '05', 'LURICOCHA'),
(516, '05', '03', '07', 'SANTILLANA'),
(517, '05', '03', '08', 'SIVIA'),
(518, '05', '03', '09', 'LLOCHEGUA'),
(519, '05', '04', '00', 'LA MAR'),
(520, '05', '04', '01', 'SAN MIGUEL'),
(521, '05', '04', '02', 'ANCO'),
(522, '05', '04', '03', 'AYNA'),
(523, '05', '04', '04', 'CHILCAS'),
(524, '05', '04', '05', 'CHUNGUI'),
(525, '05', '04', '06', 'TAMBO'),
(526, '05', '04', '07', 'LUIS CARRANZA'),
(527, '05', '04', '08', 'SANTA ROSA'),
(528, '05', '04', '09', 'SAMUGARI'),
(529, '05', '05', '00', 'LUCANAS'),
(530, '05', '05', '01', 'PUQUIO'),
(531, '05', '05', '02', 'AUCARA'),
(532, '05', '05', '03', 'CABANA'),
(533, '05', '05', '04', 'CARMEN SALCEDO'),
(534, '05', '05', '06', 'CHAVIÑA'),
(535, '05', '05', '08', 'CHIPAO'),
(536, '05', '05', '10', 'HUAC-HUAS'),
(537, '05', '05', '11', 'LARAMATE'),
(538, '05', '05', '12', 'LEONCIO PRADO'),
(539, '05', '05', '13', 'LUCANAS'),
(540, '05', '05', '14', 'LLAUTA'),
(541, '05', '05', '16', 'OCAÑA'),
(542, '05', '05', '17', 'OTOCA'),
(543, '05', '05', '20', 'SANCOS'),
(544, '05', '05', '21', 'SAN JUAN'),
(545, '05', '05', '22', 'SAN PEDRO'),
(546, '05', '05', '24', 'SANTA ANA DE HUAYCAHUACHO'),
(547, '05', '05', '25', 'SANTA LUCIA'),
(548, '05', '05', '29', 'SAISA'),
(549, '05', '05', '31', 'SAN PEDRO DE PALCO'),
(550, '05', '05', '32', 'SAN CRISTOBAL'),
(551, '05', '06', '00', 'PARINACOCHAS'),
(552, '05', '06', '01', 'CORACORA'),
(553, '05', '06', '04', 'CORONEL CASTAÑEDA'),
(554, '05', '06', '05', 'CHUMPI'),
(555, '05', '06', '08', 'PACAPAUSA'),
(556, '05', '06', '11', 'PULLO'),
(557, '05', '06', '12', 'PUYUSCA'),
(558, '05', '06', '15', 'SAN FRANCISCO DE RAVACAYCO'),
(559, '05', '06', '16', 'UPAHUACHO'),
(560, '05', '07', '00', 'VICTOR FAJARDO'),
(561, '05', '07', '01', 'HUANCAPI'),
(562, '05', '07', '02', 'ALCAMENCA'),
(563, '05', '07', '03', 'APONGO'),
(564, '05', '07', '04', 'CANARIA'),
(565, '05', '07', '06', 'CAYARA'),
(566, '05', '07', '07', 'COLCA'),
(567, '05', '07', '08', 'HUALLA'),
(568, '05', '07', '09', 'HUAMANQUIQUIA'),
(569, '05', '07', '10', 'HUANCARAYLLA'),
(570, '05', '07', '13', 'SARHUA'),
(571, '05', '07', '14', 'VILCANCHOS'),
(572, '05', '07', '15', 'ASQUIPATA'),
(573, '05', '08', '00', 'HUANCA SANCOS'),
(574, '05', '08', '01', 'SANCOS'),
(575, '05', '08', '02', 'SACSAMARCA'),
(576, '05', '08', '03', 'SANTIAGO DE LUCANAMARCA'),
(577, '05', '08', '04', 'CARAPO'),
(578, '05', '09', '00', 'VILCAS HUAMAN'),
(579, '05', '09', '01', 'VILCAS HUAMAN'),
(580, '05', '09', '02', 'VISCHONGO'),
(581, '05', '09', '03', 'ACCOMARCA'),
(582, '05', '09', '04', 'CARHUANCA'),
(583, '05', '09', '05', 'CONCEPCION'),
(584, '05', '09', '06', 'HUAMBALPA'),
(585, '05', '09', '07', 'SAURAMA'),
(586, '05', '09', '08', 'INDEPENDENCIA'),
(587, '05', '10', '00', 'PAUCAR DEL SARA SARA'),
(588, '05', '10', '01', 'PAUSA'),
(589, '05', '10', '02', 'COLTA'),
(590, '05', '10', '03', 'CORCULLA'),
(591, '05', '10', '04', 'LAMPA'),
(592, '05', '10', '05', 'MARCABAMBA'),
(593, '05', '10', '06', 'OYOLO'),
(594, '05', '10', '07', 'PARARCA'),
(595, '05', '10', '08', 'SAN JAVIER DE ALPABAMBA'),
(596, '05', '10', '09', 'SAN JOSE DE USHUA'),
(597, '05', '10', '10', 'SARA SARA'),
(598, '05', '11', '00', 'SUCRE'),
(599, '05', '11', '01', 'QUEROBAMBA'),
(600, '05', '11', '02', 'BELEN'),
(601, '05', '11', '03', 'CHALCOS'),
(602, '05', '11', '04', 'SAN SALVADOR DE QUIJE'),
(603, '05', '11', '05', 'PAICO'),
(604, '05', '11', '06', 'SANTIAGO DE PAUCARAY'),
(605, '05', '11', '07', 'SAN PEDRO DE LARCAY'),
(606, '05', '11', '08', 'SORAS'),
(607, '05', '11', '09', 'HUACAÑA'),
(608, '05', '11', '10', 'CHILCAYOC'),
(609, '05', '11', '11', 'MORCOLLA'),
(610, '06', '00', '00', 'CAJAMARCA'),
(611, '06', '01', '00', 'CAJAMARCA'),
(612, '06', '01', '01', 'CAJAMARCA'),
(613, '06', '01', '02', 'ASUNCION'),
(614, '06', '01', '03', 'COSPAN'),
(615, '06', '01', '04', 'CHETILLA'),
(616, '06', '01', '05', 'ENCAÑADA'),
(617, '06', '01', '06', 'JESUS'),
(618, '06', '01', '07', 'LOS BAÑOS DEL INCA'),
(619, '06', '01', '08', 'LLACANORA'),
(620, '06', '01', '09', 'MAGDALENA'),
(621, '06', '01', '10', 'MATARA'),
(622, '06', '01', '11', 'NAMORA'),
(623, '06', '01', '12', 'SAN JUAN'),
(624, '06', '02', '00', 'CAJABAMBA'),
(625, '06', '02', '01', 'CAJABAMBA'),
(626, '06', '02', '02', 'CACHACHI'),
(627, '06', '02', '03', 'CONDEBAMBA'),
(628, '06', '02', '05', 'SITACOCHA'),
(629, '06', '03', '00', 'CELENDIN'),
(630, '06', '03', '01', 'CELENDIN'),
(631, '06', '03', '02', 'CORTEGANA'),
(632, '06', '03', '03', 'CHUMUCH'),
(633, '06', '03', '04', 'HUASMIN'),
(634, '06', '03', '05', 'JORGE CHAVEZ'),
(635, '06', '03', '06', 'JOSE GALVEZ'),
(636, '06', '03', '07', 'MIGUEL IGLESIAS'),
(637, '06', '03', '08', 'OXAMARCA'),
(638, '06', '03', '09', 'SOROCHUCO'),
(639, '06', '03', '10', 'SUCRE'),
(640, '06', '03', '11', 'UTCO'),
(641, '06', '03', '12', 'LA LIBERTAD DE PALLAN'),
(642, '06', '04', '00', 'CONTUMAZA'),
(643, '06', '04', '01', 'CONTUMAZA'),
(644, '06', '04', '03', 'CHILETE'),
(645, '06', '04', '04', 'GUZMANGO'),
(646, '06', '04', '05', 'SAN BENITO'),
(647, '06', '04', '06', 'CUPISNIQUE'),
(648, '06', '04', '07', 'TANTARICA'),
(649, '06', '04', '08', 'YONAN'),
(650, '06', '04', '09', 'SANTA CRUZ DE TOLED'),
(651, '06', '05', '00', 'CUTERVO'),
(652, '06', '05', '01', 'CUTERVO'),
(653, '06', '05', '02', 'CALLAYUC'),
(654, '06', '05', '03', 'CUJILLO'),
(655, '06', '05', '04', 'CHOROS'),
(656, '06', '05', '05', 'LA RAMADA'),
(657, '06', '05', '06', 'PIMPINGOS'),
(658, '06', '05', '07', 'QUEROCOTILLO'),
(659, '06', '05', '08', 'SAN ANDRES DE CUTERVO'),
(660, '06', '05', '09', 'SAN JUAN DE CUTERVO'),
(661, '06', '05', '10', 'SAN LUIS DE LUCMA'),
(662, '06', '05', '11', 'SANTA CRUZ'),
(663, '06', '05', '12', 'SANTO DOMINGO DE LA CAPILLA'),
(664, '06', '05', '13', 'SANTO TOMAS'),
(665, '06', '05', '14', 'SOCOTA'),
(666, '06', '05', '15', 'TORIBIO CASANOVA'),
(667, '06', '06', '00', 'CHOTA'),
(668, '06', '06', '01', 'CHOTA'),
(669, '06', '06', '02', 'ANGUIA'),
(670, '06', '06', '03', 'COCHABAMBA'),
(671, '06', '06', '04', 'CONCHAN'),
(672, '06', '06', '05', 'CHADIN'),
(673, '06', '06', '06', 'CHIGUIRIP'),
(674, '06', '06', '07', 'CHIMBAN'),
(675, '06', '06', '08', 'HUAMBOS'),
(676, '06', '06', '09', 'LAJAS'),
(677, '06', '06', '10', 'LLAMA'),
(678, '06', '06', '11', 'MIRACOSTA'),
(679, '06', '06', '12', 'PACCHA'),
(680, '06', '06', '13', 'PION'),
(681, '06', '06', '14', 'QUEROCOTO'),
(682, '06', '06', '15', 'TACABAMBA'),
(683, '06', '06', '16', 'TOCMOCHE'),
(684, '06', '06', '17', 'SAN JUAN DE LICUPIS'),
(685, '06', '06', '18', 'CHOROPAMPA'),
(686, '06', '06', '19', 'CHALAMARCA'),
(687, '06', '07', '00', 'HUALGAYOC'),
(688, '06', '07', '01', 'BAMBAMARCA'),
(689, '06', '07', '02', 'CHUGUR'),
(690, '06', '07', '03', 'HUALGAYOC'),
(691, '06', '08', '00', 'JAEN'),
(692, '06', '08', '01', 'JAEN'),
(693, '06', '08', '02', 'BELLAVISTA'),
(694, '06', '08', '03', 'COLASAY'),
(695, '06', '08', '04', 'CHONTALI'),
(696, '06', '08', '05', 'POMAHUACA'),
(697, '06', '08', '06', 'PUCARA'),
(698, '06', '08', '07', 'SALLIQUE'),
(699, '06', '08', '08', 'SAN FELIPE'),
(700, '06', '08', '09', 'SAN JOSE DEL ALTO'),
(701, '06', '08', '10', 'SANTA ROSA'),
(702, '06', '08', '11', 'LAS PIRIAS'),
(703, '06', '08', '12', 'HUABAL'),
(704, '06', '09', '00', 'SANTA CRUZ'),
(705, '06', '09', '01', 'SANTA CRUZ'),
(706, '06', '09', '02', 'CATACHE'),
(707, '06', '09', '03', 'CHANCAYBAÑOS'),
(708, '06', '09', '04', 'LA ESPERANZA'),
(709, '06', '09', '05', 'NINABAMBA'),
(710, '06', '09', '06', 'PULAN'),
(711, '06', '09', '07', 'SEXI'),
(712, '06', '09', '08', 'UTICYACU'),
(713, '06', '09', '09', 'YAUYUCAN'),
(714, '06', '09', '10', 'ANDABAMBA'),
(715, '06', '09', '11', 'SAUCEPAMPA'),
(716, '06', '10', '00', 'SAN MIGUEL'),
(717, '06', '10', '01', 'SAN MIGUEL'),
(718, '06', '10', '02', 'CALQUIS'),
(719, '06', '10', '03', 'LA FLORIDA'),
(720, '06', '10', '04', 'LLAPA'),
(721, '06', '10', '05', 'NANCHOC'),
(722, '06', '10', '06', 'NIEPOS'),
(723, '06', '10', '07', 'SAN GREGORIO'),
(724, '06', '10', '08', 'SAN SILVESTRE DE COCHAN'),
(725, '06', '10', '09', 'EL PRADO'),
(726, '06', '10', '10', 'UNION AGUA BLANCA'),
(727, '06', '10', '11', 'TONGOD'),
(728, '06', '10', '12', 'CATILLUC'),
(729, '06', '10', '13', 'BOLIVAR'),
(730, '06', '11', '00', 'SAN IGNACIO'),
(731, '06', '11', '01', 'SAN IGNACIO'),
(732, '06', '11', '02', 'CHIRINOS'),
(733, '06', '11', '03', 'HUARANGO'),
(734, '06', '11', '04', 'NAMBALLE'),
(735, '06', '11', '05', 'LA COIPA'),
(736, '06', '11', '06', 'SAN JOSE DE LOURDES'),
(737, '06', '11', '07', 'TABACONAS'),
(738, '06', '12', '00', 'SAN MARCOS'),
(739, '06', '12', '01', 'PEDRO GALVEZ'),
(740, '06', '12', '02', 'ICHOCAN'),
(741, '06', '12', '03', 'GREGORIO PITA'),
(742, '06', '12', '04', 'JOSE MANUEL QUIROZ'),
(743, '06', '12', '05', 'EDUARDO VILLANUEVA'),
(744, '06', '12', '06', 'JOSE SABOGAL'),
(745, '06', '12', '07', 'CHANCAY'),
(746, '06', '13', '00', 'SAN PABLO'),
(747, '06', '13', '01', 'SAN PABLO'),
(748, '06', '13', '02', 'SAN BERNARDINO'),
(749, '06', '13', '03', 'SAN LUIS'),
(750, '06', '13', '04', 'TUMBADEN'),
(751, '07', '00', '00', 'CUSCO'),
(752, '07', '01', '00', 'CUSCO'),
(753, '07', '01', '01', 'CUSCO'),
(754, '07', '01', '02', 'CCORCA'),
(755, '07', '01', '03', 'POROY'),
(756, '07', '01', '04', 'SAN JERONIMO'),
(757, '07', '01', '05', 'SAN SEBASTIAN'),
(758, '07', '01', '06', 'SANTIAGO'),
(759, '07', '01', '07', 'SAYLLA'),
(760, '07', '01', '08', 'WANCHAQ'),
(761, '07', '02', '00', 'ACOMAYO'),
(762, '07', '02', '01', 'ACOMAYO'),
(763, '07', '02', '02', 'ACOPIA'),
(764, '07', '02', '03', 'ACOS'),
(765, '07', '02', '04', 'POMACANCHI'),
(766, '07', '02', '05', 'RONDOCAN'),
(767, '07', '02', '06', 'SANGARARA'),
(768, '07', '02', '07', 'MOSOC LLACTA'),
(769, '07', '03', '00', 'ANTA'),
(770, '07', '03', '01', 'ANTA'),
(771, '07', '03', '02', 'CHINCHAYPUJIO'),
(772, '07', '03', '03', 'HUAROCONDO'),
(773, '07', '03', '04', 'LIMATAMBO'),
(774, '07', '03', '05', 'MOLLEPATA'),
(775, '07', '03', '06', 'PUCYURA'),
(776, '07', '03', '07', 'ZURITE'),
(777, '07', '03', '08', 'CACHIMAYO'),
(778, '07', '03', '09', 'ANCAHUASI'),
(779, '07', '04', '00', 'CALCA'),
(780, '07', '04', '01', 'CALCA'),
(781, '07', '04', '02', 'COYA'),
(782, '07', '04', '03', 'LAMAY'),
(783, '07', '04', '04', 'LARES'),
(784, '07', '04', '05', 'PISAC'),
(785, '07', '04', '06', 'SAN SALVADOR'),
(786, '07', '04', '07', 'TARAY'),
(787, '07', '04', '08', 'YANATILE'),
(788, '07', '05', '00', 'CANAS'),
(789, '07', '05', '01', 'YANAOCA'),
(790, '07', '05', '02', 'CHECCA'),
(791, '07', '05', '03', 'KUNTURKANKI'),
(792, '07', '05', '04', 'LANGUI'),
(793, '07', '05', '05', 'LAYO'),
(794, '07', '05', '06', 'PAMPAMARCA'),
(795, '07', '05', '07', 'QUEHUE'),
(796, '07', '05', '08', 'TUPAC AMARU'),
(797, '07', '06', '00', 'CANCHIS'),
(798, '07', '06', '01', 'SICUANI'),
(799, '07', '06', '02', 'COMBAPATA'),
(800, '07', '06', '03', 'CHECACUPE'),
(801, '07', '06', '04', 'MARANGANI'),
(802, '07', '06', '05', 'PITUMARCA'),
(803, '07', '06', '06', 'SAN PABLO'),
(804, '07', '06', '07', 'SAN PEDRO'),
(805, '07', '06', '08', 'TINTA'),
(806, '07', '07', '00', 'CHUMBIVILCAS'),
(807, '07', '07', '01', 'SANTO TOMAS'),
(808, '07', '07', '02', 'CAPACMARCA'),
(809, '07', '07', '03', 'COLQUEMARCA'),
(810, '07', '07', '04', 'CHAMACA'),
(811, '07', '07', '05', 'LIVITACA'),
(812, '07', '07', '06', 'LLUSCO'),
(813, '07', '07', '07', 'QUIÑOTA'),
(814, '07', '07', '08', 'VELILLE'),
(815, '07', '08', '00', 'ESPINAR'),
(816, '07', '08', '01', 'ESPINAR'),
(817, '07', '08', '02', 'CONDOROMA'),
(818, '07', '08', '03', 'COPORAQUE'),
(819, '07', '08', '04', 'OCORURO'),
(820, '07', '08', '05', 'PALLPATA'),
(821, '07', '08', '06', 'PICHIGUA'),
(822, '07', '08', '07', 'SUYCKUTAMBO'),
(823, '07', '08', '08', 'ALTO PICHIGUA'),
(824, '07', '09', '00', 'LA CONVENCION'),
(825, '07', '09', '01', 'SANTA ANA'),
(826, '07', '09', '02', 'ECHARATE'),
(827, '07', '09', '03', 'HUAYOPATA'),
(828, '07', '09', '04', 'MARANURA'),
(829, '07', '09', '05', 'OCOBAMBA'),
(830, '07', '09', '06', 'SANTA TERESA'),
(831, '07', '09', '07', 'VILCABAMBA'),
(832, '07', '09', '08', 'QUELLOUNO'),
(833, '07', '09', '09', 'KIMBIRI'),
(834, '07', '09', '10', 'PICHARI'),
(835, '07', '10', '00', 'PARURO'),
(836, '07', '10', '01', 'PARURO'),
(837, '07', '10', '02', 'ACCHA'),
(838, '07', '10', '03', 'CCAPI'),
(839, '07', '10', '04', 'COLCHA'),
(840, '07', '10', '05', 'HUANOQUITE'),
(841, '07', '10', '06', 'OMACHA'),
(842, '07', '10', '07', 'YAURISQUE'),
(843, '07', '10', '08', 'PACCARITAMBO'),
(844, '07', '10', '09', 'PILLPINTO'),
(845, '07', '11', '00', 'PAUCARTAMBO'),
(846, '07', '11', '01', 'PAUCARTAMBO'),
(847, '07', '11', '02', 'CAICAY'),
(848, '07', '11', '03', 'COLQUEPATA'),
(849, '07', '11', '04', 'CHALLABAMBA'),
(850, '07', '11', '05', 'KOSÑIPATA'),
(851, '07', '11', '06', 'HUANCARANI'),
(852, '07', '12', '00', 'QUISPICANCHI'),
(853, '07', '12', '01', 'URCOS'),
(854, '07', '12', '02', 'ANDAHUAYLILLAS'),
(855, '07', '12', '03', 'CAMANTI'),
(856, '07', '12', '04', 'CCARHUAYO'),
(857, '07', '12', '05', 'CCATCA'),
(858, '07', '12', '06', 'CUSIPATA'),
(859, '07', '12', '07', 'HUARO'),
(860, '07', '12', '08', 'LUCRE'),
(861, '07', '12', '09', 'MARCAPATA'),
(862, '07', '12', '10', 'OCONGATE'),
(863, '07', '12', '11', 'OROPESA'),
(864, '07', '12', '12', 'QUIQUIJANA'),
(865, '07', '13', '00', 'URUBAMBA'),
(866, '07', '13', '01', 'URUBAMBA'),
(867, '07', '13', '02', 'CHINCHERO'),
(868, '07', '13', '03', 'HUAYLLABAMBA'),
(869, '07', '13', '04', 'MACHUPICCHU'),
(870, '07', '13', '05', 'MARAS'),
(871, '07', '13', '06', 'OLLANTAYTAMBO'),
(872, '07', '13', '07', 'YUCAY'),
(873, '08', '00', '00', 'HUANCAVELICA'),
(874, '08', '01', '00', 'HUANCAVELICA'),
(875, '08', '01', '01', 'HUANCAVELICA'),
(876, '08', '01', '02', 'ACOBAMBILLA'),
(877, '08', '01', '03', 'ACORIA'),
(878, '08', '01', '04', 'CONAYCA'),
(879, '08', '01', '05', 'CUENCA'),
(880, '08', '01', '06', 'HUACHOCOLPA'),
(881, '08', '01', '08', 'HUAYLLAHUARA'),
(882, '08', '01', '09', 'IZCUCHACA'),
(883, '08', '01', '10', 'LARIA'),
(884, '08', '01', '11', 'MANTA'),
(885, '08', '01', '12', 'MARISCAL CACERES'),
(886, '08', '01', '13', 'MOYA'),
(887, '08', '01', '14', 'NUEVO OCCORO'),
(888, '08', '01', '15', 'PALCA'),
(889, '08', '01', '16', 'PILCHACA'),
(890, '08', '01', '17', 'VILCA'),
(891, '08', '01', '18', 'YAULI'),
(892, '08', '01', '19', 'ASCENSION'),
(893, '08', '01', '20', 'HUANDO'),
(894, '08', '02', '00', 'ACOBAMBA'),
(895, '08', '02', '01', 'ACOBAMBA'),
(896, '08', '02', '02', 'ANTA'),
(897, '08', '02', '03', 'ANDABAMBA'),
(898, '08', '02', '04', 'CAJA'),
(899, '08', '02', '05', 'MARCAS'),
(900, '08', '02', '06', 'PAUCARA'),
(901, '08', '02', '07', 'POMACOCHA'),
(902, '08', '02', '08', 'ROSARIO'),
(903, '08', '03', '00', 'ANGARAES'),
(904, '08', '03', '01', 'LIRCAY'),
(905, '08', '03', '02', 'ANCHONGA'),
(906, '08', '03', '03', 'CALLANMARCA'),
(907, '08', '03', '04', 'CONGALLA'),
(908, '08', '03', '05', 'CHINCHO'),
(909, '08', '03', '06', 'HUALLAY-GRANDE'),
(910, '08', '03', '07', 'HUANCA-HUANCA'),
(911, '08', '03', '08', 'JULCAMARCA'),
(912, '08', '03', '09', 'SAN ANTONIO DE ANTAPARCO'),
(913, '08', '03', '10', 'SANTO TOMAS DE PATA'),
(914, '08', '03', '11', 'SECCLLA'),
(915, '08', '03', '12', 'CCOCHACCASA'),
(916, '08', '04', '00', 'CASTROVIRREYNA'),
(917, '08', '04', '01', 'CASTROVIRREYNA'),
(918, '08', '04', '02', 'ARMA'),
(919, '08', '04', '03', 'AURAHUA'),
(920, '08', '04', '05', 'CAPILLAS'),
(921, '08', '04', '06', 'COCAS'),
(922, '08', '04', '08', 'CHUPAMARCA'),
(923, '08', '04', '09', 'HUACHOS'),
(924, '08', '04', '10', 'HUAMATAMBO'),
(925, '08', '04', '14', 'MOLLEPAMPA'),
(926, '08', '04', '22', 'SAN JUAN'),
(927, '08', '04', '27', 'TANTARA'),
(928, '08', '04', '28', 'TICRAPO'),
(929, '08', '04', '29', 'SANTA ANA'),
(930, '08', '05', '00', 'TAYACAJA'),
(931, '08', '05', '01', 'PAMPAS'),
(932, '08', '05', '02', 'ACOSTAMBO'),
(933, '08', '05', '03', 'ACRAQUIA'),
(934, '08', '05', '04', 'AHUAYCHA'),
(935, '08', '05', '06', 'COLCABAMBA'),
(936, '08', '05', '09', 'DANIEL HERNANDEZ'),
(937, '08', '05', '11', 'HUACHOCOLPA'),
(938, '08', '05', '12', 'HUARIBAMBA'),
(939, '08', '05', '15', 'ÑAHUIMPUQUIO'),
(940, '08', '05', '17', 'PAZOS'),
(941, '08', '05', '18', 'QUISHUAR'),
(942, '08', '05', '19', 'SALCABAMBA'),
(943, '08', '05', '20', 'SAN MARCOS DE ROCCHAC'),
(944, '08', '05', '23', 'SURCUBAMBA'),
(945, '08', '05', '25', 'TINTAY PUNCU'),
(946, '08', '05', '26', 'SALCAHUASI'),
(947, '08', '06', '00', 'HUAYTARA'),
(948, '08', '06', '01', 'AYAVI'),
(949, '08', '06', '02', 'CORDOVA'),
(950, '08', '06', '03', 'HUAYACUNDO ARMA'),
(951, '08', '06', '04', 'HUAYTARA'),
(952, '08', '06', '05', 'LARAMARCA'),
(953, '08', '06', '06', 'OCOYO'),
(954, '08', '06', '07', 'PILPICHACA'),
(955, '08', '06', '08', 'QUERCO'),
(956, '08', '06', '09', 'QUITO ARMA'),
(957, '08', '06', '10', 'SAN ANTONIO DE CUSICANCHA'),
(958, '08', '06', '11', 'SAN FRANCISCO DE SANGAYAICO'),
(959, '08', '06', '12', 'SAN ISIDRO'),
(960, '08', '06', '13', 'SANTIAGO DE CHOCORVOS'),
(961, '08', '06', '14', 'SANTIAGO DE QUIRAHUARA'),
(962, '08', '06', '15', 'SANTO DOMINGO DE CAPILLAS'),
(963, '08', '06', '16', 'TAMBO'),
(964, '08', '07', '00', 'CHURCAMPA'),
(965, '08', '07', '01', 'CHURCAMPA'),
(966, '08', '07', '02', 'ANCO'),
(967, '08', '07', '03', 'CHINCHIHUASI'),
(968, '08', '07', '04', 'EL CARMEN'),
(969, '08', '07', '05', 'LA MERCED'),
(970, '08', '07', '06', 'LOCROJA'),
(971, '08', '07', '07', 'PAUCARBAMBA'),
(972, '08', '07', '08', 'SAN MIGUEL DE MAYOCC'),
(973, '08', '07', '09', 'SAN PEDRO DE CORIS'),
(974, '08', '07', '10', 'PACHAMARCA'),
(975, '08', '07', '11', 'COSME'),
(976, '09', '00', '00', 'HUANUCO'),
(977, '09', '01', '00', 'HUANUCO'),
(978, '09', '01', '01', 'HUANUCO'),
(979, '09', '01', '02', 'CHINCHAO'),
(980, '09', '01', '03', 'CHURUBAMBA'),
(981, '09', '01', '04', 'MARGOS'),
(982, '09', '01', '05', 'QUISQUI'),
(983, '09', '01', '06', 'SAN FRANCISCO DE CAYRAN'),
(984, '09', '01', '07', 'SAN PEDRO DE CHAULAN'),
(985, '09', '01', '08', 'SANTA MARIA DEL VALLE'),
(986, '09', '01', '09', 'YARUMAYO'),
(987, '09', '01', '10', 'AMARILIS'),
(988, '09', '01', '11', 'PILLCO MARCA'),
(989, '09', '01', '12', 'YACUS'),
(990, '09', '02', '00', 'AMBO'),
(991, '09', '02', '01', 'AMBO'),
(992, '09', '02', '02', 'CAYNA'),
(993, '09', '02', '03', 'COLPAS'),
(994, '09', '02', '04', 'CONCHAMARCA'),
(995, '09', '02', '05', 'HUACAR'),
(996, '09', '02', '06', 'SAN FRANCISCO'),
(997, '09', '02', '07', 'SAN RAFAEL'),
(998, '09', '02', '08', 'TOMAY-KICHWA'),
(999, '09', '03', '00', 'DOS DE MAYO'),
(1000, '09', '03', '01', 'LA UNION'),
(1001, '09', '03', '07', 'CHUQUIS'),
(1002, '09', '03', '12', 'MARIAS'),
(1003, '09', '03', '14', 'PACHAS'),
(1004, '09', '03', '16', 'QUIVILLA'),
(1005, '09', '03', '17', 'RIPAN'),
(1006, '09', '03', '21', 'SHUNQUI'),
(1007, '09', '03', '22', 'SILLAPATA'),
(1008, '09', '03', '23', 'YANAS'),
(1009, '09', '04', '00', 'HUAMALIES'),
(1010, '09', '04', '01', 'LLATA'),
(1011, '09', '04', '02', 'ARANCAY'),
(1012, '09', '04', '03', 'CHAVIN DE PARIARCA'),
(1013, '09', '04', '04', 'JACAS GRANDE'),
(1014, '09', '04', '05', 'JIRCAN'),
(1015, '09', '04', '06', 'MIRAFLORES'),
(1016, '09', '04', '07', 'MONZON'),
(1017, '09', '04', '08', 'PUNCHAO'),
(1018, '09', '04', '09', 'PUÑOS'),
(1019, '09', '04', '10', 'SINGA'),
(1020, '09', '04', '11', 'TANTAMAYO'),
(1021, '09', '05', '00', 'MARAÑON'),
(1022, '09', '05', '01', 'HUACRACHUCO'),
(1023, '09', '05', '02', 'CHOLON'),
(1024, '09', '05', '05', 'SAN BUENAVENTURA'),
(1025, '09', '06', '00', 'LEONCIO PRADO'),
(1026, '09', '06', '01', 'RUPA-RUPA'),
(1027, '09', '06', '02', 'DANIEL ALOMIA ROBLES'),
(1028, '09', '06', '03', 'HERMILIO VALDIZAN'),
(1029, '09', '06', '04', 'LUYANDO'),
(1030, '09', '06', '05', 'MARIANO DAMASO BERAUN'),
(1031, '09', '06', '06', 'JOSE CRESPO Y CASTILLO'),
(1032, '09', '07', '00', 'PACHITEA'),
(1033, '09', '07', '01', 'PANAO'),
(1034, '09', '07', '02', 'CHAGLLA'),
(1035, '09', '07', '04', 'MOLINO'),
(1036, '09', '07', '06', 'UMARI'),
(1037, '09', '08', '00', 'PUERTO INCA'),
(1038, '09', '08', '01', 'HONORIA'),
(1039, '09', '08', '02', 'PUERTO INCA'),
(1040, '09', '08', '03', 'CODO DEL POZUZO'),
(1041, '09', '08', '04', 'TOURNAVISTA'),
(1042, '09', '08', '05', 'YUYAPICHIS'),
(1043, '09', '09', '00', 'HUACAYBAMBA'),
(1044, '09', '09', '01', 'HUACAYBAMBA'),
(1045, '09', '09', '02', 'PINRA'),
(1046, '09', '09', '03', 'CANCHABAMBA'),
(1047, '09', '09', '04', 'COCHABAMBA'),
(1048, '09', '10', '00', 'LAURICOCHA'),
(1049, '09', '10', '01', 'JESUS'),
(1050, '09', '10', '02', 'BAÑOS'),
(1051, '09', '10', '03', 'SAN FRANCISCO DE ASIS'),
(1052, '09', '10', '04', 'QUEROPALCA'),
(1053, '09', '10', '05', 'SAN MIGUEL DE CAURI'),
(1054, '09', '10', '06', 'RONDOS'),
(1055, '09', '10', '07', 'JIVIA'),
(1056, '09', '11', '00', 'YAROWILCA'),
(1057, '09', '11', '01', 'CHAVINILLO'),
(1058, '09', '11', '02', 'APARICIO POMARES'),
(1059, '09', '11', '03', 'CAHUAC'),
(1060, '09', '11', '04', 'CHACABAMBA'),
(1061, '09', '11', '05', 'JACAS CHICO'),
(1062, '09', '11', '06', 'OBAS'),
(1063, '09', '11', '07', 'PAMPAMARCA'),
(1064, '09', '11', '08', 'CHORAS'),
(1065, '10', '00', '00', 'ICA'),
(1066, '10', '01', '00', 'ICA'),
(1067, '10', '01', '01', 'ICA'),
(1068, '10', '01', '02', 'LA TINGUIÑA'),
(1069, '10', '01', '03', 'LOS AQUIJES'),
(1070, '10', '01', '04', 'PARCONA'),
(1071, '10', '01', '05', 'PUEBLO NUEVO'),
(1072, '10', '01', '06', 'SALAS'),
(1073, '10', '01', '07', 'SAN JOSE DE LOS MOLINOS'),
(1074, '10', '01', '08', 'SAN JUAN BAUTISTA'),
(1075, '10', '01', '09', 'SANTIAGO'),
(1076, '10', '01', '10', 'SUBTANJALLA'),
(1077, '10', '01', '11', 'YAUCA DEL ROSARIO'),
(1078, '10', '01', '12', 'TATE'),
(1079, '10', '01', '13', 'PACHACUTEC'),
(1080, '10', '01', '14', 'OCUCAJE'),
(1081, '10', '02', '00', 'CHINCHA'),
(1082, '10', '02', '01', 'CHINCHA ALTA'),
(1083, '10', '02', '02', 'CHAVIN'),
(1084, '10', '02', '03', 'CHINCHA BAJA'),
(1085, '10', '02', '04', 'EL CARMEN'),
(1086, '10', '02', '05', 'GROCIO PRADO'),
(1087, '10', '02', '06', 'SAN PEDRO DE HUACARPANA'),
(1088, '10', '02', '07', 'SUNAMPE'),
(1089, '10', '02', '08', 'TAMBO DE MORA'),
(1090, '10', '02', '09', 'ALTO LARAN'),
(1091, '10', '02', '10', 'PUEBLO NUEVO'),
(1092, '10', '02', '11', 'SAN JUAN DE YANAC'),
(1093, '10', '03', '00', 'NAZCA'),
(1094, '10', '03', '01', 'NAZCA'),
(1095, '10', '03', '02', 'CHANGUILLO'),
(1096, '10', '03', '03', 'EL INGENIO'),
(1097, '10', '03', '04', 'MARCONA'),
(1098, '10', '03', '05', 'VISTA ALEGRE'),
(1099, '10', '04', '00', 'PISCO'),
(1100, '10', '04', '01', 'PISCO'),
(1101, '10', '04', '02', 'HUANCANO'),
(1102, '10', '04', '03', 'HUMAY'),
(1103, '10', '04', '04', 'INDEPENDENCIA'),
(1104, '10', '04', '05', 'PARACAS'),
(1105, '10', '04', '06', 'SAN ANDRES'),
(1106, '10', '04', '07', 'SAN CLEMENTE'),
(1107, '10', '04', '08', 'TUPAC AMARU INCA'),
(1108, '10', '05', '00', 'PALPA'),
(1109, '10', '05', '01', 'PALPA'),
(1110, '10', '05', '02', 'LLIPATA'),
(1111, '10', '05', '03', 'RIO GRANDE'),
(1112, '10', '05', '04', 'SANTA CRUZ'),
(1113, '10', '05', '05', 'TIBILLO'),
(1114, '11', '00', '00', 'JUNIN'),
(1115, '11', '01', '00', 'HUANCAYO'),
(1116, '11', '01', '01', 'HUANCAYO'),
(1117, '11', '01', '03', 'CARHUACALLANGA'),
(1118, '11', '01', '04', 'COLCA'),
(1119, '11', '01', '05', 'CULLHUAS'),
(1120, '11', '01', '06', 'CHACAPAMPA'),
(1121, '11', '01', '07', 'CHICCHE'),
(1122, '11', '01', '08', 'CHILCA'),
(1123, '11', '01', '09', 'CHONGOS ALTO'),
(1124, '11', '01', '12', 'CHUPURO'),
(1125, '11', '01', '13', 'EL TAMBO'),
(1126, '11', '01', '14', 'HUACRAPUQUIO'),
(1127, '11', '01', '16', 'HUALHUAS'),
(1128, '11', '01', '18', 'HUANCAN'),
(1129, '11', '01', '19', 'HUASICANCHA'),
(1130, '11', '01', '20', 'HUAYUCACHI'),
(1131, '11', '01', '21', 'INGENIO'),
(1132, '11', '01', '22', 'PARIAHUANCA'),
(1133, '11', '01', '23', 'PILCOMAYO'),
(1134, '11', '01', '24', 'PUCARA'),
(1135, '11', '01', '25', 'QUICHUAY'),
(1136, '11', '01', '26', 'QUILCAS'),
(1137, '11', '01', '27', 'SAN AGUSTIN'),
(1138, '11', '01', '28', 'SAN JERONIMO DE TUNAN'),
(1139, '11', '01', '31', 'SANTO DOMINGO DE ACOBAMBA'),
(1140, '11', '01', '32', 'SAÑO'),
(1141, '11', '01', '33', 'SAPALLANGA'),
(1142, '11', '01', '34', 'SICAYA'),
(1143, '11', '01', '36', 'VIQUES'),
(1144, '11', '02', '00', 'CONCEPCION'),
(1145, '11', '02', '01', 'CONCEPCION'),
(1146, '11', '02', '02', 'ACO'),
(1147, '11', '02', '03', 'ANDAMARCA'),
(1148, '11', '02', '04', 'COMAS'),
(1149, '11', '02', '05', 'COCHAS'),
(1150, '11', '02', '06', 'CHAMBARA'),
(1151, '11', '02', '07', 'HEROINAS TOLEDO'),
(1152, '11', '02', '08', 'MANZANARES'),
(1153, '11', '02', '09', 'MARISCAL CASTILLA'),
(1154, '11', '02', '10', 'MATAHUASI'),
(1155, '11', '02', '11', 'MITO'),
(1156, '11', '02', '12', 'NUEVE DE JULIO'),
(1157, '11', '02', '13', 'ORCOTUNA'),
(1158, '11', '02', '14', 'SANTA ROSA DE OCOPA'),
(1159, '11', '02', '15', 'SAN JOSE DE QUERO'),
(1160, '11', '03', '00', 'JAUJA'),
(1161, '11', '03', '01', 'JAUJA'),
(1162, '11', '03', '02', 'ACOLLA'),
(1163, '11', '03', '03', 'APATA'),
(1164, '11', '03', '04', 'ATAURA'),
(1165, '11', '03', '05', 'CANCHAYLLO'),
(1166, '11', '03', '06', 'EL MANTARO'),
(1167, '11', '03', '07', 'HUAMALI'),
(1168, '11', '03', '08', 'HUARIPAMPA'),
(1169, '11', '03', '09', 'HUERTAS'),
(1170, '11', '03', '10', 'JANJAILLO'),
(1171, '11', '03', '11', 'JULCAN'),
(1172, '11', '03', '12', 'LEONOR ORDOÑEZ'),
(1173, '11', '03', '13', 'LLOCLLAPAMPA'),
(1174, '11', '03', '14', 'MARCO'),
(1175, '11', '03', '15', 'MASMA'),
(1176, '11', '03', '16', 'MOLINOS'),
(1177, '11', '03', '17', 'MONOBAMBA'),
(1178, '11', '03', '18', 'MUQUI'),
(1179, '11', '03', '19', 'MUQUIYAUYO'),
(1180, '11', '03', '20', 'PACA'),
(1181, '11', '03', '21', 'PACCHA'),
(1182, '11', '03', '22', 'PANCAN'),
(1183, '11', '03', '23', 'PARCO'),
(1184, '11', '03', '24', 'POMACANCHA'),
(1185, '11', '03', '25', 'RICRAN'),
(1186, '11', '03', '26', 'SAN LORENZO'),
(1187, '11', '03', '27', 'SAN PEDRO DE CHUNAN'),
(1188, '11', '03', '28', 'SINCOS'),
(1189, '11', '03', '29', 'TUNAN MARCA'),
(1190, '11', '03', '30', 'YAULI'),
(1191, '11', '03', '31', 'CURICACA'),
(1192, '11', '03', '32', 'MASMA CHICCHE'),
(1193, '11', '03', '33', 'SAUSA'),
(1194, '11', '03', '34', 'YAUYOS'),
(1195, '11', '04', '00', 'JUNIN'),
(1196, '11', '04', '01', 'JUNIN'),
(1197, '11', '04', '02', 'CARHUAMAYO'),
(1198, '11', '04', '03', 'ONDORES'),
(1199, '11', '04', '04', 'ULCUMAYO'),
(1200, '11', '05', '00', 'TARMA'),
(1201, '11', '05', '01', 'TARMA'),
(1202, '11', '05', '02', 'ACOBAMBA'),
(1203, '11', '05', '03', 'HUARICOLCA'),
(1204, '11', '05', '04', 'HUASAHUASI'),
(1205, '11', '05', '05', 'LA UNION'),
(1206, '11', '05', '06', 'PALCA'),
(1207, '11', '05', '07', 'PALCAMAYO'),
(1208, '11', '05', '08', 'SAN PEDRO DE CAJAS'),
(1209, '11', '05', '09', 'TAPO'),
(1210, '11', '06', '00', 'YAULI'),
(1211, '11', '06', '01', 'LA OROYA'),
(1212, '11', '06', '02', 'CHACAPALPA'),
(1213, '11', '06', '03', 'HUAY HUAY'),
(1214, '11', '06', '04', 'MARCAPOMACOCHA'),
(1215, '11', '06', '05', 'MOROCOCHA'),
(1216, '11', '06', '06', 'PACCHA'),
(1217, '11', '06', '07', 'SANTA BARBARA DE CARHUACAYAN'),
(1218, '11', '06', '08', 'SUITUCANCHA'),
(1219, '11', '06', '09', 'YAULI'),
(1220, '11', '06', '10', 'SANTA ROSA DE SACCO'),
(1221, '11', '07', '00', 'SATIPO'),
(1222, '11', '07', '01', 'SATIPO'),
(1223, '11', '07', '02', 'COVIRIALI'),
(1224, '11', '07', '03', 'LLAYLLA'),
(1225, '11', '07', '04', 'MAZAMARI'),
(1226, '11', '07', '05', 'PAMPA HERMOSA'),
(1227, '11', '07', '06', 'PANGOA'),
(1228, '11', '07', '07', 'RIO NEGRO'),
(1229, '11', '07', '08', 'RIO TAMBO'),
(1230, '11', '08', '00', 'CHANCHAMAYO'),
(1231, '11', '08', '01', 'CHANCHAMAYO'),
(1232, '11', '08', '02', 'SAN RAMON'),
(1233, '11', '08', '03', 'VITOC'),
(1234, '11', '08', '04', 'SAN LUIS DE SHUARO'),
(1235, '11', '08', '05', 'PICHANAQUI'),
(1236, '11', '08', '06', 'PERENE'),
(1237, '11', '09', '00', 'CHUPACA'),
(1238, '11', '09', '01', 'CHUPACA'),
(1239, '11', '09', '02', 'AHUAC'),
(1240, '11', '09', '03', 'CHONGOS BAJO'),
(1241, '11', '09', '04', 'HUACHAC'),
(1242, '11', '09', '05', 'HUAMANCACA CHICO'),
(1243, '11', '09', '06', 'SAN JUAN DE YSCOS'),
(1244, '11', '09', '07', 'SAN JUAN DE JARPA'),
(1245, '11', '09', '08', 'TRES DE DICIEMBRE'),
(1246, '11', '09', '09', 'YANACANCHA'),
(1247, '12', '00', '00', 'LA LIBERTAD'),
(1248, '12', '01', '00', 'TRUJILLO'),
(1249, '12', '01', '01', 'TRUJILLO'),
(1250, '12', '01', '02', 'HUANCHACO'),
(1251, '12', '01', '03', 'LAREDO'),
(1252, '12', '01', '04', 'MOCHE'),
(1253, '12', '01', '05', 'SALAVERRY'),
(1254, '12', '01', '06', 'SIMBAL'),
(1255, '12', '01', '07', 'VICTOR LARCO HERRERA'),
(1256, '12', '01', '09', 'POROTO'),
(1257, '12', '01', '10', 'EL PORVENIR'),
(1258, '12', '01', '11', 'LA ESPERANZA'),
(1259, '12', '01', '12', 'FLORENCIA DE MORA'),
(1260, '12', '02', '00', 'BOLIVAR'),
(1261, '12', '02', '01', 'BOLIVAR'),
(1262, '12', '02', '02', 'BAMBAMARCA'),
(1263, '12', '02', '03', 'CONDORMARCA'),
(1264, '12', '02', '04', 'LONGOTEA'),
(1265, '12', '02', '05', 'UCUNCHA'),
(1266, '12', '02', '06', 'UCHUMARCA'),
(1267, '12', '03', '00', 'SANCHEZ CARRION'),
(1268, '12', '03', '01', 'HUAMACHUCO'),
(1269, '12', '03', '02', 'COCHORCO'),
(1270, '12', '03', '03', 'CURGOS'),
(1271, '12', '03', '04', 'CHUGAY'),
(1272, '12', '03', '05', 'MARCABAL'),
(1273, '12', '03', '06', 'SANAGORAN'),
(1274, '12', '03', '07', 'SARIN'),
(1275, '12', '03', '08', 'SARTIMBAMBA'),
(1276, '12', '04', '00', 'OTUZCO'),
(1277, '12', '04', '01', 'OTUZCO'),
(1278, '12', '04', '02', 'AGALLPAMPA'),
(1279, '12', '04', '03', 'CHARAT'),
(1280, '12', '04', '04', 'HUARANCHAL'),
(1281, '12', '04', '05', 'LA CUESTA'),
(1282, '12', '04', '08', 'PARANDAY'),
(1283, '12', '04', '09', 'SALPO'),
(1284, '12', '04', '10', 'SINSICAP'),
(1285, '12', '04', '11', 'USQUIL'),
(1286, '12', '04', '13', 'MACHE'),
(1287, '12', '05', '00', 'PACASMAYO'),
(1288, '12', '05', '01', 'SAN PEDRO DE LLOC'),
(1289, '12', '05', '03', 'GUADALUPE'),
(1290, '12', '05', '04', 'JEQUETEPEQUE'),
(1291, '12', '05', '06', 'PACASMAYO'),
(1292, '12', '05', '08', 'SAN JOSE'),
(1293, '12', '06', '00', 'PATAZ'),
(1294, '12', '06', '01', 'TAYABAMBA'),
(1295, '12', '06', '02', 'BULDIBUYO'),
(1296, '12', '06', '03', 'CHILLIA'),
(1297, '12', '06', '04', 'HUAYLILLAS'),
(1298, '12', '06', '05', 'HUANCASPATA'),
(1299, '12', '06', '06', 'HUAYO'),
(1300, '12', '06', '07', 'ONGON'),
(1301, '12', '06', '08', 'PARCOY'),
(1302, '12', '06', '09', 'PATAZ'),
(1303, '12', '06', '10', 'PIAS'),
(1304, '12', '06', '11', 'TAURIJA'),
(1305, '12', '06', '12', 'URPAY'),
(1306, '12', '06', '13', 'SANTIAGO DE CHALLAS'),
(1307, '12', '07', '00', 'SANTIAGO DE CHUCO'),
(1308, '12', '07', '01', 'SANTIAGO DE CHUCO'),
(1309, '12', '07', '02', 'CACHICADAN'),
(1310, '12', '07', '03', 'MOLLEBAMBA'),
(1311, '12', '07', '04', 'MOLLEPATA'),
(1312, '12', '07', '05', 'QUIRUVILCA'),
(1313, '12', '07', '06', 'SANTA CRUZ DE CHUCA'),
(1314, '12', '07', '07', 'SITABAMBA'),
(1315, '12', '07', '08', 'ANGASMARCA'),
(1316, '12', '08', '00', 'ASCOPE'),
(1317, '12', '08', '01', 'ASCOPE'),
(1318, '12', '08', '02', 'CHICAMA'),
(1319, '12', '08', '03', 'CHOCOPE'),
(1320, '12', '08', '04', 'SANTIAGO DE CAO'),
(1321, '12', '08', '05', 'MAGDALENA DE CAO'),
(1322, '12', '08', '06', 'PAIJAN'),
(1323, '12', '08', '07', 'RAZURI'),
(1324, '12', '08', '08', 'CASA GRANDE'),
(1325, '12', '09', '00', 'CHEPEN'),
(1326, '12', '09', '01', 'CHEPEN'),
(1327, '12', '09', '02', 'PACANGA'),
(1328, '12', '09', '03', 'PUEBLO NUEVO'),
(1329, '12', '10', '00', 'JULCAN'),
(1330, '12', '10', '01', 'JULCAN'),
(1331, '12', '10', '02', 'CARABAMBA'),
(1332, '12', '10', '03', 'CALAMARCA'),
(1333, '12', '10', '04', 'HUASO'),
(1334, '12', '11', '00', 'GRAN CHIMU'),
(1335, '12', '11', '01', 'CASCAS'),
(1336, '12', '11', '02', 'LUCMA'),
(1337, '12', '11', '03', 'MARMOT'),
(1338, '12', '11', '04', 'SAYAPULLO'),
(1339, '12', '12', '00', 'VIRU'),
(1340, '12', '12', '01', 'VIRU'),
(1341, '12', '12', '02', 'CHAO'),
(1342, '12', '12', '03', 'GUADALUPITO'),
(1343, '13', '00', '00', 'LAMBAYEQUE'),
(1344, '13', '01', '00', 'CHICLAYO'),
(1345, '13', '01', '01', 'CHICLAYO'),
(1346, '13', '01', '02', 'CHONGOYAPE'),
(1347, '13', '01', '03', 'ETEN'),
(1348, '13', '01', '04', 'ETEN PUERTO'),
(1349, '13', '01', '05', 'LAGUNAS'),
(1350, '13', '01', '06', 'MONSEFU'),
(1351, '13', '01', '07', 'NUEVA ARICA'),
(1352, '13', '01', '08', 'OYOTUN'),
(1353, '13', '01', '09', 'PICSI'),
(1354, '13', '01', '10', 'PIMENTEL'),
(1355, '13', '01', '11', 'REQUE'),
(1356, '13', '01', '12', 'JOSE LEONARDO ORTIZ'),
(1357, '13', '01', '13', 'SANTA ROSA'),
(1358, '13', '01', '14', 'SAÑA'),
(1359, '13', '01', '15', 'LA VICTORIA'),
(1360, '13', '01', '16', 'CAYALTI'),
(1361, '13', '01', '17', 'PATAPO'),
(1362, '13', '01', '18', 'POMALCA'),
(1363, '13', '01', '19', 'PUCALA'),
(1364, '13', '01', '20', 'TUMAN'),
(1365, '13', '02', '00', 'FERREÑAFE'),
(1366, '13', '02', '01', 'FERREÑAFE'),
(1367, '13', '02', '02', 'INCAHUASI'),
(1368, '13', '02', '03', 'CAÑARIS'),
(1369, '13', '02', '04', 'PITIPO'),
(1370, '13', '02', '05', 'PUEBLO NUEVO'),
(1371, '13', '02', '06', 'MANUEL ANTONIO MESONES MURO'),
(1372, '13', '03', '00', 'LAMBAYEQUE'),
(1373, '13', '03', '01', 'LAMBAYEQUE'),
(1374, '13', '03', '02', 'CHOCHOPE'),
(1375, '13', '03', '03', 'ILLIMO');
INSERT INTO `ubigeos` (`idubigeo`, `codigo_region`, `codigo_provincia`, `codigo_distrito`, `descripcion`) VALUES
(1376, '13', '03', '04', 'JAYANCA'),
(1377, '13', '03', '05', 'MOCHUMI'),
(1378, '13', '03', '06', 'MORROPE'),
(1379, '13', '03', '07', 'MOTUPE'),
(1380, '13', '03', '08', 'OLMOS'),
(1381, '13', '03', '09', 'PACORA'),
(1382, '13', '03', '10', 'SALAS'),
(1383, '13', '03', '11', 'SAN JOSE'),
(1384, '13', '03', '12', 'TUCUME'),
(1385, '14', '00', '00', 'LIMA'),
(1386, '14', '01', '00', 'LIMA'),
(1387, '14', '01', '01', 'LIMA'),
(1388, '14', '01', '02', 'ANCON'),
(1389, '14', '01', '03', 'ATE'),
(1390, '14', '01', '04', 'BREÑA'),
(1391, '14', '01', '05', 'CARABAYLLO'),
(1392, '14', '01', '06', 'COMAS'),
(1393, '14', '01', '07', 'CHACLACAYO'),
(1394, '14', '01', '08', 'CHORRILLOS'),
(1395, '14', '01', '09', 'LA VICTORIA'),
(1396, '14', '01', '10', 'LA MOLINA'),
(1397, '14', '01', '11', 'LINCE'),
(1398, '14', '01', '12', 'LURIGANCHO'),
(1399, '14', '01', '13', 'LURIN'),
(1400, '14', '01', '14', 'MAGDALENA DEL MAR'),
(1401, '14', '01', '15', 'MIRAFLORES'),
(1402, '14', '01', '16', 'PACHACAMAC'),
(1403, '14', '01', '17', 'PUEBLO LIBRE'),
(1404, '14', '01', '18', 'PUCUSANA'),
(1405, '14', '01', '19', 'PUENTE PIEDRA'),
(1406, '14', '01', '20', 'PUNTA HERMOSA'),
(1407, '14', '01', '21', 'PUNTA NEGRA'),
(1408, '14', '01', '22', 'RIMAC'),
(1409, '14', '01', '23', 'SAN BARTOLO'),
(1410, '14', '01', '24', 'SAN ISIDRO'),
(1411, '14', '01', '25', 'BARRANCO'),
(1412, '14', '01', '26', 'SAN MARTIN DE PORRES'),
(1413, '14', '01', '27', 'SAN MIGUEL'),
(1414, '14', '01', '28', 'SANTA MARIA DEL MAR'),
(1415, '14', '01', '29', 'SANTA ROSA'),
(1416, '14', '01', '30', 'SANTIAGO DE SURCO'),
(1417, '14', '01', '31', 'SURQUILLO'),
(1418, '14', '01', '32', 'VILLA MARIA DEL TRIUNFO'),
(1419, '14', '01', '33', 'JESUS MARIA'),
(1420, '14', '01', '34', 'INDEPENDENCIA'),
(1421, '14', '01', '35', 'EL AGUSTINO'),
(1422, '14', '01', '36', 'SAN JUAN DE MIRAFLORES'),
(1423, '14', '01', '37', 'SAN JUAN DE LURIGANCHO'),
(1424, '14', '01', '38', 'SAN LUIS'),
(1425, '14', '01', '39', 'CIENEGUILLA'),
(1426, '14', '01', '40', 'SAN BORJA'),
(1427, '14', '01', '41', 'VILLA EL SALVADOR'),
(1428, '14', '01', '42', 'LOS OLIVOS'),
(1429, '14', '01', '43', 'SANTA ANITA'),
(1430, '14', '02', '00', 'CAJATAMBO'),
(1431, '14', '02', '01', 'CAJATAMBO'),
(1432, '14', '02', '05', 'COPA'),
(1433, '14', '02', '06', 'GORGOR'),
(1434, '14', '02', '07', 'HUANCAPON'),
(1435, '14', '02', '08', 'MANAS'),
(1436, '14', '03', '00', 'CANTA'),
(1437, '14', '03', '01', 'CANTA'),
(1438, '14', '03', '02', 'ARAHUAY'),
(1439, '14', '03', '03', 'HUAMANTANGA'),
(1440, '14', '03', '04', 'HUAROS'),
(1441, '14', '03', '05', 'LACHAQUI'),
(1442, '14', '03', '06', 'SAN BUENAVENTURA'),
(1443, '14', '03', '07', 'SANTA ROSA DE QUIVES'),
(1444, '14', '04', '00', 'CAÑETE'),
(1445, '14', '04', '01', 'SAN VICENTE DE CAÑETE'),
(1446, '14', '04', '02', 'CALANGO'),
(1447, '14', '04', '03', 'CERRO AZUL'),
(1448, '14', '04', '04', 'COAYLLO'),
(1449, '14', '04', '05', 'CHILCA'),
(1450, '14', '04', '06', 'IMPERIAL'),
(1451, '14', '04', '07', 'LUNAHUANA'),
(1452, '14', '04', '08', 'MALA'),
(1453, '14', '04', '09', 'NUEVO IMPERIAL'),
(1454, '14', '04', '10', 'PACARAN'),
(1455, '14', '04', '11', 'QUILMANA'),
(1456, '14', '04', '12', 'SAN ANTONIO'),
(1457, '14', '04', '13', 'SAN LUIS'),
(1458, '14', '04', '14', 'SANTA CRUZ DE FLORES'),
(1459, '14', '04', '15', 'ZUÑIGA'),
(1460, '14', '04', '16', 'ASIA'),
(1461, '14', '05', '00', 'HUAURA'),
(1462, '14', '05', '01', 'HUACHO'),
(1463, '14', '05', '02', 'AMBAR'),
(1464, '14', '05', '04', 'CALETA DE CARQUIN'),
(1465, '14', '05', '05', 'CHECRAS'),
(1466, '14', '05', '06', 'HUALMAY'),
(1467, '14', '05', '07', 'HUAURA'),
(1468, '14', '05', '08', 'LEONCIO PRADO'),
(1469, '14', '05', '09', 'PACCHO'),
(1470, '14', '05', '11', 'SANTA LEONOR'),
(1471, '14', '05', '12', 'SANTA MARIA'),
(1472, '14', '05', '13', 'SAYAN'),
(1473, '14', '05', '16', 'VEGUETA'),
(1474, '14', '06', '00', 'HUAROCHIRI'),
(1475, '14', '06', '01', 'MATUCANA'),
(1476, '14', '06', '02', 'ANTIOQUIA'),
(1477, '14', '06', '03', 'CALLAHUANCA'),
(1478, '14', '06', '04', 'CARAMPOMA'),
(1479, '14', '06', '05', 'CASTA'),
(1480, '14', '06', '06', 'SAN JOSE DE LOS CHORRILLOS'),
(1481, '14', '06', '07', 'CHICLA'),
(1482, '14', '06', '08', 'HUANZA'),
(1483, '14', '06', '09', 'HUAROCHIRI'),
(1484, '14', '06', '10', 'LAHUAYTAMBO'),
(1485, '14', '06', '11', 'LANGA'),
(1486, '14', '06', '12', 'MARIATANA'),
(1487, '14', '06', '13', 'RICARDO PALMA'),
(1488, '14', '06', '14', 'SAN ANDRES DE TUPICOCHA'),
(1489, '14', '06', '15', 'SAN ANTONIO'),
(1490, '14', '06', '16', 'SAN BARTOLOME'),
(1491, '14', '06', '17', 'SAN DAMIAN'),
(1492, '14', '06', '18', 'SANGALLAYA'),
(1493, '14', '06', '19', 'SAN JUAN DE TANTARANCHE'),
(1494, '14', '06', '20', 'SAN LORENZO DE QUINTI'),
(1495, '14', '06', '21', 'SAN MATEO'),
(1496, '14', '06', '22', 'SAN MATEO DE OTAO'),
(1497, '14', '06', '23', 'SAN PEDRO DE HUANCAYRE'),
(1498, '14', '06', '24', 'SANTA CRUZ DE COCACHACRA'),
(1499, '14', '06', '25', 'SANTA EULALIA'),
(1500, '14', '06', '26', 'SANTIAGO DE ANCHUCAYA'),
(1501, '14', '06', '27', 'SANTIAGO DE TUNA'),
(1502, '14', '06', '28', 'SANTO DOMINGO DE LOS OLLEROS'),
(1503, '14', '06', '29', 'SURCO'),
(1504, '14', '06', '30', 'HUACHUPAMPA'),
(1505, '14', '06', '31', 'LARAOS'),
(1506, '14', '06', '32', 'SAN JUAN DE IRIS'),
(1507, '14', '07', '00', 'YAUYOS'),
(1508, '14', '07', '01', 'YAUYOS'),
(1509, '14', '07', '02', 'ALIS'),
(1510, '14', '07', '03', 'ALLAUCA'),
(1511, '14', '07', '04', 'AYAVIRI'),
(1512, '14', '07', '05', 'AZANGARO'),
(1513, '14', '07', '06', 'CACRA'),
(1514, '14', '07', '07', 'CARANIA'),
(1515, '14', '07', '08', 'COCHAS'),
(1516, '14', '07', '09', 'COLONIA'),
(1517, '14', '07', '10', 'CHOCOS'),
(1518, '14', '07', '11', 'HUAMPARA'),
(1519, '14', '07', '12', 'HUANCAYA'),
(1520, '14', '07', '13', 'HUANGASCAR'),
(1521, '14', '07', '14', 'HUANTAN'),
(1522, '14', '07', '15', 'HUAÑEC'),
(1523, '14', '07', '16', 'LARAOS'),
(1524, '14', '07', '17', 'LINCHA'),
(1525, '14', '07', '18', 'MIRAFLORES'),
(1526, '14', '07', '19', 'OMAS'),
(1527, '14', '07', '20', 'QUINCHES'),
(1528, '14', '07', '21', 'QUINOCAY'),
(1529, '14', '07', '22', 'SAN JOAQUIN'),
(1530, '14', '07', '23', 'SAN PEDRO DE PILAS'),
(1531, '14', '07', '24', 'TANTA'),
(1532, '14', '07', '25', 'TAURIPAMPA'),
(1533, '14', '07', '26', 'TUPE'),
(1534, '14', '07', '27', 'TOMAS'),
(1535, '14', '07', '28', 'VIÑAC'),
(1536, '14', '07', '29', 'VITIS'),
(1537, '14', '07', '30', 'HONGOS'),
(1538, '14', '07', '31', 'MADEAN'),
(1539, '14', '07', '32', 'PUTINZA'),
(1540, '14', '07', '33', 'CATAHUASI'),
(1541, '14', '08', '00', 'HUARAL'),
(1542, '14', '08', '01', 'HUARAL'),
(1543, '14', '08', '02', 'ATAVILLOS ALTO'),
(1544, '14', '08', '03', 'ATAVILLOS BAJO'),
(1545, '14', '08', '04', 'AUCALLAMA'),
(1546, '14', '08', '05', 'CHANCAY'),
(1547, '14', '08', '06', 'IHUARI'),
(1548, '14', '08', '07', 'LAMPIAN'),
(1549, '14', '08', '08', 'PACARAOS'),
(1550, '14', '08', '09', 'SAN MIGUEL DE ACOS'),
(1551, '14', '08', '10', 'VEINTISIETE DE NOVIEMBRE'),
(1552, '14', '08', '11', 'SANTA CRUZ DE ANDAMARCA'),
(1553, '14', '08', '12', 'SUMBILCA'),
(1554, '14', '09', '00', 'BARRANCA'),
(1555, '14', '09', '01', 'BARRANCA'),
(1556, '14', '09', '02', 'PARAMONGA'),
(1557, '14', '09', '03', 'PATIVILCA'),
(1558, '14', '09', '04', 'SUPE'),
(1559, '14', '09', '05', 'SUPE PUERTO'),
(1560, '14', '10', '00', 'OYON'),
(1561, '14', '10', '01', 'OYON'),
(1562, '14', '10', '02', 'NAVAN'),
(1563, '14', '10', '03', 'CAUJUL'),
(1564, '14', '10', '04', 'ANDAJES'),
(1565, '14', '10', '05', 'PACHANGARA'),
(1566, '14', '10', '06', 'COCHAMARCA'),
(1567, '15', '00', '00', 'LORETO'),
(1568, '15', '01', '00', 'MAYNAS'),
(1569, '15', '01', '01', 'IQUITOS'),
(1570, '15', '01', '02', 'ALTO NANAY'),
(1571, '15', '01', '03', 'FERNANDO LORES'),
(1572, '15', '01', '04', 'LAS AMAZONAS'),
(1573, '15', '01', '05', 'MAZAN'),
(1574, '15', '01', '06', 'NAPO'),
(1575, '15', '01', '07', 'PUTUMAYO'),
(1576, '15', '01', '08', 'TORRES CAUSANA'),
(1577, '15', '01', '10', 'INDIANA'),
(1578, '15', '01', '11', 'PUNCHANA'),
(1579, '15', '01', '12', 'BELEN'),
(1580, '15', '01', '13', 'SAN JUAN BAUTISTA'),
(1581, '15', '01', '14', 'TENIENTE MANUEL CLAVERO'),
(1582, '15', '02', '00', 'ALTO AMAZONAS'),
(1583, '15', '02', '01', 'YURIMAGUAS'),
(1584, '15', '02', '02', 'BALSAPUERTO'),
(1585, '15', '02', '05', 'JEBEROS'),
(1586, '15', '02', '06', 'LAGUNAS'),
(1587, '15', '02', '10', 'SANTA CRUZ'),
(1588, '15', '02', '11', 'TENIENTE CESAR LOPEZ ROJAS'),
(1589, '15', '03', '00', 'LORETO'),
(1590, '15', '03', '01', 'NAUTA'),
(1591, '15', '03', '02', 'PARINARI'),
(1592, '15', '03', '03', 'TIGRE'),
(1593, '15', '03', '04', 'URARINAS'),
(1594, '15', '03', '05', 'TROMPETEROS'),
(1595, '15', '04', '00', 'REQUENA'),
(1596, '15', '04', '01', 'REQUENA'),
(1597, '15', '04', '02', 'ALTO TAPICHE'),
(1598, '15', '04', '03', 'CAPELO'),
(1599, '15', '04', '04', 'EMILIO SAN MARTIN'),
(1600, '15', '04', '05', 'MAQUIA'),
(1601, '15', '04', '06', 'PUINAHUA'),
(1602, '15', '04', '07', 'SAQUENA'),
(1603, '15', '04', '08', 'SOPLIN'),
(1604, '15', '04', '09', 'TAPICHE'),
(1605, '15', '04', '10', 'JENARO HERRERA'),
(1606, '15', '04', '11', 'YAQUERANA'),
(1607, '15', '05', '00', 'UCAYALI'),
(1608, '15', '05', '01', 'CONTAMANA'),
(1609, '15', '05', '02', 'VARGAS GUERRA'),
(1610, '15', '05', '03', 'PADRE MARQUEZ'),
(1611, '15', '05', '04', 'PAMPA HERMOSA'),
(1612, '15', '05', '05', 'SARAYACU'),
(1613, '15', '05', '06', 'INAHUAYA'),
(1614, '15', '06', '00', 'MARISCAL RAMON CASTILLA'),
(1615, '15', '06', '01', 'RAMON CASTILLA'),
(1616, '15', '06', '02', 'PEBAS'),
(1617, '15', '06', '03', 'YAVARI'),
(1618, '15', '06', '04', 'SAN PABLO'),
(1619, '15', '07', '00', 'DATEM DEL MARAÑON'),
(1620, '15', '07', '01', 'BARRANCA'),
(1621, '15', '07', '02', 'ANDOAS'),
(1622, '15', '07', '03', 'CAHUAPANAS'),
(1623, '15', '07', '04', 'MANSERICHE'),
(1624, '15', '07', '05', 'MORONA'),
(1625, '15', '07', '06', 'PASTAZA'),
(1626, '16', '00', '00', 'MADRE DE DIOS'),
(1627, '16', '01', '00', 'TAMBOPATA'),
(1628, '16', '01', '01', 'TAMBOPATA'),
(1629, '16', '01', '02', 'INAMBARI'),
(1630, '16', '01', '03', 'LAS PIEDRAS'),
(1631, '16', '01', '04', 'LABERINTO'),
(1632, '16', '02', '00', 'MANU'),
(1633, '16', '02', '01', 'MANU'),
(1634, '16', '02', '02', 'FITZCARRALD'),
(1635, '16', '02', '03', 'MADRE DE DIOS'),
(1636, '16', '02', '04', 'HUEPETUHE'),
(1637, '16', '03', '00', 'TAHUAMANU'),
(1638, '16', '03', '01', 'IÑAPARI'),
(1639, '16', '03', '02', 'IBERIA'),
(1640, '16', '03', '03', 'TAHUAMANU'),
(1641, '17', '00', '00', 'MOQUEGUA'),
(1642, '17', '01', '00', 'MARISCAL NIETO'),
(1643, '17', '01', '01', 'MOQUEGUA'),
(1644, '17', '01', '02', 'CARUMAS'),
(1645, '17', '01', '03', 'CUCHUMBAYA'),
(1646, '17', '01', '04', 'SAN CRISTOBAL'),
(1647, '17', '01', '05', 'TORATA'),
(1648, '17', '01', '06', 'SAMEGUA'),
(1649, '17', '02', '00', 'GENERAL SANCHEZ CERRO'),
(1650, '17', '02', '01', 'OMATE'),
(1651, '17', '02', '02', 'COALAQUE'),
(1652, '17', '02', '03', 'CHOJATA'),
(1653, '17', '02', '04', 'ICHUÑA'),
(1654, '17', '02', '05', 'LA CAPILLA'),
(1655, '17', '02', '06', 'LLOQUE'),
(1656, '17', '02', '07', 'MATALAQUE'),
(1657, '17', '02', '08', 'PUQUINA'),
(1658, '17', '02', '09', 'QUINISTAQUILLAS'),
(1659, '17', '02', '10', 'UBINAS'),
(1660, '17', '02', '11', 'YUNGA'),
(1661, '17', '03', '00', 'ILO'),
(1662, '17', '03', '01', 'ILO'),
(1663, '17', '03', '02', 'EL ALGARROBAL'),
(1664, '17', '03', '03', 'PACOCHA'),
(1665, '18', '00', '00', 'PASCO'),
(1666, '18', '01', '00', 'PASCO'),
(1667, '18', '01', '01', 'CHAUPIMARCA'),
(1668, '18', '01', '03', 'HUACHON'),
(1669, '18', '01', '04', 'HUARIACA'),
(1670, '18', '01', '05', 'HUAYLLAY'),
(1671, '18', '01', '06', 'NINACACA'),
(1672, '18', '01', '07', 'PALLANCHACRA'),
(1673, '18', '01', '08', 'PAUCARTAMBO'),
(1674, '18', '01', '09', 'SAN FCO DE ASIS DE YARUSYACAN'),
(1675, '18', '01', '10', 'SIMON BOLIVAR'),
(1676, '18', '01', '11', 'TICLACAYAN'),
(1677, '18', '01', '12', 'TINYAHUARCO'),
(1678, '18', '01', '13', 'VICCO'),
(1679, '18', '01', '14', 'YANACANCHA'),
(1680, '18', '02', '00', 'DANIEL ALCIDES CARRION'),
(1681, '18', '02', '01', 'YANAHUANCA'),
(1682, '18', '02', '02', 'CHACAYAN'),
(1683, '18', '02', '03', 'GOYLLARISQUIZGA'),
(1684, '18', '02', '04', 'PAUCAR'),
(1685, '18', '02', '05', 'SAN PEDRO DE PILLAO'),
(1686, '18', '02', '06', 'SANTA ANA DE TUSI'),
(1687, '18', '02', '07', 'TAPUC'),
(1688, '18', '02', '08', 'VILCABAMBA'),
(1689, '18', '03', '00', 'OXAPAMPA'),
(1690, '18', '03', '01', 'OXAPAMPA'),
(1691, '18', '03', '02', 'CHONTABAMBA'),
(1692, '18', '03', '03', 'HUANCABAMBA'),
(1693, '18', '03', '04', 'PUERTO BERMUDEZ'),
(1694, '18', '03', '05', 'VILLA RICA'),
(1695, '18', '03', '06', 'POZUZO'),
(1696, '18', '03', '07', 'PALCAZU'),
(1697, '18', '03', '08', 'CONSTITUCION'),
(1698, '19', '00', '00', 'PIURA'),
(1699, '19', '01', '00', 'PIURA'),
(1700, '19', '01', '01', 'PIURA'),
(1701, '19', '01', '03', 'CASTILLA'),
(1702, '19', '01', '04', 'CATACAOS'),
(1703, '19', '01', '05', 'LA ARENA'),
(1704, '19', '01', '06', 'LA UNION'),
(1705, '19', '01', '07', 'LAS LOMAS'),
(1706, '19', '01', '09', 'TAMBO GRANDE'),
(1707, '19', '01', '13', 'CURA MORI'),
(1708, '19', '01', '14', 'EL TALLAN'),
(1709, '19', '01', '15', 'VEINTISEIS DE OCTUBRE'),
(1710, '19', '02', '00', 'AYABACA'),
(1711, '19', '02', '01', 'AYABACA'),
(1712, '19', '02', '02', 'FRIAS'),
(1713, '19', '02', '03', 'LAGUNAS'),
(1714, '19', '02', '04', 'MONTERO'),
(1715, '19', '02', '05', 'PACAIPAMPA'),
(1716, '19', '02', '06', 'SAPILLICA'),
(1717, '19', '02', '07', 'SICCHEZ'),
(1718, '19', '02', '08', 'SUYO'),
(1719, '19', '02', '09', 'JILILI'),
(1720, '19', '02', '10', 'PAIMAS'),
(1721, '19', '03', '00', 'HUANCABAMBA'),
(1722, '19', '03', '01', 'HUANCABAMBA'),
(1723, '19', '03', '02', 'CANCHAQUE'),
(1724, '19', '03', '03', 'HUARMACA'),
(1725, '19', '03', '04', 'SONDOR'),
(1726, '19', '03', '05', 'SONDORILLO'),
(1727, '19', '03', '06', 'EL CARMEN DE LA FRONTERA'),
(1728, '19', '03', '07', 'SAN MIGUEL DE EL FAIQUE'),
(1729, '19', '03', '08', 'LALAQUIZ'),
(1730, '19', '04', '00', 'MORROPON'),
(1731, '19', '04', '01', 'CHULUCANAS'),
(1732, '19', '04', '02', 'BUENOS AIRES'),
(1733, '19', '04', '03', 'CHALACO'),
(1734, '19', '04', '04', 'MORROPON'),
(1735, '19', '04', '05', 'SALITRAL'),
(1736, '19', '04', '06', 'SANTA CATALINA DE MOSSA'),
(1737, '19', '04', '07', 'SANTO DOMINGO'),
(1738, '19', '04', '08', 'LA MATANZA'),
(1739, '19', '04', '09', 'YAMANGO'),
(1740, '19', '04', '10', 'SAN JUAN DE BIGOTE'),
(1741, '19', '05', '00', 'PAITA'),
(1742, '19', '05', '01', 'PAITA'),
(1743, '19', '05', '02', 'AMOTAPE'),
(1744, '19', '05', '03', 'ARENAL'),
(1745, '19', '05', '04', 'LA HUACA'),
(1746, '19', '05', '05', 'COLAN'),
(1747, '19', '05', '06', 'TAMARINDO'),
(1748, '19', '05', '07', 'VICHAYAL'),
(1749, '19', '06', '00', 'SULLANA'),
(1750, '19', '06', '01', 'SULLANA'),
(1751, '19', '06', '02', 'BELLAVISTA'),
(1752, '19', '06', '03', 'LANCONES'),
(1753, '19', '06', '04', 'MARCAVELICA'),
(1754, '19', '06', '05', 'MIGUEL CHECA'),
(1755, '19', '06', '06', 'QUERECOTILLO'),
(1756, '19', '06', '07', 'SALITRAL'),
(1757, '19', '06', '08', 'IGNACIO ESCUDERO'),
(1758, '19', '07', '00', 'TALARA'),
(1759, '19', '07', '01', 'PARIÑAS'),
(1760, '19', '07', '02', 'EL ALTO'),
(1761, '19', '07', '03', 'LA BREA'),
(1762, '19', '07', '04', 'LOBITOS'),
(1763, '19', '07', '05', 'MANCORA'),
(1764, '19', '07', '06', 'LOS ORGANOS'),
(1765, '19', '08', '00', 'SECHURA'),
(1766, '19', '08', '01', 'SECHURA'),
(1767, '19', '08', '02', 'VICE'),
(1768, '19', '08', '03', 'BERNAL'),
(1769, '19', '08', '04', 'BELLAVISTA DE LA UNION'),
(1770, '19', '08', '05', 'CRISTO NOS VALGA'),
(1771, '19', '08', '06', 'RINCONADA-LLICUAR'),
(1772, '20', '00', '00', 'PUNO'),
(1773, '20', '01', '00', 'PUNO'),
(1774, '20', '01', '01', 'PUNO'),
(1775, '20', '01', '02', 'ACORA'),
(1776, '20', '01', '03', 'ATUNCOLLA'),
(1777, '20', '01', '04', 'CAPACHICA'),
(1778, '20', '01', '05', 'COATA'),
(1779, '20', '01', '06', 'CHUCUITO'),
(1780, '20', '01', '07', 'HUATA'),
(1781, '20', '01', '08', 'MAÑAZO'),
(1782, '20', '01', '09', 'PAUCARCOLLA'),
(1783, '20', '01', '10', 'PICHACANI'),
(1784, '20', '01', '11', 'SAN ANTONIO'),
(1785, '20', '01', '12', 'TIQUILLACA'),
(1786, '20', '01', '13', 'VILQUE'),
(1787, '20', '01', '14', 'PLATERIA'),
(1788, '20', '01', '15', 'AMANTANI'),
(1789, '20', '02', '00', 'AZANGARO'),
(1790, '20', '02', '01', 'AZANGARO'),
(1791, '20', '02', '02', 'ACHAYA'),
(1792, '20', '02', '03', 'ARAPA'),
(1793, '20', '02', '04', 'ASILLO'),
(1794, '20', '02', '05', 'CAMINACA'),
(1795, '20', '02', '06', 'CHUPA'),
(1796, '20', '02', '07', 'JOSE DOMINGO CHOQUEHUANCA'),
(1797, '20', '02', '08', 'MUÑANI'),
(1798, '20', '02', '10', 'POTONI'),
(1799, '20', '02', '12', 'SAMAN'),
(1800, '20', '02', '13', 'SAN ANTON'),
(1801, '20', '02', '14', 'SAN JOSE'),
(1802, '20', '02', '15', 'SAN JUAN DE SALINAS'),
(1803, '20', '02', '16', 'SANTIAGO DE PUPUJA'),
(1804, '20', '02', '17', 'TIRAPATA'),
(1805, '20', '03', '00', 'CARABAYA'),
(1806, '20', '03', '01', 'MACUSANI'),
(1807, '20', '03', '02', 'AJOYANI'),
(1808, '20', '03', '03', 'AYAPATA'),
(1809, '20', '03', '04', 'COASA'),
(1810, '20', '03', '05', 'CORANI'),
(1811, '20', '03', '06', 'CRUCERO'),
(1812, '20', '03', '07', 'ITUATA'),
(1813, '20', '03', '08', 'OLLACHEA'),
(1814, '20', '03', '09', 'SAN GABAN'),
(1815, '20', '03', '10', 'USICAYOS'),
(1816, '20', '04', '00', 'CHUCUITO'),
(1817, '20', '04', '01', 'JULI'),
(1818, '20', '04', '02', 'DESAGUADERO'),
(1819, '20', '04', '03', 'HUACULLANI'),
(1820, '20', '04', '06', 'PISACOMA'),
(1821, '20', '04', '07', 'POMATA'),
(1822, '20', '04', '10', 'ZEPITA'),
(1823, '20', '04', '12', 'KELLUYO'),
(1824, '20', '05', '00', 'HUANCANE'),
(1825, '20', '05', '01', 'HUANCANE'),
(1826, '20', '05', '02', 'COJATA'),
(1827, '20', '05', '04', 'INCHUPALLA'),
(1828, '20', '05', '06', 'PUSI'),
(1829, '20', '05', '07', 'ROSASPATA'),
(1830, '20', '05', '08', 'TARACO'),
(1831, '20', '05', '09', 'VILQUE CHICO'),
(1832, '20', '05', '11', 'HUATASANI'),
(1833, '20', '06', '00', 'LAMPA'),
(1834, '20', '06', '01', 'LAMPA'),
(1835, '20', '06', '02', 'CABANILLA'),
(1836, '20', '06', '03', 'CALAPUJA'),
(1837, '20', '06', '04', 'NICASIO'),
(1838, '20', '06', '05', 'OCUVIRI'),
(1839, '20', '06', '06', 'PALCA'),
(1840, '20', '06', '07', 'PARATIA'),
(1841, '20', '06', '08', 'PUCARA'),
(1842, '20', '06', '09', 'SANTA LUCIA'),
(1843, '20', '06', '10', 'VILAVILA'),
(1844, '20', '07', '00', 'MELGAR'),
(1845, '20', '07', '01', 'AYAVIRI'),
(1846, '20', '07', '02', 'ANTAUTA'),
(1847, '20', '07', '03', 'CUPI'),
(1848, '20', '07', '04', 'LLALLI'),
(1849, '20', '07', '05', 'MACARI'),
(1850, '20', '07', '06', 'NUÑOA'),
(1851, '20', '07', '07', 'ORURILLO'),
(1852, '20', '07', '08', 'SANTA ROSA'),
(1853, '20', '07', '09', 'UMACHIRI'),
(1854, '20', '08', '00', 'SANDIA'),
(1855, '20', '08', '01', 'SANDIA'),
(1856, '20', '08', '03', 'CUYOCUYO'),
(1857, '20', '08', '04', 'LIMBANI'),
(1858, '20', '08', '05', 'PHARA'),
(1859, '20', '08', '06', 'PATAMBUCO'),
(1860, '20', '08', '07', 'QUIACA'),
(1861, '20', '08', '08', 'SAN JUAN DEL ORO'),
(1862, '20', '08', '10', 'YANAHUAYA'),
(1863, '20', '08', '11', 'ALTO INAMBARI'),
(1864, '20', '08', '12', 'SAN PEDRO DE PUTINA PUNCO'),
(1865, '20', '09', '00', 'SAN ROMAN'),
(1866, '20', '09', '01', 'JULIACA'),
(1867, '20', '09', '02', 'CABANA'),
(1868, '20', '09', '03', 'CABANILLAS'),
(1869, '20', '09', '04', 'CARACOTO'),
(1870, '20', '10', '00', 'YUNGUYO'),
(1871, '20', '10', '01', 'YUNGUYO'),
(1872, '20', '10', '02', 'UNICACHI'),
(1873, '20', '10', '03', 'ANAPIA'),
(1874, '20', '10', '04', 'COPANI'),
(1875, '20', '10', '05', 'CUTURAPI'),
(1876, '20', '10', '06', 'OLLARAYA'),
(1877, '20', '10', '07', 'TINICACHI'),
(1878, '20', '11', '00', 'SAN ANTONIO DE PUTINA'),
(1879, '20', '11', '01', 'PUTINA'),
(1880, '20', '11', '02', 'PEDRO VILCA APAZA'),
(1881, '20', '11', '03', 'QUILCAPUNCU'),
(1882, '20', '11', '04', 'ANANEA'),
(1883, '20', '11', '05', 'SINA'),
(1884, '20', '12', '00', 'EL COLLAO'),
(1885, '20', '12', '01', 'ILAVE'),
(1886, '20', '12', '02', 'PILCUYO'),
(1887, '20', '12', '03', 'SANTA ROSA'),
(1888, '20', '12', '04', 'CAPASO'),
(1889, '20', '12', '05', 'CONDURIRI'),
(1890, '20', '13', '00', 'MOHO'),
(1891, '20', '13', '01', 'MOHO'),
(1892, '20', '13', '02', 'CONIMA'),
(1893, '20', '13', '03', 'TILALI'),
(1894, '20', '13', '04', 'HUAYRAPATA'),
(1895, '21', '00', '00', 'SAN MARTIN'),
(1896, '21', '01', '00', 'MOYOBAMBA'),
(1897, '21', '01', '01', 'MOYOBAMBA'),
(1898, '21', '01', '02', 'CALZADA'),
(1899, '21', '01', '03', 'HABANA'),
(1900, '21', '01', '04', 'JEPELACIO'),
(1901, '21', '01', '05', 'SORITOR'),
(1902, '21', '01', '06', 'YANTALO'),
(1903, '21', '02', '00', 'HUALLAGA'),
(1904, '21', '02', '01', 'SAPOSOA'),
(1905, '21', '02', '02', 'PISCOYACU'),
(1906, '21', '02', '03', 'SACANCHE'),
(1907, '21', '02', '04', 'TINGO DE SAPOSOA'),
(1908, '21', '02', '05', 'ALTO SAPOSOA'),
(1909, '21', '02', '06', 'EL ESLABON'),
(1910, '21', '03', '00', 'LAMAS'),
(1911, '21', '03', '01', 'LAMAS'),
(1912, '21', '03', '03', 'BARRANQUITA'),
(1913, '21', '03', '04', 'CAYNARACHI'),
(1914, '21', '03', '05', 'CUÑUMBUQUI'),
(1915, '21', '03', '06', 'PINTO RECODO'),
(1916, '21', '03', '07', 'RUMISAPA'),
(1917, '21', '03', '11', 'SHANAO'),
(1918, '21', '03', '13', 'TABALOSOS'),
(1919, '21', '03', '14', 'ZAPATERO'),
(1920, '21', '03', '15', 'ALONSO DE ALVARADO'),
(1921, '21', '03', '16', 'SAN ROQUE DE CUMBAZA'),
(1922, '21', '04', '00', 'MARISCAL CACERES'),
(1923, '21', '04', '01', 'JUANJUI'),
(1924, '21', '04', '02', 'CAMPANILLA'),
(1925, '21', '04', '03', 'HUICUNGO'),
(1926, '21', '04', '04', 'PACHIZA'),
(1927, '21', '04', '05', 'PAJARILLO'),
(1928, '21', '05', '00', 'RIOJA'),
(1929, '21', '05', '01', 'RIOJA'),
(1930, '21', '05', '02', 'POSIC'),
(1931, '21', '05', '03', 'YORONGOS'),
(1932, '21', '05', '04', 'YURACYACU'),
(1933, '21', '05', '05', 'NUEVA CAJAMARCA'),
(1934, '21', '05', '06', 'ELIAS SOPLIN VARGAS'),
(1935, '21', '05', '07', 'SAN FERNANDO'),
(1936, '21', '05', '08', 'PARDO MIGUEL'),
(1937, '21', '05', '09', 'AWAJUN'),
(1938, '21', '06', '00', 'SAN MARTIN'),
(1939, '21', '06', '01', 'TARAPOTO'),
(1940, '21', '06', '02', 'ALBERTO LEVEAU'),
(1941, '21', '06', '04', 'CACATACHI'),
(1942, '21', '06', '06', 'CHAZUTA'),
(1943, '21', '06', '07', 'CHIPURANA'),
(1944, '21', '06', '08', 'EL PORVENIR'),
(1945, '21', '06', '09', 'HUIMBAYOC'),
(1946, '21', '06', '10', 'JUAN GUERRA'),
(1947, '21', '06', '11', 'MORALES'),
(1948, '21', '06', '12', 'PAPAPLAYA'),
(1949, '21', '06', '16', 'SAN ANTONIO'),
(1950, '21', '06', '19', 'SAUCE'),
(1951, '21', '06', '20', 'SHAPAJA'),
(1952, '21', '06', '21', 'LA BANDA DE SHILCAYO'),
(1953, '21', '07', '00', 'BELLAVISTA'),
(1954, '21', '07', '01', 'BELLAVISTA'),
(1955, '21', '07', '02', 'SAN RAFAEL'),
(1956, '21', '07', '03', 'SAN PABLO'),
(1957, '21', '07', '04', 'ALTO BIAVO'),
(1958, '21', '07', '05', 'HUALLAGA'),
(1959, '21', '07', '06', 'BAJO BIAVO'),
(1960, '21', '08', '00', 'TOCACHE'),
(1961, '21', '08', '01', 'TOCACHE'),
(1962, '21', '08', '02', 'NUEVO PROGRESO'),
(1963, '21', '08', '03', 'POLVORA'),
(1964, '21', '08', '04', 'SHUNTE'),
(1965, '21', '08', '05', 'UCHIZA'),
(1966, '21', '09', '00', 'PICOTA'),
(1967, '21', '09', '01', 'PICOTA'),
(1968, '21', '09', '02', 'BUENOS AIRES'),
(1969, '21', '09', '03', 'CASPIZAPA'),
(1970, '21', '09', '04', 'PILLUANA'),
(1971, '21', '09', '05', 'PUCACACA'),
(1972, '21', '09', '06', 'SAN CRISTOBAL'),
(1973, '21', '09', '07', 'SAN HILARION'),
(1974, '21', '09', '08', 'TINGO DE PONASA'),
(1975, '21', '09', '09', 'TRES UNIDOS'),
(1976, '21', '09', '10', 'SHAMBOYACU'),
(1977, '21', '10', '00', 'EL DORADO'),
(1978, '21', '10', '01', 'SAN JOSE DE SISA'),
(1979, '21', '10', '02', 'AGUA BLANCA'),
(1980, '21', '10', '03', 'SHATOJA'),
(1981, '21', '10', '04', 'SAN MARTIN'),
(1982, '21', '10', '05', 'SANTA ROSA'),
(1983, '22', '00', '00', 'TACNA'),
(1984, '22', '01', '00', 'TACNA'),
(1985, '22', '01', '01', 'TACNA'),
(1986, '22', '01', '02', 'CALANA'),
(1987, '22', '01', '04', 'INCLAN'),
(1988, '22', '01', '07', 'PACHIA'),
(1989, '22', '01', '08', 'PALCA'),
(1990, '22', '01', '09', 'POCOLLAY'),
(1991, '22', '01', '10', 'SAMA'),
(1992, '22', '01', '11', 'ALTO DE LA ALIANZA'),
(1993, '22', '01', '12', 'CIUDAD NUEVA'),
(1994, '22', '01', '13', 'CORONEL GREGORIO ALBARRACIN L.'),
(1995, '22', '02', '00', 'TARATA'),
(1996, '22', '02', '01', 'TARATA'),
(1997, '22', '02', '05', 'HEROES ALBARRACIN'),
(1998, '22', '02', '06', 'ESTIQUE'),
(1999, '22', '02', '07', 'ESTIQUE PAMPA'),
(2000, '22', '02', '10', 'SITAJARA'),
(2001, '22', '02', '11', 'SUSAPAYA'),
(2002, '22', '02', '12', 'TARUCACHI'),
(2003, '22', '02', '13', 'TICACO'),
(2004, '22', '03', '00', 'JORGE BASADRE'),
(2005, '22', '03', '01', 'LOCUMBA'),
(2006, '22', '03', '02', 'ITE'),
(2007, '22', '03', '03', 'ILABAYA'),
(2008, '22', '04', '00', 'CANDARAVE'),
(2009, '22', '04', '01', 'CANDARAVE'),
(2010, '22', '04', '02', 'CAIRANI'),
(2011, '22', '04', '03', 'CURIBAYA'),
(2012, '22', '04', '04', 'HUANUARA'),
(2013, '22', '04', '05', 'QUILAHUANI'),
(2014, '22', '04', '06', 'CAMILACA'),
(2015, '23', '00', '00', 'TUMBES'),
(2016, '23', '01', '00', 'TUMBES'),
(2017, '23', '01', '01', 'TUMBES'),
(2018, '23', '01', '02', 'CORRALES'),
(2019, '23', '01', '03', 'LA CRUZ'),
(2020, '23', '01', '04', 'PAMPAS DE HOSPITAL'),
(2021, '23', '01', '05', 'SAN JACINTO'),
(2022, '23', '01', '06', 'SAN JUAN DE LA VIRGEN'),
(2023, '23', '02', '00', 'CONTRALMIRANTE VILLAR'),
(2024, '23', '02', '01', 'ZORRITOS'),
(2025, '23', '02', '02', 'CASITAS'),
(2026, '23', '02', '03', 'CANOAS DE PUNTA SAL'),
(2027, '23', '03', '00', 'ZARUMILLA'),
(2028, '23', '03', '01', 'ZARUMILLA'),
(2029, '23', '03', '02', 'MATAPALO'),
(2030, '23', '03', '03', 'PAPAYAL'),
(2031, '23', '03', '04', 'AGUAS VERDES'),
(2032, '24', '00', '00', 'CALLAO'),
(2033, '24', '01', '00', 'CALLAO'),
(2034, '24', '01', '01', 'CALLAO'),
(2035, '24', '01', '02', 'BELLAVISTA'),
(2036, '24', '01', '03', 'LA PUNTA'),
(2037, '24', '01', '04', 'CARMEN DE LA LEGUA-REYNOSO'),
(2038, '24', '01', '05', 'LA PERLA'),
(2039, '24', '01', '06', 'VENTANILLA'),
(2040, '25', '00', '00', 'UCAYALI'),
(2041, '25', '01', '00', 'CORONEL PORTILLO'),
(2042, '25', '01', '01', 'CALLERIA'),
(2043, '25', '01', '02', 'YARINACOCHA'),
(2044, '25', '01', '03', 'MASISEA'),
(2045, '25', '01', '04', 'CAMPOVERDE'),
(2046, '25', '01', '05', 'IPARIA'),
(2047, '25', '01', '06', 'NUEVA REQUENA'),
(2048, '25', '01', '07', 'MANANTAY'),
(2049, '25', '02', '00', 'PADRE ABAD'),
(2050, '25', '02', '01', 'PADRE ABAD'),
(2051, '25', '02', '02', 'IRAZOLA'),
(2052, '25', '02', '03', 'CURIMANA'),
(2053, '25', '03', '00', 'ATALAYA'),
(2054, '25', '03', '01', 'RAIMONDI'),
(2055, '25', '03', '02', 'TAHUANIA'),
(2056, '25', '03', '03', 'YURUA'),
(2057, '25', '03', '04', 'SEPAHUA'),
(2058, '25', '04', '00', 'PURUS'),
(2059, '25', '04', '01', 'PURUS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `id_venta` int(11) NOT NULL,
  `id_socio` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_modalidad_transaccion` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
CREATE TABLE IF NOT EXISTS `venta_producto` (
  `id_venta_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vigencia`
--

DROP TABLE IF EXISTS `vigencia`;
CREATE TABLE IF NOT EXISTS `vigencia` (
  `id_vigencia` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vigencia`
--

INSERT INTO `vigencia` (`id_vigencia`, `descripcion`, `dias`) VALUES
(1, 'Dias', 1),
(2, 'Semana', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alertas`
--
ALTER TABLE `alertas`
 ADD PRIMARY KEY (`id_alerta`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
 ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `almacen_producto`
--
ALTER TABLE `almacen_producto`
 ADD PRIMARY KEY (`id_almacen`,`id_producto`);

--
-- Indices de la tabla `ambiente`
--
ALTER TABLE `ambiente`
 ADD PRIMARY KEY (`id_ambiente`);

--
-- Indices de la tabla `amortizacion_compra`
--
ALTER TABLE `amortizacion_compra`
 ADD PRIMARY KEY (`id_amortizacion_compra`), ADD KEY `cuota_compra_autorizacion_compra_fk` (`id_cuota_compra`), ADD KEY `movimiento_autorizacion_compra_fk` (`id_movimiento`);

--
-- Indices de la tabla `amortizacion_matricula`
--
ALTER TABLE `amortizacion_matricula`
 ADD PRIMARY KEY (`id_amortizacion_matricula`), ADD KEY `cuota_matricula_amoritzacion_matricula_fk` (`id_cuota_matricula`), ADD KEY `movimiento_amoritzacion_matricula_fk` (`id_movimiento`);

--
-- Indices de la tabla `amortizacion_venta`
--
ALTER TABLE `amortizacion_venta`
 ADD PRIMARY KEY (`id_amortizacion_venta`), ADD KEY `cuota_venta_autorizacion_venta_fk` (`id_cuota_venta`), ADD KEY `movimiento_autorizacion_venta_fk` (`id_movimiento`);

--
-- Indices de la tabla `asistencia_empleado`
--
ALTER TABLE `asistencia_empleado`
 ADD PRIMARY KEY (`id_asistencia_empleado`), ADD KEY `empleado_asistencia_empleado_fk` (`id_empleado`), ADD KEY `turno_asistencia_empleado_fk` (`id_turno`), ADD KEY `servicio_asistencia_empleado_fk` (`id_servicio`);

--
-- Indices de la tabla `asistencia_socio`
--
ALTER TABLE `asistencia_socio`
 ADD PRIMARY KEY (`id_asistencia_socio`), ADD KEY `socio_asistencia_socio_fk` (`id_socio`), ADD KEY `turno_asistencia_socio_fk` (`id_turno`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
 ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `categoria_ejercicio`
--
ALTER TABLE `categoria_ejercicio`
 ADD PRIMARY KEY (`id_categoria_ejercicio`);

--
-- Indices de la tabla `categoria_empleado`
--
ALTER TABLE `categoria_empleado`
 ADD PRIMARY KEY (`id_categoria_empleado`);

--
-- Indices de la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
 ADD PRIMARY KEY (`id_categoria_evento`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
 ADD PRIMARY KEY (`id_categoria_producto`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
 ADD PRIMARY KEY (`id_compra`), ADD KEY `proveedor_compra_fk` (`id_proveedor`), ADD KEY `empleado_compra_fk` (`id_empleado`), ADD KEY `modalidad_transaccion_compra_fk` (`id_modalidad_transaccion`);

--
-- Indices de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
 ADD PRIMARY KEY (`id_compra`,`id_producto`,`id_almacen`), ADD KEY `almacen_compra_producto_fk` (`id_almacen`), ADD KEY `compra_compra_producto_fk` (`id_compra`), ADD KEY `producto_compra_producto_fk` (`id_producto`);

--
-- Indices de la tabla `concepto_movimiento`
--
ALTER TABLE `concepto_movimiento`
 ADD PRIMARY KEY (`id_concepto_movimiento`), ADD KEY `tipo_movimiento_concepto_movimiento_fk` (`id_tipo_movimiento`);

--
-- Indices de la tabla `concepto_triaje`
--
ALTER TABLE `concepto_triaje`
 ADD PRIMARY KEY (`id_concepto_triaje`);

--
-- Indices de la tabla `cuota_compra`
--
ALTER TABLE `cuota_compra`
 ADD PRIMARY KEY (`id_cuota_compra`), ADD KEY `compra_cuota_compra_fk` (`id_compra`);

--
-- Indices de la tabla `cuota_matricula`
--
ALTER TABLE `cuota_matricula`
 ADD PRIMARY KEY (`id_cuota_matricula`), ADD KEY `matricula_cuota_matricula_fk` (`id_matricula`);

--
-- Indices de la tabla `cuota_venta`
--
ALTER TABLE `cuota_venta`
 ADD PRIMARY KEY (`id_cuota_venta`), ADD KEY `venta_cuota_fk` (`id_venta`);

--
-- Indices de la tabla `datos_empresa`
--
ALTER TABLE `datos_empresa`
 ADD PRIMARY KEY (`id_datos_empresa`), ADD KEY `ubigeo_datos_empresa_fk` (`id_ubigeo`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
 ADD PRIMARY KEY (`id_ejercicio`), ADD KEY `categoria_ejercicio_ejercicio_fk` (`id_categoria_ejercicio`), ADD KEY `servicio_ejercicio_fk` (`id_servicio`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
 ADD PRIMARY KEY (`id_empleado`), ADD KEY `perfil_usuario_empleado_fk` (`id_perfil_usuario`), ADD KEY `categoria_empleado_empleado_fk` (`id_categoria_empleado`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
 ADD PRIMARY KEY (`id_evento`), ADD KEY `categoria_evento_evento_fk` (`id_categoria_evento`);

--
-- Indices de la tabla `forma_pago`
--
ALTER TABLE `forma_pago`
 ADD PRIMARY KEY (`id_forma_pago`);

--
-- Indices de la tabla `imagen_categoria_empleado`
--
ALTER TABLE `imagen_categoria_empleado`
 ADD PRIMARY KEY (`id_imagen_categoria_empleado`), ADD KEY `categoria_empleado_imagen_categoria_empleado_fk` (`id_categoria_empleado`);

--
-- Indices de la tabla `imagen_producto`
--
ALTER TABLE `imagen_producto`
 ADD PRIMARY KEY (`id_imagen_producto`), ADD KEY `producto_imagen_producto_fk` (`id_producto`);

--
-- Indices de la tabla `imagen_servicio`
--
ALTER TABLE `imagen_servicio`
 ADD PRIMARY KEY (`id_imagen_servicio`), ADD KEY `servicio_imagen_servicio_fk` (`id_servicio`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
 ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
 ADD PRIMARY KEY (`id_matricula`), ADD KEY `empleado_matricula_fk` (`id_empleado`), ADD KEY `membresia_matricula_fk` (`id_membresia`), ADD KEY `socio_matricula_fk` (`id_socio`);

--
-- Indices de la tabla `membresia`
--
ALTER TABLE `membresia`
 ADD PRIMARY KEY (`id_membresia`), ADD KEY `tipo_membresia_membresia_fk` (`id_tipo_membresia`), ADD KEY `vigencia_membresia_fk` (`id_vigencia`);

--
-- Indices de la tabla `modalidad_transaccion`
--
ALTER TABLE `modalidad_transaccion`
 ADD PRIMARY KEY (`id_modalidad_transaccion`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
 ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
 ADD PRIMARY KEY (`id_movimiento`), ADD KEY `concepto_movimiento_movimiento_fk` (`id_concepto_movimiento`), ADD KEY `forma_pago_movimiento_fk` (`id_forma_pago`), ADD KEY `serie_documento_movimiento_fk` (`id_serie_documento`), ADD KEY `sesion_caja_movimiento_fk` (`id_sesion_caja`);

--
-- Indices de la tabla `param`
--
ALTER TABLE `param`
 ADD PRIMARY KEY (`id_param`);

--
-- Indices de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
 ADD PRIMARY KEY (`id_perfil_usuario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
 ADD PRIMARY KEY (`id_modulo`,`id_perfil_usuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`id_producto`), ADD KEY `marca_producto_fk` (`id_marca`), ADD KEY `categoria_producto_producto_fk` (`id_categoria_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
 ADD PRIMARY KEY (`id_proveedor`), ADD KEY `ubigeo_proveedor_fk` (`id_ubigeo`);

--
-- Indices de la tabla `rutina`
--
ALTER TABLE `rutina`
 ADD PRIMARY KEY (`id_rutina`), ADD KEY `socio_rutina_fk` (`id_socio`), ADD KEY `categoria_ejercicio_rutina_fk` (`id_categoria_ejercicio`);

--
-- Indices de la tabla `serie_documento`
--
ALTER TABLE `serie_documento`
 ADD PRIMARY KEY (`id_serie_documento`), ADD KEY `tipo_documento_serie_documento_fk` (`id_tipo_documento`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
 ADD PRIMARY KEY (`id_servicio`), ADD KEY `ambiente_servicio_fk` (`id_ambiente`);

--
-- Indices de la tabla `servicio_x_matricula`
--
ALTER TABLE `servicio_x_matricula`
 ADD PRIMARY KEY (`id_servicio_x_matricula`), ADD KEY `matricula_servicio_x_matricula_fk` (`id_matricula`), ADD KEY `servicio_servicio_x_matricula_fk` (`id_servicio`);

--
-- Indices de la tabla `sesion_caja`
--
ALTER TABLE `sesion_caja`
 ADD PRIMARY KEY (`id_sesion_caja`), ADD KEY `caja_sesion_caja_fk` (`id_caja`), ADD KEY `empleado_sesion_caja_fk` (`id_empleado`), ADD KEY `turno_sesion_caja_fk` (`id_turno`);

--
-- Indices de la tabla `socio`
--
ALTER TABLE `socio`
 ADD PRIMARY KEY (`id_socio`), ADD KEY `ubigeo_socio_fk` (`idubigeo`), ADD KEY `tipo_socio_socio_fk` (`id_tipo_socio`);

--
-- Indices de la tabla `socio_x_evento`
--
ALTER TABLE `socio_x_evento`
 ADD PRIMARY KEY (`id_socio_x_evento`), ADD KEY `socio_socio_x_evento_fk` (`id_socio`), ADD KEY `evento_socio_x_evento_fk` (`id_evento`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
 ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `tipo_membresia`
--
ALTER TABLE `tipo_membresia`
 ADD PRIMARY KEY (`id_tipo_membresia`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
 ADD PRIMARY KEY (`id_tipo_movimiento`);

--
-- Indices de la tabla `tipo_socio`
--
ALTER TABLE `tipo_socio`
 ADD PRIMARY KEY (`id_tipo_socio`);

--
-- Indices de la tabla `triaje`
--
ALTER TABLE `triaje`
 ADD PRIMARY KEY (`id_triaje`), ADD KEY `socio_triaje_fk` (`id_socio`), ADD KEY `concepto_triaje_triaje_fk` (`id_concepto_triaje`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
 ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `ubigeos`
--
ALTER TABLE `ubigeos`
 ADD PRIMARY KEY (`idubigeo`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
 ADD PRIMARY KEY (`id_venta`), ADD KEY `empleado_venta_fk` (`id_empleado`), ADD KEY `modalidad_transaccion_venta_fk` (`id_modalidad_transaccion`), ADD KEY `socio_venta_fk` (`id_socio`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
 ADD PRIMARY KEY (`id_venta_producto`), ADD KEY `almacen_venta_producto_fk` (`id_almacen`), ADD KEY `producto_venta_producto_fk` (`id_producto`), ADD KEY `venta_venta_producto_fk` (`id_venta`);

--
-- Indices de la tabla `vigencia`
--
ALTER TABLE `vigencia`
 ADD PRIMARY KEY (`id_vigencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ubigeos`
--
ALTER TABLE `ubigeos`
MODIFY `idubigeo` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2060;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
