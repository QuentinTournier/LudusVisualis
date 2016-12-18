
drop table if exists Game_has_console;
drop table if exists VideoGames;
drop table if exists VideoGames_has_translation;
drop table if exists Users;
drop table if exists Categories;
drop table if exists Categories_has_translation;
drop table if exists Comments;
drop table if exists Basket;
drop table if exists Console;
drop table if exists Console_has_translation;

create table VideoGames (
    game_id integer not null primary key auto_increment,
    game_name varchar(100) not null,
    game_author varchar(150) not null,
    game_year integer not null,
    game_image varchar(100) not null,
    game_price integer not null,
    game_number integer not null,
    game_type integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table VideoGames_has_translation (
    game_id integer not null,
    `language` varchar(10) not null, 
    game_description_short varchar(500) not null,
    game_description_long varchar(2000) not null,
    primary key (`language`, game_id),
    constraint fk_trans_game foreign key(game_id) references VideoGames(game_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;


create table Users (
    user_id integer not null primary key auto_increment,
    user_email varchar(100) not null,
    user_password varchar(88) not null,
    user_lastName varchar(100) not null,
    user_firstName varchar(100) not null,
    user_address varchar(200) not null,
    user_zip integer not null,
    user_city varchar(100) not null,
    user_salt varchar(23) not null,
    user_role varchar(50) not null 
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Categories(
    id integer not null primary key auto_increment
)engine=innodb character set utf8 collate utf8_unicode_ci;

create table Categories_has_Translation(
    cat_id integer not null,
    cat_language varchar(10) not null,
    cat_name varchar(20),
    primary key(cat_id, cat_language),
    constraint categories_trans foreign key(cat_id) references Categories(id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Basket (
    basket_id integer not null primary key auto_increment,
    user_id integer not null,
    game_id integer not null,
    state varchar(20) not null,
    constraint fk_bas_usr foreign key(user_id) references Users(user_id),
    constraint fk_bas_game foreign key(game_id) references VideoGames(game_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Console (
    id integer not null primary key auto_increment,
    price integer not null,
    developer varchar(50),
    image varchar(50)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Console_has_translation (
    console_id integer not null,
    `language` varchar(10) not null,
    name varchar(50) not null,
    short_name varchar(6) not null,
    description varchar(2000),
    constraint fk_from_console foreign key(console_id) references Console(id),
    primary key(`language`, console_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Game_has_console(
    game_id integer not null,
    console_id integer not null,
    constraint fk_game foreign key(game_id) references VideoGames(game_id),
    constraint fk_console foreign key(console_id) references Console(id),
    primary key(game_id, console_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Comments(
    id integer not null primary key auto_increment,
    user_id integer not null,
    game_id integer not null,
    rating integer,
    comment_text varchar(300) not null,
    constraint fk_has_user foreign key(user_id) references Users(user_id),
    constraint fk_for_game foreign key(game_id) references VideoGames(game_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;
