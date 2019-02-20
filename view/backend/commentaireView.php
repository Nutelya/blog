<?php $title = 'Commentaire'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des commentaires</a>
          </li>
          <li class="breadcrumb-item active">Détails d'un commentaire</li>
        </ol>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              <?php echo 'Auteur : <a href="#">' . $managerU->getUnique($commentaire->idAuteur())->pseudo() . '</a>'; ?>
            </div>
            <div class="card-header">
              <i class="fas fa-table"></i>
              <?php echo 'Publié le : ' . $commentaire->dateAjout()->format('d/m/Y à H\hi'); ?>
            </div>
            <?php
            if (!empty($signals)) {
              echo '<div class="card-header">',
                   '<i class="fas fa-table"></i>',
                   ' Ce commentaire a été signalé ' . sizeof($signals) . ' fois !',
                   '</div>';
            }
             ?>
            <div class="card-body">
              <div class="table-responsive">
                <form id="get-data-form" action="commentaireDetails.php?id=<?php echo $commentaire->id() ?>" method="post">
                  <input type="hidden" name="idC" value="<?php echo $commentaire->id(); ?>" />
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Commentaire</th>
                      <?php
                      if (!empty($signals))
                      { echo '<th>Signalé par</th>',
                              '<th>Date</th>',
                              '<th>Actions</th>';
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td width=50% rowspan=<?php echo sizeof($signals);?> >
                            <textarea rows="5" style="width : 100%;" name="contenu"><?php echo $commentaire->contenu(); ?></textarea>
                      </td>
                      <?php
                      $compteur = 0;
                      if (!empty($signals))
                      {
                        foreach($signals as $signalement)
                        {
                          $compteur = $compteur + 1;
                          if ($compteur > 1) {
                            echo '<tr>';
                          }
                          echo '<td><a href="#">',$managerU->getUnique($signalement->idAuteur())->pseudo(),'</a></td><td>', $signalement->dateAjout()->format('d/m/Y à H\hi'),'</td><td><a href="?id='.$commentaire->id().'&del='.$signalement->id().'">Supprimer signalement" <a/></td></tr>';
                        }
                      }
                       ?>
                     </tbody>
                     <tfoot>
                       <tr>
                         <th><input type="submit" value="Modifier" name="modifier" />  <input type="submit" value="Supprimer" name="supprimer" /></th>
                         <?php if (!empty($signals)) {
                           echo '<th></th>',
                                '<th></th>',
                                '<th><input type="submit" value="Supprimer tous les signalements" name="deleteS" /></th>';
                         }
                         ?>
                       </tr>
                     </tfoot>
            </table>
            </form>
            </div>
            </div>
          </div>
      </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../template/templateAdmin.php'); ?>
