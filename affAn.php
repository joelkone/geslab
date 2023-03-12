<?php
// session_start();
// if(@$_SESSION["autoriser"]!="oui"){
//     header("location:/pdo/login.php");
//     exit();
// }
  require_once 'header.php';
  require_once 'style.php';

  $host = "localhost";
  $user = "root";
  $password = "";
  $dbname = "geslab";
  $conn = mysqli_connect($host, $user, $password, $dbname);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  $search = '';
  if (isset($_POST['search'])) {
      $search = $_POST['search'];
  }
  $query ="SELECT DISTINCT * FROM faireanalyses INNER JOIN patient ON faireanalyses.idpat = patient.idpat INNER JOIN analyses ON faireanalyses.idana = analyses.idana INNER JOIN consultant ON faireanalyses.idcons = consultant.idcons ORDER BY datenrg DESC LIMIT 100";
  

  $result = mysqli_query($conn, $query);

  
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
        body{
            background-color: whitesmoke;
        }
        
    </style>
    <title>Liste des analyses éffectuées</title>
</head>

<body >
    <div
        style="display: flex; align-items: center;justify-content: center;margin-top: 70px; ">
        <img height="60px" width="200px" src="logoHB .png" alt="logo">
    </div>
    <div class="container spacer col-md-12 col-md-offset-1">

        <div class="card"  >
            <div class="card-header align-items-center d-flex justify-content-between">
                <div>Liste des analyses éffectuées</div>
                <div>
                    <form action="" method="post">
                        <input type="text" class="" name="search" placeholder="" value="<?php echo $search; ?>">
                        <button type="submit">Rechercher</button>
                    </form>
                </div>
            </div>
            <div class="panel-body fade-in" id="info"  onload=showElement() >
                <table class="table table-hover table-bordered  ">
                    <thead>
                        <th>Numero Clinique</th>
                        <th>Nom</th>
                        <th>Prénom.s</th>
                        <th>Analyse</th>
                        <th>Résultat</th>
                        <th>Commentaire</th>
                        <th>Medecin traitant</th>
                        <th>Date de l'analyse </th>
                    </thead>

                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr >
                        <td>
                            <?php echo $row['numCE']; ?>
                        </td>
                        <td>
                            <?php echo $row['nompat']; ?>
                        </td>
                        <td>
                            <?php echo $row['pnompat']; ?>
                        </td>
                        <td>
                            <?php echo $row['desana']; ?>
                        </td>
                        <td>
                            <?php echo $row['resultat']; ?>
                        </td>
                        <td>
                            <?php echo $row['commentaire']; ?>
                        </td>
                        <td>
                            <?php echo $row['nomcons'].' '.$row['pnomcons']; ?>
                        </td>
                        <td>
                            <?php echo $row['datenrg']; ?>
                        </td>
                        
                    </tr>
                    <?php } ?>



                </table>
            </div>
        </div>
    </div>


</body>
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
</html>