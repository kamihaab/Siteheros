DELETE FROM user;
ALTER TABLE user auto_increment=1;

DELETE FROM  branche  ;
ALTER TABLE branche auto_increment=1;

DELETE FROM histoire ;
ALTER TABLE histoire auto_increment=1;

DELETE FROM  histoireEnCours;
DELETE FROM brancheabranche;

insert into histoire(histoire_titre,histoire_image,histoire_resume,histoire_branche_id,histoire_vie) values
("OUIIIIIIIIII","escargot","WHEEEEEEEEEEEEEEEEEEEE, cet escargot refait votre journée",1,10),
("LEEEEE RATATAT","ratatouille","Vous incarnez un rat, WOWOWOWOOWOWOWOWOWO!!!!",2,10),
("UNEE patatae","patate","Epreuve : éplucher la patate",3,10),
("Fait Chaud","desert","LEEE SOLEIELLLLL CA BRULELLE LEL LE E ELLEL",4,10),
("L'eau ca mouille","mer","Epreuve: mouiller quelqu'un d'autre puis ne pas pleurer quand on nous renvoie de l'eau",5,10),
("ZEEENITSUU L'ECLAIR","Zenitsu","Rejoignez une hisoire palpitante dans laquelle vous incarnez Zenitsu.  Vous devez fuir tous démons se présentant à vous. Cependant attention à ne pas oublier de crier TANJIROROROROROROROROO à chaque instant si vous voulez gagner. De plus regarder Nezuko vous fait gagner la partie d’un coup !",6,10);

insert into branche(branche_titre,branche_paragraphe,branche_image,branche_histoire_id,branche_vie) values
("branche1","Vous vous baladez et soudainnnnn vous rencontre cet escargot, qui fait weweeeewewewewewewewewe","escargot",1,0),
("LEEEEE RATATAT","Il etait une fois un petit rat zdedzedzed","ratatouille",2,0),
("UNEE patatae","Il ne reste que vous,la patate et l'éplucheur de patate","patate",3,0),
("Fait Chaud","Vous êtes parti pour un run et vous vous êtes perdu dans vos pensées","desert",4,0),
("L'eau ca mouille","JE VEUX ALLLLER A LA PAGGE ALED, ARRETER DE DONNER DES PROJETS","mer",5,0),
("ZEEENITSUU L'ECLAIR","Vous rentrez chez vous et soudain vous voyez votre famiile morte par terre","Zenitsu",6,0);

insert into branche(branche_titre,branche_paragraphe,branche_image,branche_histoire_id,branche_vie) values
("branche2.a","Vous courrez","escargot",1,2),
("branche2.b","vous sautez","escargot",1,3),
("branche2.c","vous crier ayayyaayyaayayayayya!!!","escargot",1,2);

insert into brancheabranche(brancheabranche_nombouton,brancheabranche_brancheactuelle_id,brancheabranche_branchesuivante_id) values
("versbranche2.a",1,7),
("versbranche2.b",1,8),
("versbranche2.b",9,7);