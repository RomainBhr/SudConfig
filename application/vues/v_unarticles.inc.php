<div class="corp-article">
    <?php
    foreach (VariablesGlobales::$LaCat as $cat)
    {
        ?>
        <span class="bleu">
            <span class="blanc">
                <span class="rouge">
                    <h1 class="moins1">
                        Vous êtes dans la catégorie <u><?= $cat->libelleCat ?></u>
                        <h3 class="moins1">
                            <a href="index.php">Accueil</a> / <a href="index.php?cas=afficherProduits&categorie=<?= $cat->idCat ?>"><?= $cat->libelleCat ?></a> /
                            <a href="index.php?cas=afficherLarticle&categorie=<?= $cat->idArticle ?>"><?= $cat->libelle ?></a>
                        </h3>
                    </h1>
                    <br />
                </span>
            </span>
        </span>
        <article>
            <h1>
                <br />
                Vous avez choisit l'option :
                <?= $cat->libelle ?>, bon choix !
            </h1>

            <div class="larticle">
                <div class="img-larticle">
                    <div class="w3-content">
                        <?php foreach (VariablesGlobales::$lesImages as $uneImage){?>
                            <div class="mySlides">
                                <img src="public/images/produit/p-<?= $uneImage->idArtic ?>/<?= $uneImage->url ?>" alt="photo" class="img-de-article" />
                            </div>
                        <?php } ?>
                    </div>
                    <div class="w3-center">
                        <?php foreach (VariablesGlobales::$lesImages as $uneImage){?>
                            <button class="boutonautre" onclick="currentDiv(<?= $uneImage->emplacement ?>)"><img src="public/images/produit/p-<?= $uneImage->idArtic ?>/<?= $uneImage->url ?>" alt="photo" width="100px" height="100px"/>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <aside>
                    <!--<div class="artplus"><a><img class="img-round2" src="<?php echo Chemins::IMAGES . 'loop.png'; ?>"> Voir plus de détails</a></div>-->
                    <div class="contenu-larticle2">
                        <h1>
                            Option,
                            <?= $cat->libelle ?>
                        </h1>
                        <h3 class="prix"><?= $cat->prix ?> €</h3>
                        <hr />
                        <h2 class="gauche"><b>Les options disponibles :</b></h2>
                        <?php
                        foreach (VariablesGlobales::$Actions as $uneAction){
                            if ($uneAction->idArticle == $cat->idArticle){ if ($uneAction->positif == 0){ ?>
                                <h3 class="gauche" style="margin-left: 5%;">
                                    <span class="vert"><b>✔ </b></span>
                                    <?= $uneAction->text ?>
                                </h3>
                                <?php
                            }else{ ?>
                                <h3 class="gauche" style="margin-left: 5%;">
                                    <span class="red"><b>X </b></span>
                                    <?= $uneAction->text ?>
                                </h3>
                            <?php }
                            }
                        }
                        foreach (VariablesGlobales::$LesStocks as $unStock){
                            if ($unStock->nbStock == 1){
                                if (isset($_SESSION['id'])){?>
                                <div class="hautCommander">
                                    <a href="#oModal<?= $cat->idArticle ?>" class="bouton"><b>Vous pouvez commander</b></a>
                                </div>
                            <?php }else{ ?>
                                <div class="hautCommander">
                                    <h3 class="center red">Vous devez être connecté pour commander</h3>
                                    <a href="index.php?cas=afficherUtilisateur" class="bouton">connectez-vous !</a>
                                </div>
                            <?php }
                            } else{ ?>
                                <div class="hautCommander">
                                    <h3 class="center red">Vous ne pouvez pas commander cette option car elle n'est pas disponible</h3>
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <!--  <a href="#"><?php var_dump(VariablesGlobales::$LaCat) ?>
                      <img class="logo" src="public/images/panier.png" title="Ajouter au panier"/> </a> -->
                </aside>
            </div>
            <div class="commentaire">
                <hr />
                <h2>Les avis sur cette option :</h2>
                <?php foreach (VariablesGlobales::$commentaire as $unCommentaire){ ?>
                    <div class="lecommentaire">
                        <p class="notecomm">
                            <?php
                            if ($unCommentaire->note == 5){ echo"★ ★ ★ ★ ★"; } elseif ($unCommentaire->note == 4){ echo"★ ★ ★ ★"; } elseif ($unCommentaire->note == 3){ echo"★ ★ ★"; } elseif ($unCommentaire->note == 2){ echo"★ ★"; } elseif
                            ($unCommentaire->note == 1){ echo"★"; } ?>
                        </p>
                        <p class="uticomm">
                            Posté par : <u><?= $unCommentaire->pseudo ?></u>
                        </p>
                        <h3><?= $unCommentaire->titre ?></h3>
                        <p class="pcomm"><?= $unCommentaire->text ?></p>
                    </div>
                <?php } ?>
            </div>
            <!-- **********************************************************
                                oModal
    ************************************************************-->
        <?php if(isset($_SESSION['id'])){ ?>
            <div class="oModal" id="oModal<?= $cat->idArticle ?>">
                <div>
                    <header>
                        <h2>Votre commande<a class="hautoModal" href="#fermer" title="Fermer la fenêtre">X</a></h2>
                    </header>
                    <section>
                        <div>
                            <h2 class='center red'><?php echo VariablesGlobales::$message; ?></h2>
                            <h2>
                                <br />
                                <p> Vous avez choisit <u><?= $cat->libelle ?></u> de la catégorie <u><?= $cat->libelleCat ?></u></p>
                                <?php
                                foreach (VariablesGlobales::$LesStocks as $unStock) {
                                    if ($unStock->nbStock == 0) { ?>
                                        <h3 class="stock">Cette article aura un délai <u class="orange">minimum de 15 jours</u></h3>
                                    <?php } else { ?>
                                        <h3 class="stock">Cette article aura un délai de <u class="vert">moins de 15 jours</u></h3>
                                    <?php }
                                } ?>
                                    <form method="post" style="text-align: center; display: initial;">
                                        <input value="Valider et commander" name="commander" type="submit" class="bouton" />
                                    </form>
                                <br />
                            </h2>
                        </div>
                    </section>
                    <footer>
                        <br />
                        <a class="basoModal" href="#fermer" title="Fermer la fenêtre">Fermer</a>
                    </footer>
                </div>
            </div>
        </article>
</div>
<?php } }?>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs((slideIndex += n));
    }

    function currentDiv(n) {
        showDivs((slideIndex = n));
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = x.length;
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace("bouton", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += "bouton";
    }
</script>
