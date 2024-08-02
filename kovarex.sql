create database kovarex;

use kovarex;

create table usuario(
    id int not null auto_increment primary key,
    hierarquia int not null,
    nome varchar(255),
    email varchar(5000),
    psw varchar(5000)
) engine = InnoDB;

create table empresa(
    id int not null auto_increment primary key,
    razao varchar(255),
    cnpj varchar(18)
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

create table grupo_pregao(
    id int not null auto_increment primary key,
    id_pregao int not null,
    id_empresa int null,
    foreign key (id_pregao) references pregao(id),
    foreign key (id_empresa) references empresa(id)
) engine = InnoDB;

create table item_pregao(
    id int not null auto_increment primary key,
    id_item int not null,
    id_pregao int not null,
    id_grupo int null,
    id_empresa int null,
    quantidade int not null,
    foreign key (id_grupo) references grupo_pregao(id),
    foreign key (id_item) references item(id),
    foreign key (id_pregao) references pregao(id),
    foreign key (id_empresa) references empresa(id)
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