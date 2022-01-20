<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Our events</title>

<link href='css/fullcalendar.css' rel='stylesheet'/>
<link href='css/list.min.css' rel='stylesheet' />
<link href='css/jquery.qtip.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.css' rel='stylesheet' media='print'/>
<link href='css/overall.css' rel='stylesheet' />

<script src='js/moment.min.js' type="application/javascript" ></script>
<script src='js/jquery.min.js' type="application/javascript"></script>
<script src='js/fullcalendar.js' type="application/javascript"></script>
<script src='js/locale-all.js' type="application/javascript"></script>
<script src="js/ical.min.js" type="application/javascript"></script>
<script src="js/ical_events.js" type="application/javascript"></script>
<script src="js/ical_fullcalendar.js" type="application/javascript"></script>
<script src="js/jquery.qtip.min.js" type="application/javascript"></script>
<script src="js/custom_display.js" type="application/javascript"></script>

<script src="js/selectattribute.js" type="application/javascript"></script>
</head>

<body>
  <center>
  <h1>ADC</h1>
    <div id="separator"></div>
    <div id="ics-feeds">
    </div>
  </center>
  <div id='calendar'></div>

<!--  <div class="box-tip" >
    <div id="legend-feeds">
    </div>
    <script src="js/copy.js" type="application/javascript"></script>
  </div> -->

<div id='external-events'>
  <h2>EDT</h2>
  <div id='external-events-list'>
    <div class='fc-event'><b>Semestre 1</b></div>  
    <select s1="Semestre1" size="1" id="s1">
      <option value="g1s1">G1S1</option>
      <option value="g2s1">G2S1</option>
      <option value="g3s1">G3S1</option>
      <option value="g4s1">G4S1</option>
      <option value="g5s1">G5S1</option>
      <option value="g6s1">G6S1</option>
    </select>
    <input type="button" id="b1" value="OK">
    <div class='fc-event'><b>Semestre 2</b></div> 
    <select s2="Semestre2" size="1" id="s2">
      <option value="g1s2">G1S2</option>
      <option value="g2s2">G2S2</option>
      <option value="g3s2">G3S2</option>
      <option value="g4s2">G4S2</option>
      <option value="g6s2">G6S2</option>
    </select>
    <input type="button" id="b2" value="OK">
    <div class='fc-event'><b>Semestre 3</b></div> 
    <select s3="Semestre3" size="1" id="s3">
      <option value="g1s3">G1S3</option>
      <option value="g2s3">G2S3</option>
      <option value="g3s3">G3S3</option>
      <option value="g4s3">G4S3</option>
      <option value="g6s3">G6S3</option>
    </select>
    <input type="button" id="b3" value="OK">
    <div class='fc-event'><b>Semestre 4</b></div> 
    <select s4="Semestre4" size="1" id="s4">
      <option value="g1s4">G1S4</option>
      <option value="g2s4">G2S4</option>
      <option value="g3s4">G3S4</option>
      <option value="g4s4">G4S4</option>
      <option value="g6s4">G6S4</option>
    </select>
    <input type="button"  id="b4" value="OK">
    <div class='fc-event'><b>Salles info</b></div>
    <select si="Salles info" size="1" id="si">
      <option value="s03">S03</option>
      <option value="s13">S13</option>
      <option value="s14">S14</option>
      <option value="s16">S16</option>
      <option value="s17">S17</option>
      <option value="s22">S22</option>
      <option value="s24">S24</option>
    </select>
    <input type="button" id="b5" value="OK">
    <div class='fc-event'><b>Salles TD</b></div>
    <select st="Salles TD" size="1" id="st">
      <option value="s10">S10</option>
      <option value="s11">S11</option>
      <option value="s12">S12</option>
      <option value="s15">S15</option>
      <option value="s26">S26</option>
    </select>
    <input type="button" id="b6" value="OK">
    <div class='fc-event'><b>Autres salles</b></div>
    <select as="Autres salles" size="1" id="as">
      <option value="s18">S18 - TP Réseau </option>
      <option value="s21">S21 </option>
      <option value="s23">S23 - TP Réseau </option>
      <option value="s25">S25 - Salle de réunion </option>
      <input type="button" id="b7" value="OK">
    </select>
  </div>
  <div class='fc-event'><b>EDT | Proposition</b></div>
  <input id="edtp" type="button" value="EDT Personnel">
  <input id="dpc" type="button" value="Proposer un déplacement de cours">
  <input id="pmtc" type="button" value="Proposer une permutation de cours"> 
  <div class='fc-event'><b>Projet ID</div>
  <form action="essai.php" method="POST">
    <input type="number" id="projectId" name="projectId" default="1">
    <button>OK<button>
  </form>
</div>
</body>
<script>
  /*
    function reqListener (){
    console.log(this.responseText);
  }
  var oReq = new XMLHttpRequest();
  oReq.onload = function(){
    alert(this.responseText);
  }; */
  const b1 = document.querySelector('#b1');
  const sb1 = document.querySelector('#s1')
  b1.onclick = (event) => {
    event.preventDefault();
    alert(sb1.selectedIndex);
    /*
    if(sb1.selectedIndex=0){
      
    }
    if(sb1.selectedIndex=1){
    
    }
    if(sb1.selectedIndex=2){

    }
    if(sb1.selectedIndex=3){

    } 
    if(sb1.selectedIndex=4){

    }
    if(sb1.selectedIndex=5){

    } */
  }
  const b2 = document.querySelector('#b2');
  const sb2 = document.querySelector('#s2')
  b2.onclick = (event) => {
    event.preventDefault();
    alert(sb2.selectedIndex);
    /*
    if(sb1.selectedIndex=0){
      
    }
    if(sb1.selectedIndex=1){

    }
    if(sb1.selectedIndex=2){

    }
    if(sb1.selectedIndex=3){

    } 
    if(sb1.selectedIndex=4){

    } */
  }
  const b3 = document.querySelector('#b3');
  const sb3 = document.querySelector('#s3')
  b3.onclick = (event) => {
    event.preventDefault();
    alert(sb3.selectedIndex);
    /*
    if(sb1.selectedIndex=0){
      
    }
    if(sb1.selectedIndex=1){

    }
    if(sb1.selectedIndex=2){

    }
    if(sb1.selectedIndex=3){

    } 
    if(sb1.selectedIndex=4){

    } */
  }
  const b4 = document.querySelector('#b4');
  const sb4 = document.querySelector('#s4')
  b4.onclick = (event) => {
    event.preventDefault();
    alert(sb4.selectedIndex);
    /*
    if(sb1.selectedIndex=0){
      
    }
    if(sb1.selectedIndex=1){

    }
    if(sb1.selectedIndex=2){

    }
    if(sb1.selectedIndex=3){

    } 
    if(sb1.selectedIndex=4){

    } */
  } 
  const b5 = document.querySelector('#b5');
  const sb5 = document.querySelector('#si')
  b5.onclick = (event) => {
    event.preventDefault();
    alert(sb5.selectedIndex);
    /*
    if(sb1.selectedIndex=0){
      
    }
    if(sb1.selectedIndex=1){

    }
    if(sb1.selectedIndex=2){

    }
    if(sb1.selectedIndex=3){

    } 
    if(sb1.selectedIndex=4){

    }
    if(sb1.selectedIndex=5){

    }
    if(sb1.selectedIndex=6){

    } */
  }
  const b6 = document.querySelector('#b6');
  const sb6 = document.querySelector('#st')
  b6.onclick = (event) => {
    event.preventDefault();
    alert(sb6.selectedIndex);
    /*
    if(sb1.selectedIndex=0){
      
    }
    if(sb1.selectedIndex=1){

    }
    if(sb1.selectedIndex=2){

    }
    if(sb1.selectedIndex=3){

    } 
    if(sb1.selectedIndex=4){

    } */
  }
  const b7 = document.querySelector('#b7');
  const sb7 = document.querySelector('#as')
  b7.onclick = (event) => {
    event.preventDefault();
    alert(sb7.selectedIndex);
    /*
    if(sb1.selectedIndex=0){
      
    }
    if(sb1.selectedIndex=1){

    }
    if(sb1.selectedIndex=2){

    } */
  }
</script>
</html>
