<?php require_once 'index.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouté</title>
</head>
<body>
    <div class="container mt-5" >
      <div class="alert alert-danger" role="alert" style="margin-top:100px;">
        <h4 class="alert-heading">Erreur lors de l'enregistrement !</h4>
        <!-- <p>
          <i class="fas fa-check fa-2x"></i>
        </p> -->
        <p>
            <li>Vérifiez le <b>numéro clinique</b> saisi</li>
            <li>Vérifiez la <b>date de naissance</b> saisie</li>
            <li>Vérifiez dans la <b>Liste des patients</b> si votre enregistrement n'existe pas déja</li>
            <br><br>
            Si le problème persiste prière contacter votre administrateur. 
        </p>
      </div>
    </div>
    <div style="display:flex ; align-items:center; justify-content:space-around;" class="col-md-12">
        <a class="card text-center" href="ajoutp.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
           Ajouter un patient
        </a>
        <a class="card text-center" href="affp.php" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
           Liste des patients
        </a>
        <a class="card text-center" href="" style="width: 10rem;height:10rem;padding-top:60px; text-decoration:none;">
           Ajouter des analyses pour "Nom du patient"
        </a>
    </div>
</body>
</html>