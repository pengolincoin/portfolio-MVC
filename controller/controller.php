<?php

require('./model/model.php');

function index() {
    $projs = getProjets();
    $arts = getArticles();
    $apropos = getApropos();
    $getarch = getArchives();
    $cat = getCat();
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

function recherche() {
  $rech = getRecherche();
  require('./view/rechercheView.php');
}

function contact() {
  require('./view/contactView.php');
}

function rechercher() {
  require('./view/rechercheView.php');
}

function login() {
  $db = dbConnect();
  $user = new User($db);
  require('./view/admin/loginAdminView.php');
}

function deconnexion() {
  $db = dbConnect();
  $user = new User($db);
  require('./view/admin/logoutAdminView.php');
}

function adminIndex() {
  // $adminProjs = getAdminIndexProjets();
  // $adminArts = getAdminIndexArticles();
  $db = dbConnect();
  $user = new User($db);

  $pagesProjets = new Paginator('5','proj');
    $stmt = $db->query('SELECT projetID FROM projets');
    $pagesProjets->set_total($stmt->rowCount());
    $adminProjs = $db->query('SELECT projetID, projetTitre, projetDate FROM projets ORDER BY projetID DESC ' .$pagesProjets->get_limit());

  $pagesArticles = new Paginator('5','art');
      $stmt = $db->query('SELECT articleID FROM articles');
      $pagesArticles->set_total($stmt->rowCount());
      $adminArts = $db->query('SELECT articleID, articleTitre, articleDate FROM articles ORDER BY articleID DESC ' .$pagesArticles->get_limit());

  require('./view/admin/indexAdminView.php');
}

function addProjetView() {
  require('./view/admin/addProjetAdminView.php');
}

function adminAddProjetBDD($projetTitre,$projetTexte,$projetCat,$projetGithub) {
  $addproj = addProjetBDD($projetTitre,$projetTexte,$projetCat,$projetGithub);
  require('./view/admin/indexAdminView.php');
}

function addArticleView() {
  require('./view/admin/addArticleAdminView.php');
}

function adminAddArticleBDD($articleTitre,$articleTexte) {
  $addart = addArticleBDD($articleTitre,$articleTexte);
  require('./view/admin/indexAdminView.php');
}

function editProjetView() {
  require('./view/admin/editProjetAdminView.php');
}

function adminEditProjetBDD($projetTitre,$projetTexte,$projetCat,$projetGithub) {
  $editProjet = editProjetBDD($projetTitre,$projetTexte,$projetCat,$projetGithub);
  require('./view/admin/indexAdminView.php');
}

function adminEditDelImage() {

}

function adminEditProjetForm() {

}
