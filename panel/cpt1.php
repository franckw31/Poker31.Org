<?php
session_start();
error_reporting(0);
include_once('include/config.php');

$res=mysqli_query($con,"SELECT * FROM `blindes` WHERE (`id-activite` = $id AND `ordre` = 1)");
$row=mysqli_fetch_array($res);
$fin=$row["fin"];$nom=$row["nom"];$ordre=$row["ordre"];
$_SESSION["fin"]=$fin;$_SESSION["nom"]=$nom;$_SESSION["stop"]='0';

$res=mysqli_query($con,"SELECT * FROM `blindes` WHERE (`id-activite` = $id AND `ordre` = 2)");
$row=mysqli_fetch_array($res);
$fin2=$row["fin"]; $nom2=$row["nom"]; $ordre2=$row["ordre"];
$_SESSION["fin2"]=$fin2; $_SESSION["nom2"]=$nom2; $_SESSION["stop2"]='0';

$res=mysqli_query($con,"SELECT * FROM `blindes` WHERE (`id-activite` = $id AND `ordre` = 3)");
$row=mysqli_fetch_array($res);
$fin3=$row["fin"]; $nom3=$row["nom"]; $ordre3=$row["ordre"];
$_SESSION["fin3"]=$fin3; $_SESSION["nom3"]=$nom3; $_SESSION["stop3"]='0';
?>

<form>
  <input type="hidden" id="nom" value="<?php echo $nom; ?>">
  <input type="hidden" id="nom2" value="<?php echo $nom2; ?>">
  <input type="hidden" id="nom3" value="<?php echo $nom3; ?>">
</form>

<div id="main">
    <div class='square-box' opacity:0.99>
        <div class='square-content' id="response" style='font-size:30px ; color:white'></div>
    </div>

<?php

if ($_SESSION["stop"] == '0') { ?>

    <div id="response"></div>
    <script type="text/javascript">
        let nIntervId;

        function compteur() { if (!nIntervId) { nIntervId = setInterval(decompte, 1000);}}
        function decompte() { var xmlhttp=new XMLHttpRequest(); xmlhttp.open("GET","response.php",false); xmlhttp.send(null);                     
            if (xmlhttp.responseText == 0) {stopcompteur();compteur2()} else {document.getElementById("response").innerHTML=document.getElementById("nom").value+" : "+xmlhttp.responseText;}}
        function stopcompteur() { clearInterval(nIntervId); nIntervId = null; }

        function compteur2() { if (!nIntervId) { nIntervId = setInterval(decompte2, 1000); }}
        function decompte2() { var xmlhttp=new XMLHttpRequest(); xmlhttp.open("GET","response2.php",false); xmlhttp.send(null);                     
            if (xmlhttp.responseText == 0) {stopcompteur2();compteur3()} else {document.getElementById("response").innerHTML=document.getElementById("nom2").value+" : "+xmlhttp.responseText;}}
        function stopcompteur2() { clearInterval(nIntervId); nIntervId = null; }

        function compteur3() { if (!nIntervId) { nIntervId = setInterval(decompte3, 1000); }}
        function decompte3() { var xmlhttp=new XMLHttpRequest(); xmlhttp.open("GET","response3.php",false); xmlhttp.send(null);                     
            if (xmlhttp.responseText == 0) {stopcompteur3();} else {document.getElementById("response").innerHTML=document.getElementById("nom3").value+" : "+xmlhttp.responseText;}}
        function stopcompteur3() { clearInterval(nIntervId); nIntervId = null; }

        compteur();
    </script>

    <?php ; }

?> 