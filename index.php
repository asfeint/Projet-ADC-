<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Our events</title>

<link href='css/fullcalendar.css' rel='stylesheet' />
<link href='css/list.min.css' rel='stylesheet' />
<link href='css/jquery.qtip.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href='css/overall.css' rel='stylesheet' />
<link rel="stylesheet" type="text/css" href="css/index.css">

<script src='js/moment.min.js' type="application/javascript" ></script>
<script src='js/jquery.min.js' type="application/javascript"></script>
<script src='js/fullcalendar.js' type="application/javascript"></script>
<script src='js/locale-all.js' type="application/javascript"></script>
<script src="js/ical.min.js" type="application/javascript"></script>
<script src="js/ical_events.js" type="application/javascript"></script>
<script src="js/ical_fullcalendar.js" type="application/javascript"></script>
<script src="js/jquery.qtip.min.js" type="application/javascript"></script>
<script src="js/custom_display.js" type="application/javascript"></script>

<script src="js/open_window.js" type="application/javascript"></script>
</head>

<body>
  <header>
    <div class="gauche">
      <img src="img/logo.png" id="logolyon">
    </div>
    <div class="milieu">
      <h2> Aide au déplacement de cours </h2>
    </div>
    <div class="droite">
      <img src="img/parrametre.png" id="paramettre">
    </div>
  </header>

  <center>
    <div id="separator"></div>
    <div id="ics-feeds">
    </div>
    <div id='calendar'></div>
    <select name="pets" id="pet-select">
      <option value="">--Choisir une classe--</option>
      <option value="dog">G1S1</option>
      <option value="cat">G2S1</option>
      <option value="cat">G3S1</option>
      <option value="cat">G4S1</option>
      <option value="cat">G6S1</option>
      <option value="cat">G1S2</option>
      <option value="cat">G2S2</option>
      <option value="cat">G3S2</option>
      <option value="cat">G4S2</option>
      <option value="cat">GS2</option>
    </select>
    <form action="essai.php" method="POST">
      <label for="">Project ID</label>
      <input type="number" id="projectId" name="projectId">
      <button>Valider</button>
    </form>
    <?php 
      /*if (isset($_SESSION['projectId'])){
        echo $_SESSION['projectId'];
      } else {
        echo "salut";
      }

      if (isset($_SESSION['test'])){
        echo $_SESSION['test'];
      } else {
        echo "uwu";
      }*/
    ?>
  </center>
  
</body>
</html>
