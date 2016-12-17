insert into VideoGames values
(1, 'Pacman', 'Jeu interessant','Jeu tres interessant','Mr.Pacman',2013,'Pacman.jpg','Arcade',153,3);

insert into VideoGames values
(2, 'Zelda Ocarina Of Time', 'Zelda sur 64','Ce zelda, sorti pendant le passage des jeux vidéos à la 3D et celui qui l\'a le mieux réussi,mélangeant bon graphisme, gameplay et des musiques d\'anthologie' ,'Nintendo',1998,'OOT.jpg','Adventure',52,3);

insert into VideoGames values
(3, 'Zelda A Link To The Past', 'Zelda sur SNES','Ce zelda, fut une révolution en son temps, une des meilleures réussites de Nintendo' ,'Nintendo',1991,'ZeldaALTTP.jpg','Adventure',32,2);

insert into VideoGames values
(4, 'Mario 64', 'Mario sur Nintendo 64','Un excellent jeu de platforme, qui révéla le plombier à tout une génération','Nintendo',1996,'Mario64.jpg','Platform',25,5);

insert into VideoGames values
(5, 'Mario Galaxy', 'Mario sur Wii','Super Mario Galaxy est un jeu vidéo de plates-formes développé par Nintendo EAD Tokyo sous la direction de Yoshiaki Koizumi. Le jeu est édité sur Wii par Nintendo en novembre 2007, près d\'un an après la sortie de la console, dans les trois pôles du marché : le Japon, l\'Amérique du Nord et l\'Europe. Dans la série principale des Super Mario, c\'est le troisième jeu de plates-formes en trois dimensions après Super Mario 64 et Super Mario Sunshine, jeux vidéo dont Koizumi est déjà respectivement le réalisateur assistant et le réalisateur. C\'est également le premier épisode destiné à la Wii, qui connaît un second épisode sorti en 2010, Super Mario Galaxy 2' ,'Nintendo',1991,'MarioGalaxy.jpg','Platform',10,3);

insert into Users values
(1,'JohnDoe@hotmail.fr','L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==','Doe','John','3 rue pierrot',14785,'Besoul','YcM=A$nsYzkyeDVjEUa7W9K','ROLE_USER');

insert into Users values

(2, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'admin', 'admin', 'admin','00000', 'admin','EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

INSERT INTO categories VALUES ('Sport');
INSERT INTO categories VALUES ('Adventure');
INSERT INTO categories VALUES ('Arcade');
INSERT INTO categories VALUES ('Platform');

INSERT INTO Console Values (1,'Wii','Wii',100,'La Wii  est une console de jeux vidéo de salon du fabricant japonais Nintendo. Console de la septième génération, tout comme la Xbox 360 et la PlayStation 3 avec lesquelles elle est en rivalité, elle est la console de salon la plus vendue de sa génération et a comme particularité d\'utiliser un accéléromètre capable de détecter la position, l\'orientation et les mouvements dans l\'espace de la manette','Nintendo','wii.jpg');


INSERT INTO Console Values (2,'Nintendo 64', 'N64',50,'La Nintendo 64, également connue sous les noms de code Project Reality et Ultra 64 lors de sa phase de développement, est une console de jeux vidéo de salon, sortie en 1996 (1997 en Europe), du constructeur japonais Nintendo en collaboration avec Silicon Graphics. Elle fut la dernière des consoles de cinquième génération à être sortie, en concurrence avec la Saturn et la PlayStation.','Nintendo','N64.jpg');

INSERT INTO Console Values (3,'Super NES', 'SNES',50,'La Super Nintendo Entertainment System (couramment abrégée Super NES ou Super Nintendo3), ou Super Famicom au Japon, est une console de jeux vidéo 16 bits du constructeur japonais Nintendo commercialisée à partir de novembre 1990. En Amérique du Nord, la console est sortie avec un look résolument différent. À noter qu\'en Corée du Sud, la Super Nintendo est distribuée par Hyundai Electronics sous le nom de Super Comboy','Nintendo', 'snes.jpg');

INSERT INTO Console Values (4, 'Borne Arcade','Arcade', 0, 'Une borne d\'arcade est un meuble contenant un jeu vidéo payant dit « jeu vidéo d\'arcade ». On les trouve habituellement dans des lieux ouverts au public comme les bars, les centres commerciaux, certains établissements de divertissement (bowlings, patinoires, cinémas multiplexe, etc.) ainsi que les salles d\'arcade.', 'Unknown','borne.png');

INSERT INTO GameHasConsole Values(1,4);
INSERT INTO GameHasConsole Values(2,2);
INSERT INTO GameHasConsole Values(3,3);
INSERT INTO GameHasConsole Values(4,2);
INSERT INTO GameHasConsole Values(5,1);


INSERT INTO Comments values (1,1,3,null,'Je pense que ce jeu est bien');
INSERT INTO Comments values (2,1,2,4,'Ce jeu est génial, j\'ai passé des supers moment en y jouant');
INSERT INTO Comments values (3,2,3,2,'Ce jeu a des défauts');
