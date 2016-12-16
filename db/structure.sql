drop table if exists VideoGames;
drop table if exists Users;
drop table if exists Categories;

create table VideoGames (
    game_id integer not null primary key auto_increment,
    game_name varchar(100) not null,
    game_description_short varchar(500) not null,
    game_description_long varchar(2000) not null,
    game_author varchar(150) not null,
    game_year integer not null,
    game_image varchar(100) not null,
    game_type varchar(100) not null,
    game_price integer not null,
    game_number integer not null
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
    category_name varchar(100) not null primary key
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table Basket (
    basket_id integer not null primary key auto_increment,
    user_id integer not null,
    game_id integer not null,
    bas_quantity integer not null,
    constraint fk_bas_usr foreign key(user_id) references Users(user_id),
    constraint fk_bas_game foreign key(game_id) references VideoGames(game_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;