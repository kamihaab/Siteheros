DELETE FROM user;
ALTER TABLE user auto_increment=1;

DELETE FROM  branche  ;
ALTER TABLE branche auto_increment=1;

DELETE FROM histoire ;
ALTER TABLE histoire auto_increment=1;

DELETE FROM  histoireEnCours;
DELETE FROM brancheabranche;

insert into histoire(histoire_titre,histoire_image,histoire_resume) values
("OUIIIIIIIIII","escargot","WHEEEEEEEEEEEEEEEEEEEE, cet escargot refait votre journée"),
("LEEEEE RATATAT","ratatouille","Vous incarnez un rat, WOWOWOWOOWOWOWOWOWO!!!!"),
("UNEE patatae","patate","Epreuve : éplucher la patate"),
("Fait Chaud","desert","LEEE SOLEIELLLLL CA BRULELLE LEL LE E ELLEL"),
("L'eau ca mouille","mer","Epreuve: mouiller quelqu'un d'autre puis ne pas pleurer quand on nous renvoie de l'eau"),
("ZEEENITSUU L'ECLAIR","Zenitsu","Rejoignez une hisoire palpitante dans laquelle vous incarnez Zenitsu.  Vous devez fuir tous démons se présentant à vous. Cependant attention à ne pas oublier de crier TANJIROROROROROROROROO à chaque instant si vous voulez gagner. De plus regarder Nezuko vous fait gagner la partie d’un coup !");