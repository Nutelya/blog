<?php
session_start();
session_unset ();
session_destroy();
header ('location: ../index.php');
require('../view/frontend/disconnectView.php');
 ?>
