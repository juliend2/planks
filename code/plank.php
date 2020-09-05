<?php

$this_filename = basename($_SERVER['SCRIPT_FILENAME']);

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
  $success = $conn->prepare("INSERT INTO planks (name) VALUES (?)")->execute([$plank['name']]);
  if ($success) {
    header('Location: '.$this_filename.'?status=success');
  }
} else {
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>Create your plank</h1>
<?php if (isset($_GET['status'])): ?>
  <?php if ($_GET['status'] == 'success'): ?>
    <p>Success!</p>
  <?php elseif ($_GET['status'] == 'error'): ?>
    <p>Error!</p>
  <?php else: ?>
    <p><?php echo $_GET['status'] ?></p>
  <?php endif ?>
<?php endif ?>
<form method="POST" action="<?php echo $this_filename ?>">
  <input type="text" name="plank[name]" placeholder="name" required>
  <br>
  <input type="submit">
</form>
</body>
</html>
