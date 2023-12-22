<?php
session_start();
error_reporting(0);
$_SESSION["cptblinde"]='1';
include('include/config.php');
$activite = intval($_GET['act']); // get value
$source = intval($_GET['sou']); // get value
$req1 = mysqli_query($con, "SELECT  * FROM `activite` WHERE `id-activite` = '$activite' ");
$req1b = mysqli_query($con, "DELETE FROM `blindes-live` WHERE `id-activite` = '$activite' ");
$nb_lignes=mysqli_num_rows($req1);
while($res1 = mysqli_fetch_array($req1))
{    
    $structure = $res1['id-structure'];
    $departh = $res1['heure_depart']; 
    // $departh = date_format($departh, 'H:i:s');
    $departd = $res1['date_depart']; 
    // $departd=date_format($departdh, 'Y-m-d H:i:s');
    // $depart = date_create($departd) + date_create($departh);
    // $depart = $departd + $departh;
    $combined = $departd . ' ' . $departh;
    echo $combined;
    
    // $depart = date_create($combined);
    $depart = $combined;
    $req2 = mysqli_query($con, "SELECT * FROM `structure` WHERE `id-structure` = $structure ORDER BY 'id-blinde'");
    while ($res2 = mysqli_fetch_array($req2)) 
    { 
        $blinde = $res2['id-blinde'];
        $req3 = mysqli_query($con, "SELECT * FROM `blindes` WHERE `id-blinde` =  '$blinde'");
        $blinde = $row['fin']; 
        while ($res3 = mysqli_fetch_array($req3))
        {
            $heure = date_create($depart);
            echo "+".date_format($heure, 'Y-m-d H:i:s')."+";
            $minutes = $res2['duree'];
            date_add($heure, date_interval_create_from_date_string($minutes.'minutes'));
            $heure = date_format($heure, 'Y-m-d H:i:s');
            $depart=$heure;
            echo $activite." / ";
            echo $res2['ordre']." / ";
            $ordre=$res2['ordre'];
            echo $res3['nom']." / ";
            $nom=$res3['nom'];
            // echo $res3['debut']." / ";
            echo $res2['duree']." / ";
            $duree=$res2['duree'];
            echo $heure." / ";
            $fin=$heure;
            echo $res3['ante']." ---------- ";
            $ante=$res3['ante'];
            
            $modif = mysqli_query($con, "INSERT INTO `blindes-live` (`id-activite`, `ordre`, `nom`, `duree`, `fin`, `ante`) VALUES ('$activite', '$ordre', '$nom', '$duree', '$heure', '$ante' )");
        };
    } ;
};
?>
<script language="JavaScript" type="text/javascript"> window.location.replace("voir-activite.php?uid=<?php echo $activite ?>"); </script>';
<!-- <script language="JavaScript" type="text/javascript"> window.location.replace("addon.php?id=<?php echo $id ?>&ac=<?php echo $id_activite ?>&source=<?php echo "https://poker31.org/panel/voir-activite.php?uid="?>");  -->
        </script>