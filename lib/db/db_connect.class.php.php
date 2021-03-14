<?php

class Dbconnect
{
	public function db_verbindung_oeffnen($db_name)
	{
		// Auswahl: Datenbank
		$dbname				= "sqliteDatabases/testDB.db";
		
		if(!file_exists($dbname)) {
		/*
			Problem: Wenn Datenbank-File nicht vorhanden legt PDO eine neue (leere) Datei mit diesem Namen an. Siehe auch http://php.net/manual/en/pdo.construct.php
			 Das vermeiden wir, indem wir prüfen, ob es die Datei gibt. Wenn NICHT Datei existiert ($dbname), dann erzeuge einen Fehler.
		*/
			throw new Exception("Datenbank " . $dbnamek . " konnte nicht gefundne werden!");
		}
		
		// Verbindungsdaten für PDO/SQLite-Zugriff festlegen
		$serverdaten 	= "sqlite:$dbname";
		
		try {
		// Verbindung zur DB öffnen ($verbindung wird auch als "Database Handle" bezeichnet)
			$verbindung		= new PDO($serverdaten);
			
		// Ausgabe von Fehlermeldungen aktivieren 
			$verbindung->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		catch (Exception $error)
		{
		// Bei Fehler (z. B. nicht existierende DB kein Absturz, sondern kontrollierter Programm-Abbruch mit aussagekräftiger Fehlermeldung)
			die("--- FEHLER bei DB-Verbindung --<br>" . $error->getMessage());
		}
		
	}

}

?>
