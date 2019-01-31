<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new UserManagerPDO($db);

require('../view/backend/userListView.php');
?>
