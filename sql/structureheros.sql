drop table if exists histoireEnCours;
drop table if exists brancheabranche;
drop table if exists branche;
drop table if exists histoire;
drop table if exists user;


create table user(
    usr_id integer not null primary key auto_increment,
    usr_login varchar(50) not null,
    usr_password varchar(120) not null,
    usr_estAdmin boolean
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table histoire(
    histoire_id integer not null primary key auto_increment,
    histoire_titre varchar(50) not null,
    histoire_image varchar(150),
    histoire_resume varchar (500),
    histoire_branche_id integer,
    histoire_vie integer,
    histoire_nombre_essai integer DEFAULT 0,
    histoire_nombre_reussite integer DEFAULT 0
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table branche(
    branche_id integer not null primary key auto_increment,
    branche_titre varchar(20),
    branche_paragraphe varchar(500) DEFAULT "pararagraphe à rentrer",
    branche_image varchar(150) DEFAULT "defaultimage",
    branche_histoire_id integer,
    branche_vie integer DEFAULT 0,
    FOREIGN KEY (branche_histoire_id) references histoire(histoire_id) ON DELETE CASCADE
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table histoireEnCours (
    histoireEnCours_usr_id integer,
    histoireEnCours_branche_id integer,
    histoireEnCours_vie integer,
    histoireEnCours_filAriane varchar(500) DEFAULT "-1",
    FOREIGN KEY (histoireEnCours_usr_id) references user(usr_id) ON DELETE CASCADE,
    FOREIGN KEY (histoireEnCours_branche_id) references branche(branche_id)ON DELETE CASCADE
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table brancheabranche (
    brancheabranche_nombouton varchar(20) DEFAULT 'vers autre branche',
    brancheabranche_brancheactuelle_id integer,
    brancheabranche_branchesuivante_id integer,
    FOREIGN KEY (brancheabranche_brancheactuelle_id) references branche(branche_id) ON DELETE CASCADE,
    FOREIGN KEY (brancheabranche_branchesuivante_id) references branche(branche_id) ON DELETE CASCADE
) engine=innodb character set utf8 collate utf8_unicode_ci;