<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new UserManagerPDO($db);

if (isset($_POST['password']) AND isset($_POST['pseudo']))
{
  $manager->connexion(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));
  if (isset($_SESSION['id'])) {
    header ('location: ../index.php');
  }
}

  require('../view/frontend/loginView.php');
 ?>
