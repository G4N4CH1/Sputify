/*create table artista(
id_art serial primary key,
nome_art varchar(100) not null,
genero_musica varchar(100) not null,
qtd_membros int not null,
pais_origem varchar(100) not null
);
create table usuario(
id_usu serial primary key,
nome_usu varchar(100) not null,
email varchar(100) not null,
senha varchar(500) not null,
tipo varchar(100) not null
);
create table musica(
id_mus serial primary key,
titulo varchar(100) not null,
duracao varchar(100) not null,
album varchar (100) null
);
create table musicafav(
id_mf serial primary key,
id_mus int not null,
id_usu int not null,
constraint fk_musica_musicafav foreign key(id_mus)references musica(id_mus),
constraint fk_usuario_musicafav foreign key(id_usu)references usuario(id_usu)
);
create table artistafav(
id_af serial primary key,
id_art int not null,
id_usu int not null,
constraint fk_artista_artistafav foreign key(id_art)references artista(id_art),
constraint fk_usuario_artistafav foreign key(id_usu)references usuario(id_usu)
);
create table artistamusica(
id_am serial primary key,
id_art int not null,
id_mus int not null,
constraint fk_artista_artistamusica foreign key(id_art)references artista(id_art),
constraint fk_musica_artistamusica foreign key(id_mus)references musica(id_mus)
);
*/