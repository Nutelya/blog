<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new BilletManagerPDO($db);

if (isset($_GET['supprimer']))
{
  $manager->delete((int) $_GET['supprimer']);
}

if (isset($_GET['retablir']))
{
  $manager->switchCorbeille((int) $_GET['retablir'], 0);
}

require('../view/backend/CorbeilleView.php');
?>
