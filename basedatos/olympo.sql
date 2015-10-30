-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2015 a las 16:01:24
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `olympo-or`
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

DROP PROCEDURE IF EXISTS `pa_i_socio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_socio`(IN `paid_tipo_socio` INT, IN `paid_ubigeo` INT, IN `padni` CHAR(8), IN `paaliass` VARCHAR(50), IN `panombre` VARCHAR(30), IN `paapellido_paterno` VARCHAR(30), IN `paapellido_materno` VARCHAR(30), IN `paemail` VARCHAR(50), IN `patelefono` VARCHAR(15), IN `pacelular` VARCHAR(15), IN `padireccion` VARCHAR(50), IN `pafecha_nacimiento` DATE, IN `pasexo` CHAR(1), IN `paestado_civil` VARCHAR(20), IN `paocupacion` VARCHAR(50), IN `pagrupo_sanguineo` VARCHAR(10), IN `pahobby` VARCHAR(30), IN `panacionalidad` VARCHAR(30), IN `paseguro_medico` VARCHAR(30), IN `paobservacion` VARCHAR(250), IN `paantecedente_medico` VARCHAR(100), IN `pacodigo_postal` VARCHAR(10), IN `pafax` VARCHAR(20), IN `panumero_hijo` INT, IN `pasector` VARCHAR(30), IN `pagrado_estudio` VARCHAR(30), IN `paingresos` VARCHAR(30))
begin
declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_socio) from socio);
set _nuevo =(_actual+1);
if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;
INSERT INTO `socio`(`id_socio`, `id_tipo_socio`, `idubigeo`, `dni`, `aliass`, `nombre`, 
	`apellido_paterno`, `apellido_materno`, `email`, `telefono`, `celular`, `direccion`, 
	`fecha_nacimiento`, `sexo`, `estado_civil`, `ocupacion`, `estado`, `grupo_sanguineo`, 
	`hobby`, `nacionalidad`, `seguro_medico`, `observacion`, `antecedente_medico`, 
	`codigo_postal`, `fax`, `numero_hijo`, `sector`, `grado_estudio`, 
	`ingresos`)
VALUES (_nuevo, paid_tipo_socio,paid_ubigeo,padni,paaliass,panombre,paapellido_paterno,
	 paapellido_materno, paemail ,patelefono ,pacelular,padireccion,pafecha_nacimiento,
	 pasexo ,paestado_civil ,paocupacion ,'1',pagrupo_sanguineo ,pahobby ,panacionalidad ,
	paseguro_medico, paobservacion ,paantecedente_medico ,pacodigo_postal ,pafax ,
	panumero_hijo ,pasector ,pagrado_estudio ,paingresos);

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

DROP PROCEDURE IF EXISTS `pa_i_triaje`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_i_triaje`(
   paid_socio int(11),
   paid_concepto_triaje int(11),
   paunidad_medida varchar(10),
   pavalor float,
   pafecha date
)
begin

declare  _actual int;
declare _nuevo int ;
set _actual=(select max(id_triaje) from triaje);
set _nuevo =(_actual+1);

if (_nuevo IS NULL or _nuevo<1) then
	set _nuevo =1;
end if;

insert into triaje(id_triaje,id_socio,id_concepto_triaje,unidad_medida,valor,fecha) 
values
(_nuevo,paid_socio,paid_concepto_triaje,paunidad_medida,pavalor,pafecha) ;
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

DROP PROCEDURE IF EXISTS `pa_m2_servicio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_servicio`(
paid_servicio int
)
begin
SELECT `id_servicio`, `id_ambiente`, `nombre`, `descripcion`, `estado` 
FROM `servicio`
where (id_servicio=paid_servicio) and estado='1';
end$$

DROP PROCEDURE IF EXISTS `pa_m2_socio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_m2_socio`(IN `paid_socio` INT)
begin
select 
  s.id_socio, 
  pu.id_perfil_usuario,
  pu.descripcion as 'perfil',
  ts.descripcion as 'tipo_socio',
  ts.id_tipo_socio,
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
where ( s.id_socio=paid_socio) and s.estado='1';
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

DROP PROCEDURE IF EXISTS `pa_u_socio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_socio`(
paid_socio int,
paid_tipo_socio int,
paid_ubigeo int,
padni char(8),
paaliass varchar(50),
panombre varchar(30),
paapellido_paterno varchar(30),
paapellido_materno varchar (30),
paemail varchar(50),
patelefono varchar(15),
pacelular varchar(15),
padireccion varchar(50),
pafecha_nacimiento date,
pasexo char(1),
paestado_civil varchar(20),
paocupacion varchar(50),
pagrupo_sanguineo varchar(10),
pahobby varchar(30),
panacionalidad varchar(30),
paseguro_medico varchar(30),
paobservacion varchar(250),
paantecedente_medico varchar(100),
pacodigo_postal varchar(10),
pafax varchar(20),
panumero_hijo int,
pasector varchar(30),
pagrado_estudio varchar(30),
paingresos varchar(30)
)
begin
UPDATE `socio` 
SET 	`id_socio`=paid_socio ,
	`id_tipo_socio`=paid_tipo_socio,
	`idubigeo`=paid_ubigeo ,
	`dni`=padni ,
	`aliass`=paaliass,
	`nombre`=panombre,
	`apellido_paterno`=paapellido_paterno,
	`apellido_materno`=paapellido_materno,
	`email`=paemail,
	`telefono`=patelefono,
	`celular`=pacelular,
	`direccion`=padireccion,
	`fecha_nacimiento`=pafecha_nacimiento,
	`sexo`= pasexo,
	`estado_civil`=paestado_civil,
	`ocupacion`=paocupacion,
	`grupo_sanguineo`=pagrupo_sanguineo,
	`hobby`=pahobby,
	`nacionalidad`=panacionalidad,
	`seguro_medico`=paseguro_medico,
	`observacion`=paobservacion,
	`antecedente_medico`=paantecedente_medico,
	`codigo_postal`=pacodigo_postal,
	`fax`=pafax,
	`numero_hijo`=panumero_hijo,
	`sector`=pasector,
	`grado_estudio`=pagrado_estudio,
	`ingresos`=paingresos
	
where `id_socio`=paid_socio ;
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

DROP PROCEDURE IF EXISTS `pa_u_triaje`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_u_triaje`(
   paid_triaje int(11) ,
   paid_socio int(11),
   paid_concepto_triaje int(11),
   paunidad_medida varchar(10),
   pavalor float,
   pafecha date
)
begin
update triaje set id_socio=paid_socio,id_concepto_triaje=paid_concepto_triaje,
unidad_medida=paunidad_medida,valor=pavalor,fecha=pafecha
where id_triaje=paid_triaje ;
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

DROP PROCEDURE IF EXISTS `sel_dni`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_dni`(
padni char(8)

)
begin
SELECT `id_socio`, `id_tipo_socio`, `idubigeo`, `dni`, `aliass`,
	 `nombre`, `apellido_paterno`, `apellido_materno`, `email`,
	 `telefono`, `celular`, `direccion`, `fecha_nacimiento`, `sexo`,
	 `estado_civil`, `ocupacion`, `estado`, `grupo_sanguineo`, `hobby`,
	 `nacionalidad`, `seguro_medico`, `observacion`, `antecedente_medico`,
	 `codigo_postal`, `fax`, `numero_hijo`, `sector`, `grado_estudio`,
	 `ingresos`
FROM `socio`
where (dni=padni) and estado='1';
end$$

DROP PROCEDURE IF EXISTS `sel_provincia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sel_provincia`(
   pacod_provincia varchar(5)
)
begin
SELECT * 
FROM ubigeos
where 
	codigo_region=pacod_provincia 
	and codigo_provincia<>'00' 
	and codigo_distrito='00';

end$$

DROP PROCEDURE IF EXISTS `triaje_socio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `triaje_socio`(
   paid_socio int(11)
)
begin
select t.id_triaje,s.nombre,s.apellido_paterno,
       s.apellido_materno,ct.descripcion,t.unidad_medida,t.valor,t.fecha

from triaje as t
inner join socio as s on s.id_socio=t.id_socio
inner join concepto_triaje as ct on ct.id_concepto_triaje=t.id_concepto_triaje

where (t.id_socio=paid_socio);

end$$

DROP PROCEDURE IF EXISTS `ultimo_triaje`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ultimo_triaje`(
   paid_socio int(11)
)
begin
declare  _ultimo date;

set _ultimo  =(select max(fecha) from triaje where id_socio = paid_socio);

select t.id_triaje,s.nombre,s.apellido_paterno,
       s.apellido_materno,ct.id_concepto_triaje as 'id_concepto_triaje',ct.descripcion as 'concepto_triaje',t.unidad_medida,t.valor,t.fecha

from triaje as t
inner join socio as s on s.id_socio=t.id_socio
inner join concepto_triaje as ct on ct.id_concepto_triaje=t.id_concepto_triaje

where (t.id_socio=paid_socio and t.fecha=_ultimo);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amortizacion_compra`
--

DROP TABLE IF EXISTS `amortizacion_compra`;
CREATE TABLE IF NOT EXISTS `amortizacion_compra` (
  `id_amortizacion_compra` int(11) NOT NULL,
  `id_cuota_compra` int(11) NOT NULL,
  `id_movimiento` int(11) NOT NULL,
  `monto` float NOT NULL
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
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

DROP TABLE IF EXISTS `compra_producto`;
CREATE TABLE IF NOT EXISTS `compra_producto` (
  `id_compra_producto` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto_triaje`
--

DROP TABLE IF EXISTS `concepto_triaje`;
CREATE TABLE IF NOT EXISTS `concepto_triaje` (
  `id_concepto_triaje` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `ruc` int(11) NOT NULL,
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
-- Estructura de tabla para la tabla `perfil_usuario`
--

DROP TABLE IF EXISTS `perfil_usuario`;
CREATE TABLE IF NOT EXISTS `perfil_usuario` (
  `id_perfil_usuario` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `sexo` bit(1) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

DROP TABLE IF EXISTS `tipo_movimiento`;
CREATE TABLE IF NOT EXISTS `tipo_movimiento` (
  `id_tipo_movimiento` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2060 DEFAULT CHARSET=latin1;

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
 ADD PRIMARY KEY (`id_compra_producto`), ADD KEY `almacen_compra_producto_fk` (`id_almacen`), ADD KEY `compra_compra_producto_fk` (`id_compra`), ADD KEY `producto_compra_producto_fk` (`id_producto`);

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
