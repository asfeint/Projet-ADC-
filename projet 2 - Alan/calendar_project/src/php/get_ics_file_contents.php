<?php 
session_start();

if (isset($_SESSION['projectId'])){

    $code = $_SESSION['projectId'];
    $lien = "http://adelb.univ-lyon1.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=9311&projectId=".
    $code."&calType=ical&firstDate=2021-09-03&lastDate=2022-06-25";
    $_SESSION['test'] = $code;
  } else {
    $code = 1;
    $_SESSION['test'] = $code;
    $lien = "http://adelb.univ-lyon1.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=9311&projectId=1
    &calType=ical&firstDate=2021-09-03&lastDate=2022-06-25";
  }
  $file = fopen($lien, "r");
    //$file = fopen("../../ics_files/ical.ics", "r");

    $line = "";
    while(!feof($file))
        $line .= fgets($file);

    echo $line;
?>
