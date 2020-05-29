DROP DATABASE quizzsa;
CREATE DATABASE quizzsa;
use quizzsa;
#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: joueurs
#------------------------------------------------------------

CREATE TABLE joueurs(
        idjoueur      Int NOT NULL AUTO_INCREMENT,
        prenomJoueur  Varchar (150) NOT NULL ,
        nomJoueur     Varchar (100) NOT NULL ,
        loginJoueur   Varchar (150) NOT NULL ,
        avatarJoueur  Varchar (255) NOT NULL ,
        passwordJoueur Text NOT NULL ,
        scoreJoueur    Int NOT NULL
	,CONSTRAINT joueurs_PK PRIMARY KEY (idjoueur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: administrateur
#------------------------------------------------------------

CREATE TABLE administrateur(
        idAdmin       Int NOT NULL AUTO_INCREMENT,
        prenomAdmin   Char (150) NOT NULL ,
        nomAdmin      Varchar (100) NOT NULL ,
        avatarAdmin   Varchar (100) NOT NULL ,
        passwordAdmin Text NOT NULL,
        loginAdmin Varchar(100) NOT NULL
	,CONSTRAINT administrateur_PK PRIMARY KEY (idAdmin)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: questions
#------------------------------------------------------------

CREATE TABLE questions(
        idQuestion      Int NOT NULL AUTO_INCREMENT,
        ennonceQuestion Longtext NOT NULL ,
        typeQuestion    Varchar (10) NOT NULL ,
        choixPossible   Longtext NOT NULL ,
        reponse         Longtext NOT NULL ,
        note            Int NOT NULL ,
        idAdmin         Int NOT NULL
	,CONSTRAINT questions_PK PRIMARY KEY (idQuestion)

	,CONSTRAINT questions_administrateur_FK FOREIGN KEY (idAdmin) REFERENCES administrateur(idAdmin)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: repondre
#------------------------------------------------------------

CREATE TABLE repondre(
        idQuestion Int NOT NULL ,
        idjoueur   Int NOT NULL
	,CONSTRAINT repondre_PK PRIMARY KEY (idQuestion,idjoueur)

	,CONSTRAINT repondre_questions_FK FOREIGN KEY (idQuestion) REFERENCES questions(idQuestion)
	,CONSTRAINT repondre_joueurs0_FK FOREIGN KEY (idjoueur) REFERENCES joueurs(idjoueur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: trouver
#------------------------------------------------------------

CREATE TABLE trouver(
        idQuestion Int NOT NULL ,
        idjoueur   Int NOT NULL
	,CONSTRAINT trouver_PK PRIMARY KEY (idQuestion,idjoueur)

	,CONSTRAINT trouver_questions_FK FOREIGN KEY (idQuestion) REFERENCES questions(idQuestion)
	,CONSTRAINT trouver_joueurs0_FK FOREIGN KEY (idjoueur) REFERENCES joueurs(idjoueur)
)ENGINE=InnoDB;

