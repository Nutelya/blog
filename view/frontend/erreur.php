<?php $title = 'Erreur';?>
<?php ob_start(); ?>

    <div class="card-header">
      Erreur
    </div>
    <div class="card-body">
    <div class="col-sm-12 blog-main">
      <h1> Ce n'est pas le chemin que vous recherchez. </h1>
      <br>
      <a href="../blog/index.php">Retourner à l'accueil</a>
    </div>
  </div>

<?php $content = ob_get_clean(); ?>

<?php require('../blog/template/templateCard.php'); ?>
