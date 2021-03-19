<?php
class ControleurProduits {
    // <editor-fold defaultstate="collapsed" desc="Afficher">
    public function afficher ($cat) {
        if ($cat == 3){
            VariablesGlobales::$cat = $cat;
            VariablesGlobales::$LaCat = GestionCategories::cat($cat);
            VariablesGlobales::$lesProduits = GestionClavier::getLesClavierByCategorie($cat);
            VariablesGlobales::$Recommander = GestionBoutique::getNosRecommandations();
            VariablesGlobales::$Actions = GestionBoutique::getLesActions();

            require Chemins::VUES . 'v_clavier.inc.php';
        }else {
            VariablesGlobales::$cat = $cat;
            VariablesGlobales::$LaCat = GestionCategories::cat($cat);
            VariablesGlobales::$lesProduits = GestionBoutique::getLesProduitsByCategorie($cat);
            VariablesGlobales::$Recommander = GestionBoutique::getNosRecommandations();
            VariablesGlobales::$Actions = GestionBoutique::getLesActions();

            require Chemins::VUES . 'v_articles.inc.php';
        }
    }
    //</editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Afficher l'article">
    public function afficherarticle ($id) {

        VariablesGlobales::$idCategorie = $id;
        VariablesGlobales::$commentaire = GestionCommentaire::getLesCommentaireByArticle($id);
        VariablesGlobales::$Actions = GestionBoutique::getLesActions();
        VariablesGlobales::$LesStocks = GestionBoutique::getLesStocks($id);
        VariablesGlobales::$LaCat = GestionBoutique::getProduitById($id);
        VariablesGlobales::$lesImages = GestionBoutique::getLesImagesById($id);
        if (isset($_SESSION['id'])){
            if (isset($_POST['commander'])){
                GestionPanier::AjoutAuPanier($_SESSION['id'],$id);
                ?>
                <script> window.location.href = "index.php"  </script>
                <?php
            }
        }else{
            VariablesGlobales::$message = "Tu dois être connecté pour pouvoir commander";
        }
        require Chemins::VUES . 'v_unarticles.inc.php';
    }
    //</editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Afficher le clavier">
    public function afficherClavier($id){
        if (!isset($_SESSION['id'])){
            ?>
            <script> window.location.href = "index.php?cas=afficherUtilisateur"</script>
            <?php
        }
        VariablesGlobales::$LesTailles = null;
        VariablesGlobales::$LaCat = GestionClavier::getLesClavierByid($id);
        VariablesGlobales::$touche = GestionClavier::getLesTouches($id);
        VariablesGlobales::$idUti = $_SESSION['id'];
        VariablesGlobales::$idMax = GestionClavier::getDerniereId();
        VariablesGlobales::$idMax = VariablesGlobales::$idMax + 1;
        VariablesGlobales::$categoriedestouches = GestionClavier::getLesCatDesTouches();
        VariablesGlobales::$prixCommande = GestionClavier::getLePrixById($id);

        VariablesGlobales::$lecompteur = GestionClavier::getDerniereCompteurById($_SESSION['id'],$id);
        VariablesGlobales::$lecompteur = VariablesGlobales::$lecompteur + 1;
        foreach (VariablesGlobales::$LaCat as $cat)
        { VariablesGlobales::$idCategorie = $cat->idClavier;
          VariablesGlobales::$prixDp = $cat->prix;
        }

        if (isset($_POST['personnalise'])) {
            GestionClavier::ajouterCommande(VariablesGlobales::$idMax,VariablesGlobales::$idUti,$id,$_POST['option'],VariablesGlobales::$lecompteur,$_POST['option'] + VariablesGlobales::$prixDp);
            foreach (VariablesGlobales::$touche as $unetouche){
                VariablesGlobales::$test = $unetouche->idTouche;
                GestionClavier::ajouterPersonnalisation(VariablesGlobales::$test ,VariablesGlobales::$idMax);
            }
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= VariablesGlobales::$idMax ?>"  </script>
            <?php
        }
        require Chemins::VUES . 'v_unclavier.inc.php';
    }
    //</editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Afficher la personnalisation">
    public function afficherPersonnalisation($id){
        VariablesGlobales::$test = GestionClavier::getCommandeById($id);
        // <editor-fold defaultstate="collapsed" desc="Foreach">
        foreach (VariablesGlobales::$test as $untest){
            if ($_SESSION['id'] != $untest->idUti ){
                ?>
                <script> window.location.href = "index.php"</script>
                <?php
            }
        }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Variable">
        VariablesGlobales::$LaCat = GestionClavier::getLesPersonnalisationById($id);
        VariablesGlobales::$touche = GestionClavier::getLesTouchesPersonnalisation($id);
        VariablesGlobales::$idUti = $_SESSION['id'];
        VariablesGlobales::$idMax = GestionClavier::getDerniereId();
        VariablesGlobales::$toutesLescouleurs = GestionClavier::getLesCouleur();
        VariablesGlobales::$idMax = VariablesGlobales::$idMax + 1;

        foreach (VariablesGlobales::$LaCat as $cat)
        { VariablesGlobales::$prixCat = $cat->prixModif; }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Afficher les forms">
        if (isset($_POST['revenir'])) {
            if ($_POST['couleurdef'] != "#000" ) {
                VariablesGlobales::$prixCat = VariablesGlobales::$prixCat - 0.10;
                GestionClavier::modifPrix(VariablesGlobales::$prixCat, $id);
            }
            GestionClavier::ModifierCouleur("#000",$_POST['couleurdef'],$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
            <?php
        }

        if (isset($_POST['valider'])) {
            GestionPanier::AjoutAuPanierPersonalisation($_SESSION['id'],$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
            <?php
        }

        if (isset($_POST['couleur'])) {
            if ($_POST['default'] == "#000" ) {
                VariablesGlobales::$prixCat = VariablesGlobales::$prixCat + 0.10;
                GestionClavier::modifPrix(VariablesGlobales::$prixCat, $id);
            }
            GestionClavier::ModifierCouleur($_POST['couleur'],$_POST['id'],$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
            <?php
        }

        if (isset($_POST['add'])) {
            GestionClavier::modifFav(1,$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
            <?php
        }

        if (isset($_POST['sup'])) {
            GestionClavier::modifFav(0,$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
            <?php
        }
        //</editor-fold>


        require Chemins::VUES . 'v_personnalise.inc.php';
    }
    //</editor-fold>

}