<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new BilletManagerPDO($db);

if (isset($_GET['modifier']))
{
  $billet = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_GET['supprimer']))
{
  $manager->delete((int) $_GET['supprimer']);
}

require('../view/backend/billetView.php');
?>
