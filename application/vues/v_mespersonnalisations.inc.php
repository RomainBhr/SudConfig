<div class="corp-article">
    <span class="bleu">
        <span class="blanc">
            <span class="rouge">
                <h1 class="moins1">Mes personnalisations</u>
                     <h3>
                        <a href="index.php">Accueil</a> /
                        <a href="index.php?cas=afficherMesPersonnalisations">Personnalisation</a>
                    </h3>
                </h1><br>
            </span>
        </span>
    </span>
    <article>
        <div class="larticle">
        <?php
        if (VariablesGlobales::$lUti == null){
            echo "<h3 class='red gauche'>Vous n'avez aucun clavier à personnaliser :( <br> Mais nous pouvons vous en trouvez un ! <a href='index.php?cas=afficherProduits&categorie=3'>Cliquez ici !</a><h3>";
        }else{
            foreach (VariablesGlobales::$lUti as $cat)
            {
            ?>
            <?php if ($cat->favori == 1){ ?>
            <div class="unarticle" style="box-shadow: #00a1ff 7px 7px 6px 0px;">
                <?php } else { ?>
                <div class="unarticle">
                    <?php } ?>
                    <div class="bas-article">
                        <h3 class="center"> <br>Custom ton clavier : #<?= $cat->compteur ?>
                            <?php if ($cat->favori == 1){ ?>
                                <span style="color: #00a1ff">★</span>
                            <?php } ?>
                        </h3>
                        <h4>Modèle : <?= $cat->libelleClavier ?></h4>
                        <br>
                        <a href="index.php?cas=afficherPersonnalisation&categorie=<?= $cat->idCommande ?>" class="plusbouton">Le prix varie selon la demande</a>
                        <h4><?= $cat->description ?></h4>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        </div>
    </article>
