    <?php
//     session_start();
//   if(@$_SESSION["autoriser"]!="oui"){
//       header("location:/pdo/login.php");
//       exit();
//   }
    require_once 'header.php';
    require_once 'style.php';
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "geslab";
    $conn = mysqli_connect($host, $user, $password, $dbname);
    if (!$conn) {
        die("Erreur connexion: " . mysqli_connect_error());
    }
    $num = "";
    $nom = "";
    $pnom = "";
    $sexe ="";
    $nais = "";
    $lnais = "";
    $fonc = "";
    $tel = "";
    $maill = "";
    if(isset($_POST['add'])){
        // Récupération des données du formulaire
        $num = mysqli_real_escape_string($conn, $_POST['num']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $pnom = mysqli_real_escape_string($conn, $_POST['pnom']);
        $sexe = mysqli_real_escape_string($conn, $_POST['sexe']);
        $nais = mysqli_real_escape_string($conn, $_POST['nais']);
        $lnais = mysqli_real_escape_string($conn, $_POST['lnais']);
        $fonc = mysqli_real_escape_string($conn, $_POST['fonc']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $maill = mysqli_real_escape_string($conn, $_POST['maill']);

        $now = new DateTime();
        $anniversaire = new DateTime($nais);
        $age = $now->diff($anniversaire)->y;
        // $age = DATEDIFF(CURRENT_DATE(), date_naissance) / 365;
        
        // Préparation de la requête d'insertion
        $query = "INSERT INTO patient (numCE, nompat, pnompat, sexpat, datnaisspat, lieunaisspat, fonctionpat, telpat, mailpat,datenrpat,age) VALUES ('$num', '$nom', '$pnom', '$sexe', '$nais', '$lnais', '$fonc', '$tel', '$maill', NOW(),$age)";
        
        //Exécution de la requête
        //mysqli_query($conn, $query);
        
        if (mysqli_query($conn, $query)) {
            //echo 'good';
            require_once 'goodAjout.php';
            //require_once 'ajoutp.php';
            //exit();
            // header('Location: goodAjout.php');
            //header("Location: affp.php");
            // echo '<script>
            //   function showNotification(message) {
            //     var notification = document.createElement("div");
            //     notification.innerHTML = message;
            //     notification.style.backgroundColor = "#4CAF50";
            //     notification.style.color = "white";
            //     notification.style.padding = "10px";
            //     notification.style.position = "fixed";
            //     notification.style.top = "10px";
            //     notification.style.right = "10px";
            //     notification.style.zIndex = "1";
            //     document.body.appendChild(notification);
            //     setTimeout(function() {
            //       notification.style.display = "none";
            //     }, 5000);
            //   }
            //   showNotification("Enregistrement réussi");
            // </script>';
          }
          else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            // require_once 'badAjout.php';
            // exit();
            }
            //require_once 'badAjout.php';
            //require_once 'ajoutp.php';
            //exit();
            //echo "Error: " . $query . "<br>" . mysqli_error($conn);
            //exit;
            // echo '<script>
            //   function showNotification(message) {
            //     var notification = document.createElement("div");
            //     notification.innerHTML = message;
            //     notification.style.backgroundColor = "red";
            //     notification.style.color = "white";
            //     notification.style.padding = "10px";
            //     notification.style.position = "fixed";
            //     notification.style.borderRadius = "10px";
            //     notification.style.top = "80px";
            //     notification.style.right = "10px";
            //     notification.style.zIndex = "1";
            //     document.body.appendChild(notification);
            //     setTimeout(function() {
            //       notification.style.display = "none";
            //     }, 5000);
            //   }
            //   showNotification("Erreur A00001Ed");
            // </script>';
        // Erreur A00001E
        //mysqli_query($conn, $query);
    }
    //header("Location: affp.php");
    ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./Style/bootstrap-cerulean.min.css">
    <link rel="stylesheet" href="./Style/style.css"> -->
    <title>Ajout</title>
</head>

<body style="font-size: ">
    <div
        style="display: flex; align-items: center;justify-content: center;margin-top: 70px; ">
        <img height="60px" width="200px" src="logoHB .png" alt="logo">
    </div>
    <div class="container col-md-6 col-md-offset-3 fade-in"  id="info"  onload=showElement() >
        <div class="card">
            <div class="card-header">Ajouter un nouveau patient</div>
            <div class="panel-body" style="padding-right:30px; padding-left: 30px;">
                <form action="" method="post" id="form">
                    <div class="form-group col-md-12 col-md-offset-0">
                    <br><br>    
                    <label for="" class="control-label">Numéro Clinique</label>
                        <input type="text" name="num" id="name" class="form-control" maxlength="7" minlength="7" 
                            placeholder="Ex. 2200001" pattern=[2]{1}[2]{1}[0-9]{5} required>
                    </div>
                    <div id="look">
                        Ce numéro clinique est déja utilisé !
                    </div>
                    <div id="looks">
                        Vous pouvez utiliser ce numero !
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Nom</label>
                            <input type="text" name="nom"  class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Prénom.s</label>
                            <input type="text" name="pnom" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Sexe</label>
                            <select class=" form-control " aria-label="Default select example" name="sexe" required>
                                <option value="nothing" name="sexe">Selectionner le sexe</option>
                                <option value="Feminin">Feminin</option>
                                <option value="Masculin">Masculin</option>
                                <option value="Autres">Autre</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label ">Date de naissance</label>
                            <input type="date" name="nais"  required class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Lieu de naissance</label>
                            <input type="text" name="lnais"  class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="control-label">Fonction du patient</label>
                            <input type="text" name="fonc"  class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="" class="control-label">Téléphone</label>
                            <input type="text" name="tel"  class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label for="" class="control-label">Adresse mail</label>
                            <input type="email" name="maill"  class="form-control">
                        </div>
                    </div> <br><br>
                    <!-- <input type="submit" class="btn btn-success" name="valider" value="Add"> -->
                    <div class="text-center">
                    <button class="btn btn-success add" name="add" type="submit">Enregistrer</button>
                    <button class="btn btn-danger" name="annuler" type="reset">Annuler</button><br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script >

// function showNotification(message) {
//   // Créer un élément div pour la notification
//   var notification = document.createElement("div");
//   notification.innerHTML = message;
//   notification.style.backgroundColor = "#4CAF50";
//   notification.style.color = "white";
//   notification.style.padding = "10px";
//   notification.style.position = "fixed";
//   notification.style.top = "10px";
//   notification.style.right = "10px";
//   notification.style.zIndex = "1";

//   // Ajouter la notification à la page
//   document.body.appendChild(notification);

//   // Supprimer la notification après 5 secondes
//   setTimeout(function() {
//     notification.style.display = "none";
//   }, 5000);
// }

// Exemple d'utilisation de la fonction showNotification()
// Supposons que la donnée ait été correctement enregistrée sur le serveur
//showNotification("Donnée enregistrée avec succès");

// function showNotification(message) {
//   // Code pour afficher une notification ...
// }

// var form = document.getElementById("form");
// form.addEventListener("submit", function(event) {
//   event.preventDefault();

//   // Envoyer une requête AJAX pour enregistrer la donnée
//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "ajoutp.php", true);
//   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//   xhr.onreadystatechange = function() {
//     if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
//       // Traiter la réponse renvoyée par le script PHP
//       if (this.responseText === "success") {
//         showNotification("Donnée enregistrée avec succès");
//       }
//       else {
//         showNotification("Erreur lors de l'enregistrement de la donnée");
//       }
//     }
//   };
//   xhr.send(form.serialize());
// });

    //verification en temps reel du numéro clinique  
  var look = document.getElementById("look");
  //var looks = document.getElementById("looks");
  look.style.display="none";
  looks.style.display="none";
  var nameInput = document.getElementById("name");
  nameInput.addEventListener("keyup", checkName);
  function checkName() {
    var name = nameInput.value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "exists") {
          
          look.style.display="block";
          look.style.color="red";
        }
        else{
          look.style.display="none";
        //   look.style.display="block";
        //   look.style.color="green";
        }
      }
    };
    xhttp.open("GET", "checkName.php?name="+name, true);
    xhttp.send();
  }
  console.log(nameInput.addEventListener("keyup", checkName))    
  </script>
  <script>
    function showElement() {
      var hiddenElement = document.getElementById("info");
      //hiddenElement.style.display = "block";
      hiddenElement.classList.add("show");
    }

    setTimeout(showElement, 900);
    // $(document).ready(function() {
    //   $('#table').hide().fadeIn(2000);
    // });
</script>
</body>
</html>