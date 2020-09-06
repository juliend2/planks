<?php

include 'inc.php';

$this_filename = basename($_SERVER['SCRIPT_FILENAME']);

if (isset($_GET['id'])):
else:
  maybe_insert_plank($conn, $this_filename.'?status=success');
endif;
?>
<!DOCTYPE html>
<html>
  <?php head() ?>
<body>
<?php if (isset($_GET['id'])): ?>

<h1 class="plank-name">Plank <?php  ?> </h1>

<table class="boxes">
  <?php

  $boxes = get_boxes_by_plank($conn, $_GET['id']);
  for ($y = 1; $y < 10; $y++):
    ?><tr><?php
    for ($x = 1; $x < 10; $x++):
      ?>
      <td class="box" data-editing="false">
        <?php #echo "$x, $y" ?>
        <?php foreach ($boxes as $box): ?>
          <?php if ($box['x_cell'] == $x && $box['y_cell'] == $y): ?>
            <?php echo $box['content'] ?>
          <?php endif ?>
        <?php endforeach ?>
      </td>
      <?php
    endfor;
    ?></tr><?php
  endfor;
  ?>
</table>


<?php else: ?>
  <?php new_plank_form($this_filename); ?>
  <a href="index.php">Cancel</a>
<?php endif ?>
</body>
</html>
