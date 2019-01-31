<?php $title = 'Liste des commentaires'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Liste des commentaires
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Auteur</th>
                      <th>Commentaire</th>
                      <th>Billet</th>
                      <th>Date de publication</th>
                      <th>Dernière modification</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($manager->getList() as $commentaire)
                    {
                      echo '<tr><td>', $managerU->getUnique($commentaire->idAuteur())->pseudo(), '</td><td>', $commentaire->contenu(), '</td><td><a href="../index.php?id=',$commentaire->idBillet(),'#',$commentaire->idBillet(),'" >', $managerB->getUnique($commentaire->idBillet())->title(), '</a></td><td>', $commentaire->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', ($commentaire->dateAjout() == $commentaire->dateEdit() ? '-' : $commentaire->dateEdit()->format('d/m/Y à H\hi')), '</td><td><a href="../controller/commentaireEdit.php?modifier=', $commentaire->id(), '">Modifier</a> | <a href="?supprimer=', $commentaire->id(), '">Supprimer</a></td></tr>', "\n";
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
