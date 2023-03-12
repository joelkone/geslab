<?php
// session_start();
// if(@$_SESSION["autoriser"]!="oui"){
//     header("location:/pdo/login.php");
//     exit();
// }
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "geslab";
    $conn = mysqli_connect($host, $user, $password, $dbname);
    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    @$idpat = $_POST['idpat'];
    @$idcons = $_POST['med'];
    @$analyse = $_POST['analyse'];
    @$resultat = $_POST['resultat'];
    @$commentaire = $_POST['commentaire'];

    if(isset($_POST["addmyana"])){
    // $count = count($resultat);
    // @$idpat = $_POST['idpat'];
    for($i=0;$i<count($commentaire);$i++){

        // $idpat = $_POST['num'][$i];

        $idpat_escaped = $idpat[$i];
        
        $idcons_escaped = $idcons[$i];

        $analyse_escaped = $analyse[$i];

        $resultat_escaped = $resultat[$i];

        $commentaire_escaped = $commentaire[$i];

        $datexec = $_POST['datexec'][$i];
        // var_dump($datexec);

        $faireAnalyse = "INSERT INTO faireanalyses (idpat, idcons, idana, resultat, commentaire, datexec, datenrg) VALUES ($idpat_escaped, $idcons_escaped, $analyse_escaped, '$resultat_escaped','$commentaire_escaped', '$datexec', NOW())";
        // var_dump($faireAnalyse);

        // $fin = mysqli_query($conn,$faireAnalyse);
        $conn->query($faireAnalyse);
    }
    // @$idpat = $_POST['idpat'];
    // var_dump($faireAnalyse);
}

    if($conn){
        // echo "Good";
        header("LOCATION: affAn.php");
        require_once('goodAjoutAn.php');
        require_once('index.php');
        exit();

    }
    else{
        // echo "Erreur de traitement: ". mysqli_error($conn);
    }
    // if(isset($_POST["addmyana"])) {
    //     $idpat = $_POST['idpat'];
    //     $idcons = $_POST['med'];
    //     $analyse = $_POST['analyse'];
    //     $resultat = $_POST['resultat'];
    //     $commentaire = $_POST['commentaire'];
    //     $datexec = $_POST['datexec'];
    //     $faireAnalyse = "INSERT INTO faireanalyses (idpat, idcons, idana, resultat, commentaire, datexec, datenrg) 
    //     VALUES ('$idpat', '$idcons', '$analyse', '$resultat','$commentaire', '$datexec', NOW())";

    //     if (mysqli_query($conn, $faireAnalyse)) {
    //         echo 'good';
    //     }
    //     else {
    //         echo "bad : " . mysqli_error($conn);
    //     }
    // }
    // else {
    //     echo "Erreur de validation";
    // }
    mysqli_close($conn);
?>
