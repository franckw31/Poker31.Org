<?php
session_start();
error_reporting(0);
include('panel/include/config.php'); 

$gid_part = intval($_GET['part']); // get value
$gid_acti = intval($_GET['acti']);
$gid_tabl = intval($_GET['tabl']);
$gid_sieg = intval($_GET['sieg']);
$source = $_GET['sour'];
$actu = strtotime(date("Y-m-d H:i:s"));
// echo $actu;
$actu2 = date("Y-m-d");
//  echo $actu2;
$rech = mysqli_query($con, "SELECT `id-activite`,`titre-activite`,`date_depart` FROM `activite` WHERE `id-membre` = 2 ORDER BY `id-activite` DESC");
$trouv = mysqli_fetch_assoc($rech);
$dateact = $trouv["date_depart"];
// echo $dateact;
$dateact2 = strtotime($dateact);
// echo $dateact2;
if (isset($_POST['submitchoixact'])) {
    $acti = $_POST['acti'];

    echo "Activité selectionnée : ".$acti;
    // $sql2 = mysqli_query($con, "INSERT INTO `membres` (`pseudo`, `fname`) VALUES ('$pseudo', '$fname')");
};



if (isset($_POST['submitcreaj'])) {
    $pseudo = $_POST['pseudo'];
    $fname = $_POST['fname'];

    echo "Pseudo Créé = ".$pseudo.", Prénom = ".$fname."-";
    $sql2 = mysqli_query($con, "INSERT INTO `membres` (`pseudo`, `fname`) VALUES ('$pseudo', '$fname')");
};

if (isset($_POST['submit'])) {
    $membre = $_POST['membre'];
    $acti = $_POST['acti'];
    $tabl = $_POST['table'];
    $sieg = $_POST['siege'];

    echo "Joueur Ins = ".$membre.", Activité = ".$acti.", Table = ".$tabl.", Siege = ".$sieg;
    $sql2 = mysqli_query($con, "INSERT INTO `participation` (`id-membre`, `id-activite`, `id-table`, `id-siege`) VALUES ('$membre', '$acti', '$tabl', '$sieg')");
};

if (isset($_POST['submitsupc'])) {
    $membre = $_POST['membresup'];
    $acti = $_POST['actisup'];

    echo "Joueur Sup = ".$membre.", Activité = ".$acti;
    $sql2 = mysqli_query($con, "DELETE FROM `participation` WHERE `id-membre` = $membre AND `id-activite` = $acti");
};?>

<form method="post">
    <tr> 
        <th>Activité</th>
        <td>
            <?php
            $acti = mysqli_query($con, "SELECT `id-activite`,`titre-activite`,`date_depart` FROM `activite` WHERE (`id-membre` = 2 AND `date_depart` >= '$actu2') ORDER BY `id-activite` ASC");
            echo "<align='center' class='rougesurblanc'><select name=acti><option value='-Anonyme-'>--> Titre IcI <--";
            while ($choix = mysqli_fetch_assoc($acti))
                {		  
	            $liste = $choix['titre-activite'] ; 
                echo "<option value={$choix["id-activite"]}>{$choix["titre-activite"]}\n";   
                }
	        echo "</select>";
	        ?>
        </td>
        <td colspan="2" style="text-align:center">
            <button
                type="submit"
                class="btn btn-primary-orange2 btn-block"
                name="submitchoixact"
                >Choix Activité
            </button>
        </td>
    </tr>
</form>

<table>
<form method="post">
    <tr> 
        <th>Pseudo</th>
        <td>
            <input
                class="form-control"
                id="pseudo" name="pseudo"
                type="text"
                value="<?php echo $row['pseudo']; ?>">
        </td>
        <th>Prénom</th>
        <td>
            <input 
                class="form-control"
                id="fname"
                name="fname"
                type="text"
                value="<?php echo $row['fname']; ?>">
        </td>
        <td colspan="2" style="text-align:center">
            <button
                type="submit"
                class="btn btn-primary-orange2 btn-block"
                name="submitcreaj"
                >Création Rapide du joueur
            </button>
        </td>
    </tr>
<!-- </form> -->
</table>

<table>
<form method="post">
    <th>Joueur</th>
    <td>
    <?php
  	$membres = mysqli_query($con, "SELECT `id-membre`,`pseudo` FROM `membres` ORDER BY `pseudo` ASC");
    echo "<align='center' class='rougesurblanc'><select name=membre><option value='-Anonyme-'>--> Pseudo IcI <--";
    while ($choix = mysqli_fetch_assoc($membres))
       {		  
	   $listepseudo = $choix['pseudo'] ; 
       echo "<option value={$choix["id-membre"]}>{$choix["pseudo"]}\n";   
       }
	   echo "</select>";
	    ?>
    <th>Activité</th>
    <td>
    <?php
    $acti = mysqli_query($con, "SELECT `id-activite`,`titre-activite`,`date_depart` FROM `activite` WHERE (`id-membre` = 2 AND `date_depart` >= '$actu2') ORDER BY `id-activite` ASC");
    echo "<align='center' class='rougesurblanc'><select name=acti><option value='-Anonyme-'>--> Titre IcI <--";
    while ($choix = mysqli_fetch_assoc($acti))
       {		  
	   $liste = $choix['titre-activite'] ; 
       echo "<option value={$choix["id-activite"]}>{$choix["titre-activite"]}\n";   
       }
	   echo "</select>";
	    ?>
    </td>
    <th>Table</a></th>
    <td>
        <select name="table" id="table" class="form-control" type="text">
            <option value='1' selected>Table 1</option>
            <option value='2'>Table 2</option> 
            <option value='3'>Table 3</option> 
            <option value='4'>Table 4</option> 
            <option value='5'>Table 5</option> 
        </select>
    </td>
    <th>Siege</a></th>
    <td>
        <select name="siege" id="siege" class="form-control" type="text">
            <option value='1'>1</option>
            <option value='2'>2</option> 
            <option value='3'>3</option> 
            <option value='4'>4</option> 
            <option value='5'>5</option>
            <option value='6'>6</option> 
            <option value='7'>7</option> 
            <option value='8'>8</option> 
            <option value='9'>9</option> 
            <option value='10'>10</option> 
        </select>
    </td>
    <td colspan="2" style="text-align:center">
            <button
                type="submit"
                class="btn btn-primary-orange2 btn-block"
                name="submit"
                >Inscription Rapide Cash
            </button>
    </td>
</form>
</table>

<table>
<form method="post">
    <th>Joueur</th>
    <td>
    <?php
    // $membres = mysqli_query($con, "SELECT `id-membre`,`pseudo` FROM `membres` ORDER BY `pseudo` ASC");
    $membres = mysqli_query($con, "SELECT `id-membre`,`pseudo` FROM `membres` ORDER BY `pseudo` ASC ");
    echo "<align='center' class='rougesurblanc'><select name=membresup><option value='-Anonyme-'>--> Pseudo IcI <--";
    while ($choix = mysqli_fetch_assoc($membres))
       {		  
	   $listepseudo = $choix['membres.pseudo'] ; 
       echo "<option value={$choix["id-membre"]}>{$choix["pseudo"]}\n";   
       };
	   echo "</select>";
	    ?>
        </td>
    <th>Activité</th>
    <td>
    <?php
    $acti = mysqli_query($con, "SELECT `id-activite`,`titre-activite`,`date_depart` FROM `activite` WHERE (`id-membre` = 2 AND `date_depart` >= '$actu2') ORDER BY `id-activite` ASC");
    echo "<align='center' class='rougesurblanc'><select name=actisup><option value='-Anonyme-'>--> Titre IcI <--";
    while ($choix = mysqli_fetch_assoc($acti))
       {		  
	   $liste = $choix['titre-activite'] ; 
       echo "<option value={$choix["id-activite"]}>{$choix["titre-activite"]}\n";   
       }
	   echo "</select>";
	    ?>
    </td>
    <?php echo "->". $_POST['actisup']."<-";?>
    <td colspan="2" style="text-align:center">
            <button
                type="submit"
                class="btn btn-primary-orange2 btn-block"
                name="submitsupc"
                >Suppression Rapide Cash
            </button>
    </td>
</form>
</table>

<?php
?>
<!-- <script type="text/javascript">window.location.replace("<?php echo $source.$id_activite; ?>")</script>   -->