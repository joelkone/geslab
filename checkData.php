<?php
if (isset($_POST['inputData'])) {
  $inputData = $_POST['inputData'];

  // Connect to database
  $conn = mysqli_connect('localhost', 'root', '', 'geslab');
  if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
  }

  // Check if the data exists in the database
  $sql = "SELECT * FROM patient WHERE numCE = '" . $inputData . "'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo 'exists';
  } else {
    echo 'does not exist';
  }

  mysqli_close($conn);
}
?>
