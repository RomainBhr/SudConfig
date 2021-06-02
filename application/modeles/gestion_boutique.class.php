<?php
//Inclusion de la classe MysqlConfig
//à partir de l'emplacement actuel (dossier "modeles")
//require_once '../../configs/mysql_configs.class.php';

class GestionBoutique {
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

      public static function getLesProduits() {
       return self::SelectAll("articles");
    }

    // </editor-fold>
    
    public static function getLesProduitsByCategorie($cat) {
        self::seConnecter();
        
        self::$requete = "SELECT * FROM articles P,articlecategorie C, stockdisponibiliter S where P.idCat = C.idCat AND c.idCat = :idCat AND S.idArticle = P.idArticle";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCat', $cat);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();
        
        self::$pdoStResults->closeCursor();
        return self::$resultat;
        
    }
    public static function getLesImagesById($id) {
        self::seConnecter();

        self::$requete = "select * from image i, articles a where a.idArticle = i.idArtic and idArtic = :idArticle ORDER BY emplacement";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idArticle', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getLesActions() {
        self::seConnecter();

        self::$requete = "select * from articles a, actionarticle ac where a.idArticle = ac.idArticles ";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

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
        public static function getProduitById($genre) {
        self::seConnecter();

        self::$requete = "SELECT * FROM articlecategorie a,articles b where idArticle = :id AND b.idCat = a.idCat";

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

    public static function ajouterCategorie($libelleCateg)  {
        self::seConnecter();
        
        self::$requete = "insert into Categorie(libelle) values(:libelle)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
    }/**
     * Ajoute une ligne dans la table Categorie
     * @param type $libelleCateg Libellé de la Catégorie
     */
     public static function ajouterProduit($nomProd,$descriptionProd,$prixProd,$idCategorieProd)  {
        self::seConnecter();
        
        self::$requete = "insert into Produit(nom,description,prix,idCategorie) values(:nom,:description,:prix,:idCategorie)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('nom', $nomProd);
        self::$pdoStResults->bindValue('description', $descriptionProd);
        self::$pdoStResults->bindValue('prix', $prixProd);
        self::$pdoStResults->bindValue('idCategorie', $idCategorieProd);
        self::$pdoStResults->execute();
    }
     public static function ModifierProduit($nomProd, $id)  {
        self::seConnecter();
        
        self::$requete = "update Produit Set nom = :nom where id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('nom',$nomProd);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }
     public static function SupprimerProduit($id)  {
        self::seConnecter();
        
        self::$requete = "delete from Produit where id = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }
}


//$lesCategories = GestionBoutique::getLesCategories();
//    var_dump($lesCategories);
//    
//    //Test de la methode getLesProduitsByCategorie()
//    $lesProduits = GestionBoutique::getLesProduitsByCategorie("blues");
//    var_dump($lesProduits);
    
//$leProduit = GestionBoutique::getLesProduitsById(1);
//var_dump($leProduit);
//var_dump(GestionBoutique::getNbProduits());
//GestionBoutique::ajouterCategorie('funk');
//var_dump(GestionBoutique::getLesCategories());
//GestionBoutique::ajouterProduit('Jul','Live in Marseille','10.99','3');
//var_dump(GestionBoutique::getLesProduits());
// GestionBoutique::ModifierCategorie('funk');
// var_dump(GestionBoutique::getLesCategories());
// GestionBoutique::ModifierProduit('enzo',17);
// GestionBoutique::SupprimerProduit(17);
//$nbProduits = GestionBoutique::getNbProduits();
//echo "Il y a $nbProduits produit(s) dans la boutique...";
//$lesProduits = GestionBoutique::getProduitById(1);
//var_dump($lesProduits);
//
//echo 'id : '.$lesProduits->id ;
//echo '<br/>nom : '.$lesProduits->nom;
//echo '<br/>description : '.$lesProduits->description;
//echo '<br/>prix : '.$lesProduits->prix;'<br/>';
//echo "<br/>Fichier de l'image : ".$lesProduits->image;
//    $lesCategories = GestionBoutique::getLesCategories();
//    var_dump($lesCategories);
//    echo 'Le libellé de la 3ème catégorie est : '.$lesCategories[2]->libelle;
//    
