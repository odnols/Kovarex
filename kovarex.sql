create database kovarex;

use kovarex;

select * from atribuicao;
delete from empresa where id = 1;

create table usuario(
    id int not null auto_increment primary key,
    hierarquia int not null,
    nome varchar(255),
    email varchar(100),
    hash varchar(5000)
) engine = InnoDB;

create table empresa(
    id int not null auto_increment primary key,
    razao_social varchar(255),
    cnpj varchar(18),
    constraint cnpj_uni unique(cnpj)
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
    data_inicio varchar(50),
    data_termino varchar(50)
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
    data_criacao varchar(50),
    id_autor int not null,
    status int,
    foreign key (id_autor) references usuario(id)
) engine = InnoDB;

create table item_pedido(
    id int not null auto_increment primary key,
    id_item int not null,
    id_autor int not null,
    id_pedido int not null,
    quantidade int not null,
    foreign key (id_item) references item(id),
    foreign key (id_autor) references usuario(id),
    foreign key (id_pedido) references pedido(id)
) engine = InnoDB;

create table departamento(
	id int not null auto_increment primary key,
    nome varchar(250),
    cor_destaque varchar(20)
) engine = InnoDB;

create table empenho(
	id int not null auto_increment primary key,
    num_empenho int not null,
    num_af int not null,
    status int not null,
    data_empenho varchar(50),
    data_entrega varchar(50),
	id_departamento int not null,
    foreign key (id_departamento) references departamento(id)
) engine = InnoDB;

create table evento_empenho(
	id int not null auto_increment primary key,
    id_autor int not null,
    descricao varchar(500),
    data_evento varchar(50),
    foreign key (id_autor) references usuario(id)
);

create table atribuicao(
	id int not null auto_increment primary key,
    id_usuario int not null,
    id_departamento int not null,
    foreign key (id_usuario) references usuario(id),
    foreign key (id_departamento) references departamento(id)
)engine = InnoDB;

update usuario set hierarquia = 1 where id = 1;
insert into departamento (nome) values ('Licitação e Compras');
insert into atribuicao (id_usuario, id_departamento) values (1, 1);

select * from usuario;