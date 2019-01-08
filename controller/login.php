<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDOuser();
$manager = new UserManagerPDO($db);

if (isset($_POST['password']) AND isset($_POST['pseudo']))
{
  $manager->connexion(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));
}

  require('../view/frontend/loginView.php');
 ?>
