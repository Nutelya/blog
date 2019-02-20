<?php $title = 'Utilisateur'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des utilisateurs</a>
          </li>
          <li class="breadcrumb-item active">Détails d'un utilisateur</li>
        </ol>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Informations
            </div>
            <div class="card-body">
              <p>Pseudo : <?php echo $utilisateur->pseudo();?></p>
              <p>Email : <?php echo $utilisateur->email();?></p>
              <p>Role : <?php echo $utilisateur->role();?></p>
              <p>Date d'inscription : <?php echo $utilisateur->date_register()->format('d/m/Y');?></p>
              <p>Nombre de commentaires : </p>
              <p>Nombre de signalements : </p>
            </div>
          </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../template/templateAdmin.php'); ?>
