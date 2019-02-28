<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Page de connexion</title>

    <!-- Bootstrap core CSS-->
    <link href="../blog/bootstrapAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../blog/bootstrapAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../blog/bootstrapAdmin/css/sb-admin.css" rel="stylesheet">

    <link href="../blog/public/css/edit.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Connexion</div>
        <div class="card-body">
          <form method="post" action="../blog/index.php?action=login">
            <div class="form-group">
              <div class="form-label-group">
                <input type="pseudo" id="pseudo" name="pseudo" <?php if (isset($_COOKIE['pseudo'])) { echo 'value="'. $_COOKIE['pseudo'] . '"';} else { echo 'autofocus="autofocus"';} ?> class="form-control" placeholder="Pseudonyme" required="required">
                <label for="pseudo">Pseudo</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required" <?php if (isset($_COOKIE['pseudo'])) { echo 'autofocus="autofocus"';} ?> >
                <label for="password">Mot de passe</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name='souvenir' value="remember-me" <?php if (isset($_COOKIE['pseudo'])) { echo 'checked';}?>>
                  Se souvenir de moi
                </label>
                <?php if (isset($erreur)) {
                  echo '</br><span class="erreur">'.$erreur.'</span>';
                } ?>
              </div>
            </div>

            <input type="submit" class="btn btn-primary btn-block"  value="Connexion" />
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="forgot-password.html">Mot de passe oublié?</a>
            <a class="d-block small mt-3" href="../blog/index.php?action=register">S'inscrire</a>
            <a class="d-block small mt-3" href="../blog/index.php">Retourner à l'accueil</a>

          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../blog/bootstrapAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="../blog/bootstrapAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../blog/bootstrapAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
