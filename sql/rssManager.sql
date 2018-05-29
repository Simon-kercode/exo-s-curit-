#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: accounts
#------------------------------------------------------------

CREATE TABLE accounts(
        idAccount     int (11) Auto_increment  NOT NULL ,
        pseudoAccount Varchar (60) NOT NULL ,
        emailAccount  Varchar (60) NOT NULL ,
        avatarAccount Varchar (275) NOT NULL ,
        statusAccount Varchar (25) NOT NULL ,
        passAccount   Varchar (255) NOT NULL ,
        PRIMARY KEY (idAccount )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: rss
#------------------------------------------------------------

CREATE TABLE rss(
        idRss   int (11) Auto_increment  NOT NULL ,
        urlRss  Varchar (275) NOT NULL ,
        nameRss Varchar (275) NOT NULL ,
        PRIMARY KEY (idRss )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: rssCategories
#------------------------------------------------------------

CREATE TABLE rssCategories(
        idRssCategory   int (11) Auto_increment  NOT NULL ,
        nameRssCategory Varchar (275) NOT NULL ,
        idAccount       Int NOT NULL ,
        PRIMARY KEY (idRssCategory )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: posts
#------------------------------------------------------------

CREATE TABLE posts(
        idPost      int (11) Auto_increment  NOT NULL ,
        titrePost   Varchar (275) NOT NULL ,
        contenuPost Varchar (1000) ,
        datePost    Date NOT NULL ,
        idRss       Int NOT NULL ,
        PRIMARY KEY (idPost )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cercleLink
#------------------------------------------------------------

CREATE TABLE cercleLink(
        idCercleLink int (11) Auto_increment  NOT NULL ,
        nameCircle   Varchar (275) NOT NULL ,
        PRIMARY KEY (idCercleLink )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        idComment      int (11) Auto_increment  NOT NULL ,
        contentComment Varchar (1000) NOT NULL ,
        dateComment    Date NOT NULL ,
        idPost         Int NOT NULL ,
        idAccount      Int NOT NULL ,
        PRIMARY KEY (idComment )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: chats
#------------------------------------------------------------

CREATE TABLE chats(
        idChat      int (11) Auto_increment  NOT NULL ,
        contentChat Varchar (275) NOT NULL ,
        dateChat    Date NOT NULL ,
        idAccount   Int NOT NULL ,
        PRIMARY KEY (idChat )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: invitation
#------------------------------------------------------------

CREATE TABLE invitation(
        idInvitation      int (11) Auto_increment  NOT NULL ,
        contentInvitation Varchar (275) NOT NULL ,
        dateInvitation    Date NOT NULL ,
        PRIMARY KEY (idInvitation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: connect
#------------------------------------------------------------

CREATE TABLE connect(
        idAccount    Int NOT NULL ,
        idCercleLink Int NOT NULL ,
        PRIMARY KEY (idAccount ,idCercleLink )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: deffine
#------------------------------------------------------------

CREATE TABLE deffine(
        idRssCategory Int NOT NULL ,
        idRss         Int NOT NULL ,
        PRIMARY KEY (idRssCategory ,idRss )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: invite
#------------------------------------------------------------

CREATE TABLE invite(
        idAccount    Int NOT NULL ,
        idInvitation Int NOT NULL ,
        PRIMARY KEY (idAccount ,idInvitation )
)ENGINE=InnoDB;

ALTER TABLE rssCategories ADD CONSTRAINT FK_rssCategories_idAccount FOREIGN KEY (idAccount) REFERENCES accounts(idAccount);
ALTER TABLE posts ADD CONSTRAINT FK_posts_idRss FOREIGN KEY (idRss) REFERENCES rss(idRss);
ALTER TABLE comments ADD CONSTRAINT FK_comments_idPost FOREIGN KEY (idPost) REFERENCES posts(idPost);
ALTER TABLE comments ADD CONSTRAINT FK_comments_idAccount FOREIGN KEY (idAccount) REFERENCES accounts(idAccount);
ALTER TABLE chats ADD CONSTRAINT FK_chats_idAccount FOREIGN KEY (idAccount) REFERENCES accounts(idAccount);
ALTER TABLE connect ADD CONSTRAINT FK_connect_idAccount FOREIGN KEY (idAccount) REFERENCES accounts(idAccount);
ALTER TABLE connect ADD CONSTRAINT FK_connect_idCercleLink FOREIGN KEY (idCercleLink) REFERENCES cercleLink(idCercleLink);
ALTER TABLE deffine ADD CONSTRAINT FK_deffine_idRssCategory FOREIGN KEY (idRssCategory) REFERENCES rssCategories(idRssCategory);
ALTER TABLE deffine ADD CONSTRAINT FK_deffine_idRss FOREIGN KEY (idRss) REFERENCES rss(idRss);
ALTER TABLE invite ADD CONSTRAINT FK_invite_idAccount FOREIGN KEY (idAccount) REFERENCES accounts(idAccount);
ALTER TABLE invite ADD CONSTRAINT FK_invite_idInvitation FOREIGN KEY (idInvitation) REFERENCES invitation(idInvitation);
