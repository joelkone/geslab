<!DOCTYPE html>
<html>
<head>
	<title>Diagramme circulaire Bootstrap</title>
	<!-- Liens Bootstrap et Chart.js -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>
<body>

<?php
require_once 'header.php';
// Connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "geslab";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour compter le nombre de personnes de chaque sexe
$sql_sexe = "SELECT sexpat, COUNT(*) as nb_personnes FROM patient GROUP BY sexpat";
$result_sexe = $conn->query($sql_sexe);

$nb_hommes = 0;
$nb_femmes = 0;
$nb_autres = 0;

if ($result_sexe->num_rows > 0) {
    while ($row_sexe = $result_sexe->fetch_assoc()) {
        switch ($row_sexe["sexpat"]) {
            case "Masculin":
                $nb_hommes = $row_sexe["nb_personnes"];
                break;
            case "Feminin":
                $nb_femmes = $row_sexe["nb_personnes"];
                break;
            default:
                $nb_autres += $row_sexe["nb_personnes"];
                break;
        }
    }
}

$conn->close();
?>

<!-- Affichage du diagramme circulaire Bootstrap -->
<div style="display: flex; align-items: center;justify-content: center;margin-top: 70px; ">
        <img height="60px" width="200px" src="logoHB .png" alt="logo">
    </div>
<div class="container " >
	<h2>Statistique des données par sexe</h2>
	<canvas id="myChart" style="width: 700px; height: 300px"></canvas>
</div>

<!-- Script pour générer le diagramme circulaire à l'aide de Chart.js -->
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Hommes", "Femmes", "Autres"],
        datasets: [{
            label: 'Nombre de personnes',
            data: [<?php echo $nb_hommes; ?>, <?php echo $nb_femmes; ?>, <?php echo $nb_autres; ?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    
});
</script>

</body>
</html>