<?php
$cas =(!isset($_REQUEST['cas'])) ? 'afficherAccueil' : $_REQUEST['cas'];
$categorie =(!isset($_REQUEST['categorie'])) ? '' : $_REQUEST['categorie'];

//Aiguillage vers le bon corps de page
switch ($cas) {
    case 'afficherAccueil':{
        require Chemins::VUES . 'v_accueil.inc.php';
        break;
    }

    case 'Afficher': {
        if (isset($_REQUEST['categorie'])) {
            if (file_exists(require Chemins::VUES .'v_' . $_REQUEST['categorie'] . '.inc.php')) {
                require Chemins::VUES .'v_' . $_REQUEST['categorie'] . '.inc.php';
            }
        }
        else {
            require Chemins::VUES . 'v_erreur404.inc.php';
        }
        break;
    }
    // <editor-fold defaultstate="collapsed" desc="Article">
    case 'afficherProduits':{
        require_once Chemins::CONTROLEURS.'controleur_produits.class.php';
        $controleurProduits = new ControleurProduits();
        $controleurProduits->afficher($categorie);
        break;
    }

    case 'afficherLarticle':{
        require_once Chemins::CONTROLEURS.'controleur_produits.class.php';
        $controleurProduits = new ControleurProduits();
        $controleurProduits->afficherarticle($categorie);
        break;
    }

    case 'afficherClavier':{
        require_once Chemins::CONTROLEURS.'controleur_produits.class.php';
        $controleurProduits = new ControleurProduits();
        $controleurProduits->afficherClavier($categorie);
        break;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Perso commu">
    case 'afficherClavierCommu':{
        require_once Chemins::CONTROLEURS.'controleur_produits.class.php';
        $controleurProduits = new ControleurProduits();
        $controleurProduits->afficherClavierCommu();
        break;
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Utilisateur">
    case 'afficherPersonnalisation':{
        require_once Chemins::CONTROLEURS.'controleur_produits.class.php';
        $controleurProduits = new ControleurProduits();
        $controleurProduits->afficherPersonnalisation($categorie);
        break;
    }
    case 'afficherMesPersonnalisations':{
        require_once Chemins::CONTROLEURS.'controleur_utilisateur.class.php';
        $controleurUtilisateur = new ControleurUtilisateur();
        $controleurUtilisateur->afficherMesPersonnalisations();
        break;
    }
    case 'afficherUtilisateur':{
        require_once Chemins::CONTROLEURS.'controleur_utilisateur.class.php';
        $controleurUtilisateur = new ControleurUtilisateur();
        $controleurUtilisateur->afficher();
        break;
    }

    case 'afficherCreerCompte':{
        require_once Chemins::CONTROLEURS.'controleur_utilisateur.class.php';
        $controleurUtilisateur = new ControleurUtilisateur();
        $controleurUtilisateur->CreerCompte();
        break;
    }

    case 'Validation':{
        require_once Chemins::CONTROLEURS.'controleur_utilisateur.class.php';
        $controleurUtilisateur = new ControleurUtilisateur();
        $controleurUtilisateur->valider();
        break;
    }
    case 'recuperationMdp':{
        require_once Chemins::CONTROLEURS.'controleur_utilisateur.class.php';
        $controleurUtilisateur = new ControleurUtilisateur();
        $controleurUtilisateur->mdpOublier();
        break;
    }
    case 'passerCommande':{
        require_once Chemins::CONTROLEURS.'controleur_passercommande.class.php';
        $controleurCommande = new ControleurPasserCommande();
        $controleurCommande->AfficherCommande();
        break;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Panier">
    case 'afficherPanier':{
        require_once Chemins::CONTROLEURS.'controleur_panier.class.php';
        $controleurPanier = new ControleurPanier();
        $controleurPanier->Afficherpanier();
        break;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="x5106">
    case 'AfficherAdminx5106':{
        require_once Chemins::CONTROLEURS.'controleur_adminx5106.class.php';
        $controleurAdminx5106 = new Controleurx5106();
        $controleurAdminx5106->AfficherAdminx5106();
        break;
    }
    // </editor-fold>

    default : {
        require Chemins::VUES . 'v_erreur404.inc.php';
        break;
    }

}
?>