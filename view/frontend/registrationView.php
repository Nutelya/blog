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
    <link href="../blog/bootstrapAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../blog/bootstrapAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../blog/bootstrapAdmin/css/sb-admin.css" rel="stylesheet">

    <link href="../blog/public/css/edit.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">S'enrengistrer</div>
        <div class="card-body">
          <form method="post" action="../blog/index.php?action=register">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Pseudo" <?php if (isset($_POST['pseudo'])) echo 'value="'.htmlspecialchars($_POST['pseudo']).'"'; ?> required="required" autofocus="autofocus">
                <label for="pseudo">Pseudo</label>
                <?php if (isset($erreurPseudo)) {
                  echo '<span class="erreur">'.$erreurPseudo.'</span>';
                } ?>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" <?php if (isset($_POST['email'])) echo 'value="'.htmlspecialchars($_POST['email']).'"'; ?> placeholder="Adresse Email" required="required">
                <label for="inputEmail">Adresse Email</label>
                <?php if (isset($erreurEmail)) {
                  echo '<span class="erreur">'.$erreurEmail.'</span>';
                } ?>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required="required">
                    <label for="inputPassword">Mot de passe (7 ~ 30 lettres)</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirmation du mot de passe" required="required">
                    <label for="confirmPassword">Confirmation du mot de passe</label>
                  </div>
                </div>
                <?php if (isset($erreurMdp)) {
                  echo '<span class="erreur">'.$erreurMdp.'</span>';
                } ?>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Inscription" />
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="../blog/index.php">Accueil</a>
            <a class="d-block small mt-3" href="../blog/index.php?action=login">Se connecter</a>
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
