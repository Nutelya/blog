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
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog de Jean Forteroche</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="public/css/blog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
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

              echo '<div class="blog-post">',
                   '<h2 class="blog-post-title">', $billet->title(), '</h2>', "\n",
                   '<p class="blog-post-meta"> Le ', $billet->dateAdd()->format('d/m/Y à H\hi'), '</p>', "\n",
                   '<p>', nl2br($billet->container()), '</p>', "\n",
                   '</div>';

                if ($billet->dateAdd() != $billet->dateEdit())
              {
                echo '<p>Modifié le ', $billet->dateEdit()->format('d/m/Y à H\hi'), '</p>';
              }
              echo '<h2 class="blog-post-title">Commentaires</h2>', "\n";
              foreach ($managerCom->getListCom(0, 10, $billet->id()) as $commentaire)
              {
                if (strlen($commentaire->contenu()) <= 200)
                {
                  $container = $commentaire->contenu();
                }
                $user = $managerUser->getUnique($commentaire->idAuteur());
                echo '<p>',$user->pseudo(),' - ',$user->role(),' - ',$commentaire->dateAjout()->format('d/m/Y à H\hi'),'</p>',
                     '<blockquote>',nl2br($container), '</blockquote>';
              }
              echo '<br>',
                   '<form id="commentary" action="index.php?id=',$billet->id(),'" method="post">',
                   '<h4>Publier un commentaire</h4>',
                   '<textarea rows="8" cols="60" name="comment"></textarea>',
                   '<input type="submit" value="Valider" />',
                   '</form>';
            }

            else
            {
              foreach ($manager->getList(0, 5) as $billet)
              {
                if (strlen($billet->container()) <= 200)
                {
                  $container = $billet->container();
                }

                else
                {
                  $debut = substr($billet->container(), 0, 200);
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

          <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">February 2014</a></li>
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
