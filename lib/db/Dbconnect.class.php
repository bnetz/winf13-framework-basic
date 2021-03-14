<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Dbconnect
{
  // Klassenvariablen (Attribute)
  protected $verbindung;
  protected $dbPath = __DIR__ . "/sqliteDatabases/";
  protected $dbName;
  // Konstruktor
  public function __construct($pDbName) {
    $this->dbName = $this->dbPath . $pDbName;
    
    // SO KÖNNTE MAN DAS TESTEN:
    // echo "<p>Datenbankpfad komplett: " . $this->dbName . "</p>";
    $this->db_verbindung_oeffnen($this->dbName);
  }
  public function readDatabase($sql) {
    $abfrage 		= $this->getVerbindung()->prepare($sql);
    $abfrage->execute();
    return $abfrage->fetchAll();
  }
  public function writeDatabase($sql) {
    $abfrage = $this->getVerbindung()->prepare($sql);
    $abfrage->execute();
  }
	public function db_verbindung_oeffnen($db_name)
	{
		if(!file_exists($this->dbName)) {
		/*
			Problem: Wenn Datenbank-File nicht vorhanden legt PDO eine neue (leere) Datei mit diesem Namen an. Siehe auch http://php.net/manual/en/pdo.construct.php
			 Das vermeiden wir, indem wir prüfen, ob es die Datei gibt. Wenn NICHT Datei/Pfad existiert ($this->dbName), dann erzeuge einen Fehler.
		*/
			throw new Exception("*** Datenbank " . $this->dbName . " konnte nicht gefunden werden! ***");
		}
		// Verbindungsdaten für PDO/SQLite-Zugriff festlegen
		$serverdaten 	= "sqlite:$this->dbName";
		try {
		// Verbindung zur DB öffnen ($verbindung wird auch als "Database Handle" bezeichnet)
			$this->verbindung		= new PDO($serverdaten);
			
		// Ausgabe von Fehlermeldungen aktivieren 
			$this->verbindung->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Exception $error)
		{
		// Bei Fehler (z. B. nicht existierende DB kein Absturz, sondern kontrollierter Programm-Abbruch mit aussagekräftiger Fehlermeldung)
			die("--- FEHLER bei DB-Verbindung --<br>" . $error->getMessage());
		}
	}
    
    // Getter, Setter
    public function getVerbindung() {
      return $this->verbindung;
    }

    public function setVerbindung($verbindung): void {
      $this->verbindung = $verbindung;
    }



}

?>
