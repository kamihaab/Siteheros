DELETE FROM user;
ALTER TABLE user auto_increment=1;

DELETE FROM  branche  ;
ALTER TABLE branche auto_increment=1;

DELETE FROM histoire ;
ALTER TABLE histoire auto_increment=1;

DELETE FROM  histoireEnCours;
DELETE FROM brancheabranche;

insert into histoire(histoire_titre,histoire_image,histoire_resume) values
("OUIIIIIIIIII","../images/escargot.jpg","WHEEEEEEEEEEEEEEEEEEEE, cet escargot refait votre journée"),
("LEEEEE RATATAT","../images/ratatouille.jpg","Vous incarnez un rat, WOWOWOWOOWOWOWOWOWO!!!!"),
("UNEE patatae","../images/patate.jpg","Epreuve : éplucher la patate");