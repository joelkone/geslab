<?php

// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "geslab");

// Vérification de la connexion
if ($mysqli->connect_errno) {
    echo "Echec de la connexion à la base de données : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

// Requête SQL pour extraire les enregistrements par mois pour les types d'analyses sélectionnés
$sql = "SELECT 
            YEAR(faireanalyses.datenrg) AS annee, 
            MONTH(faireanalyses.datenrg) AS mois, 
            COUNT(*) AS nb_enregistrements, 
            analyses.destypana
        FROM 
            faireanalyses 
            INNER JOIN analyses ON faireanalyses.idana = analyses.idana
        WHERE 
            analyses.destypana IN ('BIOCHIMIE', 'IMMUNOLOGIE', 'HEMATOLOGIE', 'PARASITOLOGIE', 'BACTERIO-VIROLOGIE')
        GROUP BY 
            YEAR(faireanalyses.datenrg), 
            MONTH(faireanalyses.datenrg), 
            analyses.destypana";

// Exécution de la requête SQL
$resultat = $mysqli->query($sql);

// Création du tableau HTML en utilisant Bootstrap
echo '<table class="table table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th>Mois</th>';
echo '<th>BIOCHIMIE</th>';
echo '<th>IMMUNOLOGIE</th>';
echo '<th>HEMATOLOGIE</th>';
echo '<th>PARASITOLOGIE</th>';
echo '<th>BACTERIO-VIROLOGIE</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Boucle pour afficher les résultats
while ($row = $resultat->fetch_assoc()) {
    $annee = $row['annee'];
    $mois = $row['mois'];
    $nb_enregistrements = $row['nb_enregistrements'];
    $destypana = $row['destypana'];
    
    // Création d'un tableau associatif pour stocker les résultats par mois et type d'analyse
    $tableau_resultats[$annee][$mois][$destypana] = $nb_enregistrements;
}

// Boucle pour afficher les résultats dans le tableau HTML
foreach ($tableau_resultats as $annee => $mois) {
    foreach ($mois as $num_mois => $valeurs) {
        $mois_nom = date('F', mktime(0, 0, 0, $num_mois, 1, $annee));
        echo '<tr>';
        echo '<td>' . $mois_nom . ' ' . $annee . '</td>';
        echo '<td>' . $valeurs['BIOCHIMIE'] . '</td>';
        echo '<td>' . $valeurs['IMMUNOLOGIE'] . '</td>';
        echo '<td>' . $valeurs['HEMATOLOGIE'] . '</td>';
        echo '<td>' . $valeurs['PARASITOLOGIE'] . '</td>';
        echo '<td>' . $valeurs['BACTERIO-VIROLOGIE'] . '</td>';
        echo '</tr>';
    }
  }

  echo '</tbody>';
  echo '</table>';
  
  // Fermeture de la connexion à la base de données
  $mysqli->close();
  
  ?>
    