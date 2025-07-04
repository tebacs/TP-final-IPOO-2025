
CREATE DATABASE bdviajes; 

USE bdviajes;

CREATE TABLE Empresa(
    idEmpresa bigint AUTO_INCREMENT,
    empresaNombre varchar(150),
    empresaDireccion varchar(150),
    borrado date DEFAULT NULL,
    PRIMARY KEY (idEmpresa) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE Persona(
    idPersona bigint AUTO_INCREMENT,
    nombre varchar(150), 
    apellido varchar(150), 
    borrado date DEFAULT NULL,
    PRIMARY KEY (idPersona)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE Responsable (
    numeroResponsable bigint,
    numeroLicencia bigint,
    idPersona bigint,
    borrado date DEFAULT NULL,
    PRIMARY KEY (idPersona),
    FOREIGN KEY (idPersona) REFERENCES Persona (idPersona)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE Pasajero (
    documentoPasajero varchar(15), 
	telefonoPasajero varchar(20), 
    idPersona bigint,
    borrado date DEFAULT NULL,
    PRIMARY KEY (idPersona),
    FOREIGN KEY (idPersona) REFERENCES Persona (idPersona)	
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)ENGINE=InnoDB DEFAULT CHARSET=utf8; 

CREATE TABLE Viaje (
    idViaje bigint AUTO_INCREMENT, /*codigo de viaje*/
	destinoViaje varchar(150),
    cantMaxPasajeros int,
	idEmpresa bigint,
    numeroResponsableViaje bigint,
    importeViaje float,
    borrado date DEFAULT NULL,
    PRIMARY KEY (idViaje),
    FOREIGN KEY (idEmpresa) REFERENCES Empresa (idEmpresa),
	FOREIGN KEY (numeroResponsableViaje) REFERENCES Responsable (idPersona)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
 
CREATE TABLE RealizaViaje (
    idViaje bigint,
    idPasajero bigint,
    fechaRealizaViaje date,
    borrado date DEFAULT NULL,
    PRIMARY KEY (idViaje, idPasajero),
    FOREIGN KEY (idViaje) REFERENCES Viaje (idViaje)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
    FOREIGN KEY (idPasajero) REFERENCES Pasajero (idPersona)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


