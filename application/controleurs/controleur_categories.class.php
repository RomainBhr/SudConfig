<?php
class ControleurCategories {

    public function afficher() {
        VariablesGlobales::$lesCategories = GestionCategories::getLesCategories();
        VariablesGlobales::$Recommander = GestionBoutique::getNosRecommandations();
        VariablesGlobales::$Actions = GestionBoutique::getLesActions();
        if (isset($_SESSION['id'])) {
            if ( GestionPanier::nombreDarticledanslepanier($_SESSION['id']) > 0){
                VariablesGlobales::$Panier = GestionPanier::nombreDarticledanslepanier($_SESSION['id']);
            }else{
                VariablesGlobales::$Panier = 0;
            }
        }
        require Chemins::VUES_PERMANENTES . 'v_menu_categories.inc.php';

        if(isset($_SERVER['HTTP_REFERER'])) {
            VariablesGlobales::$douvienstu = $_SERVER['HTTP_REFERER'];
            //var_dump(VariablesGlobales::$douvienstu);
        }

    }
}
?>