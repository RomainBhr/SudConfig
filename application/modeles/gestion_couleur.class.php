<?php
//Inclusion de la classe MysqlConfig
//à partir de l'emplacement actuel (dossier "modeles")
//require_once '../../configs/mysql_configs.class.php';

class GestionCouleur
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

    public static function getLarticleByCouleur($genre) {
        self::seConnecter();

        self::$requete = "SELECT * FROM articlecategorie ac, genre g,articles a,couleur_article c  where a.id = c.idArticle AND idCoueleur = :id AND g.idGenre = ac.genre AND a.categorie = ac.idCategorie";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $genre);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getLesCouleurs($genre) {
        self::seConnecter();

        self::$requete ="SELECT * from articles a, image_article, couleur_article c where idCoueleur = :idCoueleur and image_article.idArticle = a.id and c.idCoueleur = image_article.idCouleur";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCoueleur', $genre);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getLesCouleursEtImg($genre,$Couleur) {
        self::seConnecter();

        self::$requete ="SELECT * FROM image_article i, articles a WHERE `idArticle`= :id and `idCouleur` = :idC and i.idArticle = a.id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $genre);
        self::$pdoStResults->bindValue('idC', $Couleur);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

}

?>