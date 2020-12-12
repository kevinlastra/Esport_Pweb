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
