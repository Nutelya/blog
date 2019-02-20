<?php
require '../model/autoload.php';
session_start();
$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new billetManagerPDO($db);
$managerCom = new CommentaireManagerPDO($db);
$managerUser = new UserManagerPDO($db);
$managerSignalement = new SignalementManagerPDO($db);

if (isset($_SESSION['id']))
{
  $utilisateur = $managerUser->getUnique((int) $_SESSION['id']);
}

require('../view/frontend/compteView.php');
?>
