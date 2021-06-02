<?php
//Inclusion de la classe MysqlConfig
//à partir de l'emplacement actuel (dossier "modeles")
//require_once '../../configs/mysql_configs.class.php';

class GestionClavier {
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
    public static function seConnecter()   {
        if (!isset(self::$pdoCnxBase)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host='  . MysqlConfig::SERVEUR    .
                    ';dbname=' . MysqlConfig::BASE, MysqlConfig::UTILISATEUR, MysqlConfig::MOT_DE_PASSE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoCnxBase->query("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                // l'objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : '  . $e->getMessage()  . '<br />'; //méthode de la classe Exception
                echo 'Erreur : '  . $e->getCode(); //méthode de la classe Exception
            }
        }
    }
    public static function seDeconnecter()    {
        self::$pdoCnxBase = null;
        //si on n'appelle pas la methode, la deconnexion a lieu en fin de script
    }
    /**
     * Retourne la liste des categories
     * @return type Tableau d'objets
     */
    private static function SelectAll($table){
        self::seConnecter();

        self::$requete = "Select * From $table";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;
    }

    // </editor-fold>

    public static function getLesClavier() {
        return self::SelectAll("clavier");
    }
    public static function getLesCouleur() {
        return self::SelectAll("couleur");
    }
    public static function getLesCatDesTouches() {
        return self::SelectAll("categorie_touche");
    }
    public static function getLesMateriaux() {
        return self::SelectAll("materiaux");
    }
    // <editor-fold defaultstate="collapsed" desc="partie des touches">
    public static function getLesClavierByCategorie($cat) {
        self::seConnecter();

        self::$requete = "SELECT * FROM clavier P,articlecategorie C where P.idCat = C.idCat AND c.idCat = :idCat";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCat', $cat);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }
    public static function getLesClavierByid($genre) {
        self::seConnecter();

        self::$requete = "SELECT * FROM clavier P,articlecategorie C where P.idCat = C.idCat AND P.idClavier = :id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $genre);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }
    public static function getLesTouches($id) {
        self::seConnecter();

        self::$requete = "SELECT * from touche t where t.idClavier = :idClavier";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idClavier', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getDerniereId() {
        self::seConnecter();

        self::$requete = "SELECT MAX(idCommande)AS maxid FROM commandeclavier";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->maxid;
    }

    public static function getLePrixById($id) {
        self::seConnecter();

        self::$requete = "SELECT prix as unprix FROM clavier where idClavier = :id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->unprix;
    }
    public static function getCommandeById2($id) {
        self::seConnecter();

        self::$requete = "SELECT prix as unprix FROM clavier where idClavier = :id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->unprix;
    }
    public static function getNosRecommandations() {
        self::seConnecter();

        self::$requete = "SELECT * FROM articles a where recommander = 1";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }
    public static function getCommandeById($genre) {
        self::seConnecter();

        self::$requete = "SELECT * FROM commandeclavier WHERE idCommande = :id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $genre);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }


    public static function getLesStocks($article) {
        self::seConnecter();

        self::$requete = "SELECT * FROM `stockdisponibiliter` WHERE `idArticle` = :id ";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $article);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function nombredeCommande() {
        self::seConnecter();

        self::$requete = "SELECT sum(idCommande)AS nbProduits FROM commandeclavier WHERE idUti = :idUt ";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUt', $_SESSION['id']);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;

    }

    public static function ajouterPersonnalisation($idTouche,$idCommande)  {
        self::seConnecter();

        self::$requete = "insert into personnalisation(idTouches,idCommande,couleurperso) values(:idTouche,:idCommande,'#000')";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idTouche', $idTouche);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->execute();
    }

    public static function getDerniereCompteurById($idUti,$idClavier) {
        self::seConnecter();

        self::$requete = "SELECT MAX(compteur)AS maxid FROM commandeclavier WHERE idUti = :idUti and idClavier = :idClavier";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUti', $idUti);
        self::$pdoStResults->bindValue('idClavier', $idClavier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->maxid;
    }


    public static function ajouterCommande($idCommande,$materiaux,$idUti,$idClavier,$idToucheCat,$compteur,$prix)  {
        self::seConnecter();

        self::$requete = "insert into commandeclavier(idCommande,materiaux,idUti,idClavier,idToucheCat,compteur,prixModif) values(:idCommande,:materiaux,:idUti,:idClavier,:idToucheCat,:compteur,:prixModif)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->bindValue('materiaux', $materiaux);
        self::$pdoStResults->bindValue('idUti', $idUti);
        self::$pdoStResults->bindValue('idClavier', $idClavier);
        self::$pdoStResults->bindValue('idToucheCat', $idToucheCat);
        self::$pdoStResults->bindValue('compteur', $compteur);
        self::$pdoStResults->bindValue('prixModif', $prix);
        self::$pdoStResults->execute();
    }
    public static function ModifierCouleur($couleur,$id,$idC)  {
        self::seConnecter();

        self::$requete = "update personnalisation Set couleurperso = :couleurperso where idTouches = :id and idCommande = :idC";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('couleurperso',$couleur);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->bindValue('idC',$idC);
        self::$pdoStResults->execute();
    }
    public static function SupprimerProduit($id)  {
        self::seConnecter();

        self::$requete = "delete from Produit where id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Partie personnalisation">
    public static function supprimerPersonnalisation($id)  {
        self::seConnecter();

        self::$requete = "delete from personnalisation where `idCommande` = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }

    public static function getLesPersonalisationCommu() {
        self::seConnecter();

        self::$requete = "SELECT * FROM utilisateur u, commandeclavier c, clavier cl WHERE u.idUti = c.idUti and c.idClavier = cl.idClavier";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;
    }

    public static function supprimerCommandedeClavier($id)  {
        self::seConnecter();

        self::$requete = "DELETE FROM commandeclavier WHERE idCommande = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }

    public static function modifFav($favori,$id)  {
        self::seConnecter();

        self::$requete = "update commandeclavier Set favori = :favori where idCommande = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('favori',$favori);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }
    public static function modifPrix($prixModif,$id)  {
        self::seConnecter();

        self::$requete = "update commandeclavier Set prixModif = :prixModif where idCommande = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('prixModif',$prixModif);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }

    public static function getLesPersonnalisationById($idCommande) {
        self::seConnecter();

        self::$requete = "SELECT * FROM utilisateur u, commandeclavier c, clavier cl, articlecategorie ac WHERE u.idUti = c.idUti and c.idClavier = cl.idClavier and ac.idCat = cl.idCat and c.idCommande = :idCommande";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }
    /*
    public static function getLesPersonnalisationById($idCommande) {
        self::seConnecter();

        self::$requete = "SELECT * FROM commandeclavier c WHERE c.idCommande = :idCommande";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }*/
    public static function getLesTouchesPersonnalisation($id) {
        self::seConnecter();

        self::$requete = "SELECT * from personnalisation p, touche t where  t.idTouche = p.idTouches and p.idCommande = :idClavier";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idClavier', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getLacouleurByid($idTouche, $idCommande) {
        self::seConnecter();

        self::$requete = "SELECT couleurperso as lacouleur FROM `personnalisation` WHERE `idTouches` = :idTouche and idCommande = :idCommande";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idTouche', $idTouche);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->lacouleur;
    }

    public static function getMinTouche($idClavier) {
        self::seConnecter();

        self::$requete = "SELECT min(idTouche) as mintouche FROM `touche` where idClavier = :idClavier";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idClavier', $idClavier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->mintouche;
    }

    public static function getMaxTouche($idClavier) {
        self::seConnecter();

        self::$requete = "SELECT max(idTouche) as maxtouche FROM `touche` where idClavier = :idClavier";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idClavier', $idClavier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->maxtouche;
    }

    public static function getIdClavierByCommande($idCommande) {
        self::seConnecter();

        self::$requete = "SELECT idClavier as idclavier FROM `commandeclavier` WHERE idCommande = :idCommande";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->idclavier;
    }

    // </editor-fold>
}

