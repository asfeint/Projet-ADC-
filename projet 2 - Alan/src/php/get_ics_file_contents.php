<?php 
    //$file = fopen("../../ics_files/ical.ics", "r");
    $file = fopen("http://adelb.univ-lyon1.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=9311&projectId=1&calType=ical&firstDate=2021-09-03&lastDate=2022-06-25", "r");
    $line = "";
    while(!feof($file))
        $line .= fgets($file);

    echo $line;
?>
