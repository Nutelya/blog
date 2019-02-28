<?php $title = 'Liste des commentaires'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des commentaires</a>
          </li>
          <li class="breadcrumb-item active">Liste des commentaires</li>
        </ol>
      </div>
        <div class="container-fluid">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-comment-alt"></i>
              Liste des commentaires
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
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
                    foreach ($listeCom as $commentaire)
                    {
                      echo '<tr>';
                      if ($commentaire->estNouveau() == 1) {
                        echo '<td> <span style="font-size: 1.5em; color: yellow;">';
                      } else {
                        echo '<td> <span style="font-size: 1.5em; color: grey;">';
                      }
                      echo '<i class="fas fa-comment-alt"></i></span></td><td>', $managerUser->getUnique($commentaire->idAuteur())->pseudo(), '</td><td>', $commentaire->contenu(), '</td><td><a href="../index.php?id=',$commentaire->idBillet(),'#',$commentaire->idBillet(),'" >', $manager->getUnique($commentaire->idBillet())->title(), '</a></td><td>', $commentaire->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', ($commentaire->dateAjout() == $commentaire->dateEdit() ? '-' : $commentaire->dateEdit()->format('d/m/Y à H\hi')), '</td><td><a href="../blog/index.php?action=commentaireDetails&id=', $commentaire->id(), '">Modifier</a> | <a href="?action=commentaireListe&supprimer=', $commentaire->id(),'">Supprimer</a></td></tr>', "\n";
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
<?php require('../blog/template/templateAdmin.php'); ?>
