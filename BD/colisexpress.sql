
CREATE TABLE Itineraire (
    codeIt VARCHAR(10) PRIMARY KEY,
    villeDep VARCHAR(40),
    villeArr VARCHAR(40)
);
CREATE TABLE Voiture(
    idVoit VARCHAR(20) PRIMARY KEY,
    design VARCHAR(40),
    codeIt VARCHAR(10),
    FOREIGN KEY (codeIt) REFERENCES Itineraire (codeIt) ON DELETE CASCADE ON UPDATE CASCADE,
    frais INT
);

CREATE TABLE Envoyer(
    idEnvoi INT AUTO_INCREMENT PRIMARY KEY,
     idVoit VARCHAR(20),
     FOREIGN KEY (idVoit) REFERENCES Voiture (idVoit),
     colis VARCHAR(30),
     nomEnvoyeur VARCHAR(50),
     emailEnvoyeur VARCHAR(50),
     date_Envoi DATETIME,
     frais INT,
     nomRecepteur VARCHAR(50),
     contactRecepteur VARCHAR(20)
);

CREATE TABLE recevoir (
    idRecept INT AUTO_INCREMENT PRIMARY KEY,
    idEnvoi INT,
    FOREIGN KEY (idEnvoi) REFERENCES Envoyer (idEnvoi) ON DELETE CASCADE ON UPDATE CASCADE,
    date_Recept DATETIME
);

CREATE TABLE gerant (
    emailGerant VARCHAR(50) PRIMARY KEY,
    mdpGerant VARCHAR(20)
);
