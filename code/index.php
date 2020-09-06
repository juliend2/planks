<?php
# echo '<div>
# 	<a href="index.html">## Docker Containers Info</a></br>
# 	<a href="http://yamada.juliendesrosiers.com:8183/">## phpMyAdmin</a></br>
#      </div>';

#echo phpinfo();

include 'inc.php';

$stmt = $conn->query("SELECT * FROM planks");

?>
<h1>Planks</h1>
<table>
  <tr>
    <th colspan="2">Name</th>
  </tr>
<?php while ($row = $stmt->fetch()): ?>
  <tr>
    <td><?php echo $row['name'] ?></td>
    <td><a href="plank.php?id=<?php echo $row['id'] ?>">Edit</a></td>
  </tr>
<?php endwhile; ?>
</table>
