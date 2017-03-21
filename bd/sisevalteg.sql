-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.16-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para sisevalteg.0
CREATE DATABASE IF NOT EXISTS `sisevalteg.0` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `sisevalteg.0`;


-- Volcando estructura para tabla sisevalteg.0.actividad
CREATE TABLE IF NOT EXISTS `actividad` (
  `act_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `act_descrip` varchar(200) COLLATE utf8_bin NOT NULL,
  `act_abreviatura` varchar(10) COLLATE utf8_bin NOT NULL,
  `act_responsable` int(11) NOT NULL,
  PRIMARY KEY (`act_codigo`),
  KEY `FK_actividad_actividad_resp` (`act_responsable`),
  CONSTRAINT `FK_actividad_actividad_resp` FOREIGN KEY (`act_responsable`) REFERENCES `actividad_resp` (`actr_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.actividad: ~3 rows (aproximadamente)
DELETE FROM `actividad`;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` (`act_codigo`, `act_descrip`, `act_abreviatura`, `act_responsable`) VALUES
	(3, 'ENTREGA', 'EN', 1),
	(4, 'REVISION', 'REV', 2),
	(5, 'EVALUACION', 'EVL', 3);
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.actividad_agenda
CREATE TABLE IF NOT EXISTS `actividad_agenda` (
  `agen_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `agen_actcodigo` int(11) NOT NULL,
  `agen_tescodigo` int(11) NOT NULL,
  `agen_fecejec` date NOT NULL,
  `agen_feceval` date NOT NULL,
  `agen_estado` set('EVALUADO','EJECUTADO','POR EVALUAR') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`agen_codigo`),
  KEY `FK_actividad_agenda_actividad` (`agen_actcodigo`),
  KEY `FK_actividad_agenda_tesis` (`agen_tescodigo`),
  CONSTRAINT `FK_actividad_agenda_actividad` FOREIGN KEY (`agen_actcodigo`) REFERENCES `actividad` (`act_codigo`),
  CONSTRAINT `FK_actividad_agenda_tesis` FOREIGN KEY (`agen_tescodigo`) REFERENCES `tesis` (`tes_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.actividad_agenda: ~3 rows (aproximadamente)
DELETE FROM `actividad_agenda`;
/*!40000 ALTER TABLE `actividad_agenda` DISABLE KEYS */;
INSERT INTO `actividad_agenda` (`agen_codigo`, `agen_actcodigo`, `agen_tescodigo`, `agen_fecejec`, `agen_feceval`, `agen_estado`) VALUES
	(6, 3, 12, '2017-03-05', '2017-03-05', 'EVALUADO'),
	(7, 4, 12, '2017-03-05', '2017-03-05', 'EVALUADO'),
	(9, 5, 12, '2017-03-05', '2017-03-05', 'EVALUADO');
/*!40000 ALTER TABLE `actividad_agenda` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.actividad_resp
CREATE TABLE IF NOT EXISTS `actividad_resp` (
  `actr_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `actr_descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`actr_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.actividad_resp: ~4 rows (aproximadamente)
DELETE FROM `actividad_resp`;
/*!40000 ALTER TABLE `actividad_resp` DISABLE KEYS */;
INSERT INTO `actividad_resp` (`actr_codigo`, `actr_descripcion`) VALUES
	(1, 'ALUMNO'),
	(2, 'TUTOR'),
	(3, 'JURADO'),
	(4, 'COORDINADOR'),
	(5, 'COMISION');
/*!40000 ALTER TABLE `actividad_resp` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.area
CREATE TABLE IF NOT EXISTS `area` (
  `ar_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `ar_descrip` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ar_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.area: ~1 rows (aproximadamente)
DELETE FROM `area`;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` (`ar_codigo`, `ar_descrip`) VALUES
	(1, 'TECNOLOGIA');
/*!40000 ALTER TABLE `area` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.carrera
CREATE TABLE IF NOT EXISTS `carrera` (
  `car_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `car_descrip` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`car_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.carrera: ~1 rows (aproximadamente)
DELETE FROM `carrera`;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` (`car_codigo`, `car_descrip`) VALUES
	(1, 'ingenieria informatica');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.criterio
CREATE TABLE IF NOT EXISTS `criterio` (
  `cri_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cri_orden` int(11) NOT NULL,
  `cri_tipo` int(11) NOT NULL,
  `cri_aspecto` varchar(300) COLLATE utf8_bin NOT NULL,
  `cri_estado` int(11) NOT NULL,
  PRIMARY KEY (`cri_codigo`),
  KEY `cri_codigo` (`cri_codigo`),
  KEY `FK_criterio_criterio_tipo` (`cri_tipo`),
  KEY `FK_criterio_status` (`cri_estado`),
  CONSTRAINT `FK_criterio_criterio_tipo` FOREIGN KEY (`cri_tipo`) REFERENCES `criterio_tipo` (`crit_codigo`),
  CONSTRAINT `FK_criterio_status` FOREIGN KEY (`cri_estado`) REFERENCES `status` (`st_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.criterio: ~2 rows (aproximadamente)
DELETE FROM `criterio`;
/*!40000 ALTER TABLE `criterio` DISABLE KEYS */;
INSERT INTO `criterio` (`cri_codigo`, `cri_orden`, `cri_tipo`, `cri_aspecto`, `cri_estado`) VALUES
	(1, 1, 2, 'El título se delimita a la línea de investigación.', 1),
	(2, 2, 2, 'Organización de páginas preliminares', 1);
/*!40000 ALTER TABLE `criterio` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.criteriod
CREATE TABLE IF NOT EXISTS `criteriod` (
  `crid_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `crid_tipo` int(11) NOT NULL,
  `crid_aspecto` varchar(150) COLLATE utf8_bin NOT NULL,
  `crid_indicador` varchar(150) COLLATE utf8_bin NOT NULL,
  `crid_estado` int(11) NOT NULL,
  PRIMARY KEY (`crid_codigo`),
  KEY `FK_criteriod_status` (`crid_estado`),
  KEY `FK_criteriod_criterio_tipo` (`crid_tipo`),
  CONSTRAINT `FK_criteriod_criterio_tipo` FOREIGN KEY (`crid_tipo`) REFERENCES `criterio_tipo` (`crit_codigo`),
  CONSTRAINT `FK_criteriod_status` FOREIGN KEY (`crid_estado`) REFERENCES `status` (`st_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.criteriod: ~2 rows (aproximadamente)
DELETE FROM `criteriod`;
/*!40000 ALTER TABLE `criteriod` DISABLE KEYS */;
INSERT INTO `criteriod` (`crid_codigo`, `crid_tipo`, `crid_aspecto`, `crid_indicador`, `crid_estado`) VALUES
	(1, 5, 'El título se delimita a la línea de investigación', 'El título enuncia la propuesta de  forma clara, precisa y concisa indicando el qué, para qué y para quién.', 1);
/*!40000 ALTER TABLE `criteriod` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.criteriot
CREATE TABLE IF NOT EXISTS `criteriot` (
  `crit_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `crit_orden` int(11) NOT NULL,
  `crit_tipo` int(11) NOT NULL,
  `crit_descrip` varchar(250) COLLATE utf8_bin NOT NULL,
  `crit_estado` int(11) NOT NULL,
  PRIMARY KEY (`crit_codigo`),
  KEY `FK_criteriot_criterio_tipo` (`crit_tipo`),
  KEY `FK_criteriot_status` (`crit_estado`),
  CONSTRAINT `FK_criteriot_criterio_tipo` FOREIGN KEY (`crit_tipo`) REFERENCES `criterio_tipo` (`crit_codigo`),
  CONSTRAINT `FK_criteriot_status` FOREIGN KEY (`crit_estado`) REFERENCES `status` (`st_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.criteriot: ~0 rows (aproximadamente)
DELETE FROM `criteriot`;
/*!40000 ALTER TABLE `criteriot` DISABLE KEYS */;
/*!40000 ALTER TABLE `criteriot` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.criterio_tipo
CREATE TABLE IF NOT EXISTS `criterio_tipo` (
  `crit_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `crit_descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`crit_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.criterio_tipo: ~8 rows (aproximadamente)
DELETE FROM `criterio_tipo`;
/*!40000 ALTER TABLE `criterio_tipo` DISABLE KEYS */;
INSERT INTO `criterio_tipo` (`crit_codigo`, `crit_descripcion`) VALUES
	(1, 'DOCUMENTO'),
	(2, 'PRODUCTO'),
	(3, 'ORAL'),
	(4, 'PRESENTACION'),
	(5, 'INICIAL'),
	(6, 'CAPITULO I'),
	(7, 'CAPITULO II'),
	(8, 'CAPITULO III'),
	(9, 'CAPITULO IV'),
	(10, 'FINAL');
/*!40000 ALTER TABLE `criterio_tipo` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.docente
CREATE TABLE IF NOT EXISTS `docente` (
  `doc_codigo` int(3) NOT NULL AUTO_INCREMENT,
  `doc_cedula` int(11) NOT NULL,
  `doc_grado` int(11) NOT NULL,
  `doc_limtutot` int(2) NOT NULL,
  `doc_limjurado` int(2) NOT NULL,
  PRIMARY KEY (`doc_codigo`),
  UNIQUE KEY `doc_cedula` (`doc_cedula`),
  KEY `FK_docente_persona_grado` (`doc_grado`),
  CONSTRAINT `FK_docente_persona` FOREIGN KEY (`doc_cedula`) REFERENCES `persona` (`per_cedula`),
  CONSTRAINT `FK_docente_persona_grado` FOREIGN KEY (`doc_grado`) REFERENCES `persona_grado` (`perg_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.docente: ~1 rows (aproximadamente)
DELETE FROM `docente`;
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` (`doc_codigo`, `doc_cedula`, `doc_grado`, `doc_limtutot`, `doc_limjurado`) VALUES
	(19, 14434283, 1, 1, 6);
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.evaluacion
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `eval_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `eval_tescodigo` int(11) NOT NULL,
  `eval_cricodigo` int(11) NOT NULL,
  `eval_tipo` set('ASPECTO','TEG','DOCUMENTO') COLLATE utf8_bin NOT NULL,
  `eval_notat` int(11) DEFAULT NULL,
  `eval_cedulaj` varchar(10) COLLATE utf8_bin NOT NULL,
  `eval_notaj` int(11) DEFAULT NULL,
  PRIMARY KEY (`eval_codigo`),
  KEY `eval_cricodigo` (`eval_cricodigo`),
  KEY `eval_tescodigo` (`eval_tescodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.evaluacion: ~4 rows (aproximadamente)
DELETE FROM `evaluacion`;
/*!40000 ALTER TABLE `evaluacion` DISABLE KEYS */;
INSERT INTO `evaluacion` (`eval_codigo`, `eval_tescodigo`, `eval_cricodigo`, `eval_tipo`, `eval_notat`, `eval_cedulaj`, `eval_notaj`) VALUES
	(25, 12, 1, 'ASPECTO', NULL, '8573655', 1),
	(26, 12, 2, 'ASPECTO', NULL, '8573655', 2),
	(27, 12, 1, 'DOCUMENTO', NULL, '8573655', 1),
	(28, 12, 1, 'ASPECTO', 2, '', NULL),
	(29, 12, 2, 'ASPECTO', 3, '', NULL);
/*!40000 ALTER TABLE `evaluacion` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.firma
CREATE TABLE IF NOT EXISTS `firma` (
  `fir_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fir_cedula` varchar(15) COLLATE utf8_bin NOT NULL,
  `fir_nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`fir_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.firma: ~0 rows (aproximadamente)
DELETE FROM `firma`;
/*!40000 ALTER TABLE `firma` DISABLE KEYS */;
INSERT INTO `firma` (`fir_codigo`, `fir_cedula`, `fir_nombre`) VALUES
	(2, '19191493', 'Captura de pantalla 2016-06-04 01.32.39.png');
/*!40000 ALTER TABLE `firma` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.foto
CREATE TABLE IF NOT EXISTS `foto` (
  `fot_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fot_cedula` varchar(150) COLLATE utf8_bin NOT NULL,
  `fot_nombre` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`fot_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.foto: ~0 rows (aproximadamente)
DELETE FROM `foto`;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
INSERT INTO `foto` (`fot_codigo`, `fot_cedula`, `fot_nombre`) VALUES
	(2, '19191493', 'Captura de pantalla 2016-06-04 01.49.59.png');
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.grupo
CREATE TABLE IF NOT EXISTS `grupo` (
  `grp_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `grp_descrip` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`grp_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.grupo: ~4 rows (aproximadamente)
DELETE FROM `grupo`;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` (`grp_codigo`, `grp_descrip`) VALUES
	(5, 'COORDINADOR TEG'),
	(6, 'ALUMNO'),
	(7, 'TUTOR'),
	(8, 'JURADO');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.linea
CREATE TABLE IF NOT EXISTS `linea` (
  `lin_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `lin_descrip` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`lin_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.linea: ~1 rows (aproximadamente)
DELETE FROM `linea`;
/*!40000 ALTER TABLE `linea` DISABLE KEYS */;
INSERT INTO `linea` (`lin_codigo`, `lin_descrip`) VALUES
	(3, 'INFORMATICA');
/*!40000 ALTER TABLE `linea` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.mensaje
CREATE TABLE IF NOT EXISTS `mensaje` (
  `men_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `men_emite` varchar(10) COLLATE utf8_bin NOT NULL,
  `men_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `men_usuario` int(11) NOT NULL,
  `men_titulo` varchar(150) COLLATE utf8_bin NOT NULL,
  `men_contenido` varchar(600) COLLATE utf8_bin NOT NULL,
  `men_estado` set('ACTIVO','ELIMINADO') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`men_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.mensaje: ~6 rows (aproximadamente)
DELETE FROM `mensaje`;
/*!40000 ALTER TABLE `mensaje` DISABLE KEYS */;
INSERT INTO `mensaje` (`men_codigo`, `men_emite`, `men_fecha`, `men_usuario`, `men_titulo`, `men_contenido`, `men_estado`) VALUES
	(1, '', '2016-09-06 16:38:16', 3, 'prueba', 'hola Mundo', 'ACTIVO'),
	(2, '', '2016-09-06 16:38:16', 2, 'prueba', 'hola Mundo', 'ACTIVO'),
	(3, '', '2016-09-06 16:38:16', 5, 'prueba', 'hola Mundo', 'ACTIVO'),
	(4, '', '2016-09-29 10:34:35', 2, 'prueba', 'esto es una prueba', 'ACTIVO'),
	(5, '', '2016-09-29 10:35:12', 2, 'ss', 'ss', 'ACTIVO'),
	(6, '14434282', '2016-09-29 10:35:40', 2, 'ss', 'ss', 'ACTIVO');
/*!40000 ALTER TABLE `mensaje` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.m_menu_emp_menj
CREATE TABLE IF NOT EXISTS `m_menu_emp_menj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ConexMenuMaster` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `menu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conex` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `funcion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Imagen` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ancho` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alto` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nivel` text COLLATE utf8_unicode_ci,
  `CA` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CAdmin` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orden` (`orden`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sisevalteg.0.m_menu_emp_menj: ~9 rows (aproximadamente)
DELETE FROM `m_menu_emp_menj`;
/*!40000 ALTER TABLE `m_menu_emp_menj` DISABLE KEYS */;
INSERT INTO `m_menu_emp_menj` (`id`, `ConexMenuMaster`, `orden`, `menu`, `conex`, `funcion`, `Imagen`, `ancho`, `alto`, `nivel`, `CA`, `CAdmin`) VALUES
	(54, NULL, 1, 'Administrador', 'menu.php', NULL, 'fa fa-sun-o', NULL, NULL, NULL, NULL, NULL),
	(74, NULL, 2, 'Configuracion', NULL, NULL, 'fa fa-wrench', NULL, NULL, NULL, NULL, NULL),
	(76, NULL, 3, 'Trabajo de grado', NULL, NULL, 'fa fa-mortar-board ', NULL, NULL, NULL, NULL, NULL),
	(77, NULL, 4, 'Agenda de actividades', NULL, NULL, 'fa fa-calendar', NULL, NULL, NULL, NULL, NULL),
	(78, NULL, 7, 'Mensajes', NULL, NULL, 'fa fa-envelope', NULL, NULL, NULL, NULL, NULL),
	(79, NULL, 5, 'Evaluación de TEG', NULL, NULL, 'fa fa-pencil', NULL, NULL, NULL, NULL, NULL),
	(80, NULL, 9, 'Reclamos', NULL, NULL, 'fa fa-exclamation-circle', NULL, NULL, NULL, NULL, NULL),
	(81, NULL, 6, 'Reportes y graficos', NULL, NULL, 'fa fa-pie-chart', NULL, NULL, NULL, NULL, NULL),
	(82, NULL, 8, 'Catalogo de TEG', NULL, NULL, 'fa fa-suitcase', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `m_menu_emp_menj` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.m_menu_emp_sub_menj
CREATE TABLE IF NOT EXISTS `m_menu_emp_sub_menj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enlace` int(11) NOT NULL DEFAULT '0',
  `enlacesub` char(3) DEFAULT NULL,
  `Act` char(1) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `menu` varchar(250) DEFAULT NULL,
  `conex` varchar(250) DEFAULT NULL,
  `Url_1` varchar(100) NOT NULL,
  `Url_2` varchar(100) NOT NULL,
  `Url_3` varchar(100) NOT NULL,
  `Url_4` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Url_5` varchar(100) NOT NULL,
  `Url_6` varchar(100) DEFAULT NULL,
  `Url_7` varchar(100) DEFAULT NULL,
  `Url_8` varchar(100) DEFAULT NULL,
  `Url_9` varchar(100) DEFAULT NULL,
  `Url_10` varchar(100) DEFAULT NULL,
  `Inserte` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Updated` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Deleted` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Acciones` varchar(80) NOT NULL,
  `Ejecutar` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `conexd` varchar(200) DEFAULT NULL,
  `funcion` varchar(100) DEFAULT NULL,
  `nivel` text,
  `CA` char(2) DEFAULT NULL,
  `CAdmin` int(1) DEFAULT NULL,
  `CssColor` varchar(50) NOT NULL,
  `CssImagen` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enlace` (`enlace`),
  CONSTRAINT `m_menu_emp_sub_menj_ibfk_1` FOREIGN KEY (`enlace`) REFERENCES `m_menu_emp_menj` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sisevalteg.0.m_menu_emp_sub_menj: ~17 rows (aproximadamente)
DELETE FROM `m_menu_emp_sub_menj`;
/*!40000 ALTER TABLE `m_menu_emp_sub_menj` DISABLE KEYS */;
INSERT INTO `m_menu_emp_sub_menj` (`id`, `enlace`, `enlacesub`, `Act`, `orden`, `menu`, `conex`, `Url_1`, `Url_2`, `Url_3`, `Url_4`, `Url_5`, `Url_6`, `Url_7`, `Url_8`, `Url_9`, `Url_10`, `Inserte`, `Updated`, `Deleted`, `Acciones`, `Ejecutar`, `conexd`, `funcion`, `nivel`, `CA`, `CAdmin`, `CssColor`, `CssImagen`) VALUES
	(55, 54, NULL, NULL, NULL, 'Asignar Usuarios', 'menu.php', 'conf_usuario/crear_usuario.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(110, 54, NULL, NULL, NULL, 'Administrar Perfiles', 'menu.php', 'admin_perfil/conf_perfil.php', 'admin_perfil/conf_menu_list.php', 'admin_perfil/conf_menu_accion.php', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(159, 74, NULL, NULL, 1, 'Usuarios', 'menu.php', 'sistema/usuarios/usuario.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(160, 74, NULL, NULL, 2, 'Carreras', 'menu.php', 'sistema/carreras/carrera.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(162, 74, NULL, NULL, 3, 'Periodos', 'menu.php', 'sistema/periodo_acad/periodo.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(164, 74, NULL, NULL, 4, 'Aspectos de evaluacion', 'menu.php', 'sistema/aspectos/aspecto.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(165, 74, NULL, NULL, 5, 'Criterio de evaluacion de TEG', 'menu.php', 'sistema/criterios/criterio.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(166, 74, NULL, NULL, 6, 'Criterio de evaluacion del documento', 'menu.php', 'sistema/criterios_doc/criterio.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(168, 74, NULL, NULL, 7, 'Actividades', 'menu.php', 'sistema/actividades/actividad.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(171, 74, NULL, NULL, 8, 'Asignar carga a docente', 'menu.php', 'sistema/carga_docente/carga_docente.php', 'sistema/carga_docente/carga.php', 'sistema/carga_docente/carga_opera.php', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(172, 76, NULL, NULL, 2, 'Lineas de Investigación', 'menu.php', 'sistema/tesis/linea.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(173, 76, NULL, NULL, 1, 'Areas de Investigacion', 'menu.php', 'sistema/tesis/area.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(174, 76, NULL, NULL, 3, 'Registro de TEG', 'menu.php', 'sistema/tesis/tesis.php', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(175, 76, NULL, NULL, 4, 'Administración de TEG', 'menu.php', 'sistema/tesis/admintesis.php', 'sistema/tesis/asig_tesista.php', 'sistema/tesis/asig_jurado.php', 'sistema/tesis/asig_tutor.php', 'sistema/tesis/asig_tesista_oper.php', 'sistema/tesis/asig_tutor_oper.php', 'sistema/tesis/asig_jurado_oper.php', NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(176, 77, NULL, NULL, 1, 'Ver agenda', 'menu.php', 'sistema/agenda/agenda.php', 'sistema/agenda/agenda_act.php', 'sistema/agenda/agenda_act_oper.php', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(179, 77, NULL, NULL, 2, 'Ver toda la agenda', 'menu.php', 'sistema/agenda/agenda_all.php', 'sistema/agenda/agenda_all_act.php', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', ''),
	(180, 79, NULL, NULL, 1, 'Evaluar TEG', 'menu.php', 'sistema/tesis/evaluar.php', 'sistema/tesis/evaluar_det.php', 'sistema/tesis/evaluar_act.php', 'sistema/tesis/evaluar_act_oper.php', 'sistema/tesis/aspecto.php', 'sistema/tesis/documento.php', 'sistema/tesis/aspecto.php', 'sistema/tesis/teg.php', NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', '');
/*!40000 ALTER TABLE `m_menu_emp_sub_menj` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `CodPerfil` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`CodPerfil`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sisevalteg.0.perfiles: ~5 rows (aproximadamente)
DELETE FROM `perfiles`;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` (`CodPerfil`, `Nombre`) VALUES
	(1, 'Administrador'),
	(2, 'Alumno'),
	(5, 'Coordinador'),
	(4, 'Docente'),
	(3, 'GOD');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.perfiles_det
CREATE TABLE IF NOT EXISTS `perfiles_det` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IdPerfil` int(11) NOT NULL DEFAULT '0',
  `Submenu` int(11) NOT NULL DEFAULT '0',
  `Menu` int(11) NOT NULL DEFAULT '0',
  `S` tinyint(4) NOT NULL,
  `U` tinyint(4) NOT NULL,
  `D` tinyint(4) NOT NULL,
  `I` tinyint(4) NOT NULL,
  `P` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IdPerfil_2` (`IdPerfil`,`Submenu`,`Menu`),
  KEY `IdPerfil` (`IdPerfil`),
  KEY `Submenu` (`Submenu`),
  KEY `Menu` (`Menu`),
  CONSTRAINT `perfiles_det_ibfk_1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfiles` (`CodPerfil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `perfiles_det_ibfk_2` FOREIGN KEY (`Menu`) REFERENCES `m_menu_emp_menj` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `perfiles_det_ibfk_3` FOREIGN KEY (`Submenu`) REFERENCES `m_menu_emp_sub_menj` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sisevalteg.0.perfiles_det: ~39 rows (aproximadamente)
DELETE FROM `perfiles_det`;
/*!40000 ALTER TABLE `perfiles_det` DISABLE KEYS */;
INSERT INTO `perfiles_det` (`id`, `IdPerfil`, `Submenu`, `Menu`, `S`, `U`, `D`, `I`, `P`) VALUES
	(1, 1, 110, 54, 0, 1, 1, 1, 1),
	(113, 1, 55, 54, 0, 1, 1, 1, 1),
	(236, 1, 159, 74, 1, 1, 1, 1, 1),
	(237, 1, 160, 74, 1, 1, 1, 1, 1),
	(242, 1, 162, 74, 1, 1, 1, 1, 1),
	(247, 1, 164, 74, 1, 1, 1, 1, 1),
	(252, 1, 165, 74, 1, 1, 1, 1, 1),
	(257, 1, 166, 74, 1, 1, 1, 1, 1),
	(263, 1, 168, 74, 1, 1, 1, 1, 1),
	(272, 3, 110, 54, 1, 1, 1, 1, 1),
	(273, 3, 55, 54, 1, 1, 1, 1, 1),
	(274, 3, 164, 74, 1, 1, 1, 1, 1),
	(275, 3, 168, 74, 1, 1, 1, 1, 1),
	(276, 3, 160, 74, 1, 1, 1, 1, 1),
	(277, 3, 165, 74, 1, 1, 1, 1, 1),
	(278, 3, 166, 74, 1, 1, 1, 1, 1),
	(279, 3, 159, 74, 1, 1, 1, 1, 1),
	(280, 3, 162, 74, 1, 1, 1, 1, 1),
	(321, 1, 171, 74, 1, 1, 1, 1, 1),
	(326, 3, 171, 74, 1, 1, 1, 1, 1),
	(331, 1, 173, 76, 1, 1, 1, 1, 1),
	(332, 1, 172, 76, 1, 1, 1, 1, 1),
	(341, 3, 173, 76, 1, 1, 1, 1, 1),
	(342, 3, 172, 76, 1, 1, 1, 1, 1),
	(351, 1, 174, 76, 1, 1, 1, 1, 1),
	(356, 3, 174, 76, 1, 1, 1, 1, 1),
	(361, 1, 175, 76, 1, 1, 1, 1, 1),
	(366, 3, 175, 76, 1, 1, 1, 1, 1),
	(371, 1, 176, 77, 1, 1, 1, 1, 1),
	(376, 3, 176, 77, 1, 1, 1, 1, 1),
	(381, 2, 176, 77, 1, 1, 1, 1, 1),
	(386, 5, 176, 77, 0, 0, 0, 0, 0),
	(390, 4, 176, 77, 1, 1, 1, 1, 1),
	(395, 1, 179, 77, 1, 1, 1, 1, 1),
	(400, 3, 179, 77, 1, 1, 1, 1, 1),
	(405, 5, 179, 77, 1, 1, 1, 1, 1),
	(414, 1, 180, 79, 1, 1, 1, 1, 1),
	(419, 4, 180, 79, 1, 1, 1, 1, 1),
	(424, 3, 180, 79, 1, 1, 1, 1, 1);
/*!40000 ALTER TABLE `perfiles_det` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.periodo
CREATE TABLE IF NOT EXISTS `periodo` (
  `per_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `per_anual` int(5) NOT NULL,
  `per_periodo` int(11) NOT NULL,
  `per_inicio` date NOT NULL,
  `per_final` date NOT NULL,
  PRIMARY KEY (`per_codigo`),
  KEY `FK_periodo_tools_periodo` (`per_periodo`),
  CONSTRAINT `FK_periodo_tools_periodo` FOREIGN KEY (`per_periodo`) REFERENCES `tools_periodo` (`tper_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.periodo: ~2 rows (aproximadamente)
DELETE FROM `periodo`;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` (`per_codigo`, `per_anual`, `per_periodo`, `per_inicio`, `per_final`) VALUES
	(1, 2016, 2, '2016-08-04', '2017-03-06'),
	(2, 2016, 3, '2016-02-08', '2017-03-15');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `per_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `per_cedula` int(11) NOT NULL,
  `per_nombres` varchar(150) COLLATE utf8_bin NOT NULL,
  `per_apellidos` varchar(150) COLLATE utf8_bin NOT NULL,
  `per_correro` varchar(150) COLLATE utf8_bin NOT NULL,
  `per_telefonof` varchar(50) COLLATE utf8_bin NOT NULL,
  `per_telefonom` varchar(50) COLLATE utf8_bin NOT NULL,
  `per_tipo` int(11) NOT NULL,
  PRIMARY KEY (`per_codigo`),
  UNIQUE KEY `per_cedula` (`per_cedula`),
  KEY `FK_persona_perfiles` (`per_tipo`),
  CONSTRAINT `FK_persona_perfiles` FOREIGN KEY (`per_tipo`) REFERENCES `perfiles` (`CodPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.persona: ~6 rows (aproximadamente)
DELETE FROM `persona`;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`per_codigo`, `per_cedula`, `per_nombres`, `per_apellidos`, `per_correro`, `per_telefonof`, `per_telefonom`, `per_tipo`) VALUES
	(2, 19191493, 'GABRIEL A', 'ROJAS', 'KARPOFV.89@GMAIL.COM', '0273-5350116', '0412-4289536', 1),
	(3, 14434283, 'HELDER AROLDO', 'MONTILLA', 'HELDER.M@GMAIL.COM', '0273-5350016', '0412-4289536', 4),
	(5, 19191492, 'yusmary', 'perez', 'perez@gmail.com', '0273-5350016', '0412-4289536', 2),
	(13, 19191494, 'coord', 'coord', 'coord@gmail.com', '0412-4289536', '0273-5350116', 5),
	(15, 123456, 'GOD', 'GOD', 'god@gmail.com', '0412-4289536', '0273-5350116', 3),
	(17, 8573655, 'laya', 'laya', 'laya@gmail.com', '0412-4289536', '0273-5350116', 4);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.persona_grado
CREATE TABLE IF NOT EXISTS `persona_grado` (
  `perg_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `perg_descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`perg_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.persona_grado: ~6 rows (aproximadamente)
DELETE FROM `persona_grado`;
/*!40000 ALTER TABLE `persona_grado` DISABLE KEYS */;
INSERT INTO `persona_grado` (`perg_codigo`, `perg_descripcion`) VALUES
	(1, 'Lcdo.'),
	(2, 'Lcda.'),
	(3, 'Ing.'),
	(4, 'Dr.'),
	(5, 'Msc.'),
	(6, 'Abg.');
/*!40000 ALTER TABLE `persona_grado` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.recargar
CREATE TABLE IF NOT EXISTS `recargar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `actd` int(1) NOT NULL,
  `Accion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=354 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sisevalteg.0.recargar: ~8 rows (aproximadamente)
DELETE FROM `recargar`;
/*!40000 ALTER TABLE `recargar` DISABLE KEYS */;
INSERT INTO `recargar` (`id`, `URL`, `actd`, `Accion`) VALUES
	(1, 'uploader/receiver.php', 0, ''),
	(2, 'recargar/recargar.php', 0, ''),
	(3, 'recargar/recargar.php', 0, ''),
	(4, 'sistema/documentos/selectorAnual.php', 0, ''),
	(5, 'sistema/documentos/selectorMes.php', 0, ''),
	(351, 'sistema/index.php', 0, ''),
	(352, 'recargar/recargar.php', 1, ''),
	(353, 'sistema/reportes/pdf_constancia.php', 0, '');
/*!40000 ALTER TABLE `recargar` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.registrados
CREATE TABLE IF NOT EXISTS `registrados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nacionalidad` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Usuario` int(11) NOT NULL,
  `cedula` int(11) NOT NULL DEFAULT '0',
  `Nombres` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Apellidos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sisevalteg.0.registrados: ~2 rows (aproximadamente)
DELETE FROM `registrados`;
/*!40000 ALTER TABLE `registrados` DISABLE KEYS */;
INSERT INTO `registrados` (`id`, `nacionalidad`, `Usuario`, `cedula`, `Nombres`, `Apellidos`, `sexo`, `correo`) VALUES
	(1, '', 0, 12345, 'laya', 'juan', '', ''),
	(2, '', 0, 21589306, 'Maria', 'Fernandez', '', '');
/*!40000 ALTER TABLE `registrados` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.status
CREATE TABLE IF NOT EXISTS `status` (
  `st_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `st_descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`st_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.status: ~2 rows (aproximadamente)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`st_codigo`, `st_descripcion`) VALUES
	(1, 'ACTIVO'),
	(2, 'INACTIVO');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.tesis
CREATE TABLE IF NOT EXISTS `tesis` (
  `tes_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tes_carrera` int(11) NOT NULL,
  `tes_periodo` int(11) NOT NULL,
  `tes_linea` int(11) NOT NULL,
  `tes_area` int(11) NOT NULL,
  `tes_titulo` varchar(300) COLLATE utf8_bin NOT NULL,
  `tes_observacion` varchar(300) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`tes_codigo`),
  KEY `FK_tesis_linea` (`tes_linea`),
  KEY `FK_tesis_area` (`tes_area`),
  KEY `FK_tesis_carrera` (`tes_carrera`),
  KEY `FK_tesis_periodo` (`tes_periodo`),
  CONSTRAINT `FK_tesis_area` FOREIGN KEY (`tes_area`) REFERENCES `area` (`ar_codigo`),
  CONSTRAINT `FK_tesis_linea` FOREIGN KEY (`tes_linea`) REFERENCES `linea` (`lin_codigo`),
  CONSTRAINT `FK_tesis_periodo` FOREIGN KEY (`tes_periodo`) REFERENCES `periodo` (`per_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.tesis: ~2 rows (aproximadamente)
DELETE FROM `tesis`;
/*!40000 ALTER TABLE `tesis` DISABLE KEYS */;
INSERT INTO `tesis` (`tes_codigo`, `tes_carrera`, `tes_periodo`, `tes_linea`, `tes_area`, `tes_titulo`, `tes_observacion`) VALUES
	(12, 1, 1, 3, 1, 'GESTION DE PROYECTO', 'asdasd'),
	(13, 1, 1, 3, 1, 'SISTEMA INFORMATICO PARA CONTROL DE GANADERIA', '');
/*!40000 ALTER TABLE `tesis` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.tesis_alumno
CREATE TABLE IF NOT EXISTS `tesis_alumno` (
  `tesal_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tesal_cedula` int(11) NOT NULL,
  `tesal_tescodigo` int(11) NOT NULL,
  PRIMARY KEY (`tesal_codigo`),
  UNIQUE KEY `tesal_cedula` (`tesal_tescodigo`,`tesal_cedula`),
  KEY `FK_tesis_alumno_persona` (`tesal_cedula`),
  CONSTRAINT `FK_tesis_alumno_persona` FOREIGN KEY (`tesal_cedula`) REFERENCES `persona` (`per_cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.tesis_alumno: ~1 rows (aproximadamente)
DELETE FROM `tesis_alumno`;
/*!40000 ALTER TABLE `tesis_alumno` DISABLE KEYS */;
INSERT INTO `tesis_alumno` (`tesal_codigo`, `tesal_cedula`, `tesal_tescodigo`) VALUES
	(24, 19191492, 12);
/*!40000 ALTER TABLE `tesis_alumno` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.tesis_jurado
CREATE TABLE IF NOT EXISTS `tesis_jurado` (
  `tesju_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tesju_cedula` int(11) NOT NULL,
  `tesju_tescodigo` int(11) NOT NULL,
  PRIMARY KEY (`tesju_codigo`),
  KEY `FK_tesis_jurado_persona` (`tesju_cedula`),
  CONSTRAINT `FK_tesis_jurado_persona` FOREIGN KEY (`tesju_cedula`) REFERENCES `persona` (`per_cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.tesis_jurado: ~1 rows (aproximadamente)
DELETE FROM `tesis_jurado`;
/*!40000 ALTER TABLE `tesis_jurado` DISABLE KEYS */;
INSERT INTO `tesis_jurado` (`tesju_codigo`, `tesju_cedula`, `tesju_tescodigo`) VALUES
	(2, 8573655, 12);
/*!40000 ALTER TABLE `tesis_jurado` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.tesis_tutor
CREATE TABLE IF NOT EXISTS `tesis_tutor` (
  `testu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `testu_cedula` varchar(9) COLLATE utf8_bin NOT NULL,
  `testu_tescodigo` int(11) NOT NULL,
  PRIMARY KEY (`testu_codigo`),
  UNIQUE KEY `testu_tescodigo` (`testu_tescodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.tesis_tutor: ~0 rows (aproximadamente)
DELETE FROM `tesis_tutor`;
/*!40000 ALTER TABLE `tesis_tutor` DISABLE KEYS */;
INSERT INTO `tesis_tutor` (`testu_codigo`, `testu_cedula`, `testu_tescodigo`) VALUES
	(10, '14434283', 12);
/*!40000 ALTER TABLE `tesis_tutor` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.tools_nota
CREATE TABLE IF NOT EXISTS `tools_nota` (
  `tnota_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tnota_descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`tnota_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.tools_nota: ~4 rows (aproximadamente)
DELETE FROM `tools_nota`;
/*!40000 ALTER TABLE `tools_nota` DISABLE KEYS */;
INSERT INTO `tools_nota` (`tnota_codigo`, `tnota_descripcion`) VALUES
	(1, 'EXCELENTE'),
	(2, 'SUFICIENTE'),
	(3, 'REGULAR'),
	(4, 'DEFICIENTE');
/*!40000 ALTER TABLE `tools_nota` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.tools_periodo
CREATE TABLE IF NOT EXISTS `tools_periodo` (
  `tper_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tper_descripcion` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`tper_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla sisevalteg.0.tools_periodo: ~4 rows (aproximadamente)
DELETE FROM `tools_periodo`;
/*!40000 ALTER TABLE `tools_periodo` DISABLE KEYS */;
INSERT INTO `tools_periodo` (`tper_codigo`, `tper_descripcion`) VALUES
	(1, 'I'),
	(2, 'II'),
	(3, 'III'),
	(4, 'IV');
/*!40000 ALTER TABLE `tools_periodo` ENABLE KEYS */;


-- Volcando estructura para tabla sisevalteg.0.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Cedula` int(11) NOT NULL DEFAULT '0',
  `Usuario` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `contrasena` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `CodSede` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Nivel` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Stilo` int(1) NOT NULL,
  `theme_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Codigo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Registro` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `Observacion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Usuario` (`Usuario`),
  UNIQUE KEY `Cedula_2` (`Tipo`,`Cedula`),
  KEY `Tipo` (`Cedula`,`Tipo`,`Usuario`),
  KEY `Cedula` (`Codigo`,`Usuario`,`Cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sisevalteg.0.usuarios: ~8 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `Cedula`, `Usuario`, `contrasena`, `CodSede`, `Tipo`, `Nivel`, `Stilo`, `theme_color`, `Codigo`, `Registro`, `Fecha`, `Observacion`) VALUES
	(9, 19191493, 'ROJASGB', 'a1b995eb2627f17bfd5fcb1de8533c62', '', 'Empleado', '1', 0, '', '08801', '1', '2016-11-16 09:34:10', NULL),
	(82, 14434283, 'HELDER', 'a1b995eb2627f17bfd5fcb1de8533c62', NULL, 'Empleado', '4', 0, '', '95d14', NULL, '0000-00-00 00:00:00', NULL),
	(85, 12345, 'admin', 'a1b995eb2627f17bfd5fcb1de8533c62', NULL, 'Empleado', '1', 0, '', NULL, NULL, '0000-00-00 00:00:00', NULL),
	(95, 19191494, 'coord', '12345', NULL, 'Empleado', '5', 0, '', NULL, NULL, '0000-00-00 00:00:00', NULL),
	(97, 123456, 'god', 'a1b995eb2627f17bfd5fcb1de8533c62', NULL, 'Empleado', '3', 0, '', 'a0c55', NULL, '0000-00-00 00:00:00', NULL),
	(103, 8573655, 'laya', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'Empleado', '4', 0, '', 'c664a', NULL, '0000-00-00 00:00:00', NULL),
	(104, 19191492, 'yuyu', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'Empleado', '2', 0, '', '2902b', NULL, '0000-00-00 00:00:00', NULL),
	(110, 8573655, '', '', NULL, '', NULL, 0, '', 'c664a', NULL, '0000-00-00 00:00:00', NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
