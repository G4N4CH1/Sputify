/*
CREATE TABLE Artista (
    id_art INT AUTO_INCREMENT PRIMARY KEY,
    nome_art VARCHAR(100) NOT NULL,
    genero_musica VARCHAR(100) NOT NULL,
    qtd_membros INT NOT NULL,
    pais_origem VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE Usuario (
    id_usu INT AUTO_INCREMENT PRIMARY KEY,
    nome_usu VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(500) NOT NULL,
    tipo VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE Musica (
    id_mus INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    duracao VARCHAR(100) NOT NULL,
    album VARCHAR(100)
) ENGINE=InnoDB;

CREATE TABLE MusicaFav (
    id_mf INT AUTO_INCREMENT PRIMARY KEY,
    id_mus INT NOT NULL,
    id_usu INT NOT NULL,
    FOREIGN KEY (id_mus) REFERENCES Musica(id_mus)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ArtistaFav (
    id_af INT AUTO_INCREMENT PRIMARY KEY,
    id_art INT NOT NULL,
    id_usu INT NOT NULL,
    FOREIGN KEY (id_art) REFERENCES Artista(id_art)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_usu) REFERENCES Usuario(id_usu)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ArtistaMusica (
    id_am INT AUTO_INCREMENT PRIMARY KEY,
    id_art INT NOT NULL,
    id_mus INT NOT NULL,
    FOREIGN KEY (id_art) REFERENCES Artista(id_art)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_mus) REFERENCES Musica(id_mus)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;
*/