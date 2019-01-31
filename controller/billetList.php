<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new BilletManagerPDO($db);


if (isset($_GET['supprimer']))
{
  $manager->switchCorbeille((int) $_GET['supprimer'], 1);
}

require('../view/backend/billetView.php');
?>
