<?php

class GestionUtilisateur
{
    // <editor-fold defaultstate="collapsed" desc="Champs statiques">
    /**
     * * Objet de la classe PD0
     * @var PDO
     */
    private static $pdoCnxBase = null;
    /**
     * Objet de la classe PDOStatement
     * @var PDOStatement
     */
    private static $pdoStResults = null;
    private static $requete = "";//texte de la requete
    private static $resultat = null;//resultat de la requete
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Methodes statiques">
    /**
     * Permet de se connecter à la base de données
     */
    public static function seConnecter()
    {
        if (!isset(self::$pdoCnxBase)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host=' . MysqlConfig::SERVEUR .
                    ';dbname=' . MysqlConfig::BASE, MysqlConfig::UTILISATEUR, MysqlConfig::MOT_DE_PASSE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoCnxBase->query("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                // l'objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : ' . $e->getMessage() . '<br />'; //méthode de la classe Exception
                echo 'Erreur : ' . $e->getCode(); //méthode de la classe Exception
            }
        }
    }

    public static function seDeconnecter()
    {
        self::$pdoCnxBase = null;
        //si on n'appelle pas la methode, la deconnexion a lieu en fin de script
    }

    /**
     * Retourne la liste des categories
     * @return type Tableau d'objets
     */
    private static function SelectAll($table)
    {
        self::seConnecter();

        self::$requete = "Select * From $table";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;
    }

    // </editor-fold>

    //<editor-fold defaultstate="collapsed" desc="Controleur">
    public static function getLesUtilisateurs()
    {
        return self::SelectAll("utilisateur");
    }

    public static function getLesPersonalisationByUti() {
        self::seConnecter();

        self::$requete = "SELECT * FROM utilisateur u, commandeclavier c, clavier cl WHERE u.idUti = c.idUti and c.idClavier = cl.idClavier and u.idUti = :idUt";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUt', $_SESSION['id']);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getLesUtiById() {
        self::seConnecter();

        self::$requete = "SELECT * FROM utilisateur WHERE idUti = :idUt";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUt', $_SESSION['id']);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;

    }

    public static function loginExistant($pseudo){
        self::seConnecter();

        self::$requete = "SELECT pseudo as pseudo FROM utilisateur WHERE pseudo = :pseudo ";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    public static function emailExistant2($Mail){
        self::seConnecter();

        self::$requete = "SELECT Mail as pseudo FROM utilisateur WHERE Mail = :Mail ";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('Mail', $Mail, PDO::PARAM_STR);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    public static function logpassExistant($login,$password)
    {
        self::seConnecter();

        $mot_de_passe_hashe = password_hash($password, PASSWORD_BCRYPT);

        self::$requete="SELECT * From utilisateur WHERE login = :login AND pwd = :pwd";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('pwd', $mot_de_passe_hashe);
        self::$pdoStResults->execute();

    }
    public static function MailValid()
    {
        self::seConnecter();

        self::$requete = "select mailValid as maxid from utilisateur where idUti = :idUti";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUti', $_SESSION['id'],PDO::PARAM_INT);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->maxid;
    }
    public static function MailValidPseudo($pseudo)
    {
        self::seConnecter();

        self::$requete = "select mailValid as maxid from utilisateur where pseudo = :pseudo";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('pseudo', $pseudo);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->maxid;
    }
    public static function codeValidation()
    {
        self::seConnecter();

        self::$requete = "select codeValidation as maxid from utilisateur where idUti = :idUti";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUti', $_SESSION['id'],PDO::PARAM_INT);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->maxid;
    }
    public static function emailExistant($Mail){
        self::seConnecter();

        self::$requete = "SELECT Mail as Mail FROM utilisateur WHERE Mail = :Mail ";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('Mail', $Mail, PDO::PARAM_STR);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    /*
    // Récupération de l'id de l'utilisateur
    */
    public static function selectUserId() {
        self::seConnecter();

        self::$requete = "select * from utilisateur where idUt = :idUt";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUt', $_SESSION['idUt'],PDO::PARAM_INT);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    public static function userExistant($postName,$mail){
        self::seConnecter();

        self::$requete = "SELECT * FROM utilisateur WHERE login = :login";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $postName, PDO::PARAM_STR);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        if (self::$resultat == null) {
            self::$autorisationInscription = 1;


        }else{
            self::$autorisationInscription = 0;
        }
        return self::$autorisationInscription;
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Gestion utilisateur">
    public static function upMailValid($mailValid){

        self::seConnecter();

        self::$requete = "update utilisateur set mailValid = :mailValid where idUti = :idUti";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('mailValid', $mailValid);
        self::$pdoStResults->bindValue('idUti', $_SESSION['id'],PDO::PARAM_INT);

        self::$pdoStResults->execute();

        self::$pdoStResults->closeCursor();
    }

    public static function Inscription1($postName,$email,$postPassword,$ville,$rue,$codePostal,$pays,$complementAdresse,$datenaissance,$civilite,$nom,$prenom,$numeroTelephone,$codeValidation){

            self::seConnecter();

            $mot_de_passe_hashe = password_hash($postPassword, PASSWORD_BCRYPT);

            self::$requete = "insert into utilisateur(pseudo,Mail,pwd,DateInscription,Ville,Adresse,CodePostal,pays,ComplementAdresse,DateNaiss,civilite,nom,prenom,numtel,codeValidation) values(:login,:email,:postPassword,NOW(),:ville,:rue,:codePostal,:pays,:complementAdresse,:datenaissance,:civilite,:nom,:prenom,:numtel,:codeValidation)";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
            self::$pdoStResults->bindValue('login', $postName);
            self::$pdoStResults->bindValue('email', $email);
            self::$pdoStResults->bindValue('postPassword', $mot_de_passe_hashe);
            self::$pdoStResults->bindValue('ville', $ville);
            self::$pdoStResults->bindValue('rue', $rue);
            self::$pdoStResults->bindValue('codePostal', $codePostal);
            self::$pdoStResults->bindValue('pays', $pays);
            self::$pdoStResults->bindValue('complementAdresse', $complementAdresse);
            self::$pdoStResults->bindValue('datenaissance', $datenaissance);
            self::$pdoStResults->bindValue('civilite', $civilite);
            self::$pdoStResults->bindValue('nom', $nom);
            self::$pdoStResults->bindValue('prenom', $prenom);
            self::$pdoStResults->bindValue('numtel', $numeroTelephone);
            self::$pdoStResults->bindValue('codeValidation', $codeValidation);

            self::$pdoStResults->execute();

    }
    public static function upCode($code){

        self::seConnecter();

        self::$requete = "update utilisateur set codeValidation = :codeValidation where idUti = :idUti";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('codeValidation', $code);
        self::$pdoStResults->bindValue('idUti', $_SESSION['id'],PDO::PARAM_INT);

        self::$pdoStResults->execute();

        self::$pdoStResults->closeCursor();
    }
    public static function verificationConnexion($postName){
        self::seConnecter();

        self::$requete = "SELECT * FROM panier p, utilisateur u WHERE u.idUti = p.id and pseudo = :pseudo";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('pseudo', $postName);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    //connexion
    public static function Connexion($postName,$pwd){
        $resultat = self::verificationConnexion($postName);
        if($resultat == false) {}
        else{
            $hash = $resultat->pwd;

            if(password_verify($pwd, $hash)){
                $login = 1;
            }else{
                $login = null;
            }
            if($login == 1){
                $_SESSION['id'] = $resultat->idUti;
                $_SESSION['user'] = $resultat->pseudo;
                $_SESSION['email'] = $resultat->Mail;
                $_SESSION['dateInscription'] = $resultat->DateInscription;
                $_SESSION['ville'] = $resultat->Ville;
                $_SESSION['rue'] = $resultat->Adresse;
                $_SESSION['codePostal'] = $resultat->Codepostal;
                $_SESSION['pays'] = $resultat->pays;
                $_SESSION['complementAdresse'] = $resultat->ComplementAdresse;
                $_SESSION['datedenaissance'] = $resultat->DateNaiss;
                $_SESSION['civilite'] = $resultat->Civilite;
                $_SESSION['nom'] = $resultat->Nom;
                $_SESSION['prenom'] = $resultat->Prenom;
                $_SESSION['numeroTelephone'] =  $resultat->numtel;
                $_SESSION['codeV'] = $resultat->codeValidation;
                $_SESSION['idPanier'] = $resultat->id;
                if($resultat->idPerm == 99921){
                    $_SESSION['idPerm'] = 99921;
                }
            }else{
                $erreur = "Pseudo ou Mot de passe incorrect";
            }
        }
    }

    public static function modifierUserCommande($nom, $prenom, $civilite, $email, $ville, $rue, $Codepostal, $pays, $ComplementAdresse){

        self::seConnecter();


        self::$requete = "update utilisateur set Nom = :nom, Prenom = :prenom , Civilite = :Civilite, Mail = :email, Ville = :ville, Adresse = :rue, Codepostal = :Codepostal, pays = :pays, ComplementAdresse = :ComplementAdresse where idUti = :idUti";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUti', $_SESSION['id'],PDO::PARAM_INT);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->bindValue('prenom', $prenom);
        self::$pdoStResults->bindValue('Civilite', $civilite);
        self::$pdoStResults->bindValue('email', $email);
        self::$pdoStResults->bindValue('ville', $ville);
        self::$pdoStResults->bindValue('rue', $rue);
        self::$pdoStResults->bindValue('Codepostal', $Codepostal);
        self::$pdoStResults->bindValue('pays', $pays);
        self::$pdoStResults->bindValue('ComplementAdresse', $ComplementAdresse);

        self::$pdoStResults->execute();

        self::$pdoStResults->closeCursor();
    }

    public static function modifiermdp($Mail,$postPassword){

        self::seConnecter();

        $mot_de_passe_hashe = password_hash($postPassword, PASSWORD_BCRYPT);

        self::$requete = "update utilisateur set pwd = :pwd where Mail = :Mail";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('Mail', $Mail);
        self::$pdoStResults->bindValue('pwd', $mot_de_passe_hashe);
        self::$pdoStResults->execute();

        self::$pdoStResults->closeCursor();


    }

    public static function modifierUser($postName, $prenom, $nom, $datedenaissance, $ville, $numero, $email,$postPassword){

        self::seConnecter();

        $mot_de_passe_hashe = password_hash($postPassword, PASSWORD_BCRYPT);

        self::$requete = "update utilisateurs set login = :login,prenom = :prenom , nom = :nom, datedenaissance = :datedenaissance, numero = :numero,ville = :ville,email = :email, pwd = :pwd where idUt = :idUt";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUt', $_SESSION['idUt'],PDO::PARAM_INT);
        self::$pdoStResults->bindValue('login', $postName);
        self::$pdoStResults->bindValue('prenom', $prenom);
        self::$pdoStResults->bindValue('nom', $nom);
        self::$pdoStResults->bindValue('datedenaissance', $datedenaissance);
        //self::$pdoStResults->bindValue('civilite', $civilite);
        self::$pdoStResults->bindValue('numero', $numero);
        self::$pdoStResults->bindValue('ville', $ville);
        self::$pdoStResults->bindValue('email', $email);
        self::$pdoStResults->bindValue('pwd', $mot_de_passe_hashe);

        self::$pdoStResults->execute();

        self::$pdoStResults->closeCursor();
    }
    // </editor-fold>
}
?>