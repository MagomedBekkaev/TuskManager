CREATE TABLE ForumUser(
   id_utilisateur INT,
   pseudo VARCHAR(50) NOT NULL,
   signedAt DATETIME NOT NULL,
   avatar VARCHAR(50),
   PRIMARY KEY(id_utilisateur)
);

CREATE TABLE Forum(
   id_forum VARCHAR(50),
   title VARCHAR(50) NOT NULL,
   description VARCHAR(50),
   createdAt DATETIME NOT NULL,
   PRIMARY KEY(id_forum),
   UNIQUE(title)
);

CREATE TABLE Category(
   id_category VARCHAR(50),
   content VARCHAR(50),
   id_forum VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_category),
   FOREIGN KEY(id_forum) REFERENCES Forum(id_forum)
);

CREATE TABLE Topic(
   id_topic VARCHAR(50),
   title VARCHAR(500) NOT NULL,
   description VARCHAR(50) NOT NULL,
   author VARCHAR(50) NOT NULL,
   nbView INT,
   createdAt DATETIME,
   updatedAt DATETIME NOT NULL,
   updatedBy VARCHAR(50),
   id_category VARCHAR(50) NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_topic),
   FOREIGN KEY(id_category) REFERENCES Category(id_category),
   FOREIGN KEY(id_utilisateur) REFERENCES ForumUser(id_utilisateur)
);

CREATE TABLE Comment(
   id_comment VARCHAR(50),
   content VARCHAR(50),
   author VARCHAR(50) NOT NULL,
   createdAt DATETIME NOT NULL,
   updatedAt DATETIME,
   updatedBy VARCHAR(50),
   id_comment_1 VARCHAR(50) NOT NULL,
   id_topic VARCHAR(50) NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_comment),
   FOREIGN KEY(id_comment_1) REFERENCES Comment(id_comment),
   FOREIGN KEY(id_topic) REFERENCES Topic(id_topic),
   FOREIGN KEY(id_utilisateur) REFERENCES ForumUser(id_utilisateur)
);

CREATE TABLE Follow(
   id_utilisateur INT,
   id_forum VARCHAR(50),
   id_topic VARCHAR(50),
   followedAt DATE,
   PRIMARY KEY(id_utilisateur, id_forum, id_topic),
   FOREIGN KEY(id_utilisateur) REFERENCES ForumUser(id_utilisateur),
   FOREIGN KEY(id_forum) REFERENCES Forum(id_forum),
   FOREIGN KEY(id_topic) REFERENCES Topic(id_topic)
);

CREATE TABLE Vote(
   id_utilisateur INT,
   id_comment VARCHAR(50),
   vote AS ENUM ('down', 'up') NOT NULL,
   PRIMARY KEY(id_utilisateur, id_comment),
   FOREIGN KEY(id_utilisateur) REFERENCES ForumUser(id_utilisateur),
   FOREIGN KEY(id_comment) REFERENCES Comment(id_comment)
);

CREATE TABLE Report(
   id_utilisateur INT,
   id_utilisateur_1 INT,
   id_topic VARCHAR(50),
   id_comment VARCHAR(50),
   reason VARCHAR(50),
   createdAt DATETIME,
   PRIMARY KEY(id_utilisateur, id_utilisateur_1, id_topic, id_comment),
   FOREIGN KEY(id_utilisateur) REFERENCES ForumUser(id_utilisateur),
   FOREIGN KEY(id_utilisateur_1) REFERENCES ForumUser(id_utilisateur),
   FOREIGN KEY(id_topic) REFERENCES Topic(id_topic),
   FOREIGN KEY(id_comment) REFERENCES Comment(id_comment)
);
