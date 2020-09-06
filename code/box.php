<?php

include 'inc.php';

header('Content-Type: application/json');
echo json_encode($_POST);
die;
