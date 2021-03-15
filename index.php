<!doctype html>

<?php
  // Fehlermeldung aktivieren, falls auf Server-Konfigurationsebene abgeschaltet
  ini_set('display_errors', 1); ini_set('display_startup_errors', 1);error_reporting(E_ALL);  
	// Einbinden der Dbconnect-Klasse
  require_once(__DIR__ . '/lib/db/Dbconnect.class.php');
  // initialisiere DB-Verbindung (neues Objekt der DBconnect-Klasse erzeugen -> Konstruktor initialisiert alles)
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
        <?php
        // nur zur Demonstration: Wir prüfen, ob eines der Formulare abgeschickt wurde:
        if(!empty($_POST)) { // Ein Formular wurde abgeschickt (Daten im Post-Array vorhanden)
        // Hinweis: empty umfasst isset (also überflüssig zu schreiben: if !empty … && !isset …)
				  echo "<p style='font-size: 0.8em;'>Ein Formular wurde abgeschickt.</p>";
				} else {
				  echo "<p style='font-size: 0.8em;'>Seite wurde direkt geladen</p>";
				}
        // Zum Testen, was im Array verschickt wird: var_dump($_POST);
        ?>
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
          echo "<table class='table'>";
          echo "<thead><tr>";
          echo "<th>id</th><th>Name</th><th>Körpergröße</th>";	
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
    <div class="row border border-dark p-3">
    <!-- bootstrap border: https://getbootstrap.com/docs/4.0/utilities/borders/ -->
    <!-- bootstrap paddings: https://getbootstrap.com/docs/4.0/utilities/spacing/ -->
      <div class="col-sm-4">
        <h2>Neuen Datensatz eingeben + speichern</h2>
        <p>Als Beispiel hier zweispaltig in Bootstrap</p>
      </div>
      <div class="col-sm-8">
        <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post"> <!-- Start Formular INPUT -->
        <label for="idName">Dein Name</label>
        <input value="Beispielname" type="text" id="idName" name="tfName" placeholder="Name eingeben"><br>
		<label for="idKoerpergroesse">Deine Körpergröße</label>
        <input value="174" type="text" id="idKoerpergroesse" name="tfKoerpergroesse" placeholder="Körpergröße eingeben"><br>
        <input type="submit" value="Absenden" name="submitInsert" id="idSubmit">
        </form>
      </div> <!-- End Col #2 -->
    </div> <!-- End Row with form -->
    <?php
      if(isset($_POST['submitInsert'])) { 
      	// der Knopf name="submitInsert" wurde gedrückt --> Input-Formular wurde abgeschickt
      	// (isset: Variable existiert (ist deklariert) UND ist nicht null)
      	
      	// Man könnte testen mit:
      	// echo "erstes formular wurde abgeschickt!";
      	$name     = $_POST['tfName'];
	      $groesse  = $_POST['tfKoerpergroesse'];
	      $sqlAnweisung = "INSERT INTO `personen` (`name`, `groesse`) VALUES ('$name', '$groesse');";
  	    $dbc->writeDatabase($sqlAnweisung);
      /* php-if ist noch nicht geschlossen!!!
       Da wir das folgende HTML nicht echoen wollen (zu viele "'.'" usw.), schließen wir einfach php, schreiben HTML-Code und nehmen das PHP-Skript dann wieder auf. (Pro-Trick!)
       */
    ?>
    <!-- Dieser HTML-Code wird nur eingefügt, wenn die php-if-Bedingung isset … wahr ist!, also nur, wenn das Formular Input abgeschickt wurde -->
    <div class="row bg-success text-white mt-3">
      <!-- Bootstrap Color-Klassen: https://getbootstrap.com/docs/4.0/utilities/colors/ -->
      <div class="col-12">
        <p class="text-center">Neuer Datensatz "<?php echo $_POST['tfName']; ?>" eingefügt.</p>
        <!-- Bootstrap Textausrichtung: https://getbootstrap.com/docs/4.0/utilities/text/ -->
      </div>
    </div>
    <?php
    		} // Ende innerer if-Zweig (isset …)
    ?>
	<hr>
	<!-- datensatz löschen - formular -->
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post"> <!-- Start Formular DELETE -->
  <div class="row border border-danger p-3">
  <!-- eigentlich wäre es hübscher, wenn dieses Formular wie das obere (zweispaltig) designt wäre. Aber zur Demonstration hier ein einspaltiges Layout. -->
	  <div class="col">
	  	<h2>Datensatz löschen</h2>
	  	<p>Hier können Sie einen Datensatz löschen</p>
	  	<label for="idName">Personen-ID:</label>
	  	<input type="text" name="tfID" id="idName" placeholder="ID eingeben" value="">
	  	<input type="submit" value="Datensatz löschen!" name="submitDelete" id="idSubmitLoeschen">
	  </div> <!-- ende col -->
	</div> <!-- ende row -->
	</form>
	<?php
		/* Wenn das Formular mit dem Knopf submitDelete übermittelt wurde, soll die Person mit der ausgewählten ID gelöscht werden. */
	
	?>


</div> <!-- container ende -->
  
  
  <script src="js/jquery-3.6.0.min.js">
</body>
</html>
