create database kovarex;

use kovarex;

create table usuario(
    id int not null auto_increment primary key,
    hierarquia int not null,
    cnpj varchar(18),
    nome varchar(255),
    email varchar(100),
    hash varchar(5000),
    alterar_psw boolean
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
    sigla varchar(10),
    constraint nome unique(nome)
) engine = InnoDB;

create table tipo_item(
    id int not null auto_increment primary key,
    nome varchar(50),
    constraint nome unique(nome)
) engine = InnoDB;

create table item(
    id int not null auto_increment primary key,
    nome varchar(50),
    descricao varchar(150),
    id_unidade int not null,
    id_tipo_item int not null,
    foreign key (id_unidade) references unidade(id),
    foreign key (id_tipo_item) references tipo_item(id)
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

create table departamento(
    id int not null auto_increment primary key,
    nome varchar(250),
    cor_destaque varchar(20)
) engine = InnoDB;

create table pedido(
    id int not null auto_increment primary key,
    data_criacao varchar(50),
    id_autor int not null,
    id_departamento int not null,
    status int,
    foreign key (id_autor) references usuario(id),
    foreign key (id_departamento) references departamento(id)
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

create table empenho(
    id int not null auto_increment primary key,
    num_empenho int not null,
    num_af int not null,
    status int not null,
    data_empenho varchar(50),
    data_entrega varchar(50),
    ultima_atualizacao varchar(50),
    id_departamento int not null,
    id_pedido int not null,
    codigo_compartilhamento varchar(30) not null,
    constraint cod_unique unique (codigo_compartilhamento),
    foreign key (id_departamento) references departamento(id),
    foreign key(id_pedido) references pedido(id)
) engine = InnoDB;

create table evento_empenho(
    id int not null auto_increment primary key,
    id_autor int not null,
    id_empenho int not null,
    descricao varchar(500),
    data_evento varchar(50),
    foreign key (id_autor) references usuario(id),
    foreign key (id_empenho) references empenho(id)
);

create table atribuicao(
    id int not null auto_increment primary key,
    id_usuario int not null,
    id_departamento int not null,
    foreign key (id_usuario) references usuario(id),
    foreign key (id_departamento) references departamento(id)
) engine = InnoDB;