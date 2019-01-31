<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new UserManagerPDO($db);


if (isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['confirmPassword']))
{
  if ($_POST['password'] == $_POST['confirmPassword'])
  {
    $user = new User(
      [
        'pseudo' => htmlspecialchars($_POST['pseudo']),
        'email' => htmlspecialchars($_POST['email']),
        'password' => htmlspecialchars($_POST['password'])
      ]
    );
      $manager->add($user);
  }
  else {

  }
}
require('../view/frontend/registrationView.php')
?>
