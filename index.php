<!doctype html>

<?php
  // Fehlermeldung aktivieren, falls auf Server-Konfigurationsebene abgeschaltet
  ini_set('display_errors', 1); ini_set('display_startup_errors', 1);error_reporting(E_ALL);  
  // initialisiere DB-Verbindung
  require_once(__DIR__ . '/lib/db/Dbconnect.class.php');
  $dbc = new Dbconnect('personenTest.db');
?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Meine Website!!!!!!</title>
  <meta name="description" content="Meine Website, Beschreibung">
  <meta name="author" content="Kommissar Smith">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/myStyles.css?v=1.0">
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="col">
        <h1>Titel</h1>
        <p>Dies ist eine Beispielwebseite</p>
      </div>
    </div>
    
<!-- Bereich 1: Ausgabe der vorhandenen Daten -->
    <div class="row"> <!-- neue Zeile / Spalten, siehe Bootstrap-Grid-Doku: https://getbootstrap.com/docs/4.0/layout/grid/ -->
      <div class="col-12">
        <h2>Ausgabe der Daten in der Datenbank</h2>
        <?php 
          $sqlAbfrage     = 'select * from personen p;';
          $ergebnismenge  = $dbc->readDatabase($sqlAbfrage);
    	// Tabelle aus DB-Daten bauen
          echo "<table>";
          echo "<thead><tr>";
          echo "<td>id</td><td>Name</td><td>Körpergröße</td>";	
          echo "</tr></thead>";
          foreach($ergebnismenge as $zeile) {
            echo "<tr>";
            echo "<td>" . $zeile["id"] . "</td>";
            echo "<td>" . $zeile["name"] . "</td>";
            echo "<td>" . $zeile["groesse"] . "</td>";
            echo "</tr>";
          }  
          echo "</table>";	
        ?>
      </div> <!-- End Col 12 -->
    </div> <!-- End Row -->
    <div class="row">
      <div class="col-sm-4">
        <h2>Neuen Datensatz eingeben + speichern</h2>
        <p>Als Beispiel hier zweispaltig in Bootstrap</p>
      </div>
      <div class="col-sm-8">
        <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post"> <!-- Start Formular -->
        <label for="idName">Dein Name</label>
        <input value="Beispielname" type="text" id="idName" name="tfName" placeholder="Name eingeben"><br>
		<label for="idKoerpergroesse">Deine Körpergröße</label>
        <input value="174" type="text" id="idKoerpergroesse" name="tfKoerpergroesse" placeholder="Körpergröße eingeben"><br>
        <input type="submit" value="Absenden" name="submitknopf" id="idSubmit">
        </form>
      </div> <!-- End Col #2 -->
    </div> <!-- End Row with form -->
    <?php
      if(!empty($_POST)) {
        // Zum Testen, was im Array verschickt wird: var_dump($_POST);
        $name     = $_POST['tfName'];
        $groesse  = $_POST['tfKoerpergroesse'];
        $sqlAnweisung = "INSERT INTO `personen` (`name`, `groesse`) VALUES ('$name', '$groesse');";
        $dbc->writeDatabase($sqlAnweisung);
      // if ist noch nicht geschlossen!!!
    ?>
    <!-- Dieser HTML-Code wird nur eingefügt, wenn die php-if-Bedingung !empty … wahr ist! -->
    <div class="row bg-success text-white">
      <!-- Bootstrap Color-Klassen: https://getbootstrap.com/docs/4.0/utilities/colors/ -->
      <div class="col-12">
        <p class="text-center">Neuer Datensatz eingefügt</p>
        <!-- Bootstrap Textausrichtung: https://getbootstrap.com/docs/4.0/utilities/text/ -->
      </div>
    </div>
    <?php
      } // ende erster if-Zweig!
      else
      { // Post-Array ist leer
        // nichts … Aber man könnte hier natürlich was einfügen.
      }
    ?>
	<hr>
</div> <!-- container ende -->
  
  
  <script src="js/jquery-3.6.0.min.js">
</body>
</html>
