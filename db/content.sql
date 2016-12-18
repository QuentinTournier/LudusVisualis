insert into VideoGames values
(1, 'Pacman','Mr.Pacman',2013,'Pacman.jpg',153,3,2);
INSERT INTO VideoGames_has_translation values 
(1,'fr_FR','Jeu interessant','Jeu tres interessant'),
(1,'en_GB','One of the first arcade games','This game if one of the first game, which remains one of the references');


insert into VideoGames values
(2, 'Zelda Ocarina Of Time' ,'Nintendo',1998,'OOT.jpg',52,3,1);
INSERT INTO VideoGames_has_translation values 
(2,'fr_FR', 'Zelda sur 64', 'Ce zelda, sorti pendant le passage des jeux vidéos à la 3D et celui qui l\'a le mieux réussi,mélangeant bon graphisme, gameplay et des musiques d\'anthologie'),
(2,'en_GB','One of the best games of all time, which was a revolution in its time','The Legend of Zelda: Ocarina of Time is an action-adventure video game developed and published by Nintendo for the Nintendo 64. It was first released in Japan and North America in November 1998, and in Europe and Australia the following month');

insert into VideoGames values
(3, 'Zelda A Link To The Past' ,'Nintendo',1991,'ZeldaALTTP.jpg',32,2,1);
INSERT INTO VideoGames_has_translation values 
(3,'fr_FR', 'Zelda sur SNES', 'The Legend of Zelda: A Link to the Past, litt. « La légende de Zelda : La Triforce des dieux ») est un jeu vidéo d\'action-aventure édité par Nintendo et développé par Nintendo'),
(3,'en_GB','The legendary adventure game','The Legend of Zelda: A Link to the Past, known as The Legend of Zelda: Triforce of the Gods in Japan, is an action-adventure video game developed and published by Nintendo for the Super Nintendo Entertainment System video game console. It is the third installment in The Legend of Zelda series and was released in 1991 in Japan and 1992 in North America and Europe. ');

insert into VideoGames values
(4, 'Super Mario 64','Nintendo',1996,'Mario64.jpg',25,5,3);
INSERT INTO VideoGames_has_translation values 
(4,'fr_FR', 'Un excellent jeu de platforme, qui révéla le plombier à tout une génération','Super Mario 64 est un jeu de plates-formes développé par Nintendo Entertainment Analysis and Development sous la direction de Shigeru Miyamoto et publié par Nintendo pour la Nintendo 64. Il sort au Japon et aux États-Unis en 1996 puis en Europe et en Australie en 1997. '),
(4,'en_GB','A very good old video game, which revealed to the world the famous little red man','Super Mario 64 is a 1996 platform video game developed and published by Nintendo for the Nintendo 64. Along with Pilotwings 64, it was one of the launch titles for the console. It was released in Japan on June 23, 1996, and later in North America, Europe, and Australia. It is the best-selling game on the Nintendo 64, with more than eleven million copies sold');


insert into VideoGames values
(5, 'Mario Galaxy' ,'Nintendo',1991,'MarioGalaxy.jpg',10,3,3);
INSERT INTO VideoGames_has_translation values 
(5,'fr_FR', 'Mario sur Wii','Super Mario Galaxy est un jeu vidéo de plates-formes développé par Nintendo EAD Tokyo sous la direction de Yoshiaki Koizumi. Le jeu est édité sur Wii par Nintendo en novembre 2007, près d\'un an après la sortie de la console, dans les trois pôles du marché : le Japon, l\'Amérique du Nord et l\'Europe. Dans la série principale des Super Mario, c\'est le troisième jeu de plates-formes en trois dimensions après Super Mario 64 et Super Mario Sunshine, jeux vidéo dont Koizumi est déjà respectivement le réalisateur assistant et le réalisateur. C\'est également le premier épisode destiné à la Wii, qui connaît un second épisode sorti en 2010, Super Mario Galaxy 2'),
(5,'en_GB','One of the first arcade games','Super Mario Galaxy is a platform video game developed and published by Nintendo for the Wii worldwide in November 2007. It is the third 3D game in the Super Mario series and the eighth main instalment overall');


insert into Users values
(1,'JohnDoe@hotmail.fr','L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==','Doe','John','3 rue pierrot',14785,'Besoul','YcM=A$nsYzkyeDVjEUa7W9K','ROLE_USER');

insert into Users values

(2, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'admin', 'admin', 'admin','00000', 'admin','EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

INSERT INTO Categories_has_translation VALUES (1,'fr_FR', 'Aventure');
INSERT INTO Categories_has_translation VALUES (2,'fr_FR', 'Arcade');
INSERT INTO Categories_has_translation VALUES (3,'fr_FR', 'Platforme');
INSERT INTO Categories_has_translation VALUES (1,'en_GB', 'Adventure');
INSERT INTO Categories_has_translation VALUES (2,'en_GB', 'Arcade');
INSERT INTO Categories_has_translation VALUES (3,'en_GB', 'Platform');


INSERT INTO Console Values (1,100,'Nintendo','wii.jpg');
INSERT INTO Console_has_translation VALUES (1,'fr_FR', 'Wii','Wii','La Wii  est une console de jeux vidéo de salon du fabricant japonais Nintendo. Console de la septième génération, tout comme la Xbox 360 et la PlayStation 3 avec lesquelles elle est en rivalité, elle est la console de salon la plus vendue de sa génération et a comme particularité d\'utiliser un accéléromètre capable de détecter la position, l\'orientation et les mouvements dans l\'espace de la manette');
INSERT INTO Console_has_translation VALUES (1,'en_GB', 'Wii','Wii','The Wii is a home video game console released by Nintendo on November 19, 2006. As a seventh-generation console, the Wii competed with Microsoft\'s Xbox 360 and Sony\'s PlayStation 3. Nintendo states that its console targets a broader demographic than that of the two others.');


INSERT INTO Console Values (2,50,'Nintendo','N64.jpg');
INSERT INTO Console_has_translation VALUES(2,'fr_FR', 'Nintendo 64', 'N64','La Nintendo 64, également connue sous les noms de code Project Reality et Ultra 64 lors de sa phase de développement, est une console de jeux vidéo de salon, sortie en 1996 (1997 en Europe), du constructeur japonais Nintendo en collaboration avec Silicon Graphics. Elle fut la dernière des consoles de cinquième génération à être sortie, en concurrence avec la Saturn et la PlayStation.');
INSERT INTO Console_has_translation VALUES(2,'en_GB', 'Nintendo 64', 'N64','The Nintendo 64, stylized as NINTENDO64 and often referred to as N64, is Nintendo\'s third home video game console for the international market. Named for its 64-bit central processing unit, it was released in June 1996 in Japan, September 1996 in North America, March 1997 in Europe and Australia, September 1997 in France and December 1997 in Brazil ');

INSERT INTO Console Values (3,50,'Nintendo', 'snes.jpg');
INSERT INTO Console_has_translation VALUES (3,'fr_FR','Super Nes', 'SNES', 'La Super Nintendo Entertainment System (couramment abrégée Super NES ou Super Nintendo3), ou Super Famicom au Japon, est une console de jeux vidéo 16 bits du constructeur japonais Nintendo commercialisée à partir de novembre 1990. En Amérique du Nord, la console est sortie avec un look résolument différent. À noter qu\'en Corée du Sud, la Super Nintendo est distribuée par Hyundai Electronics sous le nom de Super Comboy');
INSERT INTO Console_has_translation VALUES (3,'en_GB','Super Nes', 'SNES', 'The Super Nintendo Entertainment System (officially abbreviated the Super NES or SNES, and commonly shortened to Super Nintendo) is a 16-bit home video game console developed by Nintendo');

INSERT INTO Console Values (4, 0, 'Unknown','borne.png');
INSERT INTO Console_has_translation Values (4,'fr_FR', 'Borne Arcade','Arcade','Une borne d\'arcade est un meuble contenant un jeu vidéo payant dit « jeu vidéo d\'arcade ». On les trouve habituellement dans des lieux ouverts au public comme les bars, les centres commerciaux, certains établissements de divertissement (bowlings, patinoires, cinémas multiplexe, etc.) ainsi que les salles d\'arcade.');
INSERT INTO Console_has_translation Values (4,'en_GB','Arcade Cabinet', 'Arcade', 'A video game arcade cabinet, also known as a video arcade machine or video coin-op, is the housing within which a video arcade game\'s hardware resides. Most cabinets designed since the mid-1980s conform to the JAMMA wiring standard. Some include additional connectors for features not included in the standard.');


INSERT INTO Game_has_console Values(1,4);
INSERT INTO Game_has_console Values(2,2);
INSERT INTO Game_has_console Values(3,3);
INSERT INTO Game_has_console Values(4,2);
INSERT INTO Game_has_console Values(5,1);


INSERT INTO Comments values (1,1,3,null,'Je pense que ce jeu est bien');
INSERT INTO Comments values (2,1,2,4,'Ce jeu est génial, j\'ai passé des supers moment en y jouant');
INSERT INTO Comments values (3,2,3,2,'Ce jeu a des défauts');
