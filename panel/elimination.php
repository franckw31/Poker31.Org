<?php
session_start();
error_reporting(0);
include('include/config.php'); 
$id_participation = intval($_GET['id']); // get value
$id_activite = intval($_GET['ac']);
$source= $_GET['source'];
$req = mysqli_query($con, "SELECT * FROM `participation` WHERE `id-participation` = '$id_participation' ");            
while ($res = mysqli_fetch_array($req)) 
    { 
    $siegelibre=$res['id-siege'];$tablelibre=$res['id-table'];
    $modif = mysqli_query($con, "UPDATE `participation` SET `option` = 'Elimine', `id-siege` = '0',`id-table` = '0' WHERE `id-participation` = '$id_participation'");
    };
; 
?>
<!-- <script type="text/javascript">window.location.replace("<?php echo $source.$id_activite; ?>");</script> ;  -->
<?php
$sql0 = mysqli_query($con, "SELECT * FROM `participation` WHERE ( (`id-activite` = '$id_activite' AND `option` NOT LIKE  'Annule') AND (`id-activite` = '$id_activite' AND `option` NOT LIKE  'Elimine') ) " ) ;
$nb_joueurs = mysqli_num_rows($sql0);
$sqleli = mysqli_query($con, "SELECT * FROM `participation` WHERE (`id-activite` = '$id_activite' AND `option` LIKE  'Elimine') " ) ;
$nb_joueurseli = mysqli_num_rows($sqleli);
$sqldep = mysqli_query($con, "SELECT * FROM `participation` WHERE ( (`id-activite` = '$id_activite' AND `option` NOT LIKE  'Annule') AND (`id-activite` = '$id_activite' AND `option` NOT LIKE  'Attente') ) " ) ;
$nb_joueursdep = mysqli_num_rows($sqldep);
$classement = $nb_joueursdep - $nb_joueurseli+1;
$modif = mysqli_query($con, "UPDATE `participation` SET `classement` = '$classement' WHERE `id-participation` = '$id_participation'");
$sql = mysqli_query($con, "SELECT * FROM `activite` WHERE `id-activite` = $id_activite ");
while ($res = mysqli_fetch_array($sql)) 
    { 
    $nb_tables = $res["nb-tables"];
    };    
(int)$table = 1;
while ((int)$table <= (int)$nb_tables)
    {
    $sql2 = mysqli_query($con, "SELECT * FROM `participation` WHERE (`id-activite` = $id_activite AND `id-table` = $table) ");
    $cpttable[$table] = mysqli_num_rows($sql2);
    (int)$table = (int)$table + 1;
    };
echo $cpttable[1].$cpttable[2].$cpttable[3].$cpttable[4];
$moy=$nb_joueurs/$nb_tables;$moy = (round($moy,0));
echo "-".$moy."-";
echo "{".$siegelibre."-".$tablelibre."}";
$table = 1;
while ((int)$table <= (int)$nb_tables)
    {
    // $sql3 = mysqli_query($con, "SELECT * FROM `participation` WHERE (`id-activite` = $id_activite AND `id-table` = $table) ");
    if ($cpttable[$table] > $moy)
        {
        $tabledepart = $table;
        };
    (int)$table = (int)$table + 1;
    };
    // echo "sortie while".$id_activite.$tabledepart;   
if ($tabledepart > 0) 
    {
    $sql3 = mysqli_query($con, "SELECT * FROM `participation` WHERE (`id-activite` = $id_activite AND `id-table` = $tabledepart) ORDER BY `id-siege`");
    // echo "sql3 av while";
    while  ($res3 = mysqli_fetch_array($sql3))
        { 
        $id_membre = $res3['id-membre'];echo "+".$id_membre."+";
        };
    // echo $id_membre;
    $modif = mysqli_query($con, "UPDATE `participation` SET `id-table` = '$tablelibre' , `id-siege` = '$siegelibre'  WHERE (`id-activite` = $id_activite AND `id-membre` = $id_membre ) ");
    };  
?>
<script type="text/javascript">window.location.replace("<?php echo $source.$id_activite; ?>");</script> ;   