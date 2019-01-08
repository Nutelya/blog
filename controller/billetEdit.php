<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new BilletManagerPDO($db);

if (isset($_GET['modifier']))
{
  $billet = $manager->getUnique((int) $_GET['modifier']);
}

if (isset($_POST['titre']))
{
  $billet = new Billet(
    [
      'title' => htmlspecialchars($_POST['titre']),
      'container' => htmlspecialchars($_POST['contenu'])
    ]
  );

  if (isset($_POST['id']))
  {
    $billet->setId($_POST['id']);
  }
    $manager->update($billet);
}
require('../view/backend/billetEditView.php');
?>
