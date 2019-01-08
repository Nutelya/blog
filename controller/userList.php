<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDOuser();
$manager = new UserManagerPDO($db);

require('../view/backend/userListView.php');
?>
