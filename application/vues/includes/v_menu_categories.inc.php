<!--********************************************************
                        Menu principal
*********************************************************-->
<body>
    <header>
        <div class="menu-principal">

                <div class="menu-gauche-logo">
                    <p><a href="index.php"><img class="img-round" src="<?php echo Chemins::IMAGES_LOGO.'logo.png'; ?>"><span class="margin-left"><span class="white">SUD-CONFIG</span></span></a></p>
                </div>
                <div class="menu-nav">
                    <nav>
                        <ul>
                            <?php foreach(VariablesGlobales::$lesCategories as $uneCategorie){
                                if ($uneCategorie->idCat == 3){ ?>
                                    <li class="menu-even">
                                        <a href="index.php?cas=afficherProduits&categorie=<?php echo $uneCategorie->idCat;?>" class="a-menu"> Custom ton clavier </a>
                                        <ul class='submenu'>
                                            <li>
                                                <a class="menu-submenu" href="index.php?cas=afficherClavierEquipe">Les customisations de l'équipe</a>
                                                <a class="menu-submenu" href="index.php?cas=afficherClavierCommu">Les customisations de la commu</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php }else{ ?>
                                    <li class="menu-even">
                                        <a href="index.php?cas=afficherProduits&categorie=<?php echo $uneCategorie->idCat;?>" class="a-menu"> <?php echo $uneCategorie->libelleCat ?> </a>
                                    </li>
                            <?php } } ?>
                            <li class="menu-even"> <a href="#" class="a-menu"> Qui sommes-nous ? </a></li>
                            <?php if (!isset($_SESSION['user'])){ ?>
                                <li class="menu-even"><a href="index.php?cas=afficherUtilisateur" class="a-menu-icon">Connexion<!--<img class="img-roundIcon" src="<?php echo Chemins::IMAGES_ICON.'user.png'; ?>">--></a></li>
                            <?php } ?>
                            <?php if (isset($_SESSION['user'])){ ?>
                                <li class='menu-even'><a  class="a-menu" href='#'>Salut : <span style="color: #ff1414"><b><?php echo $_SESSION['user']; ?></span></b></a>
                                    <ul class='submenu'>
                                        <li>
                                            <?php if (isset($_SESSION['idPerm'])){ ?>
                                            <a class="menu-submenu" style="color: #ff1414" href='index.php?cas=AfficherAdminx5106&categorie=menu'>Pannel Admin</a>
                                            <?php } ?>
                                            <a class="menu-submenu" href="index.php?cas=afficherMesPersonnalisations">Mes customisations </a>
                                            <a class="menu-submenu" href='index.php?cas=Afficher&categorie=compte'>Mon compte</a>
                                            <a class="menu-submenu" href='index.php?cas=Afficher&categorie=deco'> Déconnexion</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <div class="menu-droite-autre">
                                <?php if (isset($_SESSION['user'])){ ?><span class="panier"><?php echo VariablesGlobales::$Panier; ?></span>
                                <li class="menu-even-icon"><a href="index.php?cas=afficherPanier" class="a-menu-icon"><img class="img-roundIcon2" src="<?php echo Chemins::IMAGES_ICON.'panier.png'; ?>" ></a></li>
                                <?php } ?>
                            </div>

                        </ul>
                    </nav>

                </div>
            </div>

    </header>
    <section>
        <div class="corp-de-page">
