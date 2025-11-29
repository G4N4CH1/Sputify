/*
CREATE TABLE midias
(
    id              SERIAL PRIMARY KEY,
    titulo          VARCHAR(250) NOT NULL,
    ano             INT NOT NULL,
    genero          VARCHAR(150) NOT NULL,
    poster          TEXT,
    id_streaming    INT,
    
    CONSTRAINT fk_midia_streaming
        FOREIGN KEY (id_streaming)
        REFERENCES streamings(id)
);
CREATE TABLE streamings
(
    id              SERIAL                    NOT NULL,
    nome            VARCHAR(150)              NOT NULL UNIQUE,
    site_oficial    VARCHAR(250)              NULL,
    CONSTRAINT streamings_pkey PRIMARY KEY (id)
);
INSERT INTO streamings (nome, site_oficial)
VALUES 
('Netflix', 'https://www.netflix.com'),
('Disney+', 'https://www.disneyplus.com'),
('Amazon Prime Video', 'https://www.primevideo.com'),
('Max', 'https://www.max.com'),
('Paramount+', 'https://www.paramountplus.com'),
('Apple TV+', 'https://www.apple.com/apple-tv-plus/'),
('GloboPlay', 'https://globoplay.globo.com'),
('Star+', 'https://www.starplus.com');
CREATE TABLE series 
( id SERIAL PRIMARY KEY, 
    titulo VARCHAR(250) NOT NULL, 
    ano INT NOT NULL,
    genero VARCHAR(150) NOT NULL,
    poster TEXT,
    temporadas int,
    id_streaming    INT,
     CONSTRAINT fk_series_streaming
        FOREIGN KEY (id_streaming)
        REFERENCES streamings(id)
      
);
CREATE TABLE funcionario
(
    id       serial             NOT NULL,    
    nome     VARCHAR(350)    NOT NULL,
    email    VARCHAR(350)    NOT NULL unique,    
    senha    VARCHAR(250)    NOT NULL,
    PRIMARY KEY (id)
);
INSERT INTO midias (titulo, ano, genero, poster, id_streaming) VALUES
('O Resgate Final', 2021, 'Ação', NULL, 1),
('A Casa das Sombras', 2019, 'Terror', NULL, 2),
('Horizonte Perdido', 2020, 'Aventura', NULL, 3),
('Mar Aberto', 2018, 'Suspense', NULL, 4),
('Sombras de Outono', 2022, 'Drama', NULL, 5),
('Circuito Fatal', 2023, 'Ação', NULL, 6),
('O Jardim Esquecido', 2017, 'Romance', NULL, 7),
('Fronteira do Tempo', 2024, 'Ficção Científica', NULL, 8),
('Ruas de Concreto', 2016, 'Crime', NULL, 1),
('A Filha do Sol', 2015, 'Drama', NULL, 2),
('Além da Névoa', 2020, 'Fantasia', NULL, 3),
('O Último Guerreiro', 2022, 'Aventura', NULL, 4),
('Códigos Secretos', 2019, 'Espionagem', NULL, 5),
('O Eco do Passado', 2018, 'Drama', NULL, 6),
('Doce Liberdade', 2021, 'Romance', NULL, 7),
('O Vale das Almas', 2017, 'Terror', NULL, 8),
('A Sombra do Caçador', 2023, 'Ação', NULL, 1),
('Estrelas de Inverno', 2022, 'Drama', NULL, 2),
('Contagem Regressiva', 2021, 'Suspense', NULL, 3),
('A Ilha Perdida', 2019, 'Aventura', NULL, 4),
('Ritmo Urbano', 2024, 'Musical', NULL, 5),
('O Legado do Dragão', 2020, 'Fantasia', NULL, 6),
('Corações em Chamas', 2018, 'Romance', NULL, 7),
('O Abismo Azul', 2023, 'Suspense', NULL, 8),
('Guardiões da Luz', 2017, 'Fantasia', NULL, 1),
('O Último Ato', 2021, 'Drama', NULL, 2),
('Tempestade de Areia', 2018, 'Ação', NULL, 3),
(' Noite Eterna', 2019, 'Terror', NULL, 4),
('A Fortaleza', 2020, 'Ação', NULL, 5),
('A Ponte dos Sonhos', 2022, 'Romance', NULL, 6),
('Gelo Mortal', 2023, 'Suspense', NULL, 7),
('A História de Nós Dois', 2016, 'Drama', NULL, 8),
('Império de Ferro', 2024, 'Ação', NULL, 1),
('Doce Novembro Azul', 2018, 'Romance', NULL, 2),
('O Segredo da Lua', 2021, 'Fantasia', NULL, 3),
('Cidade Fantasma', 2019, 'Terror', NULL, 4),
('Limite Final', 2022, 'Ação', NULL, 5),
('Além do Horizonte', 2017, 'Aventura', NULL, 6),
('O Voo 709', 2020, 'Suspense', NULL, 7),
('Minha Vida em Cenas', 2023, 'Drama', NULL, 8),
('Rastro de Fogo', 2019, 'Ação', NULL, 1),
('Brilho do Amanhecer', 2018, 'Romance', NULL, 2),
('A Cidade Submersa', 2024, 'Ficção Científica', NULL, 3),
('O Guardião das Chamas', 2021, 'Fantasia', NULL, 4),
('Código Vermelho', 2022, 'Crime', NULL, 5),
('O Último Enigma', 2023, 'Suspense', NULL, 6),
('As Cores da Primavera', 2019, 'Drama', NULL, 7),
('Caçadores da Verdade', 2018, 'Ação', NULL, 8),
('A Bússola do Norte', 2021, 'Aventura', NULL, 1),
('Rosas de Vidro', 2020, 'Romance', NULL, 2),
('O Labirinto', 2022, 'Suspense', NULL, 3),
('Fragmentos do Amanhã', 2024, 'Drama', NULL, 4),
('Vingança Sombria', 2023, 'Ação', NULL, 5),
('O Portal Esquecido', 2016, 'Fantasia', NULL, 6),
('Meu Coração em Paris', 2021, 'Romance', NULL, 7),
('Prisioneiros do Medo', 2019, 'Terror', NULL, 8),
('A Revolta dos Titãs', 2022, 'Ação', NULL, 1),
('O Mistério da Estação 12', 2023, 'Suspense', NULL, 2),
('Herança de Família', 2020, 'Drama', NULL, 3),
('A Jornada da Coragem', 2018, 'Aventura', NULL, 4),
('Olhos do Infinito', 2024, 'Ficção Científica', NULL, 5),
('Cartas de um Amor Perdido', 2017, 'Romance', NULL, 6),
('A Canção da Floresta', 2022, 'Fantasia', NULL, 7),
('Terra de Ninguém', 2019, 'Ação', NULL, 8),
('O Último Trem', 2021, 'Suspense', NULL, 1),
('Almas Gêmeas', 2020, 'Romance', NULL, 2),
('Caminhos de Aço', 2023, 'Ação', NULL, 3),
('O Fim da Estrada', 2024, 'Drama', NULL, 4),
('A Profecia Perdida', 2021, 'Fantasia', NULL, 5),
('Luz na Escuridão', 2018, 'Drama', NULL, 6),
('Casamento em Veneza', 2022, 'Romance', NULL, 7),
('Sussurros da Cripta', 2023, 'Terror', NULL, 8);
INSERT INTO midias (titulo, ano, genero, poster, id_streaming) VALUES
('O Caminho da Justiça', 2021, 'Drama', NULL, NULL),
('Tempestade de Verão', 2019, 'Romance', NULL, NULL),
('Chamas da Verdade', 2020, 'Ação', NULL, NULL),
('Horizonte de Cristal', 2018, 'Fantasia', NULL, NULL),
('O Último Suspiro', 2022, 'Suspense', NULL, NULL),
('Maré Vermelha', 2017, 'Aventura', NULL, NULL),
('Noites de Ouro', 2023, 'Crime', NULL, NULL),
('O Relógio Quebrado', 2020, 'Mistério', NULL, NULL),
('Alvorada Sombria', 2016, 'Terror', NULL, NULL),
('Caminho das Estrelas', 2024, 'Ficção Científica', NULL, NULL);


insert into funcionario values
(1,'ADM','adm@gmail.com','$2y$10$/i2v2b.VUSg8h/9jpI.gF.0X.OnIxXOREZ5tB3Udex4Brjb2xSxR2');
SELECT m.id, titulo, ano, genero, poster, s.nome as streaming FROm midias m
 left join streamings s on s.id = m.id_streaming
*/