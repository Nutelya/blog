<?php
require 'model/autoload.php';
session_start();
$db = DBFactory::getMysqlConnexionWithPDO();
$manager = new billetManagerPDO($db);
$managerCom = new CommentaireManagerPDO($db);
$managerUser = new UserManagerPDO($db);
$managerSignalement = new SignalementManagerPDO($db);

if (isset($_POST['comment']))
{
  $commentaire = new Commentaire(
    [
      'contenu' => htmlspecialchars($_POST['comment']),
      'idAuteur' => htmlspecialchars($_SESSION['id']),
      'idBillet' => htmlspecialchars($_GET['id'])
    ]
  );
    $managerCom->add($commentaire);
}

if (isset($_POST['idCommentaire']))
{
  $signalement = new Signalement(
    [
      'idCommentaire' => htmlspecialchars($_POST['idCommentaire']),
      'idAuteur' => htmlspecialchars($_SESSION['id']),
      'idBillet' => htmlspecialchars($_GET['id']),
      'idSignale' => htmlspecialchars($_POST['idCommentaireAuteur'])
    ]
  );
    $managerSignalement->add($signalement);
}



include('../blog/view/frontend/indexView.php');

?>
