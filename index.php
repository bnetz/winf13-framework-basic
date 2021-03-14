<!doctype html>

<?php
  // Fehlermeldung aktivieren, falls auf Server-Konfigurationsebene abgeschaltet
  ini_set('display_errors', 1); ini_set('display_startup_errors', 1);error_reporting(E_ALL);  

  // initialisiere DB-Verbindung
  require_once(__DIR__ . '/lib/db/db_connect.class.php');
  $Db_connect = new Dbconnect();
  $Db_connect->db_verbindung_oeffnen('personenTest.db');
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
  <h1>Titel</h1>
  <p>Bla</p>
  
  
  <script src="js/jquery-3.6.0.min.js">
</body>
</html>
