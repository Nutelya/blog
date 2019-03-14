<?php
require('../blog/controller/controller.php');
session_start();
if (isset($_GET['action'])) {
  if ($_GET['action'] == 'listeBillets') {
    listeBillets($manager,$managerCom,$managerUser,$managerSignalement);
  }
  else if ($_GET['action'] == 'profil') {
    if (isset($_SESSION['id']))
    {
      profil($manager,$managerCom,$managerUser,$managerSignalement);
    }
    else {
      echo 'Erreur 404';
    }
  }
  else if ($_GET['action'] == 'login') {
    if (!isset($_SESSION['id'])) {
      login($managerUser);
    }
    else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'register') {
    if (!isset($_SESSION['id'])) {
      register($managerUser);
    }
    else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'disconnect') {
    if (isset($_SESSION['id'])) {
      disconnect();
    }
    else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'dashboard') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        dashboard($managerCom,$managerUser,$managerSignalement);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'commentaireListe' ) {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        commentaireListe($manager,$managerCom,$managerUser);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'commentaireDetails') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        commentaireDetails($manager,$managerCom,$managerUser,$managerSignalement);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'signalementListe') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        signalementListe($manager,$managerCom,$managerUser,$managerSignalement);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'userList') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        userList($managerUser);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'userDetails') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        userDetails($managerUser);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'corbeille') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        corbeille($manager);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'billetListeAdmin') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        billetListeAdmin($manager);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'billetAdd') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        billetAdd($manager);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
  else if ($_GET['action'] == 'billetEdit') {
    if (isset($_SESSION['role'])) {
      if ($_SESSION['role'] == 'admin') {
        billetEdit($manager);
      } else {
        echo "Vous n'avez pas accès à cette page";
      }
    } else {
      echo "Vous n'avez pas accès à cette page";
    }
  }
}
else {
  listeBillets($manager,$managerCom,$managerUser,$managerSignalement);
}
?>
