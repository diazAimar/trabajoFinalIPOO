CREATE TABLE IF NOT EXISTS `teatro` (
  `idteatro` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  PRIMARY KEY (`idteatro`)
);

CREATE TABLE IF NOT EXISTS `funcion` (
  `idfuncion` int(3) NOT NULL AUTO_INCREMENT,
  `idteatro` int(3) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `horariodeinicio` int(4) NOT NULL,
  `duracion` int(3) NOT NULL,
  `precio` varchar(6) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idteatro`) REFERENCES `teatro` (`idteatro`)
);

CREATE TABLE IF NOT EXISTS `funcioncine` (
  `idfuncion` int(3) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `paisorigen` varchar(20) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`)
);

CREATE TABLE IF NOT EXISTS `funcionmusical` (
  `idfuncion` int(3) NOT NULL,
  `director` varchar(20) NOT NULL,
  `cantpersonasescena` int(4) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`)
);

CREATE TABLE IF NOT EXISTS `funcionteatro` (
  `idfuncion` int(3) NOT NULL,
  PRIMARY KEY (`idfuncion`),
  FOREIGN KEY (`idfuncion`) REFERENCES `funcion` (`idfuncion`)
);