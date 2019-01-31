<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new CommentaireManagerPDO($db);
$managerB = new BilletManagerPDO($db);
$managerU = new UserManagerPDO($db);


if (isset($_GET['supprimer']))
{
  $manager->delete((int) $_GET['supprimer']);
}

require('../view/backend/commentaireListView.php');
?>
