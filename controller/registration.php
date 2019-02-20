<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new UserManagerPDO($db);


if (isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['confirmPassword']))
{
  if (strlen($_POST['password']) > 6)
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
    if (($manager->verifyPseudo($user->pseudo()) == true) OR ($manager->verifyEmail($user->email()) == true))
    {
      if ($manager->verifyPseudo($user->pseudo()) == true)
      {
        $erreurPseudo = "Ce pseudo n'est pas disponible.";
      }
      if ($manager->verifyEmail($user->email()) == true)
      {
        $erreurEmail = 'Cet email est déjà utilisé.';
      }
    } else
    {
      $manager->add($user);
      header ('location: ../index.php');
    }
  }
  else {
    $erreurMdp = 'Les mots de passes doivent être identiques.';
  }
} else {
  $erreurMdp = "Le mot de passe n'est pas assez long";
}
}

require('../view/frontend/registrationView.php')
?>
