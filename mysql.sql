create table blogs
(
  id               int  not null  AUTO_INCREMENT,
  name             int,
  description      TEXT,
  creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
create table articles
(
  id               int  not null  AUTO_INCREMENT,
  nom              TEXT,
  description      TEXT,
  chapo            TEXT,
  corp             TEXT,
  creation_date    DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

create table users
(
  id               int  not null  AUTO_INCREMENT,
  name            TEXT,
  firstname       TEXT,
  peudo           TEXT,
  date_naissance DATETIME,
  email           TEXT,
  password        TEXT,
  creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
create table commentaires
(
  id               int  not null  AUTO_INCREMENT,
  id_pseudo        int,
  corp             TEXT,
  creation_date    DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

create table categories
(
  id               int  not null  AUTO_INCREMENT,
  name             TEXT,
  creation_date    DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
create table picesjointes
(
  id               int  not null  AUTO_INCREMENT,
  name             TEXT,
  chemin           TEXT,
  creation_date    DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

-- jointure tables relastion
create table categories_articles
(
  id_articles int,
  id_categorie int
);
create table blogs_users
(
  id_blogs int,
  id_users int
);
create table blogs_articles
(
  id_blogs int,
  id_articles int
);
create table articles_users
(
  users_droits TEXT,
  id_users int,
  id_articles int
);
create table articles_piecesjointes
(
  id_articles int,
  id_piecsjointes int

)
-- INSERT INTO user (name, email) VALUES
--     ('test', 'test@test.com'),('jeremie', 'jeremie@test.com'),('truc', 'truc@truc.com'),
--     ('test2', 'test2@test.com'),('lalaland', 'blablaland@test.com'),('ostrich', 'ok@ok.com');
--
-- INSERT INTO task (user_id, title, description, status) VALUES
--         (3, 'tirte ', 'fwefwfw', 'die'),(4, 'tidadasrte ', 'fwdadaefwfw', 'stop'),(5, 'tidasdarte ', 'fwadsadaefwfw', 'encour'),(3, 'tsadairte ', 'fdadaswefwfw', 'fini');
