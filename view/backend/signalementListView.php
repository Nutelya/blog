<?php $title = 'Liste des commentaires'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des commentaires</a>
          </li>
          <li class="breadcrumb-item active">Signalements</li>
        </ol>
      </div>
      <div class="container-fluid">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-flag"></i>
              Tous les signalements
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Commentaire</th>
                      <th>Signaleur</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($managerS->getList() as $signalement)
                    {
                      if (strlen($manager->getUnique($signalement->idCommentaire())->contenu()) <= 50)
                      {
                        $contenu = $manager->getUnique($signalement->idCommentaire())->contenu();
                      }

                      else
                      {
                        $debut = substr($manager->getUnique($signalement->idCommentaire())->contenu(), 0, 50);
                        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                        $contenu = $debut;
                      }
                      echo '<tr>';
                      if ($signalement->estNouveau() == 1) {
                        echo '<td> <span style="font-size: 1.5em; color: yellow;">';
                      } else {
                        echo '<td> <span style="font-size: 1.5em; color: grey;">';
                      }
                      echo '<i class="fas fa-flag"></i></span></td><td><a href="../index.php?id=',$signalement->idBillet(),'#com',$signalement->idCommentaire(),'">', $contenu , '</a></td><td>', $managerU->getUnique($signalement->idAuteur())->pseudo(), '</td><td>', $signalement->dateAjout()->format('d/m/Y à H\hi'), '</td><td><a href="../controller/commentaireDetails.php?id=', $signalement->idCommentaire(), '">Détails</a></td></tr>', "\n";
                    }
                    ?>
                  </tbody>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../template/templateAdmin.php'); ?>
