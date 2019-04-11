<?php $title = 'Blog de JeanForteroche'; ?>
<?php ob_start(); ?>
<div class="container">
  <div class="blog-header">
    <h1 class="blog-title">Blog de Jean Forteroche</h1>
    <p class="lead blog-description"><em><u>Billet simple pour l'Alaska</em></u></p>
  </div>
<hr>
  <div class="row">

    <div class="col-sm-8 blog-main">

        <?php
        if (isset($_GET['id']))
        {
          echo '<div id="',$billet->id(),'" class="blog-post">',
               '<h2 class="blog-post-title">', $billet->title(), '</h2>', "\n",
               '<p class="blog-post-meta"> Le ', $billet->dateAdd()->format('d/m/Y à H\hi'), '</p>', "\n",
               '<p>', nl2br($billet->container()), '</p>', "\n",
               '</div>';

            if ($billet->dateAdd() != $billet->dateEdit())
          {
            echo '<p>Dernière modification le ', $billet->dateEdit()->format('d/m/Y à H\hi'), '</p>';
          }
          echo '<h2 class="blog-post-title">Commentaires</h2>', "\n";
          foreach ($managerCom->getListCom(-1, -1, $billet->id()) as $commentaire)
          {
            echo '<div class="panel panel-info">',
                  '<div class="panel-heading" id="com',$commentaire->id(),'"><h3 class="panel-title">',$managerUser->getUnique($commentaire->idAuteur())->pseudo(),' - ',$managerUser->getUnique($commentaire->idAuteur())->role(),' - ',$commentaire->dateAjout()->format('d/m/Y à H\hi'),'</h3>',
                  '</div>',
                  '<div class="panel-body">',
                   nl2br($commentaire->contenu()),
                  '</div>',
                  '</div>';
                 if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND $managerSignalement->peutSignaler($_SESSION['id'], $commentaire->id())) {
                   echo '<form action="index.php?id=',$billet->id(),'" method="post">',
                   '<input type="hidden" name="idCommentaire" value="',$commentaire->id(),'"/>',
                   '<input type="hidden" name="idCommentaireAuteur" value="',$commentaire->idAuteur(),'"/>',
                   '<input class="btn btn-sm btn-danger" type="submit" value="Signaler" />',
                   '</form>',
                   '<br>';
                 }
          }
          if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
          {
          echo '</br>',
               '<form id="commentary" action="index.php?id=',$billet->id(),'" method="post">',
               '<h4>Publier un commentaire</h4>',
               '<textarea id="commentaires" class="col-sm-12" rows="6" name="comment"></textarea>',
               '</br>',
               '<input type="submit" value="Valider" />',
               '</form>';
          }
          else {
            echo 'Vous devez être connecté pour publier un commentaire',
                 '</br><a href="../blog/index.php?action=login">Se connecter</a>';
          }
        }
        else
        {
          foreach ($billetPagination as $billet2)
          {
            if (strlen($billet2->container()) <= 360)
            {
              $container = $billet2->container();
            }

            else
            {
              $debut = substr($billet2->container(), 0, 360);
              $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

              $container = $debut;
            }

            echo '<div class="blog-post">',
                 '<h2 class="blog-post-title"><a href="?id=', $billet2->id(), '">', $billet2->title(), '</a></h2>', "\n",
                 '<p>', nl2br($container), '</p>',
                 '</div>';
          }
        }
        ?>
<!-- /.blog-post -->
<nav>
  <ul class="pager">
  <?php
  if (isset($_GET['page'])) {
    if ($_GET['page'] == $page) {
      echo '<li><a href="index.php?page=' . (htmlspecialchars($_GET['page']) - 1) .'">Précédant</a></li>';
    }
    else if ($_GET['page'] == 1) {
      echo '<li><a href="index.php?page=2">Suivant</a></li>';
    }
    else {
      echo '<li><a href="index.php?page=' . (htmlspecialchars($_GET['page']) - 1) .'">Précédant</a></li>',
           '<li><a href="index.php?page=' . (htmlspecialchars($_GET['page']) + 1) .'">Suivant</a></li>';
    }
  }
  else if (!isset($_GET['id'])) {
    echo '<li><a href="index.php?page=' . 2 .'">Suivant</a></li>';
  }
  ?>
  </ul>
</nav>

</div><!-- /.blog-main -->

<?php $content = ob_get_clean(); ?>

<?php require('../blog/template/template.php'); ?>
