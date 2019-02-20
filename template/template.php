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
    <link href="/blog/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/blog/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/blog/public/css/blog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/blog/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

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
          <a class="blog-nav-item active" href="/blog/index.php">Accueil</a>
          <?php
          if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
          {
              echo '<a class="blog-nav-item" href="/blog/controller/compte.php">Profil</a>
              <a class="blog-nav-item" href="/blog/controller/admin.php">Administration</a>
              <a class="blog-nav-item" href="/blog/controller/disconnect.php">Déconnexion</a>';
          }
          else
          {
            echo '<a class="blog-nav-item" href="/blog/controller/registration.php">Inscription</a>
            <a class="blog-nav-item" href="/blog/controller/login.php">Connexion</a>';
          }
          ?>
        </nav>
      </div>
    </div>
    <?= $content ?>
    <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <h4>About</h4>
      <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>
    <div class="sidebar-module">
      <h4>Chapitres</h4>
      <ol class="list-unstyled">
        <?php
        foreach ($manager->getList() as $billet) {
          echo '<li><a href="index.php?id='.$billet->id().'">'.$billet->title().'</a></li>';
        }
        ?>
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
    <script>window.jQuery || document.write('<script src="/blog/bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/blog/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/blog/bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
