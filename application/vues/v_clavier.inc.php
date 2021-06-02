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
                    <div class="bas-article">
                        <h4 style="color: #00a1f1"><?php if ($unProduit->recommander == 1){ ?> Recommander <?php } else { echo " <br> "; } ?></h4>
                        <?php if ($unProduit->libelleClavier == "Premium"){ ?>
                            <h3 class="premium">Clavier <?= $unProduit->libelleClavier ?></h3>
                        <?php }else{ ?>
                            <h3 class="center">Clavier <?= $unProduit->libelleClavier ?></h3>
                        <?php } ?>
                        <a href="index.php?cas=afficherClavier&categorie=<?= $unProduit->idClavier ?>" class="plusbouton">Le prix varie selon la demande</a>
                        <h4><?= $unProduit->description ?></h4>
                        <p class="blanc2">Le prix de départ est de <span class="prix"><?= number_format($unProduit->prix,2,',',' ') ?> €</span></p>
                    </div>

                </div>
                <?php } ?>
            </div>

        </article>
    </div>
</div>
