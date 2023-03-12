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
  $query = "SELECT * FROM patient WHERE nompat LIKE '%$search%'";
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
    <title>Liste patients</title>
</head>

<body >
    <div
        style="display: flex; align-items: center;justify-content: center;margin-top: 70px; ">
        <img height="60px" width="200px" src="logoHB .png" alt="logo">
    </div>
    <div class="container spacer col-md-12 col-md-offset-1 "  >

        <!-- <nav class="bg-light"  >
         <form  style="margin-top:70px" action="" method="post">
                <input type="text" class="" name="search" placeholder="" value="<?php //echo $search; ?>">
                <button type="submit">Rechercher</button>
            </form>
        </nav> -->

        <div class="card"  >
            <div class="card-header align-items-center d-flex justify-content-between">
                <div>Liste patients</div>
                <div>
                    <form action="" method="post">
                        <input type="text" class="" name="search" placeholder="" value="<?php echo $search; ?>">
                        <button type="submit">Rechercher</button>
                    </form>
                </div>
            </div>
            <div class="panel-body fade-in col-12" id="info"  onload=showElement() >
                <table class="table table-hover col-12 table-bordered  ">
                    <thead>
                        <th class="text-center">Numero CE</th>
                        <th>Nom</th>
                        <th>Prénom.s</th>
                        <th title="Année/Mois/Jour">Date de naissance</th>
                        <th>Sexe</th>
                        <!-- <th>Lieu de naissance</th> -->
                        <th>Fonction</th>
                        <!-- <th>Téléphone</th>
                        <th>Adresse mail</th> -->
                        <th>Voir dossier</th>
                        <th>Edition</th>
                        <!-- <th>Suppression</th> -->
                    </thead>

                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr style="max-height: 200px; overflow-y: auto;">
                        <td class="text-center">
                            <a  href='infop.php?id=<?php echo $row['idpat']; ?>' class='text-center' style='text-decoration:none; color: black'><?php echo $row['numCE']; ?></a>
                        </td>
                        <td>
                            <?php echo $row['nompat']; ?>
                        </td>
                        <td>
                            <?php echo $row['pnompat']; ?>
                        </td>
                        <td>
                            <?php $date=$row['datnaisspat']; echo date("d/m/Y", strtotime($date)) ; ?>
                        </td>
                        <td>
                            <?php echo $row['sexpat']; ?>
                        </td>
                        <!-- <td>
                            <?php //echo $row['lieunaisspat']; ?>
                        </td> -->
                        <td>
                            <?php echo $row['fonctionpat']; ?>
                        </td>
                        <!-- <td>
                            <?php //echo $row['telpat']; ?>
                        </td> -->
                        <!-- <td>
                            <?php //echo $row['mailpat']; ?>
                        </td> -->
                        <td><a  href='infop.php?id=<?php echo $row['idpat']; ?>' class='text-center btn btn-warning col-md-12' style='text-decoration:none; color: black'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                            <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z"/>
                        </svg></a></td>
                        <td class='text-center' ><a href='edit.php?id=<?php echo $row['idpat']; ?>' class='btn btn-primary'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg></a>
                        <a href='delete.php?id=<?php echo $row['idpat']; ?>' class='btn btn-danger' onclick ='return confirmation();'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg></a>
                        </td>

                        <!-- <td><a href='delete.php?id=<?php //echo $row['idpat']; ?>' class='btn btn-danger' onclick ='return confirmation();'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg></a></td> -->
                        
                    </tr>
                    <?php } ?>

                <script>
                    function confirmation() {
                        return confirm("Voulez-vous réelement procéder à la suppression ?")
                    }
                </script>

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