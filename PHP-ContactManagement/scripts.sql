CREATE my_db
use my_db

CREATE TABLE contatos (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  email varchar(50) DEFAULT NULL,
  apelido varchar(15) DEFAULT NULL,
  dtnasc date DEFAULT NULL,
  idTipo int(11) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE foto (
  id INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(30) NOT NULL,
  tipo VARCHAR(30) NOT NULL,
  tamanho INT NOT NULL,
  conteudo MEDIUMBLOB NOT NULL,
  idCont INT NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE telefones (
  id_cont int(11) NOT NULL,
  telefone varchar(50) DEFAULT NULL
);

CREATE TABLE tipocontatos (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(50) DEFAULT NULL,
  email varchar(50) NOT NULL,
  senha varchar(50) DEFAULT NULL,
  PRIMARY KEY(id)
);
