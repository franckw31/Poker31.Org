<?php
session_start();

$departsecondes=strtotime(date("Y-m-d H:i:s"));
$arriveesecondes1=strtotime($_SESSION["fin3"]);
$ecartsecondes1=$arriveesecondes1-$departsecondes;
$_SESSION["blinde"]="3";

if ($ecartsecondes1 >= 0)
{ echo gmdate("i:s",$ecartsecondes1);}
else
// { $_SESSION["stop1"] = "1";echo "0";}
{ echo "0";}
?> 