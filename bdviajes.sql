CREATE DATABASE bdviajes; 

CREATE TABLE Empresa(
    idEmpresa bigint AUTO_INCREMENT,
    empresaNombre varchar(150),
    empresaDireccion varchar(150),
    PRIMARY KEY (idEmpresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE Responsable (
    numeroResponsable bigint AUTO_INCREMENT,
    numeroLicencia bigint,
	nombreResponsable varchar(150), 
    apellidoResponsable  varchar(150), 
    PRIMARY KEY (numeroResponsable)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;;
	
CREATE TABLE Viaje (
    idViaje bigint AUTO_INCREMENT, /*codigo de viaje*/
	destinoViaje varchar(150),
    cantMaxPasajeros int,
	idEmpresa bigint,
    numeroResponsableViaje bigint,
    importeViaje float,
    PRIMARY KEY (idViaje),
    FOREIGN KEY (idEmpresa) REFERENCES Empresa (idEmpresa),
	FOREIGN KEY (numeroResponsableViaje) REFERENCES Responsable (numeroResponsable)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
	
CREATE TABLE Pasajero (
    documentoPasajero varchar(15),
    nombrePasajero varchar(150), 
    apellidoPasajero varchar(150), 
	telefonoPasajero int, 
	idViajePasajero bigint,
    PRIMARY KEY (documentoPasajero),
	FOREIGN KEY (idViajePasajero) REFERENCES Viaje (idViaje)	
    )ENGINE=InnoDB DEFAULT CHARSET=utf8; 
 
  
