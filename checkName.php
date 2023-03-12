<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "geslab";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

@$name = $_GET["name"];

$sql = "SELECT * FROM patient WHERE numCE='$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "exists";
} else {
    echo "not exists";
}

$conn->close();
?>