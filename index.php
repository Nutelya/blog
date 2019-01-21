<?php
require 'model/autoload.php';
session_start();
$db = DBFactory::getMysqlConnexionWithPDO();
$dbU = DBFactory::getMysqlConnexionWithPDOuser();
$manager = new billetManagerPDO($db);
$managerCom = new CommentaireManagerPDO($db);
$managerUser = new UserManagerPDO($dbU);

if (isset($_POST['comment']))
{
  $commentaire = new Commentaire(
    [
      'contenu' => htmlspecialchars($_POST['comment']),
      'idAuteur' => $_SESSION['id'],
      'idBillet' => $_GET['id']
    ]
  );
    $managerCom->add($commentaire);
}


include('../blog/view/frontend/indexView.php');

?>
