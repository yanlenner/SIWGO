SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-04:00";

CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

USE `test`;

DROP TABLE IF EXISTS `regularidad`;

CREATE TABLE `regularidad` (
  `cedula` varchar(10) COLLATE utf8_spanish_ci NOT NULL,  
  `nombres` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `carrera` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `carnet` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


COMMIT;


CREATE DATABASE IF NOT EXISTS `odontologia` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';
GRANT USAGE ON *.* TO 'usuario'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `odontologia`.* TO 'usuario'@'localhost';
GRANT ALL PRIVILEGES ON `test`.* TO 'usuario'@'localhost';


USE `odontologia`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `cedula` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ci de la persona',
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la persona',
  `apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellido de la persona',
  `genero` char(1) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Género de la persona',
  `telefono` varchar(12) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Número de teléfono / celular de la persona',
  `fecha` date NOT NULL COMMENT 'Fecha de nacimiento de la persona',
  `correo` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Correo electrónico de la persona',
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Dirección de domicilio de la persona',
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `trabajador`;

CREATE TABLE `trabajador` (
  `cedula` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ci de la persona',
  `usuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cuenta del usuario',
  `password` varchar(32) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Contraseña del usuario',
  `respuesta` varchar(32) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Respuesta antiphishing del usuario',
  `nivel` char(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'ae' COMMENT 'Nivel de permisos del usuario',
  `mpps` varchar(9) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0' COMMENT 'Código de Médico adscrito al M.P.P.S.',
  PRIMARY KEY (`usuario`),
  KEY `cedula_trabajador` (`cedula`),
  CONSTRAINT `cedula_trabajador` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `estudiante`;

CREATE TABLE `estudiante` (
  `cedula` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ci del paciente',
  `id_historia` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id de la historia clínica',
  `carrera` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Carrera que estudia el paciente',
  `carnet` varchar(9) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Número de carnet estudiantil del paciente',
  `aspecto` varchar(535) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Aspecto extraoral del paciente',
  `hallazgo` varchar(535) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Hallazgos clínicos bucales de importancia',
  `observacion` varchar(535) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Observaciones percibidas del paciente',
  `respuesta` varchar(535) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Respuestas positivas del paciente',
 PRIMARY KEY (`id_historia`),
  KEY `cedula_estudiante` (`cedula`),
  CONSTRAINT `cedula_estudiante` FOREIGN KEY (`cedula`) REFERENCES `persona` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `sesion`;

CREATE TABLE `sesion` (
  `id_sesion` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Número de inicio de sesión',
  `usuario` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Cuenta del usuario que accede al sistema',
  `inicio` datetime NOT NULL COMMENT 'Marca temporal de la entrada',
  `fin` datetime DEFAULT NULL COMMENT 'Marca temporal de la salida',
  `minutos` smallint(5) unsigned DEFAULT NULL COMMENT 'Tiempo de sesión',
  PRIMARY KEY (`id_sesion`),
  UNIQUE KEY `id_sesion` (`id_sesion`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `usuario` FOREIGN KEY (`usuario`) REFERENCES `trabajador` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `registro_devisitas`;

CREATE TABLE `registro_devisitas` (
  `id_visita` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Número de visita',
  `id_sesion` bigint(20) unsigned NOT NULL COMMENT 'Número de inicio de sesión',
  `enlace` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ruta que visitó',
  `tiempo` datetime NOT NULL COMMENT 'Marca temporal de visita a la página',
  PRIMARY KEY (`id_visita`),
  KEY `id_sesion_fk1` (`id_sesion`),
  CONSTRAINT `id_sesion_fk1` FOREIGN KEY (`id_sesion`) REFERENCES `sesion` (`id_sesion`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `antecedente`;

CREATE TABLE `antecedente` (
  `id_antecedente` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id del antecedente médico',
  `id_historia` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id de la historia clínica',
  `nombre_antecedente` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Antecedente asociado al paciente',
  UNIQUE KEY `id_antecedente` (`id_antecedente`),
  KEY `historia_clinica` (`id_historia`),
  CONSTRAINT `historia_clinica` FOREIGN KEY (`id_historia`) REFERENCES `estudiante` (`id_historia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `consulta`;

CREATE TABLE `consulta` (
  `id_historia` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id de la historia clínica',
  `cedula` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ci del odontólogo que asistió al paciente',
  `id_consulta` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id de la consulta realizada',
  `pieza` varchar(7) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Pieza dental tratada durante la consulta',
  `diagnostico` varchar(180) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Diagnostico establecido durante la consulta',
  `tipo_consulta` varchar(30) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tipo de consulta aplicada',
  `fecha` date NOT NULL COMMENT 'Fecha de registro de la consulta',
  PRIMARY KEY (`id_consulta`),
  KEY `odontologo` (`cedula`),
  KEY `historia_clinica_fk2` (`id_historia`),
  CONSTRAINT `historia_clinica_fk2` FOREIGN KEY (`id_historia`) REFERENCES `estudiante` (`id_historia`),
  CONSTRAINT `odontologo` FOREIGN KEY (`cedula`) REFERENCES `trabajador` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

DROP TABLE IF EXISTS `tratamiento`;

CREATE TABLE `tratamiento` (
  `id_historia` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id de la historia clínica',
  `cedula` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Ci del odontólogo que receta al paciente',
  `id_consulta` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id de la consulta asociada',
  `id_tratamiento` varchar(10) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Id del tratamiento',
  `indicaciones` varchar(250) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Indicaciones del tratamiento',
  `medicamento` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Medicamentos recetados',
  `duracion` varchar(15) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Duración del tratamiento',
  PRIMARY KEY (`id_tratamiento`),
  KEY `odontologo_fk2` (`cedula`),
  KEY `historia_clinica_fk3` (`id_historia`),
  KEY `consulta` (`id_consulta`),
  CONSTRAINT `consulta` FOREIGN KEY (`id_consulta`) REFERENCES `consulta` (`id_consulta`),
  CONSTRAINT `historia_clinica_fk3` FOREIGN KEY (`id_historia`) REFERENCES `estudiante` (`id_historia`),
  CONSTRAINT `odontologo_fk2` FOREIGN KEY (`cedula`) REFERENCES `trabajador` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

SET foreign_key_checks = 1;