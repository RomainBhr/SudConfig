<?php
session_start();

//Config
require_once 'configs/chemins.class.php';
require_once Chemins::CONFIGS.'mysql_configs.class.php';
require_once Chemins::CONFIGS.'variables_globales.class.php';

//Modeles
require_once Chemins::MODELES.'gestion_categories.class.php';
require_once Chemins::MODELES.'gestion_boutique.class.php';
require_once Chemins::MODELES.'gestion_couleur.class.php';
require_once Chemins::MODELES.'gestion_commentaire.class.php';
require_once Chemins::MODELES.'gestion_panier.class.php';
require_once Chemins::MODELES.'gestion_clavier.class.php';
require_once Chemins::MODELES.'gestion_utilisateur.class.php';

//entete
require Chemins::VUES_PERMANENTES.'v_entete.inc.php';

//controleur
require_once Chemins::CONTROLEURS.'controleur_categories.class.php';
$controleurCategories = new ControleurCategories();
$controleurCategories->afficher();

//aiquillage

require Chemins::CONFIGS.'redirection.class.php';

//pied de page
require Chemins::VUES_PERMANENTES.'v_pidedepage.inc.php';
?>

    
        
        
        