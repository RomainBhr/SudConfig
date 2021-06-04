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

    public static function getLesLivreurs()
    {
        return self::SelectAll("modelivraison");
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

    public  static  function lastProduit($idPanier){
        self::seConnecter();

        self::$requete = "SELECT idCont as nbProduits FROM contenu_panier where id_panier = :idPanier ORDER BY idCont DESC LIMIT 1";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idPanier', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;
    }

    public  static  function lastLivreur(){
        self::seConnecter();

        self::$requete = "SELECT idLivraison as nbProduits FROM modelivraison ORDER BY idLivraison DESC LIMIT 1";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;
    }

    public static function prixTotal($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT sum(prix * quantite) as nbProduits FROM articles a, contenu_panier cp WHERE a.idArticle = cp.articles_id AND cp.id_panier = :idPanier ";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idPanier', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;

    }

    public static function prixTotal2($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT sum(prixModif)as nbProduits FROM commandeclavier c, contenu_panier cp WHERE c.idCommande = cp.id_Commande AND cp.id_panier = :idPanier ";

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

    public static function SupprimerAllPanier($id)  {
        self::seConnecter();

        self::$requete = "DELETE FROM `contenu_panier` WHERE id_panier = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }


    public static function getPanierByIdUserArticle($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT * FROM contenu_panier cp, articles a, panier p, articlecategorie ac where p.id = cp.id_panier AND a.idArticle = cp.articles_id and ac.idCat = a.idCat and p.id = :id ORDER BY idCont ASC";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getPanierByIdUser($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT * FROM contenu_panier cp, panier p where p.id = cp.id_panier and p.id = :id";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id', $idPanier);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getLivreurById($idLivreur) {
        self::seConnecter();

        self::$requete = "SELECT * FROM modelivraison where idLivraison = :idLivraison";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idLivraison', $idLivreur);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }

    public static function getConserverIdUserClavier($idUti) {
        self::seConnecter();

        self::$requete = "SELECT idCarte AS nbProduits,numCarte,nomCarte,dateExperiration,codeSecu,conserver,idUti FROM cartebancaire where idUti = :idUti AND conserver = 1 ORDER BY idCarte desc LIMIT 1";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idUti', $idUti);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;

    }


    public static function getPanierByIdUserClavier($idPanier) {
        self::seConnecter();

        self::$requete = "SELECT * FROM contenu_panier cp, panier p, commandeclavier c,clavier cl, materiaux m where m.prixMat = c.materiaux AND p.id = cp.id_panier AND  c.idCommande = cp.id_Commande AND cl.idClavier = c.idClavier AND p.id = :id";

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
    //****Parti gestion commander (créer une page modele plutard)
    public static function supprimerPanier($id)  {
        self::seConnecter();

        self::$requete = "DELETE FROM contenu_panier WHERE id_panier = :id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('id',$id);
        self::$pdoStResults->execute();
    }

    public  static  function lastidCommande(){
        self::seConnecter();

        self::$requete = "SELECT idCommande as nbProduits FROM commande ORDER BY idCommande DESC LIMIT 1";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;
    }
    public  static  function lastidValidation(){
        self::seConnecter();

        self::$requete = "SELECT numvalidation as nbProduits FROM validation ORDER BY numvalidation DESC LIMIT 1";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;
    }
    public  static  function lastidCarte(){
        self::seConnecter();

        self::$requete = "SELECT idCarte as nbProduits FROM cartebancaire ORDER BY idCarte DESC LIMIT 1";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;
    }
    public static function ajouterUneCommande($idCommande,$prix,$idUser,$adresseRetenue,$nomPrenomEmail,$idLivreur,$idCarte){

        self::seConnecter();

        self::$requete = "insert into commande(idCommande,prix,datePaiment,idUser,adresseRetenue,nomPrenomEmail,idLivreur,idCarte) values(:idCommande,:prix,now(),:idUser,:adresseRetenue,:nomPrenomEmail,:idLivreur,:idCarte)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->bindValue('prix', $prix);
        self::$pdoStResults->bindValue('idUser', $idUser);
        self::$pdoStResults->bindValue('adresseRetenue', $adresseRetenue);
        self::$pdoStResults->bindValue('nomPrenomEmail', $nomPrenomEmail);
        self::$pdoStResults->bindValue('idLivreur', $idLivreur);
        self::$pdoStResults->bindValue('idCarte', $idCarte);

        self::$pdoStResults->execute();

    }

    public static function ajouterUnArticleParCommande($idArticle,$idCommande,$numValidation, $quantite){

        self::seConnecter();

        self::$requete = "insert into artcilecommande(idArticle,idCommande,numValidation,quantite) values(:idArticle,:idCommande,:numValidation,:quantite)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idArticle', $idArticle);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->bindValue('numValidation', $numValidation);
        self::$pdoStResults->bindValue('quantite', $quantite);

        self::$pdoStResults->execute();

    }

    public static function ajouterValidation($numvalidation,$idTouche,$idCommande,$couleurFinal){

        self::seConnecter();

        self::$requete = "insert into validation(numvalidation,idTouche,idCommande,couleurFinal) values(:numvalidation,:idTouche,:idCommande,:couleurFinal)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('numvalidation', $numvalidation);
        self::$pdoStResults->bindValue('idTouche', $idTouche);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->bindValue('couleurFinal', $couleurFinal);

        self::$pdoStResults->execute();

    }

    public static function updateCarte($numCarte,$nomCarte,$dateExperiration, $codeSecu, $conserver, $idUti, $idCarte)  {
        self::seConnecter();

        self::$requete = "update cartebancaire Set numCarte = :numCarte,nomCarte = :nomCarte,dateExperiration = :dateExperiration,codeSecu = :codeSecu,conserver = :conserver where idUti = :idUti and idCarte = :idCarte";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('numCarte', $numCarte);
        self::$pdoStResults->bindValue('nomCarte', $nomCarte);
        self::$pdoStResults->bindValue('dateExperiration', $dateExperiration);
        self::$pdoStResults->bindValue('codeSecu', $codeSecu);
        self::$pdoStResults->bindValue('conserver', $conserver);
        self::$pdoStResults->bindValue('idUti', $idUti);
        self::$pdoStResults->bindValue('idCarte', $idCarte);
        self::$pdoStResults->execute();
    }

    public static function ajouterCarteDecredit($numCarte,$nomCarte,$dateExperiration, $codeSecu, $conserver, $idUti){

        self::seConnecter();

        self::$requete = "insert into cartebancaire(numCarte,nomCarte,dateExperiration,codeSecu,conserver,idUti) values(:numCarte,:nomCarte,:dateExperiration,:codeSecu,:conserver,:idUti)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('numCarte', $numCarte);
        self::$pdoStResults->bindValue('nomCarte', $nomCarte);
        self::$pdoStResults->bindValue('dateExperiration', $dateExperiration);
        self::$pdoStResults->bindValue('codeSecu', $codeSecu);
        self::$pdoStResults->bindValue('conserver', $conserver);
        self::$pdoStResults->bindValue('idUti', $idUti);

        self::$pdoStResults->execute();

    }

    public  static  function getLivreurByidCommande($idCommande){
        self::seConnecter();

        self::$requete = "SELECT * FROM commande c, modelivraison l where c.idCommande = :idCommande and c.idLivreur = l.idLivraison";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idCommande', $idCommande);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();
        return self::$resultat;
    }
}



?>