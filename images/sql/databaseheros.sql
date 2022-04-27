create database if not exists heros character set utf8 collate utf8_unicode_ci;
use heros;

grant all privileges on heros.* to 'paulca'@'localhost' identified by 'capaul';