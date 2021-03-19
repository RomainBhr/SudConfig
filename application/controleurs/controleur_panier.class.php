<?php
class ControleurPanier
{

// <editor-fold defaultstate="collapsed" desc="afficher le panier">
    public function Afficherpanier()
    {
        if (isset($_SESSION['id'])) {
            if (GestionUtilisateur::MailValid() == 0){
                ?>
                <script> window.location.href = "index.php?cas=Validation"  </script>
                <?php
            }
        }
        VariablesGlobales::$lesPaniers = GestionPanier::getPanierByIdUserClavier($_SESSION['id']);

        // <editor-fold defaultstate="collapsed" desc="panier vide ?">
        VariablesGlobales::$lesProduits = GestionPanier::nombreDeCustomisation($_SESSION['id']);
        var_dump(VariablesGlobales::$lesProduits);
        if (VariablesGlobales::$lesProduits == null){
            VariablesGlobales::$message = "Vous avez aucune customisation dans votre panier, pourquoi ne pas en <a href='index.php?cas=afficherProduits&categorie=3'>créer une ? Cliquez ici !</a>";
        }
        VariablesGlobales::$Actions = GestionPanier::nombreDArticle($_SESSION['id']);
        var_dump(VariablesGlobales::$lesProduits);
        if (VariablesGlobales::$Actions == null){
            VariablesGlobales::$message2 = "Vous avez aucun article dans votre panier, pourquoi ne pas en <a href='index.php'>commander un ? Cliquez ici !</a>";
        }
        //</editor-fold>

        VariablesGlobales::$LesArticles = GestionPanier::getPanierByIdUserArticle($_SESSION['id']);
        // VariablesGlobales::$touche = GestionClavier::getLesTouchesPersonnalisation();

        require Chemins::VUES . 'v_monpanier.inc.php';
    }
//</editor-fold>

}

?>