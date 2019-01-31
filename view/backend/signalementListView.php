<?php $title = 'Liste des commentaires'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Tous les signalements
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Commentaire</th>
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
                      echo '<tr><td><a href="../index.php?id=',$signalement->idBillet(),'#com',$signalement->idCommentaire(),'">', $contenu , '</a></td><td>', $signalement->dateAjout()->format('d/m/Y à H\hi'), '</td><td><a href="../controller/commentaireEdit.php?modifier=', $signalement->id(), '">Détails</a></td></tr>', "\n";
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
  </div>
<?php $content = ob_get_clean(); ?>
<?php require('../template/templateAdmin.php'); ?>
