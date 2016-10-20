create database if not exists miniplayer character set utf8 collate utf8_unicode_ci;
use miniplayer;

grant all privileges on miniplayer.* to 'miniplayer_user'@'localhost' identified by 'secret';
