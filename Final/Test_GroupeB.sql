/*
Fichier : Creation_GroupB.sql
Auteurs:
	Benjamin Baska  21503576
	Kevin Lastra    21706783
Nom du groupe : B
*/


--------Test Procedure----------
CALL event_par_org(1);
CALL stats_event(1);
--------Test Triggers-----------
INSERT INTO organisateur VALUES(20, 'org_trigger_test', 'pass', NULL);
SELECT * FROM organisateur WHERE id_o = 20;

--------trigger :  update_organisateur_last_date
INSERT INTO evenement VALUES(30, 'event_trigger_test', '2021-12-12', 'jeu_test', 'description_test', 1, 20);
SELECT * FROM evenement WHERE id_e = 30;
SELECT * FROM organisateur WHERE id_o = 20;

--------trigger :  delete_organisateur
DELETE FROM organisateur WHERE id_o = 20;
SELECT * FROM organisateur WHERE id_o = 20;
SELECT * FROM evenement WHERE id_e = 30;
