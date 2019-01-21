<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new BilletManagerPDO($db);


if (isset($_POST['titre']))
{
  if (!empty($_POST['titre']) && !empty($_POST['contenu']))
  {
  $billet = new Billet(
    [
      'title' => htmlspecialchars($_POST['titre']),
      'container' => $_POST['contenu']
    ]
  );
    $manager->add($billet);
    header('Location: ../controller/billetEdit.php?modifier=' . $manager->getId($_POST['titre']));
}
}
require('../view/backend/billetAddView.php')
?>
