<?php

$servername = "mariaDB";
$username = "root";
$password = getenv('MYSQL_ROOT_PASSWORD');
$dbname = 'planks';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  #echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  die;
}

$plank = $_POST['plank'];
if (!empty($plank)) {
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
?>
</body>
</html>
