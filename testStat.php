<!DOCTYPE html>
<html>
<head>
	<title>Geslab - Bilan par type analyses</title>
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
$sql_sexe = "SELECT idtypana, COUNT(*) as typana 
FROM faireanalyses 
INNER JOIN analyses ON faireanalyses.idana = analyses.idana 
GROUP BY idtypana
";
$result_sexe = $conn->query($sql_sexe);

$hema = 0;
$para = 0;
$bio = 0;
$bacterio = 0;
$virolo = 0;
$immuno = 0;
$bacterio_virolo = 0;
$autre = 0;


if ($result_sexe->num_rows > 0) {
    while ($row_sexe = $result_sexe->fetch_assoc()) {
        switch ($row_sexe["idtypana"]) {
            case "1":
                $hema = $row_sexe["typana"];
                break;
            case "2":
                $para = $row_sexe["typana"];
                break;
            case "3":
                $bio = $row_sexe["typana"];
                break;
            case "4":
                $bacterio = $row_sexe["typana"];
                break;
            case "5":
                $virolo = $row_sexe["typana"];
                break;
            case "6":
                $immuno = $row_sexe["typana"];
                break;
            case "7":
                $bacterio_virolo = $row_sexe["typana"];
                break;
            default:
                $autre += $row_sexe["typana"];
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
	<!-- <h2>Données statistique des analyses classé par types d'analyses</h2> -->
	<canvas id="myChart" style="width: 700px; height: 300px"></canvas>
</div>

<!-- Script pour générer le diagramme circulaire à l'aide de Chart.js -->
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Hémathologie", "Parasitologie","Biologie","Immunologie","Bacterio-virologie", "Autres"],
        datasets: [{
            label: 'Nombre d\'analyses réalisées',
            data: [<?php echo $hema; ?>, <?php echo $para; ?>, <?php echo $bio; ?>,<?php echo $immuno; ?>,<?php echo $bacterio_virolo; ?>,<?php echo $autre; ?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                
                'rgba(184, 255, 51, 0.2)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(82, 23, 168, 0.62)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(184, 255, 51, 1)',
                'rgba(255, 20, 86, 1)',
                'rgba(255, 40, 86, 1)',
                'rgba(255, 60, 86, 1)',
                'rgba(255, 80, 86, 1)'
            ],
            borderWidth: 1
        }]
    },
    
});
</script>
<div class="container " >
	<h2 class ="text-center underline">Diagramme des types d'analayses effectuées</h2>
	<canvas id="myChart" style="width: 700px; height: 300px"></canvas>
</div>
</body>
</html>