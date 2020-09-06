<?php

include 'inc.php';

$stmt = $conn->prepare("
INSERT INTO boxes (id, plank_id, x_cell, y_cell, content)
VALUES (:id, :plank_id, :x_cell, :y_cell, :content)
ON DUPLICATE KEY UPDATE content = :content
");
$success = $stmt->execute([
  'id' => $_POST['id'] != '' ? intval($_POST['id']) : null,
  'plank_id' => $_POST['plank_id'],
  'x_cell' => $_POST['x_cell'],
  'y_cell' => $_POST['y_cell'],
  'content' => $_POST['content']
]);


header('Content-Type: application/json');
if ($success) {
  echo json_encode(['status' => 'success', 'data' => $_POST]);
} else {
  echo json_encode(['status' => 'error', 'data' => $_POST]);
}
die;
