<?php

require('./model/model.php');

function index() {
    $projs = getProjets();
    $arts = getArticles();
    $apropos = getApropos();
    $getarch = getArchives();
    require('./view/indexView.php');
}

function projet() {
  if (isset($_GET['projetID']) && $_GET['projetID'] > 0) {
    $proj = getProjet($_GET['projetID']);
    require('./view/projetView.php');
  }
  else {
      echo 'Erreur : aucun identifiant de projet envoyé';
  }
}

function article() {
  if (isset($_GET['articleID']) && $_GET['articleID'] > 0) {
    $art = getArticle($_GET['articleID']);
    require('./view/articleView.php');
  }
  else {
      echo 'Erreur : aucun identifiant d\'article envoyé';
  }
}

function archive() {
  if (isset($_GET['month']) && isset($_GET['year']) && !empty($_GET['month']) && !empty($_GET['year'])) {
    $arch = getArchive($_GET['month'],$_GET['year']);
    require('./view/archivesView.php');
  }
}

function contact() {
  require('./view/contactView.php');
}
