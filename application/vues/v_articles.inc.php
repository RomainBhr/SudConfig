<div class="corp-article">
    <?php
    foreach (VariablesGlobales::$LaCat as $cat)
    {
    ?>

    <span class="bleu">
        <span class="blanc">
            <span class="rouge">
                <h1 class="moins1">Vous êtes dans la catégorie <u><?= $cat->libelleCat?></u>
                     <h3 class="">
                        <a href="index.php">Accueil</a> /
                        <a href="index.php?cas=afficherProduits&categorie=<?= $cat->idCat ?>"><?= $cat->libelleCat ?></a>
                    </h3>
                </h1><br>
            </span>
        </span>
    </span>

    <article>

        <?php } ?>
        <div class="article"><?php
            foreach (VariablesGlobales::$lesProduits as $unProduit) {
                ?>
            <?php if ($unProduit->recommander == 1){ ?>
                <div class="unarticle" style="box-shadow: #00a1ff 7px 7px 6px 0px;">
                <?php } else { ?>
                    <div class="unarticle">
                    <?php } ?>
                        <?php if ($unProduit->nbStock < 1){ ?>
                            <div class="stock-succ">
                                <h4>Victime de son succès</h4>
                            </div>
                        <div class="bas-article" style="padding-top: 0px">
                        <?php }else{ ?>
                            <div class="bas-article">
                                <?php } ?>
                                <h4 style="color: #00a1f1"><?php if ($unProduit->recommander == 1){ ?> Recommander <?php } else { echo " <br> "; } ?></h4>
                                <?php if ($unProduit->libelle == "Premium"){ ?>
                                    <h3 class="premium"><?= $unProduit->libelle ?></h3>
                                <?php }else{ ?>
                                <h3 class="center"><?= $unProduit->libelle ?></h3>
                                    <?php } ?>
                                <a href="index.php?cas=afficherLarticle&categorie=<?= $unProduit->idArticle ?>" class="plusbouton"><?= $unProduit->prix ?> €</a>
                                <h4><?= $unProduit->Description ?></h4>
                                <hr>
                                <h3 class="gauchetitre"><b>Les options disponibles :</b></h3>
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
                            </div>

                    </div>
            <?php } ?>
        </div>

    </article>
</div>
