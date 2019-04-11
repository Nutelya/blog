<?php $title = 'Créer un billet'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des billets</a>
          </li>
          <li class="breadcrumb-item active">Créer un billet</li>
        </ol>
        <form id="get-data-form" action="../blog/index.php?action=billetAdd"  method="post">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-heading"></i>
              Titre : <input type="text" name="titre" id="titre" required/>
              <span id="aidetitre"></span>
            </div>
            <div class="card-body">
              <p>
                <textarea class="tinymce" rows="8" cols="60" name="contenu"></textarea>
                <span id="aideContenu"></span>
                <input type="submit" value="Ajouter" />
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../blog/template/templateAdmin.php'); ?>
