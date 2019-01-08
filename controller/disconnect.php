<?php
session_start();

$_SESSION = array();
session_destroy();

setcookie('id', '');
setcookie('pseudo', '');

require('../view/frontend/disconnectView.php');
 ?>
