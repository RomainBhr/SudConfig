<?php
class ControleurUtilisateur
{

// <editor-fold defaultstate="collapsed" desc="afficher">
    public function afficher()
    {

        // <editor-fold defaultstate="collapsed" desc="Message selon d'ou vient la personne">
        VariablesGlobales::$lid = GestionClavier::getLesClavier();
        foreach (VariablesGlobales::$lid as $uneId) {
            if ($_SERVER['HTTP_REFERER'] == "http://rboehler.bts-sio.com/index.php?cas=afficherClavier&categorie=$uneId->idClavier") {
                VariablesGlobales::$messageredirection = "Vous avez été redirigé ici car vous devez êtres connecté pour commander un clavier";
                VariablesGlobales::$lurl = "http://rboehler.bts-sio.com/index.php?cas=afficherClavier&categorie=$uneId->idClavier";
            }
        }

            if (isset($_POST['connexion'])) {
                if (!empty($_POST)) {
                    if(GestionUtilisateur::Connexion($_POST['pseudo'],$_POST['pwd']) != GestionUtilisateur::getLesUtilisateurs()){
                        VariablesGlobales::$message="Pseudo ou Password non valide ! ";
                    } else {
                    GestionUtilisateur::Connexion($_POST['pseudo'],$_POST['pwd']);
                        if (GestionUtilisateur::MailValidPseudo($_POST['pseudo']) == 0){
                            ?>
                            <script> window.location.href = "index.php?cas=Validation"  </script>
                            <?php
                        }else{
                            ?>
                            <script> window.location.href = "index.php"  </script>
                            <?php
                        }
                 }
            }
        }
        //</editor-fold>

        if (isset($_SESSION['id'])){
            if (GestionUtilisateur::MailValid() == 0){
                ?>
                <script> window.location.href = "index.php?cas=Validation"  </script>
                <?php
            }else{
                ?>
                <script> window.location.href = "index.php"  </script>
                <?php
            }
        }

        require Chemins::VUES . 'v_utilisateur.inc.php';
    }
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="Créer compte">
    public function CreerCompte()
    {
        if (isset($_SESSION['id'])){
            ?>
            <script> window.location.href = "index.php"  </script>
            <?php
        }

        if (isset($_POST['creercompte'])){
            if (!empty($_POST)) {
                // Le nom est-il rempli ?
                if (filter_var($_POST['emails'],FILTER_VALIDATE_EMAIL)) {
                    VariablesGlobales::$message = " ";
                }else{
                    VariablesGlobales::$message = "Cette emails n'est pas valide ou n'existe pas !";
                }
                if ($_POST['nom'] == ""){
                    VariablesGlobales::$message = "Indiquer votre nom !";
                }
                elseif (GestionUtilisateur::emailExistant($_POST['emails'])) {
                    VariablesGlobales::$message = "Votre emails est déjà pris !";
                }
                elseif (GestionUtilisateur::loginExistant($_POST['login'])) {
                    VariablesGlobales::$message = "Votre pseudo est déjà pris !";

                }else{
                    VariablesGlobales::$bytes = bin2hex(random_bytes(3));
                    VariablesGlobales::$nom = $_POST['nom'];
                    VariablesGlobales::$nom = ucfirst(VariablesGlobales::$nom);
                    VariablesGlobales::$prenom = $_POST['prenom'];
                    VariablesGlobales::$prenom = ucfirst(VariablesGlobales::$prenom);

                    GestionUtilisateur::Inscription1($_POST['login'],$_POST['emails'],$_POST['pwd'],$_POST['ville'],$_POST['rue'],$_POST['codepostal'],$_POST['pays'],$_POST['complementadresse'],$_POST['datedenaissance'],$_POST['civilite'],VariablesGlobales::$nom,VariablesGlobales::$prenom,$_POST['numero'],VariablesGlobales::$bytes);
                    GestionPanier::creerPanier();

                    require Chemins::MAIL . 'new_compte.php';
                    require Chemins::MAIL . 'new_utilisateur.php';

                    GestionUtilisateur::Connexion($_POST['login'],$_POST['pwd']);
                    ?>
                    <script> window.location.href = "index.php?cas=Validation"  </script>
                    <?php
                }
            }
        }
        require Chemins::VUES . 'v_creercompte.inc.php';
    }

//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="Validation">
    public function valider(){
        if (!isset($_SESSION['id'])){
            ?>
            <script> window.location.href = "index.php?cas=afficherUtilisateur"  </script>
            <?php
        }
        VariablesGlobales::$mail = $_SESSION['email'];
        if (isset($_POST['modifMdp'])) {
            VariablesGlobales::$bytes = bin2hex(random_bytes(3));
            GestionUtilisateur::upCode(VariablesGlobales::$bytes);
            require Chemins::MAIL . 'codevalidation.php';
            if (!VariablesGlobales::$retour) {
                VariablesGlobales::$message = "<p>Le message ne c'est pas envoyé, votre mail n'est peut être pas valide ?</p>";
                ?>
                <script> window.location.href = "index.php?cas=Validation"  </script>
                <?php
            }
        }

        if (GestionUtilisateur::MailValid() == 1){
            ?>
            <script> window.location.href = "index.php?cas=afficherPanier"  </script>
            <?php
        }else {
            if ($_SERVER['HTTP_REFERER'] == "http://rboehler.bts-sio.com/index.php?cas=Afficherpanier") {
                VariablesGlobales::$messageredirection = "Vous avez été redirigé ici car vous devez valider votre compte pour accéder au panier";
            }
            VariablesGlobales::$Actions = GestionUtilisateur::codeValidation();
            if (isset($_POST['validercompte'])) {
                if ($_POST['code'] == VariablesGlobales::$Actions) {
                    GestionUtilisateur::upMailValid(1);
                    ?>
                    <script> window.location.href = "index.php"  </script>
                    <?php
                } else {
                    VariablesGlobales::$message = "Le code est mauvais";
                }
            }
        }
        require Chemins::VUES . 'v_validercompte.inc.php';
    }
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="Mdp oublié">
    public function mdpOublier(){
        if (isset($_SESSION['id'])){
            ?>
            <script> window.location.href = "index.php"  </script>
            <?php
        }
        if (isset($_POST['validermdp'])) {
            if (GestionUtilisateur::emailExistant($_POST['emails'])) {
                VariablesGlobales::$bytesmdp = bin2hex(random_bytes(3));
                require Chemins::MAIL . 'mdp_oublie.php';
                GestionUtilisateur::modifiermdp($_POST['emails'],VariablesGlobales::$bytesmdp);
                VariablesGlobales::$message = "Un mail à bien était envoyé nous vous laissons suivre les indications <br> Si le mail n'apparait pas vérifier vos spams ou attendais quelques minutes";
            } else {
                VariablesGlobales::$message = "Ce mail n'est relié à aucun compte !";
            }
        }

        require Chemins::VUES . 'v_mdpoublier.inc.php';
    }
//</editor-fold>

// <editor-fold defaultstate="collapsed" desc="Afficher mes personnalisations">
    public function afficherMesPersonnalisations(){
        if (!isset($_SESSION['id'])) {
            ?>
            <script> window.location.href = "index.php?cas=afficherUtilisateur"  </script>
            <?php
        }
        VariablesGlobales::$commandesum = GestionClavier::nombredeCommande();
        VariablesGlobales::$lUti = GestionUtilisateur::getLesPersonalisationByUti();
        VariablesGlobales::$idUti = $_SESSION['id'];

        /*VariablesGlobales::$touche = GestionClavier::getLesTouchesPersonnalisation($id);
        VariablesGlobales::$idMax = GestionClavier::getDerniereId();
        VariablesGlobales::$idMax = VariablesGlobales::$idMax + 1;
        */
        require Chemins::VUES . 'v_mespersonnalisations.inc.php';
    }
    //</editor-fold>

}
?>