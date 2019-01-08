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
              Liste des Utilisateurs
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Pseudo</th>
                      <th>Mot de passe</th>
                      <th>Email</th>
                      <th>Date d'inscription</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($manager->getList() as $user)
                    {
                      echo '<tr><td>', $user->pseudo(), '</td><td>', $user->password(), '</td><td>', $user->email(), '</td><td>', $user->date_register()->format('d/m/Y à H\hi'), '</td></tr>', "\n";
                    }
                    ?>
                  </tbody>
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
