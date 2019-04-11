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
              <i class="fas fa-user"></i>
              Informations
            </div>
            <div class="card-body">
              <table class="table table-condensed">
                <thead>
                  <tr>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Pseudo : <?php echo $utilisateur->pseudo();?></td>

                  </tr>
                  <tr>
                    <td>Email : <?php echo $utilisateur->email();?></td>

                  </tr>
                  <tr>
                    <td>Rôle : <?php echo $utilisateur->role();?></td>

                  </tr>
                  <tr>
                    <td>Date d'inscription : <?php echo $utilisateur->date_register()->format('d/m/Y');?></td>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../blog/template/templateAdmin.php'); ?>
