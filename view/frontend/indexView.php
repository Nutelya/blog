<?php $title = 'Blog de JeanForteroche'; ?>
<?php ob_start(); ?>
<div class="blog-masthead">
  <div class="container">
    <nav class="blog-nav">
      <a class="blog-nav-item active" href="../blog/index.php">Accueil</a>
      <?php
      if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
      {
          echo '<a class="blog-nav-item" href="../blog/controller/disconnect.php">Déconnexion</a>
          <a class="blog-nav-item" href="../blog/controller/admin.php">Administration</a>';
      }
      else
      {
        echo '<a class="blog-nav-item" href="../blog/controller/registration.php">Inscription</a>
        <a class="blog-nav-item" href="../blog/controller/login.php">Connexion</a>';
      }
      ?>
    </nav>
  </div>
</div>

<div class="container">

  <div class="blog-header">
    <h1 class="blog-title">Blog de Jean Forteroche</h1>
    <p class="lead blog-description">Le livre de Jean Forteroche</p>
  </div>

  <div class="row">

    <div class="col-sm-8 blog-main">

        <?php
        if (isset($_GET['id']))
        {
          $billet = $manager->getUnique((int) $_GET['id']);

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
          foreach ($managerCom->getListCom(0, 10, $billet->id()) as $commentaire)
          {
            echo '<p id="com',$commentaire->id(),'">',$managerUser->getUnique($commentaire->idAuteur())->pseudo(),' - ',$managerUser->getUnique($commentaire->idAuteur())->role(),' - ',$commentaire->dateAjout()->format('d/m/Y à H\hi'),'</p>',
                 '<blockquote>',nl2br($commentaire->contenu()), '</blockquote>',
                 '</br>';
                 if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])) {
                   echo '<form action="index.php?id=',$billet->id(),'" method="post">',
                   '<input type="hidden" name="idCommentaire" value="',$commentaire->id(),'"/>',
                   '<input type="submit" value="Signaler" />',
                   '</form>';
                 }
          }
          if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
          {
          echo '</br>',
               '<form id="commentary" action="index.php?id=',$billet->id(),'" method="post">',
               '<h4>Publier un commentaire</h4>',
               '<textarea rows="8" cols="60" name="comment"></textarea>',
               '<input type="submit" value="Valider" />',
               '</form>';
          }
          else {
            echo 'Vous devez être connecté pour publier un commentaire',
                 '</br><a href="../controller/login.php">Se connecter</a>';
          }
        }
        else
        {
          if (isset($_GET['page'])) {
            $fin = (htmlspecialchars($_GET['page']) * 5);
            $début = ($fin - 5);
          }
          else {
            $début = 0;
            $fin = 5;
          }
          foreach ($manager->getList($début, $fin) as $billet)
          {
            if (strlen($billet->container()) <= 360)
            {
              $container = $billet->container();
            }

            else
            {
              $debut = substr($billet->container(), 0, 360);
              $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

              $container = $debut;
            }

            echo '<div class="blog-post">',
                 '<h2 class="blog-post-title"><a href="?id=', $billet->id(), '">', $billet->title(), '</a></h2>', "\n",
                 '<p>', nl2br($container), '</p>',
                 '</div>';
          }
        }
        ?>
<!-- /.blog-post -->
<?php $content = ob_get_clean(); ?>

<?php require('../blog/template/template.php'); ?>
