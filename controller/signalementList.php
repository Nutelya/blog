<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new CommentaireManagerPDO($db);
$managerB = new BilletManagerPDO($db);
$managerU = new UserManagerPDO($db);
$managerS = new SignalementManagerPDO($db);


if (isset($_GET['supprimer']))
{
  $managerS->delete((int) $_GET['supprimer']);
}

require('../view/backend/signalementListView.php');
?>
