CREATE TABLE Utilisateur(
   id INT,
   email VARCHAR(50) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   mdp VARCHAR(50) NOT NULL,
   dateNaissance DATE NOT NULL,
   role VARCHAR(50),
   dateInscripiton DATE NOT NULL,
   avatar VARCHAR(50),
   PRIMARY KEY(id),
   UNIQUE(email)
);

CREATE TABLE Forum(
   id VARCHAR(50),
   titre VARCHAR(50) NOT NULL,
   description VARCHAR(50),
   dateCreation DATE NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(titre)
);

CREATE TABLE Categorie(
   id VARCHAR(50),
   contenu VARCHAR(50),
   auteur VARCHAR(50) NOT NULL,
   dateCreation VARCHAR(50) NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE Signalement(
   id VARCHAR(50),
   utilisateur VARCHAR(50),
   message VARCHAR(50),
   sujet VARCHAR(50),
   raison VARCHAR(50),
   statut VARCHAR(50),
   dateSignal DATE,
   PRIMARY KEY(id)
);

CREATE TABLE Statistique(
   id VARCHAR(50),
   nbUtilisateurs VARCHAR(50),
   nbForum VARCHAR(50),
   nbSujet VARCHAR(50),
   nbMessage VARCHAR(50),
   nbSignalement VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE Sujet(
   id VARCHAR(50),
   titre VARCHAR(50) NOT NULL,
   description VARCHAR(50) NOT NULL,
   auteur VARCHAR(50) NOT NULL,
   dateCreation DATE,
   nbVues INT,
   id_1 VARCHAR(50) NOT NULL,
   id_2 VARCHAR(50),
   id_3 INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Categorie(id),
   FOREIGN KEY(id_2) REFERENCES Forum(id),
   FOREIGN KEY(id_3) REFERENCES Utilisateur(id)
);

CREATE TABLE Message(
   id VARCHAR(50),
   contenu VARCHAR(50),
   auteur VARCHAR(50) NOT NULL,
   dateCreation VARCHAR(50) NOT NULL,
   id_1 VARCHAR(50),
   id_2 INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Sujet(id),
   FOREIGN KEY(id_2) REFERENCES Utilisateur(id)
);

CREATE TABLE Reponse(
   id VARCHAR(50),
   contenu VARCHAR(50),
   auteur VARCHAR(50) NOT NULL,
   dateCreation VARCHAR(50) NOT NULL,
   id_1 VARCHAR(50) NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Message(id)
);

CREATE TABLE Moderation(
   id VARCHAR(50),
   moderateur VARCHAR(50) NOT NULL,
   message VARCHAR(50) NOT NULL,
   raison VARCHAR(50),
   dateModeration DATE NOT NULL,
   id_1 VARCHAR(50) NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Message(id)
);

CREATE TABLE Abonner(
   id INT,
   id_1 VARCHAR(50),
   id_2 VARCHAR(50),
   dateAbbonnement VARCHAR(50),
   PRIMARY KEY(id, id_1, id_2),
   FOREIGN KEY(id) REFERENCES Utilisateur(id),
   FOREIGN KEY(id_1) REFERENCES Forum(id),
   FOREIGN KEY(id_2) REFERENCES Sujet(id)
);

CREATE TABLE Voter(
   id INT,
   id_1 VARCHAR(50),
   upVote VARCHAR(50),
   downVote VARCHAR(50),
   PRIMARY KEY(id, id_1),
   FOREIGN KEY(id) REFERENCES Utilisateur(id),
   FOREIGN KEY(id_1) REFERENCES Message(id)
);

CREATE TABLE Signaler(
   id INT,
   id_1 VARCHAR(50),
   id_2 VARCHAR(50),
   id_3 VARCHAR(50),
   PRIMARY KEY(id, id_1, id_2, id_3),
   FOREIGN KEY(id) REFERENCES Utilisateur(id),
   FOREIGN KEY(id_1) REFERENCES Sujet(id),
   FOREIGN KEY(id_2) REFERENCES Message(id),
   FOREIGN KEY(id_3) REFERENCES Signalement(id)
);
