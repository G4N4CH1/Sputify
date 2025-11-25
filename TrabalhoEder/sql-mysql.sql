/*
TRABALHO EDER - ANITA, GANACHI E RAIRA

CREATE TABLE artista (
    id_art SERIAL PRIMARY KEY,
    nome_art VARCHAR(200) NOT NULL,
    genero_musica VARCHAR(150),
    qtd_membros INT,
    pais_origem VARCHAR(120)
);
*/


/*
CREATE TABLE midias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(250) NOT NULL,
  ano INT NOT NULL,
  genero VARCHAR(150) NOT NULL,
  poster TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO midias (titulo, ano, genero, poster) VALUES
('Um Sonho de Liberdade', 1994, 'Drama', 'https://example.com/posters/um-sonho-de-liberdade.jpg'),
('O Poderoso Chefão', 1972, 'Crime', 'https://example.com/posters/o-poderoso-chefao.jpg'),
('O Cavaleiro das Trevas', 2008, 'Ação', 'https://example.com/posters/o-cavaleiro-das-trevas.jpg'),
('Pulp Fiction: Tempo de Violência', 1994, 'Crime', 'https://example.com/posters/pulp-fiction.jpg'),
('Forrest Gump: O Contador de Histórias', 1994, 'Drama', 'https://example.com/posters/forrest-gump.jpg'),
('A Origem', 2010, 'Ficção Científica', 'https://example.com/posters/a-origem.jpg'),
('Clube da Luta', 1999, 'Drama', 'https://example.com/posters/clube-da-luta.jpg'),
('Matrix', 1999, 'Ficção Científica', 'https://example.com/posters/matrix.jpg'),
('Os Bons Companheiros', 1990, 'Crime', 'https://example.com/posters/os-bons-companheiros.jpg'),
('Seven: Os Sete Crimes Capitais', 1995, 'Suspense', 'https://example.com/posters/seven.jpg'),
('O Silêncio dos Inocentes', 1991, 'Suspense', 'https://example.com/posters/o-silencio-dos-inocentes.jpg'),
('O Resgate do Soldado Ryan', 1998, 'Guerra', 'https://example.com/posters/soldado-ryan.jpg'),
('Interestelar', 2014, 'Ficção Científica', 'https://example.com/posters/interestelar.jpg'),
('Parasita', 2019, 'Suspense', 'https://example.com/posters/parasita.jpg'),
('Gladiador', 2000, 'Ação', 'https://example.com/posters/gladiador.jpg'),
('Titanic', 1997, 'Romance', 'https://example.com/posters/titanic.jpg'),
('Os Vingadores', 2012, 'Ação', 'https://example.com/posters/os-vingadores.jpg'),
('Avatar', 2009, 'Ficção Científica', 'https://example.com/posters/avatar.jpg'),
('O Senhor dos Anéis: A Sociedade do Anel', 2001, 'Fantasia', 'https://example.com/posters/sociedade-do-anel.jpg'),
('O Senhor dos Anéis: As Duas Torres', 2002, 'Fantasia', 'https://example.com/posters/duas-torres.jpg'),
('O Senhor dos Anéis: O Retorno do Rei', 2003, 'Fantasia', 'https://example.com/posters/retorno-do-rei.jpg'),
('Star Wars: Uma Nova Esperança', 1977, 'Ficção Científica', 'https://example.com/posters/starwars4.jpg'),
('Star Wars: O Império Contra-Ataca', 1980, 'Ficção Científica', 'https://example.com/posters/starwars5.jpg'),
('Star Wars: O Retorno de Jedi', 1983, 'Ficção Científica', 'https://example.com/posters/starwars6.jpg'),
('O Rei Leão', 1994, 'Animação', 'https://example.com/posters/o-rei-leao.jpg'),
('Toy Story', 1995, 'Animação', 'https://example.com/posters/toy-story.jpg'),
('Procurando Nemo', 2003, 'Animação', 'https://example.com/posters/procurando-nemo.jpg'),
('Up: Altas Aventuras', 2009, 'Animação', 'https://example.com/posters/up.jpg'),
('Viva: A Vida é uma Festa', 2017, 'Animação', 'https://example.com/posters/viva.jpg'),
('Coringa', 2019, 'Drama', 'https://example.com/posters/coringa.jpg'),
('A Rede Social', 2010, 'Drama', 'https://example.com/posters/a-rede-social.jpg'),
('O Lobo de Wall Street', 2013, 'Comédia', 'https://example.com/posters/o-lobo-de-wall-street.jpg'),
('Django Livre', 2012, 'Faroeste', 'https://example.com/posters/django-livre.jpg'),
('Bastardos Inglórios', 2009, 'Guerra', 'https://example.com/posters/bastardos-inglorios.jpg'),
('Whiplash: Em Busca da Perfeição', 2014, 'Drama', 'https://example.com/posters/whiplash.jpg'),
('La La Land: Cantando Estações', 2016, 'Musical', 'https://example.com/posters/la-la-land.jpg'),
('Mad Max: Estrada da Fúria', 2015, 'Ação', 'https://example.com/posters/mad-max.jpg'),
('Pantera Negra', 2018, 'Ação', 'https://example.com/posters/pantera-negra.jpg'),
('Vingadores: Ultimato', 2019, 'Ação', 'https://example.com/posters/vingadores-ultimato.jpg'),
('Doutor Estranho', 2016, 'Ação', 'https://example.com/posters/doutor-estranho.jpg'),
('Guardiões da Galáxia', 2014, 'Ação', 'https://example.com/posters/guardioes-da-galaxia.jpg'),
('Homem-Aranha: Sem Volta para Casa', 2021, 'Ação', 'https://example.com/posters/homem-aranha.jpg'),
('The Batman', 2022, 'Ação', 'https://example.com/posters/the-batman.jpg'),
('Oppenheimer', 2023, 'Drama', 'https://example.com/posters/oppenheimer.jpg'),
('Barbie', 2023, 'Comédia', 'https://example.com/posters/barbie.jpg'),
('A Lista de Schindler', 1993, 'Drama', 'https://example.com/posters/lista-de-schindler.jpg'),
('O Pianista', 2002, 'Drama', 'https://example.com/posters/o-pianista.jpg'),
('Cisne Negro', 2010, 'Drama', 'https://example.com/posters/cisne-negro.jpg'),
('O Grande Gatsby', 2013, 'Romance', 'https://example.com/posters/o-grande-gatsby.jpg'),
('O Código Da Vinci', 2006, 'Suspense', 'https://example.com/posters/o-codigo-da-vinci.jpg'),
('Ilha do Medo', 2010, 'Suspense', 'https://example.com/posters/ilha-do-medo.jpg');


CREATE TABLE funcionario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(350) NOT NULL,
  email VARCHAR(350) NOT NULL,
  senha VARCHAR(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE series (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(250) NOT NULL,
  ano INT NOT NULL,
  genero VARCHAR(150) NOT NULL,
  poster TEXT,
  temporadas INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO series (titulo, ano, genero, temporadas, poster) VALUES
('Breaking Bad', 2008, 'Drama', 5, 'https://image.tmdb.org/t/p/w500/ggFHVNu6YYI5L9pCfOacjizRGt.jpg'),
('Game of Thrones', 2011, 'Fantasia', 8, 'https://image.tmdb.org/t/p/w500/u3bZgnGQ9T01sWNhyveQz0wH0Hl.jpg'),
('Stranger Things', 2016, 'Ficção Científica', 5, 'https://image.tmdb.org/t/p/w500/49WJfeN0moxb9IPfGn8AIqMGskD.jpg'),
('The Witcher', 2019, 'Fantasia', 3, 'https://image.tmdb.org/t/p/w500/7vjaCdMw15FEbXyLQTVa04URsPm.jpg'),
('The Last of Us', 2023, 'Drama', 1, 'https://image.tmdb.org/t/p/w500/uKvVjHNqB5VmOrdxqAt2F7J78ED.jpg'),
('Peaky Blinders', 2013, 'Crime', 6, 'https://image.tmdb.org/t/p/w500/jeWoeUQyHdxGFbLz4nZ2RyrxwLs.jpg'),
('The Mandalorian', 2019, 'Ficção Científica', 3, 'https://image.tmdb.org/t/p/w500/eU1i6eHXlzMOlEq0ku1Rzq7Y4wA.jpg'),
('The Boys', 2019, 'Ação', 4, 'https://image.tmdb.org/t/p/w500/7Ns6tO3aYjppI5ehKYaX9hMlOa9.jpg'),
('Loki', 2021, 'Ação', 2, 'https://image.tmdb.org/t/p/w500/voHUmluYmKyleFkTu3lOXQG702u.jpg'),
('WandaVision', 2021, 'Ficção Científica', 1, 'https://image.tmdb.org/t/p/w500/frobUz2X5Pc8OiVZU8Oo5K3NKMM.jpg'),
('House of the Dragon', 2022, 'Fantasia', 2, 'https://image.tmdb.org/t/p/w500/1X4h40fcB4WWUmIBK0auT4zRBAV.jpg'),
('Better Call Saul', 2015, 'Drama', 6, 'https://image.tmdb.org/t/p/w500/l47o4F6Z2tU7aJYzjJ5cVJQxGzk.jpg'),
('The Office', 2005, 'Comédia', 9, 'https://image.tmdb.org/t/p/w500/qWnJzyZhyy74gjpSjIXWmuk0ifX.jpg'),
('Friends', 1994, 'Comédia', 10, 'https://image.tmdb.org/t/p/w500/f496cm9enuEsZkSPzCwnTESEK5s.jpg'),
('How I Met Your Mother', 2005, 'Comédia', 9, 'https://image.tmdb.org/t/p/w500/yTZQkSsxUFJZJe67IenRM0AEklc.jpg'),
('The Big Bang Theory', 2007, 'Comédia', 12, 'https://image.tmdb.org/t/p/w500/ooBGRQBdbGzBxAVfExiO8r7kloA.jpg'),
('Sherlock', 2010, 'Mistério', 4, 'https://image.tmdb.org/t/p/w500/f9zGxLHGyQB10cMDZNY5ZcGKhZi.jpg'),
('Dark', 2017, 'Ficção Científica', 3, 'https://image.tmdb.org/t/p/w500/7bcpYf6c9mO9G3ZLPGN4b3tP0tF.jpg'),
('The Crown', 2016, 'Drama', 6, 'https://image.tmdb.org/t/p/w500/pXQwJ0q8UOEW3Vq0D2mO3Y2dGgd.jpg'),
('Narcos', 2015, 'Crime', 3, 'https://image.tmdb.org/t/p/w500/rTmal9fDbwh4JdU9R91xIXz5Z8z.jpg'),
('Vikings', 2013, 'Ação', 6, 'https://image.tmdb.org/t/p/w500/bQLrHIRNEkE3PdIWQrZHynQZazu.jpg'),
('Lúcifer', 2016, 'Fantasia', 6, 'https://image.tmdb.org/t/p/w500/ekZobS8isE6mA53RAiGDG93hBxL.jpg'),
('Supernatural', 2005, 'Terror', 15, 'https://image.tmdb.org/t/p/w500/KoYWXbnYuS3b0GyQPkbuexlVK9.jpg'),
('Lost', 2004, 'Aventura', 6, 'https://image.tmdb.org/t/p/w500/og6S0aTZU6YUJAbqxeKjCa3kY1E.jpg'),
('Prison Break', 2005, 'Ação', 5, 'https://image.tmdb.org/t/p/w500/5tSHzkJ1HBnyGdcpr6wSyw7jYnJ.jpg'),
('Dexter', 2006, 'Crime', 8, 'https://image.tmdb.org/t/p/w500/58H6Ctze1nnpS0s9vPmAAzPcipR.jpg'),
('The Walking Dead', 2010, 'Terror', 11, 'https://image.tmdb.org/t/p/w500/xf9wuDcqlUPWABZNeDKPbZUjWx0.jpg'),
('Casa de Papel', 2017, 'Ação', 5, 'https://image.tmdb.org/t/p/w500/reEMJA1uzscCbkpeRJeTT2bjqUp.jpg'),
('The Umbrella Academy', 2019, 'Ação', 4, 'https://image.tmdb.org/t/p/w500/scZlQQYnDVlnpxFTxaIv2g0BWnL.jpg'),
('Arcane', 2021, 'Animação', 1, 'https://image.tmdb.org/t/p/w500/qcgYvwKqK5LrCzB95bcP8iB1a4A.jpg');

*/