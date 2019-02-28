<?php $title = 'Blog de JeanForteroche'; ?>
<?php ob_start(); ?>

<div class="container">

  <div class="blog-header">
    <h1 class="blog-title">Mon Profil</h1>
  </div>

  <div class="row">

    <div class="col-sm-8 blog-main">
      <p>Pseudo : <?php echo $utilisateur->pseudo();?></p>
      <p>Email : <?php echo $utilisateur->email();?></p>
      <p>Role : <?php echo $utilisateur->role();?></p>
      <p>Date d'inscription : <?php echo $utilisateur->date_register()->format('d/m/Y');?></p>
      <p>Nombre de commentaires : </p>
      <p>Nombre de signalements : </p>
    </div>

<!-- /.blog-post -->
<?php $content = ob_get_clean(); ?>

<?php require('../blog/template/template.php'); ?>
