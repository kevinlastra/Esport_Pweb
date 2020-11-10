/*
reset tables
*/

DROP TABLE joueur;
DROP TABLE EPE;
DROP TABLE equipe;
DROP TABLE tournois;
DROP TABLE typetournois;
DROP TABLE evenement;
DROP TABLE typejeux;
DROP TABLE org_morale;
DROP TABLE org_physique;
DROP TABLE organisateur;

/*
create tables
*/

#organisateur
CREATE TABLE organisateur
(
    id_o INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id_o)
);
#organisateur physique
CREATE TABLE org_physique
(
    id_o INT NOT NULL,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    PRIMARY KEY(id_o),
    FOREIGN KEY(id_o) REFERENCES organisateur(id_o)
);
#organisateur morale
CREATE TABLE org_morale
(
    id_o INT NOT NULL,
    nom VARCHAR(100) NOT NULL,
    raison_s VARCHAR(50) NOT NULL,
    siege_s VARCHAR(200) NOT NULL,
    PRIMARY KEY(id_o),
    FOREIGN KEY(id_o) REFERENCES organisateur(id_o)
);
#typejeux
CREATE TABLE typejeux
(
    id_tj INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(20),
    PRIMARY KEY(id_tj)
);
#evenement
CREATE TABLE evenement
(
    id_e INT NOT NULL AUTO_INCREMENT,
    date_e DATE NOT NULL,
    id_tj INT NOT NULL,
    nb_tournois INTEGER(3) NOT NULL,
    id_o INT NOT NULL,
    formule_sportive VARCHAR(1000),
    PRIMARY KEY(id_e),
    FOREIGN KEY(id_tj) REFERENCES typejeux(id_tj),
    FOREIGN KEY(id_o) REFERENCES organisateur(id_o)
);
#typetournois
CREATE TABLE typetournois
(
    id_tt INT NOT NULL AUTO_INCREMENT,
    nom_tournois VARCHAR(20) NOT NULL,
    PRIMARY KEY(id_tt)
);
#tournois
CREATE TABLE tournois
(
    id_tt INT NOT NULL,
    id_e INT NOT NULL,
    PRIMARY KEY(id_tt, id_e),
    FOREIGN KEY(id_tt) REFERENCES typetournois(id_tt),
    FOREIGN KEY(id_e) REFERENCES evenement(id_e)
);
#equipe
CREATE TABLE equipe
(
    id_team INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(20) NOT NULL,
    niveau VARCHAR(20) NOT NULL,
    PRIMARY KEY(id_team)
);
#EPE(Equipe qui Participe au Evenement)
CREATE TABLE EPE
(
    id_e INT NOT NULL,
    id_team INT NOT NULL,
    PRIMARY KEY(id_team, id_e),
    FOREIGN KEY(id_team) REFERENCES equipe(id_team),
    FOREIGN KEY(id_e) REFERENCES evenement(id_e)
);
#joueur
CREATE TABLE joueur
(
    id_j INT NOT NULL AUTO_INCREMENT,
    id_team INT NOT NULL,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    niveau VARCHAR(20) NOT NULL,
    PRIMARY KEY(id_j),
    FOREIGN KEY(id_team) REFERENCES equipe(id_team)
);