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
    die("Erreur connexion : " . mysqli_connect_error());
}
// Get record ID from GET variable
$id = $_GET['id'];

// Delete record from database
$conn->query("DELETE FROM patient WHERE idpat=$id");

// Redirect to index page
header("Location: affp.php");
exit;
?>