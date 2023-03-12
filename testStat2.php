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
$sql_sexe = "SELECT idana, COUNT(*) as nombre_analyses
FROM faireanalyses
GROUP BY idana";
$result_sexe = $conn->query($sql_sexe);

$HGB = 0;
$HCT = 0;
$TP = 0;
$NFS = 0;
$VS = 0;
$ELECTRO = 0;
$IONO = 0;
$TCA = 0;
$TRANS = 0;
$GS = 0;
$SELLES = 0;
$URINES = 0;
$GE = 0;
$URINES_SUCRE = 0;
$URINES_ALB = 0;
$GLYCEMIE = 0;
$CREATINE = 0;
$UREE = 0;
$GOT = 0;
$GPT = 0;
$CHOL_T = 0;
$ACIDE_U = 0;
$CHOL_HDL = 0;
$TRYG = 0;
$HEMO = 0;
$GLY_R = 0;
$BIO_PRO = 0;
$COL_BK = 0;
$GRAM = 0;
$CULTURE = 0;
$ABG = 0;
$PL = 0;
$CD4 = 0;
$DETERMINE = 0;
$BIOLINE = 0;
$TOXO = 0;
$RPR = 0;
$RUBEOLE = 0;
$WIDAL = 0;
$UCG = 0;
$AGHBS = 0;
$AC_HVC = 0;
$CRP = 0;
$FSA = 0;
$TDR_PALU = 0;
$ASLO = 0;
$SPERMO = 0;


if ($result_sexe->num_rows > 0) {
    while ($row_sexe = $result_sexe->fetch_assoc()) {
        switch ($row_sexe["idana"]) {
            case 2:
                $HGB = $row_sexe["nombre_analyses"];
                break;
            case 3:
                $HCT = $row_sexe["nombre_analyses"];
                break;
            case 4:
                $TP = $row_sexe["nombre_analyses"];
                break;
            case 5:
                $NFS = $row_sexe["nombre_analyses"];
                break;
            case 6:
                $VS = $row_sexe["nombre_analyses"];
                break;
            case 7:
                $ELECTRO = $row_sexe["nombre_analyses"];
                break;
            case 8:
                $IONO = $row_sexe["nombre_analyses"];
                break;
            case 9:
                $TCA = $row_sexe["nombre_analyses"];
                break;
            case 10:
                $TRANS = $row_sexe["nombre_analyses"];
                break;
            case 11:
                $GS = $row_sexe["nombre_analyses"];
                break;
            case 12:
                $SELLES = $row_sexe["nombre_analyses"];
                break;
            case 13:
                $URINES = $row_sexe["nombre_analyses"];
                break;
            case 14:
                $GE = $row_sexe["nombre_analyses"];
                break;
            case 29:
                $URINES_SUCRE = $row_sexe["nombre_analyses"];
                break;
            case 30:
                $URINES_ALB = $row_sexe["nombre_analyses"];
                break;
            case 31:
                $GLYCEMIE = $row_sexe["nombre_analyses"];
                break;
            case 32:
                $CREATINE = $row_sexe["nombre_analyses"];
                break;
            case 33:
                $UREE = $row_sexe["nombre_analyses"];
                break;
            case 34:
                $GOT = $row_sexe["nombre_analyses"];
                break;
            case 35:
                $GPT = $row_sexe["nombre_analyses"];
                break;
            case 36:
                $CHOL_T = $row_sexe["nombre_analyses"];
                break;
            case 37:
                $ACIDE_U = $row_sexe["nombre_analyses"];
                break;
            case 38:
                $CHOL_HDL = $row_sexe["nombre_analyses"];
                break;
            case 39:
                $TRYG = $row_sexe["nombre_analyses"];
                break;
            case 40:
                $HEMO = $row_sexe["nombre_analyses"];
                break;
            case 41:
                $GLY_R = $row_sexe["nombre_analyses"];
                break;
            case 42:
                $BIO_PRO = $row_sexe["nombre_analyses"];
                break;
            case 43:
                $COL_BK = $row_sexe["nombre_analyses"];
                break;
            case 44: 
                $GRAM = $row_sexe["nombre_analyses"];
                break;
            case 45:
                $CULTURE = $row_sexe["nombre_analyses"];
                break;
            case 46:
                $ABG = $row_sexe["nombre_analyses"];
                break;
            case 47:
                $PL = $row_sexe["nombre_analyses"];
                break;
            case 48:
                $CD4 = $row_sexe["nombre_analyses"];
                break;
            case 49:
                $DETERMINE = $row_sexe["nombre_analyses"];
                break;
            case 50:
                $BIOLINE = $row_sexe["nombre_analyses"];
                break;
            case 51:
                $TOXO = $row_sexe["nombre_analyses"];
                break;
            case 52:
                $RPR = $row_sexe["nombre_analyses"];
                break;
            case 53:
                $RUBEOLE = $row_sexe["nombre_analyses"];
                break;
            case 54:
                $WIDAL = $row_sexe["nombre_analyses"];
                break;
            case 55:
                $UCG = $row_sexe["nombre_analyses"];
                break;
            case 56:
                $AGHBS = $row_sexe["nombre_analyses"];
                break;
            case 57:
                $AC_HVC = $row_sexe["nombre_analyses"];
                break;
            case 58:
                $CRP = $row_sexe["nombre_analyses"];
                break;
            case 59:
                $FSA = $row_sexe["nombre_analyses"];
                break;
            case 60:
                $TDR_PALU = $row_sexe["nombre_analyses"];
                break;
            case 61:
                $ASLO = $row_sexe["nombre_analyses"];
                break;
            case 62:
                $SPERMO = $row_sexe["nombre_analyses"];
                break;
            default:
                echo "Rien";
                // $autre += $row_sexe["idana"];
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
        labels: ["HGB", "HCT","TP","NFS","V.S", "ELECTROPHORESE HB", "IONOGRAMME", "TCA", "TRANSFUSION", "GROUPE SANGUIN", "SELLES", "URINES", "GOUTTE EPAISSE", "URINES SUCRE", "URINES ALBUMINE", "GLYCEMIE", "CREATINE", "UREE", "GOT", "GPT", "CHOLESTEROL TOTAL", "ACIDE URIQUE", "CHOLESTEROL HDL", "TRYGLYCERIDE", "HEMOGLOBINE GLYQUEE", "GLYCEMIE RAPIDE", "BIOCHIMIE PROJET", "COLORATION BK", "GRAM", "CULTURE", "ABG", "PL", "CD4", "DETERMINE", "BIOLINE", "TOXOPLASMOSE", "RPR", "RUBEOLE", "WIDAL FELIX", "UCG", "AGHBS", "AC HVC", "CRP", "FSA", "TDR PALU", "ASLO", "SPERMOGRAMME"],
        datasets: [{
            label: 'Nombre d\'analyses réalisées',
            data: [<?php echo $HGB; ?>, <?php echo $HCT; ?>, <?php echo $TP; ?>,<?php echo $NFS; ?>,<?php echo $VS; ?>,<?php echo $ELECTRO; ?>,<?php echo $IONO; ?>,<?php echo $TCA; ?>,<?php echo $TRANS; ?>,<?php echo $GS; ?>,<?php echo $SELLES; ?>,<?php echo $URINES; ?>,<?php echo $GE; ?>,<?php echo $URINES_SUCRE; ?>,<?php echo $URINES_ALB; ?>,<?php echo $GLYCEMIE; ?>,<?php echo $CREATINE; ?>,<?php echo $UREE; ?>,<?php echo $GOT; ?>,<?php echo $GPT; ?>,<?php echo $CHOL_T; ?>,<?php echo $TRYG; ?>,<?php echo $HEMO; ?>,<?php echo $GLY_R; ?>,<?php echo $BIO_PRO; ?>,<?php echo $COL_BK; ?>,<?php echo $GRAM; ?>,<?php echo $CULTURE; ?>,<?php echo $ABG; ?>,<?php echo $PL; ?>,<?php echo $CD4; ?>,<?php echo $DETERMINE; ?>,<?php echo $BIOLINE; ?>,<?php echo $TOXO; ?>,<?php echo $RPR; ?>,<?php echo $RUBEOLE; ?>,<?php echo $WIDAL; ?>,<?php echo $UCG; ?>,<?php echo $AGHBS; ?>,<?php echo $AC_HVC; ?>,<?php echo $CRP; ?>,<?php echo $FSA; ?>,<?php echo $TDR_PALU; ?>,<?php echo $ASLO; ?>,<?php echo $SPERMO; ?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',

                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                
                'rgba(184, 255, 51, 0.2)',
                'rgba(184, 255, 51, 0.2)',
                'rgba(184, 255, 51, 0.2)',
                'rgba(184, 255, 51, 0.2)',
                'rgba(184, 255, 51, 0.2)',


                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',
                'rgba(245, 40, 145, 0.8)',

                'rgba(255, 80, 86, 1)'
            ],
            borderColor: [
                
            ],
            borderWidth: 1
        }]
    },
    
});
</script>

</body>
</html>