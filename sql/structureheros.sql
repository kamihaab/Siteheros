drop table if exists histoireEnCours;
drop table if exists brancheabranche;
drop table if exists branche;
drop table if exists histoire;
drop table if exists user;


create table user(
    usr_id integer not null primary key auto_increment,
    usr_login varchar(50) not null,
    usr_password varchar(88) not null,
    usr_estAdmin boolean
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table histoire(
    histoire_id integer not null primary key auto_increment,
    histoire_titre varchar(50) not null,
    histoire_image varchar(150),
    histoire_resume varchar (500),
    histoire_branche_id integer

) engine=innodb character set utf8 collate utf8_unicode_ci;

create table branche(
    branche_id integer not null primary key auto_increment,
    branche_titre varchar(20),
    branche_paragraphe varchar(500),
    branche_image varchar(150),
    branche_histoire_id integer,
    FOREIGN KEY (branche_histoire_id) references histoire(histoire_id) ON DELETE CASCADE
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table histoireEnCours (
    histoireEnCours_usr_id integer,
    histoireEnCours_branche_id integer,
    FOREIGN KEY (histoireEnCours_usr_id) references user(usr_id) ON DELETE CASCADE,
    FOREIGN KEY (histoireEnCours_branche_id) references branche(branche_id)ON DELETE CASCADE
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table brancheabranche (
    brancheabranche_nombouton varchar(20),
    brancheabranche_brancheactuelle_id integer,
    brancheabranche_branchesuivante_id integer,
    FOREIGN KEY (brancheabranche_brancheactuelle_id) references branche(branche_id) ON DELETE CASCADE,
    FOREIGN KEY (brancheabranche_branchesuivante_id) references branche(branche_id) ON DELETE CASCADE
) engine=innodb character set utf8 collate utf8_unicode_ci;