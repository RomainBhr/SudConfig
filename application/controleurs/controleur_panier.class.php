<?php
class ControleurPanier
{

// <editor-fold defaultstate="collapsed" desc="afficher le panier">
    public function Afficherpanier()
    {
        // <editor-fold defaultstate="collapsed" desc="Vérification">
        if (!isset($_SESSION['id'])){
            ?>
            <script> window.location.href = "index.php?cas=afficherUtilisateur"  </script>
            <?php
        }
        if (isset($_SESSION['id'])) {
            if (GestionUtilisateur::MailValid() == 0){
                ?>
                <script> window.location.href = "index.php?cas=Validation"  </script>
                <?php
            }
        }
        //</editor-fold>

        // <editor-fold defaultstate="collapsed" desc="Variable">
        VariablesGlobales::$lesPaniers = GestionPanier::getPanierByIdUserClavier($_SESSION['id']);
        VariablesGlobales::$prix1 = GestionPanier::prixTotal($_SESSION['id']);
        VariablesGlobales::$prix2 = GestionPanier::prixTotal2($_SESSION['id']);
        VariablesGlobales::$prixTotal = number_format(VariablesGlobales::$prix1 + VariablesGlobales::$prix2, 2,'.', ' ');
        VariablesGlobales::$prixTotalTTC = number_format((VariablesGlobales::$prix1 + VariablesGlobales::$prix2) * 1.20, 2,'.', ' ');
        VariablesGlobales::$LesArticles = GestionPanier::getPanierByIdUserArticle($_SESSION['id']);
        //</editor-fold>

        if (isset($_POST['vider'])){
            GestionPanier::SupprimerAllPanier($_SESSION['id']);
            ?>
            <script> window.location.href = "index.php?cas=afficherPanier"  </script>
            <?php
        }


        // <editor-fold defaultstate="collapsed" desc="panier vide ?">
        VariablesGlobales::$lesProduits = GestionPanier::nombreDeCustomisation($_SESSION['id']);
        if (VariablesGlobales::$lesProduits == null){
            VariablesGlobales::$message = "Vous avez aucune customisation dans votre panier, pourquoi ne pas en <a href='index.php?cas=afficherProduits&categorie=3'>créer une ? Cliquez ici !</a>";
        }
        VariablesGlobales::$Actions = GestionPanier::nombreDArticle($_SESSION['id']);
        if (VariablesGlobales::$Actions == null){
            VariablesGlobales::$message2 = "Vous avez aucun article dans votre panier, pourquoi ne pas en <a href='index.php'>commander un ? Cliquez ici !</a>";
        }
        //</editor-fold>

        //VariablesGlobales::$touche = GestionClavier::getLesTouchesPersonnalisation();

        require Chemins::VUES . 'v_monpanier.inc.php';
    }
//</editor-fold>

}

?>