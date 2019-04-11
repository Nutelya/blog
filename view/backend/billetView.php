<?php $title = 'Liste des billets'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des billets</a>
          </li>
          <li class="breadcrumb-item active">Liste des billets</li>
        </ol>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-list"></i>
              Liste des billets
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Titre</th>
                      <th>Date de publication</th>
                      <th>Dernière modification</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($listeBillets as $billet)
                    {
                      echo '<tr><td>', $billet->title(), '</td><td>', $billet->dateAdd()->format('d/m/Y à H\hi'), '</td><td>', ($billet->dateAdd() == $billet->dateEdit() ? '-' : $billet->dateEdit()->format('d/m/Y à H\hi')), '</td><td><a href="?action=billetEdit&modifier=', $billet->id(), '">Modifier</a> | <a href="?action=billetListeAdmin&supprimer=', $billet->id(), '">Supprimer</a></td></tr>', "\n";
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
<?php require('../blog/template/templateAdmin.php'); ?>
