<?php
require '../model/autoload.php';

$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new CommentaireManagerPDO($db);
$managerB = new BilletManagerPDO($db);
$managerU = new UserManagerPDO($db);
$managerS = new SignalementManagerPDO($db);

if (isset($_POST['deleteS']))
{
  $managerS->deleteTous((int) $_POST['idC']);
}

if (isset($_POST['modifier']))
{
  $com = new Commentaire(
    [
      'contenu' => htmlspecialchars($_POST['contenu']),
      'id' => htmlspecialchars($_POST['idC'])
    ]
  );
  $manager->update($com);
}

if (isset($_GET['del'])) {
  $managerS->delete((int) $_GET['del']);
}


if (isset($_GET['id']))
{
  $commentaire = $manager->getUnique((int) $_GET['id']);
  $signals = $managerS->getlist(-1,-1,$commentaire->id());
}

if (isset($_POST['supprimer']))
{
  $manager->delete((int) $_POST['idC']);
  header('Location: ../controller/commentaireList.php');
}

$manager->updateNew((int) $_GET['id'],0);
$managerS->updateNew((int) $_GET['id'],0);

require('../view/backend/commentaireView.php');
?>
