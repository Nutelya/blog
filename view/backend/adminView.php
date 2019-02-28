<?php $title = 'Accueil Administration'; ?>
<?php ob_start(); ?>
<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Tableau de bord</a>
            </li>
            <li class="breadcrumb-item active">Vue globale</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comment-alt"></i>
                  </div>
                  <?php echo '<div class="mr-5">';
                  if ($NbNewCom == 0){
                    echo "Aucun nouveau commentaire";
                  }
                  else if ($NbNewCom == 1) {
                    echo $NbNewCom. ' nouveau commentaire !';
                  }
                  else {
                    echo $NbNewCom. ' nouveaux commentaires !';
                  }
                  echo '</div>';
                  ?>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="../blog/index.php?action=commentaireListe">
                  <span class="float-left">Détails</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-flag"></i>
                  </div>
                  <?php echo '<div class="mr-5">';
                  if ($NbNewSign == 0){
                    echo "Aucun nouveau signalement";
                  }
                  else if ($NbNewSign == 1) {
                    echo $NbNewSign. ' nouveau signalement !';
                  }
                  else {
                    echo $NbNewSign. ' nouveaux signalements !';
                  }
                  echo '</div>';
                  ?>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="../blog/index.php?action=signalementListe">
                  <span class="float-left">Détails</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
      </div>
    </div>
        <!-- /.container-fluid -->
<?php $content = ob_get_clean(); ?>
<?php require('../blog/template/templateAdmin.php'); ?>
