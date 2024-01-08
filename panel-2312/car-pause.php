<?php
session_start();
if ($_SESSION["act"]>0) {$id=$_SESSION["act"];} else $id=1;
// $finpause=strtotime(date("Y-m-d H:i:s"));
include_once('include/config.php');
$req0=mysqli_query($con,"SELECT * FROM `blindes-live` WHERE (`id-activite` = '$id' AND `nom` LIKE 'Pause')");
$row0=mysqli_fetch_array($req0);$ordre = $row0["ordre"];$ordre=$ordre-1;
$req2=mysqli_query($con,"SELECT * FROM `blindes-live` WHERE (`id-activite` = '$id' AND `ordre` = '$ordre')");
$row2=mysqli_fetch_array($req2);$finpause = $row2["fin"];;
$departsecondes=strtotime(date("Y-m-d H:i:s"));
// $duree = strtotime($duree);
// date_add($finpause, date_interval_create_from_date_string($duree.'minutes'));
$arriveesecondes=strtotime($finpause);
// $duree=((int)$duree)*60;
// $arriveesecondesf=$arriveesecondes-($duree*60);

$ecartsecondes=$arriveesecondes-$departsecondes;
// $ecartsecondesf=$arriveesecondesf-$departsecondes;
if ($ecartsecondes < 1)
{ 
    echo "-".$is." Pause En cours ou passée ";
    $_SESSION["stoppause"] = "1";
    // $_SESSION["bl"]=$_SESSION["bl"]+1;    
}
else
{
    echo "Pause & Fin des recaves dans : ".gmdate("i",$ecartsecondes)." Min et ".gmdate("s",$ecartsecondes)." Sec ";
}

?> 