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
$id = $_GET['id'];


// Selction des donnees 
$result = $conn->query("SELECT * FROM patient WHERE idpat=$id");
$row = $result->fetch_assoc();


//Verif si le form est valide
if (isset($_POST['maj'])) {
    // MAJ DB
        $num = mysqli_real_escape_string($conn, $_POST['num']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $pnom = mysqli_real_escape_string($conn, $_POST['pnom']);
        $sexe = mysqli_real_escape_string($conn, $_POST['sexe']);
        $nais = mysqli_real_escape_string($conn, $_POST['nais']);
        $lnais = mysqli_real_escape_string($conn, $_POST['lnais']);
        $fonc = mysqli_real_escape_string($conn, $_POST['fonc']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $maill = mysqli_real_escape_string($conn, $_POST['maill']);
        $sql = "UPDATE patient SET nompat='$nom',pnompat='$pnom',sexpat='$sexe', datnaisspat='$nais',lieunaisspat='$lnais',fonctionpat='$fonc',telpat='$tel',mailpat='$maill' WHERE idpat=$id";
        mysqli_query($conn,$sql);

    // Redirection
    if(mysqli_query($conn,$sql)){
        require_once 'goodUpdate.php';
        require_once 'affp.php';
        exit();
        //echo 'good';
        //header('Location: goodUpdate.php');
    }
    else{
        echo 'bad';
        //header("Location: badUpdate.php");
    }
    
}
// Fermetture BD
$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./Style/bootstrap-cerulean.min.css"> -->
    <link rel="stylesheet" href="Style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Modifier les données du patient</title>
</head>
<body>
<div
        style="display: flex; align-items: center;justify-content: center;margin-top: 70px; ">
        <img height="60px" width="200px" src="logoHB .png" alt="logo">
    </div>
<div class="container col-md-6 col-md-offset-3 ">
        <div class="card">
            <div class="card-header">Modification</div>
            <div class="panel-body" style="padding-right:30px; padding-left: 30px;">
                <form action ="" method="post">
                <div class="form-group col-md-12 ">
                        <!-- <label for="" class="control-label">Identifiant</label> -->
                        <input type="hidden" class="form-control" value="<?php echo $row['idpat'];?>" readonly>
                    </div>
                    <div class="form-group col-md-12 col-md-offset-0">
                        <label for="" class="control-label">Numéro Clinique</label>
                        <input type="text" name="num"  class="form-control"  maxlength="7" minlength="7" placeholder="Ex. 2200001"  value="<?php echo $row['numCE'];?> " readonly>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Nom</label>
                            <input type="text" name="nom" class="form-control"  required value="<?php echo $row['nompat'];?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Prénom.s</label>
                            <input type="text" name="pnom" class="form-control" required value="<?php echo $row['pnompat'];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Sexe</label>
                            <select class=" form-control " aria-label="Default select example" name="sexe" required>
                                <option value="<?php echo $row['sexpat'];?>" > <?php echo $row['sexpat']; ?> </option>
                                <option value="Feminin" >Feminin</option>
                                <option value="Masculin" >Masculin</option>
                                <option value="Autres" >Autre</option>
                              </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label ">Date de naissance</label>
                            <input type="date" name="nais" required class="form-control" required value="<?php echo $row['datnaisspat'];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label" >Lieu de naissance</label>
                            <input type="text" name="lnais" class="form-control" required value="<?php echo $row['lieunaisspat'];?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Fonction du patient</label>
                            <input type="text" name="fonc" class="form-control" value="<?php echo $row['fonctionpat'];?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="control-label">Téléphone</label>
                            <input type="text" name="tel" class="form-control" value="<?php echo $row['telpat'];?>">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="" class="control-label">Adresse mail</label>
                            <input type="email" name="maill" class="form-control" value="<?php echo $row['mailpat'];?>" >
                        </div>
                    </div><br><br>

                    <!-- <input type="submit" class="btn btn-success" name="valider" value="Add"> -->
                    <button class="btn btn-success" name="maj" type="submit">Mettre à jour</button>
                    <a class="btn btn-danger" href='affp.php' >Annuler</a> <br><br>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

