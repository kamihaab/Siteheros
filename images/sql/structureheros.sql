drop table if exists user;
drop table if exists branche;
drop table if exists histoire;
drop table if exists histoireEnCours;
drop table if exists brancheabranche;

create table user(
    usr_id integer not null primary key auto_increment,
    usr_login varchar(50) not null,
    usr_password varchar(88) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table branche(
    branche_id integer not null primary key auto_increment,
    branche_titre varchar(20),
    branche_paragraphe varchar(500),
    branche_image varchar(150)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table histoire(
    histoire_id integer not null primary key auto_increment,
    histoire_titre varchar(50) not null,
    histoire_image varchar(150),
    histoire_resume varchar (500)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table histoireEnCours (
    histoireEnCours_usr_id integer,
    histoireEnCours_branche_id integer,
    FOREIGN KEY (histoireEnCours_usr_id) references user(usr_id),
    FOREIGN KEY (histoireEnCours_branche_id) references branche(branche_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table brancheabranche (
    brancheabranche_brancheprecedente_id integer,
    brancheabranche_branchesuivante_id integer,
    FOREIGN KEY (brancheabranche_brancheprecedente_id) references branche(branche_id),
    FOREIGN KEY (brancheabranche_branchesuivante_id) references branche(branche_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;