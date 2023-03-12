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
      die("Erreur de connexion: " . mysqli_connect_error());
  }
  //$inputData = '';
  if (isset($_POST["btn"])) {
      $inputData = $_POST["text"];
  }
  @$inputData = $_POST["text"];
  $query = "SELECT * FROM patient WHERE numCE = $inputData";

  $result = mysqli_query($conn, $query);
  //var_dump($result);
  //mysqli_stmt_bind_param($stmt, "s", $inputData);
  //mysqli_stmt_execute($stmt);
  
  //$result = mysqli_stmt_get_result($stmt);
  if ($result) {
      $row = mysqli_fetch_array($result);
    //   echo "id: " . $row["idpat"] . " - Name: " . $row["nompat"] . " - Email: " . $row["mailpat"] . "<br>";
  } else {
      //echo "0 resultat";
  }
//   requete pour liste analyse
  $reqAna = "SELECT * FROM analyses ORDER BY desana ASC";

  $resReqAna = mysqli_query($conn,$reqAna);
//   requete pour resultat
  $reqResultat = "SELECT * FROM resultat";
  $resReqResultat = mysqli_query($conn,$reqResultat);

//   requete pour liste medecin
  $reqMed = "SELECT * FROM consultant ORDER BY nomcons ASC";
  $resReqMed = mysqli_query($conn,$reqMed);
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
    </style>
    <title>Liste patients</title>
</head>

<body>
    <div style="display: flex; align-items: center;justify-content: center;margin-top: 70px; ">
        <img height="60px" width="200px" src="logoHB .png" alt="logo">
    </div>
    <div class="container spacer col-md-11 col-md-offset-1 ">
        <div class="card">
            <div class="card-header align-items-center d-flex justify-content-between">
                <div>ANALYSES</div>
                <div>
                    <form action="" method="post">
                        <input type="hidden" name="form" value="recherche">
                        <input type="text" name="text" id="inputData" value="<?php echo $inputData;?>">
                        <input type="button" name="btn" value="valider" id="submitBtn">
                    </form>
    
                </div>
            </div>
        <div style="padding-right:30px; padding-left: 30px;">
            
            <form action="insertana.php" method="post" class="mt-2" >
                <div class="row" style="padding-right:315px; padding-left: 315px;">
                <div class="form-group text-center">
                
                <!-- <input type="hidden" name="idpat"  class="form-control" readonly value=<?php //if(isset($row['idpat'])){echo $row['idpat'];} else{echo '';} ?>> -->
                    <label for="" class="control-label"></label>
                    <input type="text" name="num[]" required class="form-control text-center" readonly value=<?php if(isset($row["numCE"])){echo $row["numCE"];} else{echo '';} ?>>
                </div>
                </div>
                <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="" class="control-label">Nom</label>
                    <input type="text" name="nom"  class="form-control" readonly value=<?php if(isset($row['nompat'])){echo $row['nompat'];} else{echo '';} ?>>
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="control-label">Prénom(s)</label>
                    <input type="text" class="form-control" readonly value=<?php if(isset($row['pnompat'])){echo $row['pnompat'];} else{echo '';} ?>>
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="control-label">Sexe</label>
                    <input type="text" class="form-control" readonly value=<?php if(isset($row['sexpat'])){echo $row['sexpat'];} else{echo '';} ?>>
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="control-label">Date de naissance</label>
                    <input type="text" class="form-control" readonly value=<?php if(isset($row['datnaisspat'])){$date=$row['datnaisspat']; echo date("d/m/Y", strtotime($date)) ;} else{echo '';} ?>>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="" class="control-label">Âge</label>
                    <input type="text" class="form-control" readonly value=<?php if(isset($row['age'])){echo $row['age'].' ans';} else{echo '';} ?>>
                </div>
                <div class="form-group col-md-6">
                <label for="" class="control-label">Renseignement clinique</label>
                    <input type="text" class="form-control" readonly >
                </div>
            </div>
            <hr>
        <!-- <div>
            <div class="text-center">
                <p style="color:red;"><b>Important:</b>  Veuillez à entrer le numéro clinique du patient avant tout enregistrement</p>
            </div>
            <div class="row" >
                <div class="form-group col-md-3" >
                <label for="" class="control-label">Date de l'analyse</label>
                    <input type="date" id="todayDate" name="datexec"  class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                <label for="" class="control-label">Sélectionner analyse</label>
                    <select name="analyse" id="" class="form-control" required>
                        <option value="">Aucune sélection</option>
                                <?php
                                  
                                //    while ($rows = mysqli_fetch_row($resReqAna)){
                                //            echo "<option value='$rows[0]'>$rows[1]</option>";
                                //    }
                                ?>
                    </select>
                </div>
                
                <div class="form-group col-md-3">
                <label for="" class="control-label">Médecin Traitant</label>
                    <select name="med" id="" class="form-control" required>
                        <option value="">Aucune selection</option>
                        <?php
                        // while ($rows = mysqli_fetch_row($resReqMed)){

                        //     echo "<option value='$rows[0]'>$rows[1] $rows[2]</option>";
                        // }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                <label for="" class="control-label">Résultat</label>
                <input type="text" name="resultat" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <label for="" class="control-label">Commentaire</label>
                <textarea placeholder="Veuillez inserer un commentaire pour plus de précision" id="" cols="30" rows="5" class="form-control" name="commentaire" required></textarea>
                </div>
            </div>    
        </div> -->

        <!-- Le bouton pour dupliquer le bloc -->

        <button class="btn btn-primary " id="duplicateButton">Ajouter une nouvelle ligne</button>
<!-- Le premier bloc -->
<div class="text-center">
  <p style="color:red;"><b>Important:</b>  Veuillez à entrer le numéro clinique du patient avant tout enregistrement</p>
</div>
<div id="original">
  <div class="row">
  <div class="form-group col-md-3" >
  <input type="hidden" name="idpat[]"  class="form-control" readonly value=<?php if(isset($row['idpat'])){echo $row['idpat'];} else{echo '';} ?>>
                <label for="" class="control-label">Date de l'analyse</label>
                    <input type="date" id="todayDate" name="datexec[]" class="form-control" >
                </div>
                <div class="form-group col-md-3">
                <label for="" class="control-label">Sélectionner analyse</label>
                    <select name="analyse[]" id="" class="form-control" required>
                        <option value="">Aucune sélection</option>
                                <?php
                                  
                                   while ($rows = mysqli_fetch_row($resReqAna)){
                                           echo "<option value='$rows[0]'>$rows[1]</option>";
                                   }
                                ?>
                    </select>
                </div>
                
                <div class="form-group col-md-3">
                <label for="" class="control-label">Médecin Traitant</label>
                    <select name="med[]" id="" class="form-control" required>
                        <option value="">Aucune selection</option>
                        <?php
                        while ($rows = mysqli_fetch_row($resReqMed)){

                            echo "<option value='$rows[0]'>$rows[1] $rows[2]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                <label for="" class="control-label">Résultat</label>
                <input type="text" name="resultat[]" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <label for="" class="control-label">Commentaire</label>
                <textarea placeholder="Veuillez inserer un commentaire pour plus de précision" id="" cols="30" rows="3" class="form-control" name="commentaire[]" required></textarea>
                </div>
            </div>    
            <hr style="color:red;font-weight:bold">
  </div>
</div>

<!-- JavaScript pour dupliquer et supprimer les blocs -->
<script>
  // Fonction pour dupliquer le bloc
  function duplicateBlock() {
    // Cloner le premier bloc
    var original = document.getElementById("original");
    var clone = original.cloneNode(true);
    
    // Ajouter un bouton pour supprimer le bloc dupliqué
    var removeButton = document.createElement("button");
    removeButton.innerHTML = "<span class='btn btn-primary'>Supprimer</span>";
    removeButton.onclick = function() {
      this.parentNode.remove();
    };
    clone.appendChild(removeButton);
    
    // Ajouter le bloc dupliqué à la suite du premier bloc
    original.parentNode.appendChild(clone);
  }
  
  // Ajouter un écouteur d'événement au bouton pour dupliquer le bloc
  var duplicateButton = document.getElementById("duplicateButton");
  duplicateButton.onclick = duplicateBlock;
</script>


            <br><br>
            <div class="text-center">
                <button class="btn btn-success add" name="addmyana" id="addmyana" type="submit">Enregistrer</button>
                <a class="btn btn-danger" href="ajoutp.php" name="annuler" >Annuler</a> <br><br>
            </div>
        </form>

            </div>

                <!-- Affiche si la donnee existe dans la BD -->
            <!-- <div class="panel-body">

                <div id="ajoutAn" style="display:none;">
                    <?php
                    // if (isset($_POST["btn"])) {
                    //     $inputData = $_POST["text"];
                    // }
                    // $inputData = $_POST["text"];
                    // $query = "SELECT * FROM patient WHERE numCE = ?";
                  
                    // $stmt = mysqli_prepare($conn, $query);
                    // mysqli_stmt_bind_param($stmt, "s", $inputData);
                    // mysqli_stmt_execute($stmt);
                    //     $result = mysqli_stmt_get_result($stmt);
                    //     if (mysqli_num_rows($result) > 0) {
                    //         $row = mysqli_fetch_assoc($result);
                    //         echo "id: " . $row["idpat"] . " - Name: " . $row["nompat"] . " - Email: " . $row["mailpat"] . "<br>";
                    //     } else {
                    //         echo "0 resultat";
                            
                    //     }
                    ?>
                </div> -->
                <!-- <div id="nothing" style="display:none;">
                    Valeur innexistante
                </div> -->
            </div>
            
        </div>
    </div>

</body>

<!-- <script>
    $(document).ready(function() {
  $("#submitBtn").click(function(e) {
    e.preventDefault();
    var inputData = $("#inputData").val();

    $.ajax({
      url: "checkData.php",
      type: "post",
      data: { inputData: inputData },
      success: function(response) {
        if (response == "exists") {
            $("#ajoutAn").show();
            $("#nothing").hide();
        } else {
            $("#ajoutAn").hide();
            $("#nothing").show();
        }
      }
    });
  });
});
</script> -->
<script>
    var look = document.getElementById("look");
  //var looks = document.getElementById("looks");
  look.style.display="none";
  looks.style.display="none";
  var nameInput = document.getElementById("inputData");
  nameInput.addEventListener("input", checkName);
  function checkName() {
    var name = nameInput.value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "exists") {
          
          look.style.display="block";
          //look.style.color="red";
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
  console.log(nameInput.addEventListener("input", checkName))    
  </script>
  
  <script>
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); 
  var yyyy = today.getFullYear();

  today = yyyy + '-' + mm + '-' + dd;
  document.getElementById("todayDate").value = today;
</script>

</html>