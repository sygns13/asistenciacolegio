-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.43-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema cristoreyasistencia
--

CREATE DATABASE IF NOT EXISTS cristoreyasistencia;
USE cristoreyasistencia;

--
-- Definition of table `aescolar`
--

DROP TABLE IF EXISTS `aescolar`;
CREATE TABLE `aescolar` (
  `idA` int(11) NOT NULL AUTO_INCREMENT,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idA`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aescolar`
--

/*!40000 ALTER TABLE `aescolar` DISABLE KEYS */;
INSERT INTO `aescolar` (`idA`,`fechaini`,`fechafin`,`descripcion`,`estado`) VALUES 
 (1,'2015-01-01','2015-12-31','2015','Clausurado'),
 (2,'2016-01-01','2016-12-31','2016','Activo');
/*!40000 ALTER TABLE `aescolar` ENABLE KEYS */;


--
-- Definition of table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE `alumno` (
  `idAlumno` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) DEFAULT NULL,
  `idpersona` int(11) NOT NULL,
  PRIMARY KEY (`idAlumno`),
  KEY `fk_Alumno_Persona1_idx` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumno`
--

/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` (`idAlumno`,`estado`,`idpersona`) VALUES 
 (2,'Estudiante',2),
 (3,'Estudiante',3),
 (4,'Estudiante',4),
 (5,'Estudiante',9),
 (6,'Estudiante',10),
 (7,'Estudiante',13),
 (8,'Estudiante',14),
 (9,'Egresado',16);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;


--
-- Definition of table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia` (
  `idAsistencia` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hraIngreso` time DEFAULT NULL,
  `hraSalida` time DEFAULT NULL,
  `idpersona` int(11) NOT NULL,
  `idA` int(11) NOT NULL,
  `detPerson` varchar(2000) DEFAULT NULL,
  `idDia` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idAsistencia`),
  KEY `fk_Asistencia_Persona1_idx` (`idpersona`),
  KEY `fk_Asistencia_DiaAsistencia1` (`idDia`) USING BTREE,
  KEY `fk_Asistencia_AñoEscolar1_idx` (`idA`) USING BTREE,
  KEY `fk_Asistencia_Usuario` (`idUsuario`) USING BTREE,
  CONSTRAINT `fk_Asistencia_AñoEscolar1` FOREIGN KEY (`idA`) REFERENCES `aescolar` (`idA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asistencia_DiaAsistencia1` FOREIGN KEY (`idDia`) REFERENCES `diaasistencia` (`idDia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asistencia_Persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Asistencia_Usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asistencia`
--

/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` (`idAsistencia`,`estado`,`fecha`,`hraIngreso`,`hraSalida`,`idpersona`,`idA`,`detPerson`,`idDia`,`idUsuario`) VALUES 
 (12,'Asistió','2015-11-18','16:39:38','16:39:38',2,1,'Hora Adecuada',2,1),
 (13,'Asistió','2015-11-29','14:42:39','14:42:39',2,1,'Hora Adecuada',3,1),
 (14,'Asistió','2015-11-29','14:43:04','14:43:04',3,1,'Hora Adecuada',3,1),
 (15,'Asistió','2015-11-29','14:43:12','14:43:12',4,1,'Hora Adecuada',3,1),
 (16,'Asistió','2015-12-03','20:53:37','20:53:37',2,1,'Hora Adecuada',4,1),
 (17,'Asistió','2015-12-08','09:46:36','09:46:36',3,1,'Hora Adecuada',5,1),
 (18,'Asistió','2015-12-08','09:46:43','09:46:43',4,1,'Hora Adecuada',5,1),
 (19,'Asistió','2015-12-08','09:46:52','09:46:52',2,1,'Hora Adecuada',5,1),
 (20,'Asistió','2015-12-08','09:46:59','09:46:59',7,1,'Hora Adecuada',5,1),
 (21,'Asistió','2015-12-08','09:47:05','09:47:05',8,1,'Hora Adecuada',5,1),
 (22,'Asistió','2015-12-08','10:28:50','10:28:50',9,1,'Hora Adecuada',5,1),
 (23,'Asistió','2016-01-06','09:21:10','09:21:10',2,1,'Hora Adecuada',6,1),
 (24,'Asistió','2016-01-19','16:32:24','16:32:24',7,1,'Hora Adecuada',7,1),
 (25,'Asistió','2016-01-19','16:33:54','16:33:54',8,1,'Hora Adecuada',7,2),
 (26,'Asistió','2016-01-21','16:57:46','16:57:46',2,2,'Hora Adecuada',8,1),
 (27,'Asistió','2016-01-21','16:58:06','16:58:06',3,2,'Hora Adecuada',8,1),
 (28,'Asistió','2016-01-21','17:01:02','17:01:02',4,2,'Hora Adecuada',8,1),
 (29,'Asistió','2016-01-21','17:01:10','17:01:10',9,2,'Hora Adecuada',8,1),
 (30,'Asistió','2016-01-21','17:01:19','17:01:19',10,2,'Hora Adecuada',8,1),
 (31,'Asistió','2016-01-21','17:24:16','17:56:57',7,2,'Hora Adecuada',8,1),
 (32,'Asistió','2016-01-21','17:24:28','17:57:14',8,2,'Hora Adecuada',8,1),
 (33,'Asistió','2016-01-21','17:34:33','17:56:42',11,2,'Hora Adecuada',8,1),
 (34,'Asistió','2016-01-21','17:58:35','17:58:40',12,2,'Hora Adecuada',8,1),
 (35,'Asistió','2016-01-22','18:00:21','18:01:47',7,2,'Hora Adecuada',9,1),
 (36,'Asistió','2016-01-22','18:13:50','18:13:50',8,2,'Hora Adecuada',9,1),
 (37,'Asistió','2016-01-22','18:16:08','18:16:08',10,2,'Hora Adecuada',9,1),
 (38,'Asistió','2016-01-22','18:16:15','18:16:15',13,2,'Hora Adecuada',9,1),
 (39,'Asistió','2016-01-23','12:57:20','12:57:20',13,2,'Hora Adecuada',10,1),
 (40,'Asistió','2016-01-23','12:58:25','12:58:25',14,2,'Hora Adecuada',10,1),
 (41,'Inasistio','2016-01-23','13:25:19','13:25:19',3,2,'Presento Certificado de Salud, enfermedad.                 \n                 ',10,1),
 (42,'Inasistio','2016-01-23','15:48:15','15:48:15',15,2,'Hoy no tiene labores académicas',10,1),
 (43,'Asistió','2016-01-23','15:48:35','15:48:35',8,2,'Hora Adecuada',10,1),
 (44,'Asistió','2016-01-25','09:23:56','09:23:56',13,2,'Hora Adecuada',11,1),
 (45,'Asistió','2016-01-25','09:24:02','09:24:02',10,2,'Hora Adecuada',11,1),
 (46,'Inasistio','2016-01-25','09:24:51','09:24:51',14,2,'Faltó debido a enfermedad, presentó certificado médico',11,1),
 (47,'Asistió','2016-01-25','09:24:57','09:24:57',4,2,'Hora Adecuada',11,1),
 (48,'Asistió','2016-01-25','09:25:13','09:25:13',9,2,'Hora Adecuada',11,1),
 (49,'Asistió','2016-01-25','09:25:24','09:25:24',12,2,'Hora Adecuada',11,1),
 (50,'Asistió','2016-01-25','09:25:34','09:25:34',15,2,'Hora Adecuada',11,1),
 (51,'Inasistio','2016-01-25','09:25:51','09:25:51',8,2,'No es un día laborable del docente.',11,1),
 (52,'Asistió','2016-01-25','23:08:41','23:08:41',2,2,'Hora Adecuada',11,1),
 (53,'Inasistio','2016-01-27','10:45:55','10:45:55',10,2,'Se enfermo',12,1),
 (54,'Asistió','2016-01-27','10:46:58','10:46:58',12,2,'Hora Adecuada',12,1),
 (55,'Asistió','2016-02-01','19:39:48','19:39:48',13,2,'Hora Adecuada',13,1),
 (56,'Asistió','2016-02-01','19:39:56','19:39:56',10,2,'Hora Adecuada',13,1),
 (57,'Asistió','2016-02-01','19:41:23','19:41:23',12,2,'Hora Adecuada',13,1),
 (58,'Asistió','2016-02-01','19:41:37','19:41:37',15,2,'Hora Adecuada',13,1),
 (59,'Asistió','2016-02-02','09:58:32','09:58:32',12,2,'Hora Adecuada',14,1),
 (60,'Asistió','2016-02-02','09:58:44','09:58:44',15,2,'Hora Adecuada',14,1),
 (61,'Asistió','2016-02-02','09:58:53','10:23:30',8,2,'Hora Adecuada',14,1),
 (62,'Inasistio','2016-02-02','09:59:05','09:59:05',11,2,'Enferma',14,1),
 (63,'Asistió','2016-02-02','09:59:18','10:30:21',13,2,'Hora Adecuada',14,1),
 (64,'Asistió','2016-02-02','09:59:23','10:31:35',10,2,'Hora Adecuada',14,1),
 (65,'Asistió','2016-02-02','09:59:33','09:59:33',14,2,'Hora Adecuada',14,1),
 (66,'Asistió','2016-02-02','09:59:44','09:59:44',3,2,'Hora Adecuada',14,1),
 (67,'Inasistio','2016-02-02','09:59:52','09:59:52',4,2,'Mal de Salud',14,1),
 (68,'Asistió','2016-03-11','01:33:26','01:33:26',13,2,'Hora Adecuada',15,1),
 (69,'Asistió','2016-03-11','01:33:31','01:33:31',10,2,'Hora Adecuada',15,1),
 (70,'Asistió','2016-03-11','01:33:36','01:33:36',14,2,'Hora Adecuada',15,1),
 (71,'Asistió','2016-03-11','01:33:43','01:33:43',3,2,'Hora Adecuada',15,1),
 (72,'Asistió','2016-03-11','01:33:49','01:33:49',4,2,'Hora Adecuada',15,1),
 (73,'Asistió','2016-03-11','01:33:56','01:33:56',2,2,'Hora Adecuada',15,1),
 (74,'Asistió','2016-03-12','02:11:59','02:11:59',13,2,'Hora Adecuada',16,1),
 (75,'Asistió','2016-08-07','23:28:25','23:37:17',9,2,'Hora Adecuada',17,1),
 (76,'Asistió','2016-08-14','18:41:28','18:41:28',13,2,'Hora Adecuada',18,3),
 (77,'Inasistio','2016-08-14','18:41:44','18:41:44',10,2,'Se hizo tarde',18,3),
 (78,'Asistió','2016-08-14','18:43:32','18:43:32',14,2,'Hora Adecuada',18,4),
 (79,'Inasistio','2016-08-14','18:43:40','18:43:40',3,2,'se enfermo',18,4);
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;


--
-- Definition of table `concepto`
--

DROP TABLE IF EXISTS `concepto`;
CREATE TABLE `concepto` (
  `idconcepto` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(100) DEFAULT NULL,
  `codGeneral` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idconcepto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concepto`
--

/*!40000 ALTER TABLE `concepto` DISABLE KEYS */;
INSERT INTO `concepto` (`idconcepto`,`descr`,`codGeneral`,`estado`) VALUES 
 (1,'MÉRITOS','M','activo'),
 (2,'DEMÉRITOS','D','activo'),
 (3,'PRESENTACIÓN','P','activo'),
 (4,'FORMACIÓN DIGNIDAD / HONRADEZ / NEGLIGENCIA','F','activo');
/*!40000 ALTER TABLE `concepto` ENABLE KEYS */;


--
-- Definition of table `configpago`
--

DROP TABLE IF EXISTS `configpago`;
CREATE TABLE `configpago` (
  `idConfig` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` decimal(12,2) DEFAULT NULL,
  `mensualidad` decimal(12,2) DEFAULT NULL,
  `fecini` date DEFAULT NULL,
  `fecfin` date DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idConfig`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configpago`
--

/*!40000 ALTER TABLE `configpago` DISABLE KEYS */;
INSERT INTO `configpago` (`idConfig`,`matricula`,`mensualidad`,`fecini`,`fecfin`,`estado`) VALUES 
 (1,'300.00','190.00','2016-01-01','2016-01-01','Activo');
/*!40000 ALTER TABLE `configpago` ENABLE KEYS */;


--
-- Definition of table `descuento`
--

DROP TABLE IF EXISTS `descuento`;
CREATE TABLE `descuento` (
  `idDes` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) DEFAULT NULL,
  `monto` decimal(12,2) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDes`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `descuento`
--

/*!40000 ALTER TABLE `descuento` DISABLE KEYS */;
INSERT INTO `descuento` (`idDes`,`descripcion`,`monto`,`tipo`,`estado`) VALUES 
 (1,'Ninguno','0.00',0,'Intangible'),
 (2,'Hijo de Docente -%5','5.00',1,'Activo'),
 (3,'Hermanos  -S/50.00','50.00',0,'Activo'),
 (7,'Otro -20%','20.00',1,'Activo'),
 (8,'otro2 -S/20','20.00',0,'Activo'),
 (9,'Descuento 15S/','15.00',0,'Activo');
/*!40000 ALTER TABLE `descuento` ENABLE KEYS */;


--
-- Definition of table `detalusec`
--

DROP TABLE IF EXISTS `detalusec`;
CREATE TABLE `detalusec` (
  `idDetAluSec` int(11) NOT NULL AUTO_INCREMENT,
  `idAlumno` int(11) DEFAULT NULL,
  `idA` int(11) DEFAULT NULL,
  `idSeccion` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDetAluSec`),
  KEY `idAlumno` (`idAlumno`),
  KEY `idA` (`idA`),
  KEY `idSeccion` (`idSeccion`),
  CONSTRAINT `detalusec_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `alumno` (`idAlumno`),
  CONSTRAINT `detalusec_ibfk_2` FOREIGN KEY (`idA`) REFERENCES `aescolar` (`idA`),
  CONSTRAINT `detalusec_ibfk_3` FOREIGN KEY (`idSeccion`) REFERENCES `seccion` (`idseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalusec`
--

/*!40000 ALTER TABLE `detalusec` DISABLE KEYS */;
INSERT INTO `detalusec` (`idDetAluSec`,`idAlumno`,`idA`,`idSeccion`,`estado`) VALUES 
 (1,2,1,1,'Finalizado'),
 (2,3,1,1,'Finalizado'),
 (3,4,1,1,'Finalizado'),
 (4,5,1,9,'Finalizado'),
 (5,6,2,1,'Activo'),
 (6,3,2,5,'Activo'),
 (7,2,2,5,'Activo'),
 (9,4,2,5,'Activo'),
 (11,7,2,1,'Activo'),
 (12,8,2,1,'Activo'),
 (13,9,1,41,'Egresado'),
 (14,5,2,9,'Activo');
/*!40000 ALTER TABLE `detalusec` ENABLE KEYS */;


--
-- Definition of table `detconcepto`
--

DROP TABLE IF EXISTS `detconcepto`;
CREATE TABLE `detconcepto` (
  `iddetConcepto` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `fecR` date DEFAULT NULL,
  `obs` varchar(500) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `idlista` int(11) DEFAULT NULL,
  `idpersona` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetConcepto`),
  KEY `idlista` (`idlista`),
  KEY `idpersona` (`idpersona`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `detconcepto_ibfk_1` FOREIGN KEY (`idlista`) REFERENCES `listaconcepto` (`idlista`),
  CONSTRAINT `detconcepto_ibfk_2` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`),
  CONSTRAINT `detconcepto_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detconcepto`
--

/*!40000 ALTER TABLE `detconcepto` DISABLE KEYS */;
INSERT INTO `detconcepto` (`iddetConcepto`,`fecha`,`fecR`,`obs`,`estado`,`idlista`,`idpersona`,`idUsuario`) VALUES 
 (2,'2016-03-12','2016-03-11','','Activo',6,13,1),
 (3,'2016-03-12','2016-03-12','holi','Activo',1,13,1),
 (4,'2016-03-12','2016-03-12','ee','Activo',3,13,1),
 (5,'2016-03-12','2016-03-12','fds','Activo',32,13,1),
 (7,'2016-03-11','2016-03-12','','Activo',1,13,1),
 (8,'2016-02-26','2016-03-12','','Activo',7,13,1);
/*!40000 ALTER TABLE `detconcepto` ENABLE KEYS */;


--
-- Definition of table `dethoradocente`
--

DROP TABLE IF EXISTS `dethoradocente`;
CREATE TABLE `dethoradocente` (
  `idHoraDocente` int(11) NOT NULL AUTO_INCREMENT,
  `idDocente` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  PRIMARY KEY (`idHoraDocente`),
  KEY `fk_detHoraDocente_Docente1_idx` (`idDocente`),
  KEY `fk_detHoraDocente_Horario1_idx` (`idhorario`),
  CONSTRAINT `fk_detHoraDocente_Docente1` FOREIGN KEY (`idDocente`) REFERENCES `docente` (`idDocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detHoraDocente_Horario1` FOREIGN KEY (`idhorario`) REFERENCES `horario` (`idhorario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dethoradocente`
--

/*!40000 ALTER TABLE `dethoradocente` DISABLE KEYS */;
/*!40000 ALTER TABLE `dethoradocente` ENABLE KEYS */;


--
-- Definition of table `dethoraseccion`
--

DROP TABLE IF EXISTS `dethoraseccion`;
CREATE TABLE `dethoraseccion` (
  `idHoraSeccion` int(11) NOT NULL AUTO_INCREMENT,
  `idseccion` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  PRIMARY KEY (`idHoraSeccion`),
  KEY `fk_detHoraSeccion_seccion1_idx` (`idseccion`),
  KEY `fk_detHoraSeccion_Horario1_idx` (`idhorario`),
  CONSTRAINT `fk_detHoraSeccion_Horario1` FOREIGN KEY (`idhorario`) REFERENCES `horario` (`idhorario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detHoraSeccion_seccion1` FOREIGN KEY (`idseccion`) REFERENCES `seccion` (`idseccion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dethoraseccion`
--

/*!40000 ALTER TABLE `dethoraseccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `dethoraseccion` ENABLE KEYS */;


--
-- Definition of table `diaasistencia`
--

DROP TABLE IF EXISTS `diaasistencia`;
CREATE TABLE `diaasistencia` (
  `idDia` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDia`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diaasistencia`
--

/*!40000 ALTER TABLE `diaasistencia` DISABLE KEYS */;
INSERT INTO `diaasistencia` (`idDia`,`fecha`,`estado`) VALUES 
 (2,'2015-11-18','Cerrado'),
 (3,'2015-11-29','Cerrado'),
 (4,'2015-12-03','Cerrado'),
 (5,'2015-12-08','Cerrado'),
 (6,'2016-01-06','Cerrado'),
 (7,'2016-01-19','Cerrado'),
 (8,'2016-01-21','Cerrado'),
 (9,'2016-01-22','Cerrado'),
 (10,'2016-01-23','Cerrado'),
 (11,'2016-01-25','Cerrado'),
 (12,'2016-01-27','Cerrado'),
 (13,'2016-02-01','Cerrado'),
 (14,'2016-02-02','Cerrado'),
 (15,'2016-03-11','Cerrado'),
 (16,'2016-03-12','Cerrado'),
 (17,'2016-08-07','Cerrado'),
 (18,'2016-08-14','Activo');
/*!40000 ALTER TABLE `diaasistencia` ENABLE KEYS */;


--
-- Definition of table `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `idDocente` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) DEFAULT NULL,
  `especialidad` varchar(100) DEFAULT NULL,
  `idpersona` int(11) NOT NULL,
  PRIMARY KEY (`idDocente`),
  KEY `fk_Docente_Persona_idx` (`idpersona`),
  CONSTRAINT `fk_Docente_Persona` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docente`
--

/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` (`idDocente`,`estado`,`especialidad`,`idpersona`) VALUES 
 (1,'Activo','Matemática',7),
 (2,'Activo','Ciencias',8),
 (3,'Activo','Turismo',11),
 (4,'Activo','Matemáticas',12),
 (5,'Activo','Literatura',15);
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;


--
-- Definition of table `filtropago`
--

DROP TABLE IF EXISTS `filtropago`;
CREATE TABLE `filtropago` (
  `idFiltroPago` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idFiltroPago`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filtropago`
--

/*!40000 ALTER TABLE `filtropago` DISABLE KEYS */;
INSERT INTO `filtropago` (`idFiltroPago`) VALUES 
 (15),
 (16),
 (17),
 (18),
 (19),
 (20),
 (21),
 (22),
 (23),
 (24),
 (25),
 (26),
 (27),
 (28),
 (29),
 (30),
 (31),
 (32),
 (33),
 (34),
 (35),
 (36),
 (37),
 (38),
 (39),
 (40),
 (41),
 (42),
 (43),
 (44),
 (45),
 (46),
 (47),
 (48),
 (49),
 (50),
 (51),
 (52),
 (53),
 (54),
 (55);
/*!40000 ALTER TABLE `filtropago` ENABLE KEYS */;


--
-- Definition of table `grado`
--

DROP TABLE IF EXISTS `grado`;
CREATE TABLE `grado` (
  `idGrado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idGrado`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grado`
--

/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
INSERT INTO `grado` (`idGrado`,`nombre`,`estado`) VALUES 
 (1,'1° Primaria','Activo'),
 (2,'2° Primaria','Activo'),
 (3,'3° Primaria','Activo'),
 (4,'4° Primaria','Activo'),
 (5,'5° Primaria','Activo'),
 (6,'6° Primaria','Activo'),
 (7,'1° Secundaria','Activo'),
 (8,'2° Secundaria','Activo'),
 (9,'3° Secundaria','Activo'),
 (10,'4° Secundaria','Activo'),
 (11,'5° Secundaria','Activo');
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;


--
-- Definition of table `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `horaIngreso` date DEFAULT NULL,
  `horaSalida` date DEFAULT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Definition of table `listaconcepto`
--

DROP TABLE IF EXISTS `listaconcepto`;
CREATE TABLE `listaconcepto` (
  `idlista` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(250) DEFAULT NULL,
  `codlista` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `idconcepto` int(11) DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlista`),
  KEY `idconcepto` (`idconcepto`),
  CONSTRAINT `listaconcepto_ibfk_1` FOREIGN KEY (`idconcepto`) REFERENCES `concepto` (`idconcepto`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listaconcepto`
--

/*!40000 ALTER TABLE `listaconcepto` DISABLE KEYS */;
INSERT INTO `listaconcepto` (`idlista`,`descr`,`codlista`,`estado`,`idconcepto`,`puntos`) VALUES 
 (1,'Tiene ordenado y al día sus cuadernos','M1','Activo',1,2),
 (2,'Aporta ideas significativas en clases','M2','Activo',1,2),
 (3,'No tiene ordenado sus cuadernos / mala presentación','D1','Activo',2,-2),
 (4,'No presentó cuaderno / no tiene al día cuaderno','D2','Activo',2,-2),
 (5,'Cumple con las tareas','M3','Activo',1,2),
 (6,'Presentó un buen trabajo','M4','Activo',1,4),
 (7,'Realizó una excelente exposición','M5','Activo',1,2),
 (8,'Coopera con las necesidades del aula','M6','Activo',1,2),
 (9,'Rindió un buen examen (17 a 20)','M7','Activo',1,4),
 (10,'Demuestra siempre voluntad de trabajo','M8','Activo',1,2),
 (11,'Al retirarse del aula mantiene limpió su carpeta y el aula','M9','Activo',1,2),
 (12,'Guarda respeto al profesor, se dirige a él con mesura y presta el máximo de atención a la clase','M10','Activo',1,4),
 (13,'Adopta una posición correcta al hablar con sus compañeros de aula y es respetuoso(a)','M11','Activo',1,2),
 (14,'No cumple con las tareas','D3','Activo',2,-2),
 (15,'No trabajó en el aula (no tomó apuntes / no realizó los ejercicios propuestos)','D4','Activo',2,-4),
 (16,'No presentó su trabajo / copió o transcribió del Internet sin procesar ','D5','Activo',2,-4),
 (17,'No realizó la exposición','D6','Activo',2,-2),
 (18,'El cuaderno no tiene carátula','D7','Activo',2,-1),
 (19,'Rindió un mal examen (menos de 10)','D8','Activo',2,-2),
 (20,'Se le encontró plagiando en el examen','D9','Activo',2,-8),
 (21,'No trajo material de trabajo (libro, útiles escolares u otros)','D10','Activo',2,-4),
 (22,'No trajo el uniforme solicitado para educación física','D11','Activo',2,-4),
 (23,'Lanza objetos de forma desdemedida a sus compañeros','D12','Activo',2,-4),
 (24,'Faltó el respeto al Profesor','D13','Activo',2,-8),
 (25,'Realiza la tarea de otra asignatura','D14','Activo',2,-2),
 (26,'Llegó cuando el profesor había ingresado al aula','D15','Activo',2,-2),
 (27,'Se expresa con palabras soeces y desacata las órdenes del Profesor','D16','Activo',2,-8),
 (28,'Interrumpe la explicación del Profesor (conversa mucho en el aula) ','D17','Activo',2,-2),
 (29,'Realiza inscripciones en paredes, puertas, ventanas, muebles y enseres del aula','D18','Activo',2,-8),
 (30,'Se mofó de un compañero que participó en clases / faltó el respeto a su compañero','D19','Activo',2,-2),
 (31,'Camina demasiado en el aula','D20','Activo',2,-2),
 (32,'No tiene sus prendas marcadas','P1','Activo',3,-2),
 (33,'Llegó tarde al colegio','P2','Activo',3,-4),
 (34,'Asistió con buzo en horario inadecuado','P3','Activo',3,-4),
 (35,'Estuvo con cabello suelto dentro del colegio (mujeres)','P4','Activo',3,-2),
 (36,'No se cortó el cabello (corte escolar)','P5','Activo',3,-2),
 (37,'No trajo la agenda','P6','Activo',3,-4),
 (38,'No presenta la agenda firmada','P7','Activo',3,-2),
 (39,'Tiene la agenda impresentable','P8','Activo',3,-4),
 (40,'No estuvo correctamente uniformado','P9','Activo',3,-4),
 (41,'Tiene el uniforme sucio','P10','Activo',3,-4),
 (42,'Se evadió del plantel','F1','Activo',4,-16),
 (43,'Llegó tarde a la formación','F2','Activo',4,-4),
 (44,'No respeta los símbolos patrios','F3','Activo',4,-2),
 (45,'No canta los himnos correspondientes (HIMNO NACIONAL, HIMNO DE HUARAZ, HIMNO AL COLEGIO)','F4','Activo',4,-2),
 (46,'Realiza las inscripciones en paredes, puertas, baños, ventanas, muebles y enseres del colegio','F5','Activo',4,-8),
 (47,'Introduce al plantel bebidas alcohólicas, material pornográfico y sustancias prohibidas','F6','Activo',4,-16),
 (48,'Hace desorden en el aula y demás ambientes del colegio durante el recreo','F7','Activo',4,-4),
 (49,'trajo sortijas. iPod, radios, tablet, teléfono celular, cualquier alhaja o artículo de valor, sabien','F8','Activo',4,-4),
 (50,'Falsificó la firma del padre o apoderado','F9','Activo',4,-8),
 (51,'Realizó gestos obcenos','F10','Activo',4,-4),
 (52,'Pone sobrenombres a sus compañeros','F11','Activo',4,-2),
 (53,'Consume golosinas dentro del aula','F12','Activo',4,-2),
 (54,'Se expresa escandalosamente dentro del colegio','F13','Activo',4,-2),
 (55,'Coge objetos de su compañero','F14','Activo',4,-2),
 (56,'No cumple las funciones de (brigadier general, brigadier de aula, policía escolar, cruz roja, defensa civil, escolta, estandarte)','F15','Activo',4,-4);
/*!40000 ALTER TABLE `listaconcepto` ENABLE KEYS */;


--
-- Definition of table `obs`
--

DROP TABLE IF EXISTS `obs`;
CREATE TABLE `obs` (
  `idObs` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(500) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fecR` date DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `idpersona` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idObs`),
  KEY `idpersona` (`idpersona`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `obs_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`),
  CONSTRAINT `obs_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obs`
--

/*!40000 ALTER TABLE `obs` DISABLE KEYS */;
INSERT INTO `obs` (`idObs`,`descr`,`fecha`,`fecR`,`estado`,`idpersona`,`idUsuario`) VALUES 
 (3,'El alumno se enfermó y se retiró del plantel a las 14:00 hrs','2016-03-12','2016-03-11','Activo',13,1),
 (4,'El alumno se enfermó y se retiró del plantel a las 14:00 hrs','2016-03-12','2016-03-11','Activo',13,1),
 (5,'El alumno se enfermó y se retiró del plantel a las 14:00 hrs','2016-03-13','2016-03-11','Activo',13,1);
/*!40000 ALTER TABLE `obs` ENABLE KEYS */;


--
-- Definition of table `pagocronogramado`
--

DROP TABLE IF EXISTS `pagocronogramado`;
CREATE TABLE `pagocronogramado` (
  `idPagoCrono` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(12,2) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `idFiltroPago` int(11) NOT NULL,
  `idA` int(11) NOT NULL,
  PRIMARY KEY (`idPagoCrono`),
  KEY `fk_PagoCronogramado_FiltroPago1_idx` (`idFiltroPago`),
  KEY `fk_PagoCronogramado_aescolar1_idx` (`idA`),
  CONSTRAINT `fk_PagoCronogramado_FiltroPago1` FOREIGN KEY (`idFiltroPago`) REFERENCES `filtropago` (`idFiltroPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PagoCronogramado_aescolar1` FOREIGN KEY (`idA`) REFERENCES `aescolar` (`idA`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagocronogramado`
--

/*!40000 ALTER TABLE `pagocronogramado` DISABLE KEYS */;
INSERT INTO `pagocronogramado` (`idPagoCrono`,`monto`,`descripcion`,`fechaini`,`fechafin`,`idFiltroPago`,`idA`) VALUES 
 (14,'300.00','Pago de Matrícula','2016-01-01','2016-03-01',15,2),
 (15,'180.00','Pago del Mes de Marzo','2016-03-01','2016-03-31',16,2),
 (16,'180.00','Pago del Mes de Abril','2016-04-01','2016-04-30',17,2),
 (17,'180.00','Pago del Mes de Mayo','2016-05-01','2016-05-31',18,2),
 (18,'180.00','Pago del Mes de Junio','2016-06-01','2016-06-30',19,2),
 (19,'180.00','Pago del Mes de Julio','2016-07-01','2016-07-31',20,2),
 (20,'180.00','Pago del Mes de Agosto','2016-08-01','2016-08-31',21,2),
 (21,'180.00','Pago del Mes de Setiembre','2016-09-01','2016-09-30',22,2),
 (22,'180.00','Pago del Mes de Octubre','2016-10-01','2016-10-31',23,2),
 (23,'180.00','Pago del Mes de Noviembre','2016-11-01','2016-11-30',24,2),
 (24,'180.00','Pago del Mes de Diciembre','2016-12-01','2016-12-15',25,2),
 (25,'300.00','Pago de Matrícula','2015-01-01','2015-03-01',26,1),
 (26,'180.00','Pago del Mes de Marzo','2015-03-01','2015-03-31',27,1),
 (27,'180.00','Pago del Mes de Abril','2015-04-01','2015-04-30',28,1),
 (28,'180.00','Pago del Mes de Mayo','2015-05-01','2015-05-31',29,1),
 (29,'180.00','Pago del Mes de Junio','2015-06-01','2015-06-30',30,1),
 (30,'180.00','Pago del Mes de Julio','2015-07-01','2015-07-31',31,1),
 (31,'180.00','Pago del Mes de Agosto','2015-08-01','2015-08-31',32,1),
 (32,'180.00','Pago del Mes de Setiembre','2015-09-01','2015-09-30',33,1),
 (33,'180.00','Pago del Mes de Octubre','2015-10-01','2015-10-31',34,1),
 (34,'180.00','Pago del Mes de Noviembre','2015-11-01','2015-11-30',35,1),
 (35,'180.00','Pago del Mes de Diciembre','2015-12-01','2015-12-15',36,1);
/*!40000 ALTER TABLE `pagocronogramado` ENABLE KEYS */;


--
-- Definition of table `pagogeneral`
--

DROP TABLE IF EXISTS `pagogeneral`;
CREATE TABLE `pagogeneral` (
  `idPagoGen` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(12,2) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `idFiltroPago` int(11) NOT NULL,
  PRIMARY KEY (`idPagoGen`),
  KEY `fk_PagoGeneral_FiltroPago1_idx` (`idFiltroPago`),
  CONSTRAINT `fk_PagoGeneral_FiltroPago1` FOREIGN KEY (`idFiltroPago`) REFERENCES `filtropago` (`idFiltroPago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagogeneral`
--

/*!40000 ALTER TABLE `pagogeneral` DISABLE KEYS */;
INSERT INTO `pagogeneral` (`idPagoGen`,`monto`,`descripcion`,`idFiltroPago`) VALUES 
 (1,'10.50','Imp Constancia',37),
 (2,'10.00','Imp Boleta de Notas',38),
 (3,'49.00','Imp Certificado',39),
 (4,'80.00','4413421',43),
 (5,'50.00','adcasd',43),
 (6,'434.00','90',43),
 (7,'20.00','asdsa',43),
 (8,'60.00','fasddsa',44),
 (9,'40.00','fasdf',47),
 (10,'45.00','asdsad',48),
 (11,'50.00','dsadsa',48),
 (12,'50.00','asdsad',48),
 (13,'20.00','asdsad',50),
 (14,'40.00','dasdsad',50),
 (15,'15.00','sadsa',51),
 (16,'67.00','asdsad',54),
 (17,'12.00','asdsad',54),
 (18,'19.00','dasdsa',54),
 (19,'16.00','imp Constancia',55);
/*!40000 ALTER TABLE `pagogeneral` ENABLE KEYS */;


--
-- Definition of table `pagorealizado`
--

DROP TABLE IF EXISTS `pagorealizado`;
CREATE TABLE `pagorealizado` (
  `idPago` int(11) NOT NULL AUTO_INCREMENT,
  `pago` decimal(12,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `numboleta` varchar(45) DEFAULT NULL,
  `idFiltroPago` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `idDes` int(11) NOT NULL,
  `idRec` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idPago`),
  KEY `fk_PagoRealizado_FiltroPago1_idx` (`idFiltroPago`),
  KEY `fk_PagoRealizado_persona1_idx` (`idpersona`),
  KEY `fk_PagoRealizado_Descuento1_idx` (`idDes`),
  KEY `fk_PagoRealizado_Recargo1_idx` (`idRec`),
  KEY `fk_PagoRealizado_usuario1_idx` (`idUsuario`),
  CONSTRAINT `fk_PagoRealizado_FiltroPago1` FOREIGN KEY (`idFiltroPago`) REFERENCES `filtropago` (`idFiltroPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PagoRealizado_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PagoRealizado_Descuento1` FOREIGN KEY (`idDes`) REFERENCES `descuento` (`idDes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PagoRealizado_Recargo1` FOREIGN KEY (`idRec`) REFERENCES `recargo` (`idRec`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PagoRealizado_usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagorealizado`
--

/*!40000 ALTER TABLE `pagorealizado` DISABLE KEYS */;
INSERT INTO `pagorealizado` (`idPago`,`pago`,`fecha`,`numboleta`,`idFiltroPago`,`idpersona`,`idDes`,`idRec`,`idUsuario`) VALUES 
 (1,'300.00','2016-09-23','001-00001',26,2,1,1,1),
 (2,'180.00','2016-09-27','General',27,2,1,1,1),
 (3,'171.00','2016-09-27','General',28,2,2,1,1),
 (4,'180.00','2016-09-27','General',29,2,1,1,1),
 (5,'180.00','2016-09-27','General',30,2,1,1,1),
 (6,'180.00','2016-09-27','General',31,2,1,1,1),
 (7,'180.00','2016-09-27','General',32,2,1,1,1),
 (8,'180.00','2016-09-27','General',33,2,1,1,1),
 (9,'198.00','2016-09-27','General',28,3,1,2,1),
 (10,'151.20','2016-09-27','General',30,3,7,16,1),
 (11,'171.00','2016-09-27','General',27,3,2,1,1),
 (12,'300.00','2016-09-27','General',26,3,1,1,1),
 (13,'195.00','2016-09-27','General',31,3,8,17,1),
 (14,'160.00','2016-09-27','General',29,3,3,15,1),
 (15,'222.80','2016-09-27','General',32,3,9,18,1),
 (16,'188.10','2016-09-27','boleta 01',27,4,2,2,1),
 (17,'300.00','2016-09-27','boleta 01',26,4,1,1,1),
 (18,'136.50','2016-09-27','boleta 01',28,4,3,16,1),
 (19,'10.50','2016-09-27','General',37,2,2,2,1),
 (20,'215.00','2016-09-27','boleta02',31,4,1,17,1),
 (21,'201.00','2016-09-27','boleta02',30,4,2,15,1),
 (22,'180.00','2016-09-27','boleta02',29,4,1,1,1),
 (23,'10.00','2016-09-27','boleta02',38,4,1,1,1),
 (24,'180.00','2016-09-27','General',32,4,1,1,1),
 (25,'180.00','2016-09-27','General',36,4,1,1,1),
 (26,'180.00','2016-09-27','General',34,4,1,1,1),
 (27,'180.00','2016-09-27','General',35,4,1,1,1),
 (28,'180.00','2016-09-27','General',33,4,1,1,1),
 (30,'180.00','2016-09-27','General',31,9,1,1,1),
 (31,'180.00','2016-09-27','General',28,9,1,1,1),
 (32,'300.00','2016-09-27','General',26,9,1,1,1),
 (33,'180.00','2016-09-27','General',27,9,1,1,1),
 (34,'180.00','2016-09-27','General',30,9,1,1,1),
 (35,'180.00','2016-09-27','General',29,9,1,1,1),
 (36,'180.00','2016-09-27','General',32,9,1,1,1),
 (37,'180.00','2016-09-27','General',33,9,1,1,1),
 (38,'180.00','2016-09-27','General',35,9,1,1,1),
 (39,'180.00','2016-09-27','General',34,9,1,1,1),
 (40,'180.00','2016-09-27','General',36,9,1,1,1),
 (41,'180.00','2016-09-27','General',16,14,1,1,1),
 (42,'300.00','2016-09-27','General',15,14,1,1,1),
 (43,'49.00','2016-09-27','General',39,14,2,15,1),
 (44,'180.00','2016-09-27','General',16,4,1,1,1),
 (45,'300.00','2016-09-27','General',15,4,1,1,1),
 (46,'80.00','2016-09-27','General',43,4,1,1,1),
 (47,'50.00','2016-09-27','General',43,4,1,1,1),
 (48,'434.00','2016-09-27','General',43,4,1,1,1),
 (49,'20.00','2016-09-27','General',43,4,1,1,1),
 (50,'60.00','2016-09-27','General',44,4,1,1,1),
 (51,'180.00','2016-09-27','General',18,14,1,1,1),
 (52,'180.00','2016-09-27','General',17,14,1,1,1),
 (53,'40.00','2016-09-27','General',47,14,1,1,1),
 (54,'45.00','2016-09-27','General',48,14,1,1,1),
 (55,'50.00','2016-09-27','General',48,14,1,1,1),
 (56,'50.00','2016-09-27','General',48,14,1,1,1),
 (57,'20.00','2016-09-27','General',50,14,1,1,1),
 (58,'40.00','2016-09-27','General',50,14,1,1,1),
 (59,'15.00','2016-09-27','General',51,14,1,1,1),
 (60,'67.00','2016-09-27','General',54,14,1,1,1),
 (61,'12.00','2016-09-27','General',54,14,1,1,1),
 (62,'19.00','2016-09-27','General',54,14,1,1,1),
 (63,'180.00','2016-09-27','General',19,14,1,1,1),
 (64,'16.00','2016-09-27','General',55,14,1,1,1);
/*!40000 ALTER TABLE `pagorealizado` ENABLE KEYS */;


--
-- Definition of table `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `dni` char(8) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `fecR` date NOT NULL,
  PRIMARY KEY (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persona`
--

/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`idpersona`,`nombres`,`apellidos`,`dni`,`telefono`,`direccion`,`correo`,`fecR`) VALUES 
 (2,'Rosa María','Quispe Barreto','47859584','','','','2015-10-29'),
 (3,'Hector Fernando','Chávez Ríos','14785236','','','','2015-10-29'),
 (4,'Juan1','Flores','14774113','4235445','Av. Pumacayan 4564','mail@gmail.com','2015-10-29'),
 (5,'Dorian','Rios','58964220','587584','Jr. Av. Luzuriaga 814','docente@gmail.com','2015-11-02'),
 (6,'Dorian','Rios','47852365','5845845','Jr, Los Olivos 342','dcente1@gmail.com','2015-11-02'),
 (7,'Dorian','Rios','56859541','548595','Jr. Los Olivos 234','docent1@gmail.com','2015-11-02'),
 (8,'Ana María','Lopez Mercedez','65425895','425896','Jr. Los Azulejos 565','docent2@gmail.com','2015-11-02'),
 (9,'Juan','Ortiz Tamara','47331640','425898','Jr. Los Libertadores 321','juan@gmail.com','2015-12-08'),
 (10,'Mario','Gomez','25895632','424567','Jr. Trrinitarias 232','mario@gmail.com','2016-01-21'),
 (11,'Laura','Palma','47859555','423567','Jr. Los Libertadores 534','profeLaura@yahoo.com','2016-01-21'),
 (12,'Manuel','Alegria','42342342','458595','Psje. Los Alizos 867','manuel@gmail.com','2016-01-21'),
 (13,'Cristian','Chávez','85236999','525234','asdasd','cris@gmail.com','2016-01-21'),
 (14,'Maria','Mercedes','36547852','879584','Las amapolas 322','mari@hotmail.com','2016-01-21'),
 (15,'Raul','Alexander','45871232','589565','Jr. Los Quenuales 983','raul@gmail.com','2016-01-21'),
 (16,'Roman1','Riquelme','45832654','785478','Av. Las Esturias 234','roman@gmail.com','2016-01-21');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;


--
-- Definition of table `recargo`
--

DROP TABLE IF EXISTS `recargo`;
CREATE TABLE `recargo` (
  `idRec` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) DEFAULT NULL,
  `monto` decimal(12,2) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRec`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recargo`
--

/*!40000 ALTER TABLE `recargo` DISABLE KEYS */;
INSERT INTO `recargo` (`idRec`,`descripcion`,`monto`,`tipo`,`estado`) VALUES 
 (1,'Ninguno','0.00',0,'Intangible'),
 (2,'Mora 01 mes. +10%','10.00',1,'Activo'),
 (15,'demora +S/30.00','30.00',0,'Activo'),
 (16,'mora2 +5%','5.00',1,'Activo'),
 (17,'mora3 +S/35','35.00',0,'Activo'),
 (18,'Mora 35%','35.00',1,'Activo');
/*!40000 ALTER TABLE `recargo` ENABLE KEYS */;


--
-- Definition of table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE `seccion` (
  `idseccion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `idGrado` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idseccion`),
  KEY `fk_table1_Grado1_idx` (`idGrado`),
  CONSTRAINT `fk_table1_Grado1` FOREIGN KEY (`idGrado`) REFERENCES `grado` (`idGrado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seccion`
--

/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` (`idseccion`,`nombre`,`idGrado`,`estado`) VALUES 
 (1,'Sección 1',1,'Activo'),
 (5,'Sección 1',2,'Activo'),
 (9,'Sección 1',3,'Activo'),
 (13,'Sección 1',4,'Activo'),
 (17,'Sección 1',5,'Activo'),
 (21,'Sección 1',6,'Activo'),
 (25,'Sección 1',7,'Activo'),
 (29,'Sección 1',8,'Activo'),
 (33,'Sección 1',9,'Activo'),
 (37,'Sección 1',10,'Activo'),
 (41,'Sección 1',11,'Activo');
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;


--
-- Definition of table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE `tipousuario` (
  `idTipoUsu` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`idTipoUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipousuario`
--

/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` (`idTipoUsu`,`descripcion`,`nivel`) VALUES 
 (1,'Superadministrador',1),
 (2,'Administrador',2),
 (3,'Trabajador',3);
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `ape` varchar(100) DEFAULT NULL,
  `dni` char(8) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `idTipoUsu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `idTipoUsu` (`idTipoUsu`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idTipoUsu`) REFERENCES `tipousuario` (`idTipoUsu`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`,`nom`,`ape`,`dni`,`usuario`,`clave`,`idTipoUsu`) VALUES 
 (1,'Juan Rios','Flores Leyva','14785236','admin','123',1),
 (2,'Juan','Jose','14725896','Juan1','123',2),
 (3,'user','sadsad','12312312','user','123',3),
 (4,'trab1','asdsad','42321321','trab1','123',3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


--
-- Definition of procedure `CAsistencia`
--

DROP PROCEDURE IF EXISTS `CAsistencia`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `CAsistencia`(in Pdni char(8),in idUsu int)
begin

declare aux int default 0;
declare idP int default 0;
declare idAe int default 0;

declare auxT time default '00:00:00';


SELECT d.iddia into aux FROM diaasistencia d where d.fecha=curdate() group by d.iddia;

IF aux=0 THEN
update diaasistencia set estado='Cerrado';
insert into diaasistencia values(null,curdate(),'Activo');
SELECT d.iddia into aux FROM diaasistencia d where d.fecha=curdate() group by d.iddia;

end if;

select p.idpersona into idP from persona p where p.dni=Pdni;
select a.idA into idAe from Aescolar a where a.estado='Activo';
set auxT=curtime();


insert into asistencia values(null,'Asistió',curdate(),auxT,auxT,idP,idAe,'Hora Adecuada',aux,idUsu);




    end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `EgresarEstudios`
--

DROP PROCEDURE IF EXISTS `EgresarEstudios`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `EgresarEstudios`(in idPer int)
begin

declare aux int default 0;
declare idAescolar int default 0;
declare idAlu int default 0;

select idAlumno into idAlu from alumno where idpersona=idPer;

select d.idDetAluSec into aux  from detAluSec d
inner join aescolar a on a.idA=d.idA
where d.idAlumno=idAlu and a.estado='Activo';

if aux=0 then

update alumno set estado='Egresado' where idalumno=idAlu;
update detAluSec set estado='Egresado' where idalumno=idAlu;

end if;


select aux;

end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `JustificarI`
--

DROP PROCEDURE IF EXISTS `JustificarI`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `JustificarI`(in idP int,in idUsu int, motivo varchar(2000))
begin

declare aux int default 0;
declare idAe int default 0;

declare auxT time default '00:00:00';


SELECT d.iddia into aux FROM diaasistencia d where d.fecha=curdate() group by d.iddia;

IF aux=0 THEN
update diaasistencia set estado='Cerrado';
insert into diaasistencia values(null,curdate(),'Activo');
SELECT d.iddia into aux FROM diaasistencia d where d.fecha=curdate() group by d.iddia;

end if;


select a.idA into idAe from Aescolar a where a.estado='Activo';
set auxT=curtime();


insert into asistencia values(null,'Inasistio',curdate(),auxT,auxT,idP,idAe,motivo,aux,idUsu);




    end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `NuevoA`
--

DROP PROCEDURE IF EXISTS `NuevoA`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `NuevoA`(in des varchar(100), in feci date, in fecf date)
begin

declare aux varchar(50) default '';
declare aux1 decimal(12,2) default 0;
declare aux2 decimal (12,2) default 0;

declare auxae varchar(10) default '';
declare auxfil int default 0;

update aescolar set estado='Clausurado';

insert into aescolar values(null,feci,fecf,des,'Activo');

select idA into aux from aescolar where estado='Activo';
select descripcion into auxae from aescolar where estado='Activo';

SELECT matricula into aux1 FROM configpago c where estado='Activo';
SELECT mensualidad into aux2 FROM configpago c where estado='Activo';


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux1,'Pago de Matrícula',concat(auxae,'/01/01'),concat(auxae,'/03/01'),auxfil,aux);




insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Marzo',concat(auxae,'/03/01'),concat(auxae,'/03/31'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Abril',concat(auxae,'/04/01'),concat(auxae,'/04/30'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Mayo',concat(auxae,'/05/01'),concat(auxae,'/05/31'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Junio',concat(auxae,'/06/01'),concat(auxae,'/06/30'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Julio',concat(auxae,'/07/01'),concat(auxae,'/07/31'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Agosto',concat(auxae,'/08/01'),concat(auxae,'/08/31'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Setiembre',concat(auxae,'/09/01'),concat(auxae,'/09/30'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Octubre',concat(auxae,'/10/01'),concat(auxae,'/10/31'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Noviembre',concat(auxae,'/11/01'),concat(auxae,'/11/30'),auxfil,aux);


insert into filtropago values (null);
select idfiltropago into auxfil from filtropago ORDER BY idfiltropago DESC LIMIT 1;
insert into pagocronogramado values(null,aux2,'Pago del Mes de Diciembre',concat(auxae,'/12/01'),concat(auxae,'/12/15'),auxfil,aux);


end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PagarGeneral`
--

DROP PROCEDURE IF EXISTS `PagarGeneral`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PagarGeneral`(in mont decimal(12,2), in des varchar(200), in fec date, in bolet varchar(45),in idPer int,in idDes int, in idRec int, in idUsu int )
begin

declare aux int default 0;



insert into filtropago values (null);
select idfiltropago into aux from filtropago ORDER BY idfiltropago DESC LIMIT 1;


insert into pagogeneral values(null,mont,des,aux);

insert into pagorealizado values(null,mont,fec,bolet,aux,idPer,idDes,idRec,idUsu);

end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `PasarDeGrado`
--

DROP PROCEDURE IF EXISTS `PasarDeGrado`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `PasarDeGrado`(in idS int,in idPer int)
begin

declare aux int default 0;
declare idAescolar int default 0;
declare idAlu int default 0;

select idAlumno into idAlu from alumno where idpersona=idPer;


select d.idDetAluSec into aux  from detAluSec d
inner join aescolar a on a.idA=d.idA
where d.idAlumno=idAlu and a.estado='Activo';

if aux=0 then

update detAluSec set estado='Finalizado' where idalumno=idAlu;
select idA into idAescolar from aescolar where estado='Activo';
insert into detAluSec values(null,idAlu,idAescolar,idS,'Activo');

end if;


select aux;

end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
