﻿create table usuario (
id integer not null auto_increment,
login varchar(30) not null unique,
senha varchar(255) not null,
nome varchar(255) not null, 
primary key (id));

insert into usuario(login, senha, nome) values ('joao','123','João da Silva');
insert into usuario(login, senha, nome) values ('maria','123','Maria da Silva');
