<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="../bootstrapAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../bootstrapAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../bootstrapAdmin/css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Connexion</div>
        <div class="card-body">
          <form method="post" action="../controller/login.php">
            <div class="form-group">
              <div class="form-label-group">
                <input type="pseudo" id="pseudo" name="pseudo" class="form-control" placeholder="Pseudonyme" required="required" autofocus="autofocus">
                <label for="pseudo">Pseudo</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                <label for="password">Mot de passe</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Se souvenir de moi
                </label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block"  value="Connexion" />
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']) ?>">Revenir à la dernière page</a>
            <a class="d-block small mt-3" href="../index.php">Accueil</a>
            <a class="d-block small mt-3" href="registration.php">S'inscrire</a>
            <a class="d-block small mt-3" href="forgot-password.html">Mot de passe oublié?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../bootstrapAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="../bootstrapAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../bootstrapAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
