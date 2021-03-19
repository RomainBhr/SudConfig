<!--Corps de la page-->
<!--<div class="photo1">
    <img class="photo" src="<?php echo Chemins::IMAGES_PRODUITS.'noir.PNG'; ?>">
</div>
<div class="photo2">
    <img class="photo" src="<?php echo Chemins::IMAGES_PRODUITS.'Capture.PNG'; ?>">
</div>e-->
<div>
    <div class="menu-logo">

        <img class="logo" src="<?php echo Chemins::IMAGES_LOGO.'logo.gif'; ?>">

    </div>

    <div class="titre">

        <p class="dypherhents"><span class="jaune">SUD</span><span class="blanc2">-CONFIG</span></p>

    </div>
</div>
<div class="corp-de-page" style="margin-top: 8%; padding: 2%">
    <h1 class="moins1">Nos recommandations :</h1><br>
    <article>
        <div class="article" style="margin-top: -40px"><?php
            foreach (VariablesGlobales::$Recommander as $unProduit) {
                ?>
                <div class="unarticle">
                    <div class="bas-article">
                        <h4 style="color: #00a1f1"><?php if ($unProduit->recommander == 1){ ?> Recommander <?php } else { echo " <br> "; } ?></h4>
                        <?php if ($unProduit->libelle == "Premium"){ ?>
                            <h3 class="premium"><?= $unProduit->libelle ?></h3>
                        <?php }else{ ?>
                            <h3 class="center"><?= $unProduit->libelle ?></h3>
                        <?php } ?>
                        <a href="index.php?cas=afficherLarticle&categorie=<?= $unProduit->idArticle ?>" class="plusbouton"><?= $unProduit->prix ?> €</a>
                        <h4><?= $unProduit->Description ?></h4>
                        <hr>
                        <h3 class="gauche"><b>Les options disponibles :</b></h3>
                        <?php
                        foreach (VariablesGlobales::$Actions as $uneAction){
                            if ($uneAction->idArticle == $unProduit->idArticle){
                                if ($uneAction->positif == 0){
                                    ?>
                                    <h4 class="gauche" style="margin-left: 5%"><span class="vert"><b>✔ </b></span><?= $uneAction->text ?></h4>
                                    <?php
                                }else{ ?>
                                    <h4 class="gauche" style="margin-left: 5%"><span class="red"><b>X </b></span><?= $uneAction->text ?></h4>
                                <?php }
                            }
                        }?>
                    </div></div>
            <?php } ?>
        </div>
    </article>
</div>


