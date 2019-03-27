<?php $title = 'Mot de passe oublié';?>

<?php ob_start(); ?>
  <div class="card-header">
    Mot de passe oublié
  </div>
  <div class="card-body">
    <form method="post" action="../blog/index.php?action=mdpOublie">
      <div class="form-group">
        <div class="form-label-group">
          <input type="pseudo" id="pseudo" name="pseudo"  class="form-control" placeholder="Pseudonyme" required="required">
          <label for="pseudo">Pseudo</label>
        </div>
      </div>
      <div class="form-group">
        <div class="form-label-group">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required" >
          <label for="email">Email</label>
        </div>
      </div>
      <div class="form-group">
          <?php if (isset($erreur)) {
            echo '</br><span class="erreur">'.$erreur.'</span>';
          } ?>
      </div>

      <input type="submit" class="btn btn-primary btn-block"  value="Envoyer" />
    </form>
    <div class="text-center">
      <a class="d-block small mt-3" href="../blog/index.php">Retourner à l'accueil</a>
    </div>
  </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('../blog/template/templateCard.php'); ?>
