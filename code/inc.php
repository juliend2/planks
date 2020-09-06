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

function head() {
?>
<head>
  <meta charset="utf-8">
  <meta name=viewport content="width=device-width,initial-scale=1">
  <title>Plank</title>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
  <script src="/js/planks.js"></script>
  <link href="/css/custom.css" rel="stylesheet">
</head>
<?php
}


# action - String of the URL where we send:
function new_plank_form($action) {
  ?>
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
  <form method="POST" action="<?php echo $action ?>">
    <input type="text" name="plank[name]" placeholder="name" required>
    <br>
    <input type="submit">
  </form>
  <?php
}

function maybe_insert_plank($conn, $redirect_url) {
  $plank = $_POST['plank'];
  if (!empty($plank)) {
    $success = $conn->prepare("INSERT INTO planks (name) VALUES (?)")->execute([$plank['name']]);
    if ($success) {
      header('Location: '.$this_filename.'?status=success');
    }
  } else {
  }
}

# id - Integer
function get_boxes_by_plank($conn, $id) {
  $stmt = $conn->prepare("SELECT * FROM boxes WHERE plank_id = ?");
  $stmt->execute([$id]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
