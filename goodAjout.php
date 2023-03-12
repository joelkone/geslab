<?php
// session_start();
// if(@$_SESSION["autoriser"]!="oui"){
//     header("location:/pdo/login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouté</title>
</head>
<body onload="hideDivWithTransition()">
  <div id="monDive">
    <div class="container mt-5" id="monDiv">
      <div class="alert alert-success" role="alert" style="margin-top:100px;">
        <h4 class="alert-heading">Patient ajouté</h4>
        <p>
          <i class="fas fa-check fa-2x"></i>
        </p>
      </div>
    </div>
  </div>
    
</body>
<script>
    function hideDivWithTransition() {
  const div = document.getElementById("monDiv");
  div.style.transition = "ease-out 2s";
  div.style.height = "0px";
  div.style.width = "0px";
  div.style.opacity = "0";
  setTimeout(function() {
    div.style.display = "none";
  }, 2300);
}

</script>
</html>