<!DOCTYPE html>
<html>
  <head>
    <title>Administration</title>
    <?php include("../template/cssLink.php"); ?>
  </head>

  <body id="page-top">
    <?php include("../template/menuAdmin.php"); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des billets</a>
          </li>
          <li class="breadcrumb-item active">Créer un billet</li>
        </ol>
        <form id="get-data-form" action="billetAdd.php" method="post">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Titre : <input type="text" name="titre" value="<?php if (isset($billet)) echo $billet->title(); ?>" />
            </div>
            <div class="card-body">
              <p>
                <textarea class="tinymce" rows="8" cols="60" name="contenu"><?php if (isset($billet)) echo $billet->container(); ?></textarea>
                <input type="submit" value="Ajouter" />
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php include("../template/scriptLink.php"); ?>
  </body>
</html>
