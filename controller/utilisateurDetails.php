<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new CommentaireManagerPDO($db);
$managerB = new BilletManagerPDO($db);
$managerU = new UserManagerPDO($db);
$managerS = new SignalementManagerPDO($db);


if (isset($_GET['idUser']))
{
  $utilisateur = $managerU->getUnique((int) $_GET['idUser']);
}


require('../view/backend/utilisateurView.php');
?>
