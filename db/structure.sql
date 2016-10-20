drop table if exists t_album;
drop table if exists t_artist;
drop table if exists t_playlist;
drop table if exists t_user;

create table t_user (
    user_id integer not null primary key auto_increment,
    user_name varchar(50) not null,
    user_password varchar(88) not null,
    user_salt varchar(23) not null,
    user_role varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_artist (
    artist_id integer not null primary key auto_increment,
    artist_name varchar(500) not null,
    mini_image_url varchar(200) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_album (
    media_id integer not null primary key auto_increment,
    artist_id integer not null,
    media_name varchar(500) not null,
    deezer_id varchar(200) not null,
    mini_image_url varchar(200) not null,
    user_id integer not null,
    constraint fk_album_usr foreign key(user_id) references t_user(user_id),
    constraint fk_album_artist foreign key(artist_id) references t_artist(artist_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_playlist (
    media_id integer not null primary key auto_increment,
    media_name varchar(500) not null,
    deezer_id varchar(200) not null,
    mini_image_url varchar(200) not null,
    user_id integer not null,
    constraint fk_playlist_usr foreign key(user_id) references t_user(user_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;
