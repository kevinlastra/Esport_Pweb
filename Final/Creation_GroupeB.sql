/*
Fichier : Creation_GroupB.sql
Auteurs:
	Benjamin Baska  21503576
	Kevin Lastra    21706783
Nom du groupe : B
*/

DROP DATABASE IF EXISTS esport;
CREATE DATABASE esport;
USE esport;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `equipe`;
DROP TABLE IF EXISTS `joueur`;
DROP TABLE IF EXISTS `participation`;
DROP TABLE IF EXISTS `typetournoi`;
DROP TABLE IF EXISTS `tournoi`;
DROP TABLE IF EXISTS `organisateur`;
DROP TABLE IF EXISTS `evenement`;
SET FOREIGN_KEY_CHECKS=1;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

------CREATION DES TABLES---------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE `equipe` (
  `id_equipe` int(3) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `id_e` int(3) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `jeu` varchar(30) NOT NULL,
  `description` text,
  `ouvert` tinyint(1) NOT NULL,
  `id_o` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `joueur`
--

CREATE TABLE `joueur` (
  `id_j` int(3) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `niveau` int(20) NOT NULL,
  `id_equipe` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organisateur`
--

CREATE TABLE `organisateur` (
  `id_o` int(3) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `dernier_event_cree` date
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id_equipe` int(11) NOT NULL,
  `id_t` int(11) NOT NULL,
  `place` smallint
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tournoi`
--

CREATE TABLE `tournoi` (
  `id_t` int(3) NOT NULL,
  `nombre_joueur` int(20) NOT NULL,
  `description` text NOT NULL,
  `feuille_match` json DEFAULT NULL,
  `id_tt` int(3) NOT NULL,
  `id_e` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `typetournoi`
--

CREATE TABLE `typetournoi` (
  `id_tt` int(3) NOT NULL,
  `type` varchar(20) NOT NULL,
  `niveau` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id_equipe`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_e`),
  ADD KEY `id_o` (`id_o`);

--
-- Indexes for table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id_j`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Indexes for table `organisateur`
--
ALTER TABLE `organisateur`
  ADD PRIMARY KEY (`id_o`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD KEY `id_equipe` (`id_equipe`),
  ADD KEY `id_t` (`id_t`);

--
-- Indexes for table `tournoi`
--
ALTER TABLE `tournoi`
  ADD PRIMARY KEY (`id_t`),
  ADD KEY `id_tt` (`id_tt`),
  ADD KEY `id_e` (`id_e`);

--
-- Indexes for table `typetournoi`
--
ALTER TABLE `typetournoi`
  ADD PRIMARY KEY (`id_tt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id_equipe` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_e` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id_j` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `id_o` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tournoi`
--
ALTER TABLE `tournoi`
  MODIFY `id_t` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `typetournoi`
--
ALTER TABLE `typetournoi`
  MODIFY `id_tt` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`id_o`) REFERENCES `organisateur` (`id_o`);

--
-- Constraints for table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `joueur_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id_equipe`);

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id_equipe`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`id_t`) REFERENCES `tournoi` (`id_t`);

--
-- Constraints for table `tournoi`
--
ALTER TABLE `tournoi`
  ADD CONSTRAINT `tournoi_ibfk_1` FOREIGN KEY (`id_tt`) REFERENCES `typetournoi` (`id_tt`),
  ADD CONSTRAINT `tournoi_ibfk_2` FOREIGN KEY (`id_e`) REFERENCES `evenement` (`id_e`);


------Affichage des tuples---------------
SELECT * FROM evenement;
SELECT * FROM organisateur;
SELECT * FROM tournoi;
SELECT * FROM typetournoi;
SELECT * FROM participation;
SELECT * FROM equipe;
SELECT * FROM joueur;


------INSERTION--------------------------
------Organisateur par default-----------
INSERT INTO organisateur VALUES (1,'root','root', NULL);
-----------------------------------------
------Procedures-------------------------

DROP procedure IF EXISTS event_par_org;
DROP procedure IF EXISTS stats_event;

DELIMITER |
CREATE PROCEDURE event_par_org (IN org_id INT)
BEGIN
	SELECT e.id_e, e.nom
	FROM evenement e
	WHERE e.id_o = org_id;
END |

CREATE PROCEDURE stats_event(IN event_id INT)
BEGIN
	SELECT e.id_e, e.nom, e.id_o, o.nom, COUNT(t.id_t)
	FROM evenement e, tournoi t, organisateur o
	WHERE e.id_e = event_id AND e.id_o = o.id_o AND t.id_e = event_id
	GROUP BY e.id_e;
	
	SELECT t.id_t, COUNT(e.id_equipe)
	FROM equipe e, tournoi t, participation p
	WHERE t.id_e = event_id AND p.id_t = t.id_t AND p.id_equipe = e.id_equipe
	GROUP BY t.id_t;
END | 

DELIMITER ;

------Triggers---------------------------

DROP TRIGGER IF EXISTS update_organisateur_last_date;
DROP TRIGGER IF EXISTS delete_organisateur;

DELIMITER |
CREATE TRIGGER update_organisateur_last_date AFTER INSERT ON evenement
FOR EACH ROW
BEGIN
	UPDATE organisateur
	SET dernier_event_cree = CURDATE()
	WHERE id_o = NEW.id_o;
END;
|
CREATE TRIGGER delete_organisateur BEFORE DELETE ON organisateur
FOR EACH ROW
BEGIN	
	UPDATE evenement SET id_o = 1
		WHERE id_o = OLD.id_o;
END;
|
DELIMITER ;


COMMIT;

