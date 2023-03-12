<?php
require_once 'header.php';
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "geslab");

// Vérification de la connexion
if ($mysqli->connect_errno) {
	echo "Échec de la connexion : " . $mysqli->connect_error;
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Statistique Générale</title>
	<!-- Inclusion des fichiers CSS de Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container col-md-12" style='margin-top: 100px'>
		<h1>Statistiques pour la BIOCHIMIE</h1>
		<table class="table table-hover table-bordered ">
			<thead>
				<tr class="text-center">
                <th>Mois</th>
					<th>0 à 4 ans</th>
					<th>5 à 9 ans</th>
					<th>10 à 14 ans</th>
					<th>15 à 19 ans</th>
					<th>20 à 24 ans</th>
					<th>25 à 29 ans</th>
					<th>30 à 34 ans</th>
					<th>35 à 39 ans</th>
					<th>40 à 44 ans</th>
					<th>45 à 49 ans</th>
					<th>50 à 54 ans</th>
					<th>55 à 59 ans</th>
					<th>60 ans et plus</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				// Table de correspondance des mois en français
				$mois_fr = array(
					'January' => 'Janvier',
					'February' => 'Février',
					'March' => 'Mars',
					'April' => 'Avril',
					'May' => 'Mai',
					'June' => 'Juin',
					'July' => 'Juillet',
					'August' => 'Août',
					'September' => 'Septembre',
					'October' => 'Octobre',
					'November' => 'Novembre',
					'December' => 'Décembre'
				);

				// Requête SQL pour récupérer le nombre d'enregistrements par mois pour des personnes de différentes tranches d'âge
				$sql = "SELECT DATE_FORMAT(datenrg, '%Y-%m') AS mois, COUNT(CASE WHEN age BETWEEN 0 AND 4 THEN 1 END) AS `0_4_ans`, COUNT(CASE WHEN age BETWEEN 5 AND 9 THEN 1 END) AS `5_9_ans`, COUNT(CASE WHEN age BETWEEN 10 AND 14 THEN 1 END) AS `10_14_ans`, COUNT(CASE WHEN age BETWEEN 15 AND 19 THEN 1 END) AS `15_19_ans`,COUNT(CASE WHEN age BETWEEN 20 AND 24 THEN 1 END) AS `20_24_ans`,COUNT(CASE WHEN age BETWEEN 25 AND 29 THEN 1 END) AS `25_29_ans`,COUNT(CASE WHEN age BETWEEN 30 AND 34 THEN 1 END) AS `30_34_ans`,COUNT(CASE WHEN age BETWEEN 35 AND 39 THEN 1 END) AS `35_39_ans`,COUNT(CASE WHEN age BETWEEN 40 AND 44 THEN 1 END) AS `40_44_ans`,COUNT(CASE WHEN age BETWEEN 45 AND 49 THEN 1 END) AS `45_49_ans`,COUNT(CASE WHEN age BETWEEN 50 AND 54 THEN 1 END) AS `50_54_ans`,COUNT(CASE WHEN age BETWEEN 55 AND 59 THEN 1 END) AS `55_59_ans`,COUNT(CASE WHEN age BETWEEN 60 AND 1000 THEN 1 END) AS `60_1000_ans`,COUNT(*) AS `total` FROM faireanalyses INNER JOIN patient ON faireanalyses.idpat = patient.idpat INNER JOIN analyses ON faireanalyses.idana = analyses.idana WHERE YEAR(datenrg) = 2023 AND analyses.idtypana = 8 GROUP BY MONTH(datenrg) ASC";

				// Exécution de la requête
				$resultat = $mysqli->query($sql);

				// Initialisation des totaux par colonne
				$tot_0_4_ans = 0;
				$tot_5_9_ans = 0;
				$tot_10_14_ans = 0;
				$tot_15_19_ans = 0;
				$tot_20_24_ans = 0;
				$tot_25_29_ans = 0;
				$tot_30_34_ans = 0;
				$tot_35_39_ans = 0;
				$tot_40_44_ans = 0;
				$tot_45_49_ans = 0;
				$tot_50_54_ans = 0;
				$tot_55_59_ans = 0;
				$tot_60_1000_ans = 0;
				$tot_total = 0;

				// Affichage des résultats dans un tableau HTML
				while ($ligne = $resultat->fetch_assoc()) {
					$mois_fr_string = strftime('%B', strtotime($ligne['mois']));
					
                    if (isset($mois_fr[$mois_fr_string])) {
                        $mois_fr_string = $mois_fr[$mois_fr_string];
                    }
                    $tot_0_4_ans += $ligne['0_4_ans'];
                    $tot_5_9_ans += $ligne['5_9_ans'];
                    $tot_10_14_ans += $ligne['10_14_ans'];
                    $tot_15_19_ans += $ligne['15_19_ans'];
                    $tot_20_24_ans += $ligne['20_24_ans'];
                    $tot_25_29_ans += $ligne['25_29_ans'];
                    $tot_30_34_ans += $ligne['30_34_ans'];
                    $tot_35_39_ans += $ligne['35_39_ans'];
                    $tot_40_44_ans += $ligne['40_44_ans'];
                    $tot_45_49_ans += $ligne['45_49_ans'];
                    $tot_50_54_ans += $ligne['50_54_ans'];
                    $tot_55_59_ans += $ligne['55_59_ans'];
                    $tot_60_1000_ans += $ligne['60_1000_ans'];
                    
                    $tot_total += $ligne['total'];
    
                    echo "<tr>";
                    echo "<td>" . $mois_fr_string . "</td>";
                    echo "<td>" . $ligne['0_4_ans'] . "</td>";
					echo "<td>" . $ligne['5_9_ans'] . "</td>";
					echo "<td>" . $ligne['10_14_ans'] . "</td>";
					// echo "<td>" . $ligne['10_14_ans'] . "</td>";
					echo "<td>" . $ligne['15_19_ans'] . "</td>";
					echo "<td>" . $ligne['20_24_ans'] . "</td>";
					echo "<td>" . $ligne['25_29_ans'] . "</td>";
					echo "<td>" . $ligne['30_34_ans'] . "</td>";
					echo "<td>" . $ligne['35_39_ans'] . "</td>";
					echo "<td>" . $ligne['40_44_ans'] . "</td>";
					echo "<td>" . $ligne['45_49_ans'] . "</td>";
					echo "<td>" . $ligne['50_54_ans'] . "</td>";
					echo "<td>" . $ligne['55_59_ans'] . "</td>";
					echo "<td>" . $ligne['60_1000_ans'] . "</td>";
					echo "<td>" . $ligne['total'] . "</td>";
					echo "</tr>";
                }
    
                // Affichage du total par colonne
                echo "<tr>";
                echo "<td>Total</td>";
                echo "<td>" . $tot_0_4_ans . "</td>";
                echo "<td>" . $tot_5_9_ans . "</td>";
                echo "<td>" . $tot_10_14_ans . "</td>";
                echo "<td>" . $tot_15_19_ans . "</td>";
                echo "<td>" . $tot_20_24_ans . "</td>";
                echo "<td>" . $tot_25_29_ans . "</td>";
                echo "<td>" . $tot_30_34_ans . "</td>";
                echo "<td>" . $tot_35_39_ans . "</td>";
                echo "<td>" . $tot_40_44_ans . "</td>";
                echo "<td>" . $tot_45_49_ans . "</td>";
                echo "<td>" . $tot_50_54_ans . "</td>";
                echo "<td>" . $tot_55_59_ans . "</td>";
                echo "<td>" . $tot_60_1000_ans . "</td>";
                // echo "<td>" . $tot_15_19_ans . "</td>";
                echo "<td>" . $tot_total . "</td>";
                echo "</tr>";
    
                // Fermeture de la connexion à la base de données
                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Inclusion des fichiers JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    