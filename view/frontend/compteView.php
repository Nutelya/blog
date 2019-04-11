<?php $title = 'Blog de JeanForteroche'; ?>
<?php ob_start(); ?>

<div class="container">

  <div class="blog-header">
    <h1 class="blog-title">Mon Profil</h1>
  </div>
  <hr>

  <div class="row">

    <div class="col-sm-8 blog-main">
      <p>Pseudo : <?php echo $utilisateur->pseudo();?></p>
      <p>Email : <?php echo $utilisateur->email();?></p>
      <p>Role : <?php echo $utilisateur->role();?></p>
      <p>Date d'inscription : <?php echo $utilisateur->date_register()->format('d/m/Y');?></p>
      <button type="button" class="btn btn-sm btn-primary">Changer le mot de passe</button>
      <hr>
      <form id="changermdp" action="../blog/index?action=profil" method="post">
          Mot de passe actuel : <input type="password" name="password" id="password" required/>
          <hr align=left width="50px">
          Nouveau mot de passe : <input type="password" name="passwordNew" id="passwordNew" required/>
          <hr align=left width="50px">
          Confirmation du mot de passe : <input type="password" name="passwordConf" id="passwordConf" required/>
          <br>
        <input type="submit" value="Valider"/>
      </form>

      <?php if (isset($erreur)) {
        echo '</br><span class="erreur">'.$erreur.'</span>';
      } ?>
      <hr>
    </div>

<!-- /.blog-post -->
<?php $content = ob_get_clean(); ?>

<?php require('../blog/template/template.php'); ?>
