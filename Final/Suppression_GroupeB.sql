/*
Fichier : Creation_GroupB.sql
Auteurs:
	Benjamin Baska  21503576
	Kevin Lastra    21706783
Nom du groupe : B
*/

DROP TRIGGER IF EXISTS update_organisateur_last_date;
DROP TRIGGER IF EXISTS delete_organisateur;

DROP procedure IF EXISTS event_par_org;
DROP procedure IF EXISTS stats_event;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `equipe`;
DROP TABLE IF EXISTS `joueur`;
DROP TABLE IF EXISTS `participation`;
DROP TABLE IF EXISTS `typetournoi`;
DROP TABLE IF EXISTS `tournoi`;
DROP TABLE IF EXISTS `organisateur`;
DROP TABLE IF EXISTS `evenement`;
SET FOREIGN_KEY_CHECKS=1;

DROP DATABASE IF EXISTS esport;
