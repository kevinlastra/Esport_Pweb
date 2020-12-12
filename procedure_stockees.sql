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

