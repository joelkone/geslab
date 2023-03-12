
<?php
// session_start();
// if(@$_SESSION["autoriser"]!="oui"){
//     header("location:/pdo/login.php");
//     exit();
// }
require_once 'header.php';
$host = "localhost";
$user = "root";
$password = "";
$dbname = "geslab";
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$nbpat = "SELECT COUNT(*) FROM patient";
$nban = "SELECT COUNT(*) FROM faireanalyses";
$res = mysqli_query($conn,$nbpat);
$ress = mysqli_query($conn,$nban);
$patient = "SELECT * FROM patient ORDER BY idpat DESC LIMIT 5
";
$respat = mysqli_query($conn,$patient);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body style='background-color:beige; '>
    <br>
    <div class="d-flex align-items-center justify-content-center mt-5">
        <img class="img-fluid" src="logoHB .png" alt="logo" style="max-height: 60px; max-width: 200px;">
    </div>


    <div class="text-center bg-white py-3 px-4 rounded-lg shadow-lg mx-auto mt-5" style="max-width: 700px;">
        <h2 class="mb-0" style="font-size: 2rem;">Bienvenue <?php echo '<b>'. $_SESSION['nomPrenom'].'</b>' ?></h2>
    </div>


    
    <div class="d-flex justify-content-evenly align-items-center mt-5">
        <div class="bg-white col-12 col-md-4 mx-md-3 mb-4 p-4 rounded-lg" style="max-width: 1000px; height: 350px;font-size:150%">
            <div class="text-center mt-3 py-3 rounded-lg bg-info" >
                <?php if (mysqli_num_rows($res) > 0) {
                        $row = mysqli_fetch_assoc($res);
                        echo "<b><em>".$row["COUNT(*)"]."</em></b>". "<br> Patients enregistrés";
                    } else {
                        echo "0 ";
                    } ?>
            </div>
        <div class="text-center mt-2 py-3 rounded-lg bg-secondary" >
            <?php if (mysqli_num_rows($ress) > 0) {
                    $row = mysqli_fetch_assoc($ress);
                    echo "<b><em>".$row["COUNT(*)"]."</em></b>". "<br> Analyses éffectuées";
                } else {
                    echo "0 ress";
                } ?>
            </div>
            <a href="statsexe.php" style="text-decoration: none; color : white">
                <div class="text-center mt-2 py-3 rounded-lg bg-success" >
                    Présenter les données par sexe.
                </div>
            </a>

        </div>

        <div class="bg-white text-center p-4 rounded-lg" style="max-width: 500px; font-size: 25px;">
            <div class="text-center" style="font-size: 25px;">
                Que voulez-vous faire ?
            </div>

            <div class="d-flex justify-content-around align-items-center my-4">
                <a href="ajoutp.php" class="card btn btn-outline-primary" style=" text-decoration: none;">
                    Ajouter un patient
                </a>
                <a href="ajoutAn.php" class="card btn btn-outline-primary" style=" text-decoration: none;">
                    Ajouter des analyses
                </a>
                <a href="affp.php" class="card btn btn-outline-primary" style=" text-decoration: none;">
                    Rechercher un patient
                </a>
            
            </div>
        </div>
            
        <div class="bg-white rounded-lg p-4 mx-3" style="max-width: 500px;">
            <div class="text-center my-3" style="font-size: 1.5rem;">
                Patients récemment ajoutés</div>
        
                <div class="list-group" style="font-weight: bold;">
                    <?php while ($row = mysqli_fetch_array($respat)) { ?>
                    <a href="infop.php?id=<?php echo $row['idpat']; ?>" class="list-group-item list-group-item-action" style="text-decoration:none; color: black;">
                    <?php echo $row['numCE'] . ' ' . $row['nompat'] . ' ' . $row['pnompat']; ?>
                    </a>
                    <?php } ?>
                </div>
        </div>
    </div>
    
    <!-- <div style="display:flex ; align-items:center; justify-content:space-around;margin-top:10px; " class="col-md-12 mb-5">
                       
            <a class="card text-center btn btn-outline-primary" href="ajoutAn.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Stattistique Générale des analyses
            </a>

            <a class="card text-center btn btn-outline-warning" href="" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Statistique Biochimie
            </a>
            
            <a class="card text-center btn btn-outline-success" href="stat.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Statistique Hématologie
            </a>
            <a class="card text-center btn btn-outline-primary" href="stat.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Statistique Bactério-virologie
            </a>
            <a class="card text-center btn btn-outline-warning" href="stat.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Statistique Parasitologie
            </a>
            <a class="card text-center btn btn-outline-success" href="stat.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Statistique Immunologie
            </a>
            <a class="card text-center btn btn-outline-primary" href="stat.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Statistique Immunologie
            </a>
            <a class="card text-center btn btn-outline-warning" href="stat.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
            Statistique Autres analyses
            </a>
    </div> -->

</body>
</html>