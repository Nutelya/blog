<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new BilletManagerPDO($db);


if (isset($_POST['titre']))
{
  $billet = new Billet(
    [
      'title' => htmlspecialchars($_POST['titre']),
      'container' => $_POST['contenu']
    ]
  );

  if (isset($_POST['id']))
  {
    $billet->setId($_POST['id']);
  }
    $manager->add($billet);
}
require('../view/backend/billetAddView.php')
?>
