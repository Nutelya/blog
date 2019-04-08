<?php
namespace blog\controller;

$db = \blog\model\Dbfactory::getMysqlConnexionWithPDO();
$manager = new \blog\model\BilletManagerPDO($db);
$managerCom = new \blog\model\CommentaireManagerPDO($db);
$managerUser = new \blog\model\UserManagerPDO($db);
$managerSignalement = new \blog\model\SignalementManagerPDO($db);


function listeBillets($manager,$managerCom,$managerUser,$managerSignalement) {
  $listeBillet = $manager->getList();

  if (isset($_GET['page'])) {
    $nbrPage = $manager->count();
    $page =(($nbrPage - ($nbrPage % 5)) / 5);
    if (($nbrPage % 5) != 0) {
      $page = $page + 1;
    }
    $début = (htmlspecialchars($_GET['page']) * 5) - 5;
    $billetPagination = $manager->getList($début, 5);
  }
  else {
    $billetPagination = $manager->getList(0, 5);
  }

  if (isset($_GET['id'])) {
    $billet = $manager->getUnique((int) $_GET['id']);
  }

  if (isset($_POST['comment']))
  {
    $commentaire = new \blog\model\Commentaire(
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
    $signalement = new \blog\model\Signalement(
      [
        'idCommentaire' => htmlspecialchars($_POST['idCommentaire']),
        'idAuteur' => htmlspecialchars($_SESSION['id']),
        'idBillet' => htmlspecialchars($_GET['id']),
        'idSignale' => htmlspecialchars($_POST['idCommentaireAuteur'])
      ]
    );
      $managerSignalement->add($signalement);
  }

  require('../blog/view/frontend/indexView.php');
}

function profil($manager,$managerCom,$managerUser,$managerSignalement) {
    $listeBillet = $manager->getList();
    $utilisateur = $managerUser->getUnique((int) $_SESSION['id']);

  require('../blog/view/frontend/compteView.php');
}

function login($managerUser) {
  if (isset($_POST['password']) AND isset($_POST['pseudo']))
  {
    $managerUser->connexion(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['password']));
    if (isset($_SESSION['id'])) {
      if (isset($_POST['souvenir']) && $_POST['souvenir'] == 'remember-me') {
        setcookie('pseudo',htmlspecialchars($_POST['pseudo']));
      }
      else {
        setcookie('pseudo','',time() - 3600);
      }
      header ('location: ../blog/index.php');
    }
    else {
      $erreur = "Mauvais pseudo ou mot de passe !";
    }
  }

    require('../blog/view/frontend/loginView.php');
}

function register($managerUser) {
  if (isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['confirmPassword']))
  {
    if (strlen($_POST['password']) > 6)
    {
      if ($_POST['password'] == $_POST['confirmPassword'])
      {
        $user = new \blog\model\User(
          [
            'pseudo' => htmlspecialchars($_POST['pseudo']),
            'email' => htmlspecialchars($_POST['email']),
            'password' => htmlspecialchars($_POST['password'])
          ]
        );
        if (($managerUser->verifyPseudo($user->pseudo()) == true) OR ($managerUser->verifyEmail($user->email()) == true))
        {
          if ($managerUser->verifyPseudo($user->pseudo()) == true)
          {
            $erreurPseudo = "Ce pseudo n'est pas disponible.";
          }
          if ($managerUser->verifyEmail($user->email()) == true)
          {
            $erreurEmail = 'Cet email est déjà utilisé.';
          }
        } else
        {
          $managerUser->add($user);
          header ('location: ../blog/index.php');
        }
      }
      else
      {
        $erreurMdp = 'Les mots de passes doivent être identiques.';
      }
    } else
      {
        $erreurMdp = "Le mot de passe n'est pas assez long";
      }
    }
  require('../blog/view/frontend/registrationView.php');
}

function disconnect() {
  session_unset ();
  session_destroy();
  require('../blog/view/frontend/disconnectView.php');
}

function dashboard($managerCom,$managerUser,$managerSignalement) {
  $NbNewCom = $managerCom->countNew();
  $NbNewSign = $managerSignalement->countNew();
  include('../blog/view/backend/adminView.php');
}

function commentaireListe($manager,$managerCom,$managerUser) {
  if (isset($_GET['supprimer']))
  {
    $managerCom->delete((int) $_GET['supprimer']);
  }
  $listeCom = $managerCom->getList();
  require('../blog/view/backend/commentaireListView.php');
}

function commentaireDetails($manager,$managerCom,$managerUser,$managerSignalement) {
  if (isset($_POST['deleteS']))
  {
    $managerSignalement->deleteTous((int) $_POST['idC']);
  }

  if (isset($_POST['modifier']))
  {
    $com = new \blog\model\Commentaire(
      [
        'contenu' => htmlspecialchars($_POST['contenu']),
        'id' => htmlspecialchars($_POST['idC'])
      ]
    );
    $managerCom->update($com);
  }

  if (isset($_GET['del'])) {
    $managerSignalement->delete((int) $_GET['del']);
  }


  if (isset($_GET['id']))
  {
    $commentaire = $managerCom->getUnique((int) $_GET['id']);
    $signals = $managerSignalement->getlist(-1,-1,$commentaire->id());
  }

  if (isset($_POST['supprimer']))
  {
    $managerCom->delete((int) $_POST['idC']);
    header('Location: ../blog/index.php?action=commentaireListe');
  }

  $managerCom->updateNew((int) $_GET['id'],0);
  $managerSignalement->updateNew((int) $_GET['id'],0);

  require('../blog/view/backend/commentaireView.php');
}

function signalementListe($manager,$managerCom,$managerUser,$managerSignalement) {
  if (isset($_GET['supprimer']))
  {
    $managerSignalement->delete((int) $_GET['supprimer']);
  }
  $listeSignalement = $managerSignalement->getList();
  require('../blog/view/backend/signalementListView.php');
}

function userList($managerUser) {
  if (isset($_GET['delU'])) {
    $managerUser->delete((int) $_GET['delU']);
  }
  $listeUser = $managerUser->getlist();
  require('../blog/view/backend/userListView.php');
}

function userDetails($managerUser) {
  if (isset($_GET['idUser']))
  {
    $utilisateur = $managerUser->getUnique((int) $_GET['idUser']);
  }
  require('../blog/view/backend/utilisateurView.php');
}

function corbeille($manager) {
  if (isset($_GET['supprimer']))
  {
    $manager->delete((int) $_GET['supprimer']);
  }

  if (isset($_GET['retablir']))
  {
    $manager->switchCorbeille((int) $_GET['retablir'], 0);
  }
  $corbeille = $manager->getList(-1,-1,1);
  require('../blog/view/backend/CorbeilleView.php');
}

function billetListeAdmin($manager) {
  if (isset($_GET['supprimer']))
  {
    $manager->switchCorbeille((int) $_GET['supprimer'], 1);
  }
  $listeBillets = $manager->getlist();
  require('../blog/view/backend/billetView.php');
}

function billetAdd($manager) {
  if (isset($_POST['titre']))
  {
    if (!empty($_POST['titre']) && !empty($_POST['contenu']))
    {
    $billet = new \blog\model\Billet(
      [
        'title' => htmlspecialchars($_POST['titre']),
        'container' => $_POST['contenu']
      ]
    );
      $manager->add($billet);
      header('Location: ../blog/index.php?action=billetEdit&modifier=' . $manager->getId($_POST['titre']));
    }
  }
  require('../blog/view/backend/billetAddView.php');
}

function billetEdit($manager) {
  if (isset($_GET['modifier']))
  {
    $billet = $manager->getUnique((int) $_GET['modifier']);
  }
  if (isset($_POST['titre']))
  {
    $billet = new \blog\model\Billet(
      [
        'title' => htmlspecialchars($_POST['titre']),
        'container' => $_POST['contenu']
      ]
    );
    if (isset($_POST['id']))
    {
      $billet->setId($_POST['id']);
    }
      $manager->update($billet);
  }
  require('../blog/view/backend/billetEditView.php');
}

function erreurPage() {
  require('../blog/view/frontend/erreur.php');
}

function mdpOublie($managerUser) {
  if (isset($_POST['pseudo']) && isset($_POST['email'])) {
    if ($managerUser->verifyUser(htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['email'])) == true) {
      $newmdp = $managerUser->changeMdp($_POST['email']);
      $managerUser->emailMdp(htmlspecialchars($_POST['email']),$newmdp);
      $erreur = "Un nouveau mot de passe va vous être envoyé sur votre adresse Email."
    } else {
      $erreur = "Ce pseudo ou email n'existe pas.";
    }
  }
  require('../blog/view/frontend/mdpOublie.php');
}

?>
