<?php
//Inclusion de la classe MysqlConfig
//à partir de l'emplacement actuel (dossier "modeles")
//require_once '../../configs/mysql_configs.class.php';

class GestionPanier
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

    public static function getLesProduits()
    {
        return self::SelectAll("articles");
    }

    // </editor-fold>

    public static function nombreDarticledanslepanier($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT sum(quantite)AS nbProduits FROM `contenu_panier` WHERE `id_panier` = :idPanier ";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idPanier', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;

    }

    public static function nombreDeCustomisation($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT sum(id_Commande)AS nbProduits FROM `contenu_panier` WHERE id_panier = :idPanier ";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idPanier', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;

    }

    public static function nombreDArticle($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT sum(articles_id)AS nbProduits FROM `contenu_panier` WHERE id_panier = :idPanier ";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idPanier', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;

    }

    public static function getPanierByIdUserArticle($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT * FROM contenu_panier cp, articles a, panier p, articlecategorie ac where p.id = cp.id_panier AND a.idArticle = cp.articles_id and ac.idCat = a.idCat and p.id = :id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getPanierByIdUserClavier($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT * FROM contenu_panier cp, panier p, commandeclavier c,clavier cl where p.id = cp.id_panier AND  c.idCommande = cp.id_Commande AND cl.idClavier = c.idClavier AND p.id = :id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function AjoutAuPanier($idpanier,$articleid)  {
        self::seConnecter();

        self::$requete = "insert into contenu_panier(id_panier,articles_id) values(:id_panier,:articles_id)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id_panier', $idpanier);
        self::$pdoStResults->bindValue('articles_id', $articleid);
        self::$pdoStResults->execute();
    }
    public static function AjoutAuPanierPersonalisation($idpanier,$id_Commande)  {
        self::seConnecter();

        self::$requete = "insert into contenu_panier(id_panier,id_Commande) values(:id_panier,:id_Commande)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id_panier', $idpanier);
        self::$pdoStResults->bindValue('id_Commande', $id_Commande);
        self::$pdoStResults->execute();
    }
    public static function creerPanier()
    {

        self::seConnecter();

        self::$requete = "insert into panier(dateCreation) values(NOW())";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
    }
}

?>