<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new UserManagerPDO($db);

if (isset($_GET['delU'])) {
  $manager->delete((int) $_GET['delU']);
}

require('../view/backend/userListView.php');
?>
