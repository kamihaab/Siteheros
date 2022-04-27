DELETE FROM user;
ALTER TABLE user auto_increment=1;

DELETE FROM  branche  ;
ALTER TABLE branche auto_increment=1;

DELETE FROM histoire ;
ALTER TABLE histoire auto_increment=1;

DELETE FROM  histoireEnCours;
DELETE FROM brancheabranche;

insert into histoire(histoire_titre,histoire_image,histoire_resume,histoire_branche_id) values
("OUIIIIIIIIII","escargot","WHEEEEEEEEEEEEEEEEEEEE, cet escargot refait votre journée",1),
("LEEEEE RATATAT","ratatouille","Vous incarnez un rat, WOWOWOWOOWOWOWOWOWO!!!!",2),
("UNEE patatae","patate","Epreuve : éplucher la patate",3),
("Fait Chaud","desert","LEEE SOLEIELLLLL CA BRULELLE LEL LE E ELLEL",4),
("L'eau ca mouille","mer","Epreuve: mouiller quelqu'un d'autre puis ne pas pleurer quand on nous renvoie de l'eau",5),
("ZEEENITSUU L'ECLAIR","Zenitsu","Rejoignez une hisoire palpitante dans laquelle vous incarnez Zenitsu.  Vous devez fuir tous démons se présentant à vous. Cependant attention à ne pas oublier de crier TANJIROROROROROROROROO à chaque instant si vous voulez gagner. De plus regarder Nezuko vous fait gagner la partie d’un coup !",6);

insert into branche(branche_titre,branche_paragraphe,branche_image,branche_histoire_id) values
("branche1","escargot","l'escargot de la mortttttt",1),
("LEEEEE RATATAT","ratatouille","Vous incarnez un rat, WOWOWOWOOWOWOWOWOWO!!!!",2),
("UNEE patatae","patate","Epreuve : éplucher la patate",3),
("Fait Chaud","desert","LEEE SOLEIELLLLL CA BRULELLE LEL LE E ELLEL",4),
("L'eau ca mouille","mer","Epreuve: mouiller quelqu'un d'autre puis ne pas pleurer quand on nous renvoie de l'eau",5),
("ZEEENITSUU L'ECLAIR","Zenitsu","Rejoignez une hisoire palpitante dans laquelle vous incarnez Zenitsu.  Vous devez fuir tous démons se présentant à vous. Cependant attention à ne pas oublier de crier TANJIROROROROROROROROO à chaque instant si vous voulez gagner. De plus regarder Nezuko vous fait gagner la partie d’un coup !",6);