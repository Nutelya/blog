<?php
require '../model/autoload.php';
session_start();
$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new billetManagerPDO($db);
$managerCom = new CommentaireManagerPDO($db);
$managerUser = new UserManagerPDO($db);
$managerSignalement = new SignalementManagerPDO($db);

include('../view/backend/adminView.php');
 ?>
