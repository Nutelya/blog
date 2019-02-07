<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new UserManagerPDO($db);

if (isset($_POST['password']) AND isset($_POST['pseudo']))
{
  $manager->connexion(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));
  if (isset($_SESSION['id'])) {
    if (isset($_POST['souvenir']) && $_POST['souvenir'] == 'remember-me') {
      setcookie('pseudo',htmlspecialchars($_POST['pseudo']));
    }
    else {
      setcookie('pseudo','',time() - 3600);
    }
    header ('location: ../index.php');
  }
  else {
    $erreur = "Mauvais pseudo ou mot de passe !";
  }
}

  require('../view/frontend/loginView.php');
 ?>
