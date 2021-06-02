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
        VariablesGlobales::$Materiaux = GestionClavier::getLesMateriaux();

        VariablesGlobales::$lecompteur = GestionClavier::getDerniereCompteurById($_SESSION['id'],$id);
        VariablesGlobales::$lecompteur = VariablesGlobales::$lecompteur + 1;
        foreach (VariablesGlobales::$LaCat as $cat)
        { VariablesGlobales::$idCategorie = $cat->idClavier;
          VariablesGlobales::$prixDp = $cat->prix;
        }

        foreach (VariablesGlobales::$categoriedestouches as $uneTouche){
            if (isset($_POST['personnalise'])) {
                if ($_POST['option'] == $uneTouche->prixToucheCat) {
                    GestionClavier::ajouterCommande(VariablesGlobales::$idMax,$_POST['mat'],VariablesGlobales::$idUti,$id,$_POST['option'],VariablesGlobales::$lecompteur,$_POST['option'] + $_POST['mat'] + VariablesGlobales::$prixDp);
                    foreach (VariablesGlobales::$touche as $unetouche){
                        VariablesGlobales::$test = $unetouche->idTouche;
                        GestionClavier::ajouterPersonnalisation(VariablesGlobales::$test ,VariablesGlobales::$idMax);
                    }
                    ?>
                    <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= VariablesGlobales::$idMax ?>"  </script>
                    <?php
                }else{
                    VariablesGlobales::$message2 = "Cette catégorie n'existe pas !";
                }
            }
        }

        require Chemins::VUES . 'v_unclavier.inc.php';
    }
    //</editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Afficher la personnalisation">
    public function afficherPersonnalisation($id){
        if (!isset($_SESSION['id'])){
            ?>
            <script> window.location.href = "index.php?cas=afficherUtilisateur"</script>
            <?php
        }
        // <editor-fold defaultstate="collapsed" desc="Foreach">
        VariablesGlobales::$test = GestionClavier::getCommandeById($id);
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
        VariablesGlobales::$Couleur = GestionClavier::getLesCouleur();
        //Savoir l'id du clavier, pour savoir si la touche existe dans ce clavier
        VariablesGlobales::$idClavierByCommande = GestionClavier::getIdClavierByCommande($id);
        VariablesGlobales::$maxToucheClavier = GestionClavier::getMaxTouche(VariablesGlobales::$idClavierByCommande);
        VariablesGlobales::$minToucheClavier = GestionClavier::getMinTouche(VariablesGlobales::$idClavierByCommande);


        foreach (VariablesGlobales::$LaCat as $cat)
        { VariablesGlobales::$prixCat = $cat->prixModif; }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Ajout au panier">
        if (isset($_POST['valider'])) {
            GestionPanier::AjoutAuPanierPersonalisation($_SESSION['id'],$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPanier"</script>
            <?php
        }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Ajouter une couleur à une nouvelle touche">
        foreach (VariablesGlobales::$Couleur as $unecouleur){
            if (isset($_POST['subcouleur'])) {
                if (VariablesGlobales::$minToucheClavier <= $_POST['id'] || $_POST['id'] >= VariablesGlobales::$maxToucheClavier){

                    VariablesGlobales::$lacouleurlid = GestionClavier::getLacouleurByid($_POST['id'],$id);

                    if ($_POST['couleur'] == $unecouleur->couleurHtag){
                        if (VariablesGlobales::$lacouleurlid == "#000" ) {
                            VariablesGlobales::$prixCat = VariablesGlobales::$prixCat + 0.10;
                            GestionClavier::modifPrix(VariablesGlobales::$prixCat, $id);
                            GestionClavier::ModifierCouleur($_POST['couleur'],$_POST['id'],$id);
                            ?>
                            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
                            <?php
                        }else{
                            GestionClavier::ModifierCouleur($_POST['couleur'],$_POST['id'],$id);
                            ?>
                            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
                            <?php
                        }
                    }else{
                        ?>
                        <script> window.location.href = "#fermer"</script>
                        <?php
                        VariablesGlobales::$message2 = "Cette couleur n'est pas disponible !";
                    }
                }else{
                    ?>
                    <script> window.location.href = "#fermer"</script>
                    <?php
                    VariablesGlobales::$message2 = "Cette id n'existe pas pour ce clavier !";
                }
            }
        }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Revenir a la couleur par default">
        if (isset($_POST['revenir'])) {
            foreach (VariablesGlobales::$touche as $unetouche){
                if ($unetouche->idTouches == $_POST['couleurdef']){
                    if ($unetouche->couleurperso != "#000" ){
                        VariablesGlobales::$prixCat = VariablesGlobales::$prixCat - 0.10;
                        GestionClavier::modifPrix(VariablesGlobales::$prixCat, $id);
                        GestionClavier::ModifierCouleur("#000",$_POST['couleurdef'],$id);
                        ?>
                        <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
                        <?php
                    }else{
                        ?>
                        <script> window.location.href = "#fermer"</script>
                        <?php
                        VariablesGlobales::$message2 = "La touche $unetouche->libelleTou à déjà la couleur par défaut !";
                    }
                }else{
                    ?>
                    <script> window.location.href = "#fermer"</script>
                    <?php
                    VariablesGlobales::$message2 = "Un problème est survenue lors de la remise à 0, <br>car la touche est peut-être inexistante <br>ou elle a déjà une valeur par défaut.";
                }
            }
        }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Ajouter au fav">
        if (isset($_POST['add'])) {
            GestionClavier::modifFav(1,$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
            <?php
        }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Retirer des fav">
        if (isset($_POST['sup'])) {
            GestionClavier::modifFav(0,$id);
            ?>
            <script> window.location.href = "index.php?cas=afficherPersonnalisation&categorie=<?= $id ?>"</script>
            <?php
        }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Supprimer la personnalisation">
        if (isset($_POST['supprimer'])) {
            GestionClavier::supprimerPersonnalisation($id);
            GestionClavier::supprimerCommandedeClavier($id);
            ?>
            <script> window.location.href = "index.php?cas=afficherMesPersonnalisations"</script>
            <?php
        }
        //</editor-fold>

        //</editor-fold>

        require Chemins::VUES . 'v_personnalise.inc.php';
    }
    //</editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Afficher ClavierCommu ">
    public function afficherClavierCommu () {

        VariablesGlobales::$lUti = GestionClavier::getLesPersonalisationCommu();
        VariablesGlobales::$touche = GestionClavier::getLesTouchesPersonnalisation(6);

        require Chemins::VUES . 'v_claviercommu.inc.php';
    }
    //</editor-fold>

}