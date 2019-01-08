<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscription</title>

    <!-- Bootstrap core CSS-->
    <link href="../bootstrapAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../bootstrapAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../bootstrapAdmin/css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">S'enrengistrer</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autofocus="autofocus">
                <label for="pseudo">Pseudo</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adresse Email" required="required">
                <label for="inputEmail">Adresse Email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required="required">
                    <label for="inputPassword">Mot de passe</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirmation du mot de passe" required="required">
                    <label for="confirmPassword">Confirmation du mot de passe</label>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" href="login.html" value="Inscription" />
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']) ?>">Revenir à la dernière page</a>
            <a class="d-block small mt-3" href="../index.php">Accueil</a>
            <a class="d-block small mt-3" href="login.php">Se connecter</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
