<!DOCTYPE html>
<html>
  <head>
    <title>Administration</title>
    <?php include("../template/cssLink.php"); ?>
  </head>

  <body id="page-top">
    <?php include("../template/menuAdmin.php"); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
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
                    foreach ($manager->getList() as $billet)
                    {
                      echo '<tr><td>', $billet->title(), '</td><td>', $billet->dateAdd()->format('d/m/Y à H\hi'), '</td><td>', ($billet->dateAdd() == $billet->dateEdit() ? '-' : $billet->dateEdit()->format('d/m/Y à H\hi')), '</td><td><a href="../controller/billetEdit.php?modifier=', $billet->id(), '">Modifier</a> | <a href="?supprimer=', $billet->id(), '">Supprimer</a></td></tr>', "\n";
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

    <?php include("../template/scriptLink.php"); ?>
  </body>
</html>
