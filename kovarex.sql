create database kovarex;
use kovarex;

select * from usuario;

create table usuario(
    id int not null auto_increment primary key,
    hierarquia int not null,
    nome varchar(255),
    email varchar(100),
    psw varchar(25)
) engine = InnoDB;

create table unidade(
    id int not null auto_increment primary key,
    nome varchar(50),
    constraint nome_uni unique(nome)
) engine = InnoDB;

create table item(
    id int not null auto_increment primary key,
    nome varchar(255),
    id_unidade int not null,
    foreign key (id_unidade) references unidade(id)
) engine = InnoDB;

create table pregao(
    id int not null auto_increment primary key,
    nome varchar(255),
    inicio date,
    termino date
) engine = InnoDB;

create table itens_pregao(
    id int not null auto_increment primary key,
    id_item int not null,
    id_pregao int not null,
    foreign key (id_item) references item(id),
    foreign key (id_pregao) references pregao(id)
) engine = InnoDB;

create table pedido(
    id int not null auto_increment primary key,
    criacao date not null,
    id_autor int not null,
    foreign key (id_autor) references usuario(id)
) engine = InnoDB;

create table item_pedido(
    id int not null auto_increment primary key,
    id_item int not null,
    id_autor int not null,
    quantidade int not null,
    foreign key (id_item) references item(id),
    foreign key (id_autor) references usuario(id)
) engine = InnoDB;