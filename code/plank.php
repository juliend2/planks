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

<script>
$(function() {
  PlankBoxes.init('.boxes', <?php echo $_GET['id'] ?>);
});
</script>

<h1 class="plank-name">Plank  </h1>

<table class="boxes">
  <?php

  $boxes = get_boxes_by_plank($conn, $_GET['id']);
  for ($y = 1; $y < 10; $y++):
    ?><tr><?php
    for ($x = 1; $x < 10; $x++):
      $content = null;
      $id = null;
      foreach ($boxes as $box) {
        if ($box['x_cell'] == $x && $box['y_cell'] == $y) {
          $content = $box['content'];
          $id = $box['id'];
        }
      } ?>
      <td class="box"
          data-x="<?php echo $x ?>"
          data-y="<?php echo $y ?>"
          data-id="<?php echo $id ?>"
          data-editing="false">
        <?php echo $content ?>
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
