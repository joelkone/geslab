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
    die("Erreur connexion : " . mysqli_connect_error());
}

// Recup de l'id
@$id = $_GET['id'];


// Selction des donnees
$queryy = "SELECT * FROM faireanalyses INNER JOIN patient ON faireanalyses.idpat = patient.idpat INNER JOIN analyses ON faireanalyses.idana = analyses.idana INNER JOIN consultant ON faireanalyses.idcons = consultant.idcons WHERE patient.idpat = '$id' "; 
$query = "SELECT * FROM patient WHERE idpat ='$id'";
$result = mysqli_query($conn, $query);
$resultt = mysqli_query($conn, $queryy);
// $row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./Style/bootstrap-cerulean.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Style/style.css">
    <script src="./Script/script.js"></script>
    <style>
        body {
            background-color: whitesmoke;
        }
        input{
            font-weight: bold;
        }
        @media print {
  body {
    font-size: 12pt;
    margin: 5cm;
  }
  h1, h2, h3 {
    page-break-after: avoid;
  }
  p {
    orphans: 3;
    widows: 3;
  }
  table {
    page-break-inside: avoid;
  }
  img {
    max-width: 100%;
  }
  /* Éviter que les images de fond soient imprimées */
  body {
    background-image: none;
  }
  nav{
    display: hidden;
  }
}

    </style>
    <title>Liste patients</title>
</head>

<body>
    <div style="display: flex; align-items: center;justify-content: center;margin-top: 70px;">
        <img height="60px" width="200px" src="logoHB .png" alt="logo">
    </div>
    <div class="container spacer col-md-11 col-md-offset-1 ">
        <div class="card">
            <div class="card-header">
                INFORMATIONS DU PATIENTS
            </div>
        <div style="padding-right:30px; padding-left: 30px;">
            
            <form action="insertana.php" method="post" class="mt-2" >
            <?php 
                    while($row = mysqli_fetch_array($result)){ ?>
            <div class="row" >
                <div class="form-group text-center">
                    <label for="" class="control-label">NUMERO CLINIQUE</label>
                    <input type="text" name="" value="<?php echo $row['numCE'];?>" required class="form-control text-center" readonly >
                </div>
            </div>
                <br>
            <a href="AjouAnInfo.php?num=<?php echo $row['numCE']; ?>" class="btn btn-danger">Ajouter des analyses</a>
            <div style='display: flex; align-items:center; justify-content: space-evenly'>
                <div>
                    <img src="patprofile.png" class="rounded float-start border" style='height: 232px;;width: 260px; margin-top: 15px; padding:60px' alt="...">
                </div>
                
                        
                    
                <div style='width: 900px;'>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Nom</label>
                            <input type="text" name="nom"  class="form-control" value="<?php echo $row['nompat'];?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Prenom</label>
                            <input type="text" name="nom"  class="form-control" value="<?php echo $row['pnompat'];?>" readonly>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Sexe</label>
                            <input type="text" value="<?php echo $row['sexpat'];?>" class="form-control" readonly >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Date de naissance</label>
                            <input type="text" value="<?php $date=$row['datnaisspat']; echo date("d/m/Y", strtotime($date)) ;?>" class="form-control" readonly >
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Lieu de naissance / Ethnie</label>
                            <input type="text" value="<?php echo $row['lieunaisspat'];?>" class="form-control" readonly >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Fonction</label>
                            <input type="text" value="<?php echo $row['fonctionpat'];?>" class="form-control" readonly >
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Téléphone</label>
                            <input type="text" value="<?php echo $row['telpat'];?>" class="form-control" readonly >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Adresse mail</label>
                            <input type="text" value="<?php echo $row['mailpat'];?>" class="form-control" readonly >
                        </div>
                    </div>  
                </div>
            </div> 
        <?php } ?>
        <div class="card-body border mt-2 mb-5" style='background-color: rgb(211, 211, 211)'>
            <h5 class="card-title">ANALYSES REALISEES</h5>
            <div  style="overflow-y:scroll; height: 58px">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-2" style=''>ANALYSE</td>
                        <th class="col-2" style=';'>RESULTAT</th>
                        <th class="col-2" style=';'>COMMENTAIRE</th>
                        <!-- <th style='width:237px;'>COMMENTAIRE</th> -->
                        <th class="col-2" >MEDECIN TRAITANT</th>
                        <th class="col-2" >DATE DE L'ANALYSE</th>
                    </tr>
                </thead>
            </table>
            </div>
            
            <div class="table-responsive try" style="height:200px; overflow-y:scroll;">
                <table class="table table-bordered ">
                    <tbody>
                    <?php 
                        while($row = mysqli_fetch_array($resultt)){ 
                        ?>
                        <tr>
                            <td class="col-2"><?php echo $row['desana'];?></td>
                            <td class="col-2"><?php echo $row['resultat'];?></td>
                            <td class="col-2"><?php echo $row['commentaire'];?></td>
                            <td class="col-2"><?php echo $row['nomcons'].' '.$row['pnomcons'];?></td>
                            <td class="col-2"><?php $date=$row['datexec']; echo date("d/m/Y", strtotime($date)) ;?></td>
                        </tr> 
                        <?php } 
                        if(mysqli_num_rows($resultt) == 0){ 
                            echo "<span class='text-center mt-5'>Aucune analyse enregistrée </span>";
                        }
                        ?>

                        <!-- Ajoutez autant de lignes que nécessaire -->
                    </tbody>
                </table>
            </div>
    </div>
    
 
</body>



</html>