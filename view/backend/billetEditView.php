<?php $title = 'Modifier un billet'; ?>
<?php ob_start(); ?>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Gestion des billets</a>
          </li>
          <li class="breadcrumb-item active">Modifier un billet</li>
        </ol>
        <form id="get-data-form" action="?action=billetEdit" method="post">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-heading"></i>
              Titre : <input type="text" name="titre" value="<?php if (isset($billet)) echo $billet->title(); ?>" />
            </div>
            <div class="card-body">
              <p>
                <textarea class="tinymce" rows="8" cols="60" name="contenu"><?php if (isset($billet)) echo $billet->container(); ?></textarea>
                <input type="hidden" name="id" value="<?= $billet->id() ?>" />
                <input type="submit" value="Modifier" name="modifier" />
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('../blog/template/templateAdmin.php'); ?>
