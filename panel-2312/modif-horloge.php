<?php
define('DB_SERVER','db5011397709.hosting-data.io');
define('DB_USER','dbu5472475');
define('DB_PASS' ,'Kookies7*');
define('DB_NAME', 'dbs9616600');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
date_default_timezone_set('UTC');
// $id_blinde = intval($_GET['bli']); // get value
$id_activite = "";
$id_activite = intval($_GET['act']);
$minutes = 0;
$minutes = intval($_GET['min']);
$source = "https://poker31.org/indexnav.php";
$source = $_GET['sou'];
$sql = mysqli_query($con, "SELECT * FROM `blindes-live` WHERE `id-activite` =  '$id_activite' ");
while($res = mysqli_fetch_array($sql))
{    
    $structure = $res['id-structure'];
    $id_blinde = $res['ordre'];
    $blinde = $res['fin']; 
    $dt = date_create($blinde);
    date_add($dt, date_interval_create_from_date_string($minutes.'minutes'));
    $fin = date_format($dt, 'Y-m-d H:i:s');
    $modif = mysqli_query($con, "UPDATE `blindes-live` SET `fin` = '$fin' WHERE `ordre` ='$id_blinde' AND `id-activite` =  '$id_activite'");
};
// echo "Ok";
?>
<script type="text/javascript">window.location.replace("<?php echo $source.$id_activite; ?>")</script>