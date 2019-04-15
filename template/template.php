<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Bootstrap core CSS -->
    <link href="../blog/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../blog/public/css/styleblog.css" rel="stylesheet">
    <link href="../blog/public/css/edit.css" rel="stylesheet">

  </head>

  <body>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="../blog/index.php">Accueil</a>
          <?php
          if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['role']))
          {
              echo '<a class="blog-nav-item" href="/blog/index?action=profil">Profil</a>
              <a class="blog-nav-item" href="/blog/index?action=disconnect">Déconnexion</a>';
              if ($_SESSION['role'] == 'admin') {
                echo '<a class="blog-nav-item" href="/blog/index.php?action=dashboard">Administration</a>';
              }
          }
          else
          {
            echo '<a class="blog-nav-item" href="/blog/index.php?action=register">Inscription</a>
            <a class="blog-nav-item" href="/blog/index?action=login">Connexion</a>';
          }
          ?>
        </nav>
      </div>
    </div>
    <?= $content ?>
    <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <h4>À propos</h4>
      <p>Jean Forteroche est un acteur et écrivain. Il a notamment publié les romans best sellers <em><u>L'étoile de l'Arizona</u></em> et <em><u>La galaxie des destins</u></em>.</p>
      <p>Il publie son nouveau roman <em><u>Billet simple pour l'Alaska</u></em> par épisode sur ce blog.</p>
    </div>
    <hr>
    <div class="sidebar-module">
      <h4>Chapitres</h4>
      <ol class="list-unstyled">
        <?php
        foreach ($listeBillet as $billet4) {
          echo '<li><a href="index.php?id='.$billet4->id().'">'.$billet4->title().'</a></li>';
        }
        ?>
      </ol>
    </div>
    </div><!-- /.blog-sidebar -->


          </div><!-- /.row -->

        </div><!-- /.container -->


    <footer class="blog-footer">
      <p> Mentions légales </p>
      <p>
        <a href="#">Retourner en haut</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../blog/bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../blog/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../blog/public/js/profil.js"></script>
  </body>
</html>
