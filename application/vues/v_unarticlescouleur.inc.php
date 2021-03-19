<div class="corp-article">
    <?php
    foreach (VariablesGlobales::$idCouleur as $cat)
    {
    ?>
    <span class="bleu">
        <span class="blanc">
            <span class="rouge">
                <h1 class="moins1">Vous êtes dans l'espace <u><?= $cat->libelleg ?></u> dans la catégorie : <i><?= $cat->libelle ?></i>
                     <h3 class="moins1">
                        <a href="index.php">Accueil</a> /
                        <a href="#"><?= $cat->libelleg ?></a> /
                        <a href="index.php?cas=afficherProduits&categorie=<?= $cat->idCategorie ?>"><?= $cat->libelle ?></a> /
                        <a href="index.php?cas=afficherLarticle&categorie=<?= $cat->id ?>"><?= $cat->nom ?></a> /
                        <a href="index.php?cas=afficherLarticle&categorie=<?= $cat->idCoueleur ?>"><?= $cat->libelleCouleur ?></a>
                    </h3>
                </h1><br>
            </span>
        </span>
    </span>
    <article>
        <div class="w3-content">
            <div class="mySlides">
                <h1><br>Vêtement : <?= $cat->nom ?> </h1>
                <div class="w3-center">
                    <button class="bouton" onclick="currentDiv(1)"><b>Le vêtement</b></button>
                    <button class="bouton" onclick="currentDiv(2)"><b>Description du vêtement</b></button>
                </div>
                <div class="larticle">
                    <div class="img-larticle">
                        <?php
                            foreach (VariablesGlobales::$LesImgs as $uneImg) {
                                 ?>
                                    <img class="img-de-article" src="public/images/vetement/<?= $cat->categorie ?>/<?= $uneImg->image ?>" alt="photo"/>
                                <?php
                            }
                        ?>

                    </div>
                    <aside>
                        <!--<div class="artplus"><a><img class="img-round2" src="<?php echo Chemins::IMAGES . 'loop.png'; ?>"> Voir plus de détails</a></div>-->
                        <div class="contenu-larticle2">
                            <h1><?= $cat->nom ?></h1>
                            <h3><?= $cat->prix ?> €</h3>
                            <h3>Couleur disponible :
                            <?php
                            foreach (VariablesGlobales::$test2 as $uneCouleur) { ?>
                                <a href="index.php?cas=afficherLarticleCouleur&categorie=<?=$uneCouleur->idCouleur ?>" class="img-round3" style="padding-left: 37px; background-image: url('<?php echo Chemins::IMAGES_COULEUR . $uneCouleur->imageCouleur; ?>')"> </a>
                            <?php } ?></h3>
                            <!-- **********************************************************
                                                        oModal taille
                            ************************************************************-->

                            <div class="oModal" id="oModal<?= $cat->id ?>">
                                <div>
                                    <header>
                                        <h2>Votre taille :<a class="hautoModal" href="#fermer" title="Fermer la fenêtre">X</a></h2>
                                    </header>
                                    <section>
                                        <div>
                                            <h2>
                                                <br>
                                                <?php foreach (VariablesGlobales::$LesTailles as $uneTaille) { ?>
                                                    <form method="post" style="text-align: center; display: initial;">
                                                        <input value="<?= $uneTaille->libelleTaille ?>" name="Taille" type="submit" class="bouton">
                                                        <input name="TailleHide" type="hidden" value="<?= $uneTaille->idTaille ?>">
                                                    </form>
                                                <?php } ?>
                                                <?php
                                                foreach (VariablesGlobales::$LesStocks as $unStock){
                                                    if ($unStock->NombreEnStock == 0) { ?>
                                                        <h3 class='stock'>
                                                            Cette article aura un délai <u class="orange">minimum de 15 jours</u>
                                                        </h3>
                                                    <?php } else { ?>
                                                        <h3 class="stock">
                                                            Cette article aura un délai de <u class="vert">moins de 15 jours</u>
                                                        </h3>
                                                    <?php } } if (VariablesGlobales::$LaTaille == null or VariablesGlobales::$LaTaille > 3){ ?>
                                                        <p style="width: auto"> Veuillez choisir votre taille pour pouvoir commander  !</p>
                                                <?php } else { ?>
                                                <form method="post" style="text-align: center; display: initial;">
                                                    <input value="<?= $cat->id ?>" name="idArticle" type="hidden">
                                                    <input value="<?php echo VariablesGlobales::$LaTaille ?>" name="LaTaille" type="hidden">
                                                    <input value="<?php echo $cat->idCoueleur ?>" name="idCouleur" type="hidden">
                                                    <input value="Valider et commander" name="commander" type="submit" class="bouton">
                                                </form>
                                                <?php } ?>
                                                <br>
                                            </h2>
                                        </div>
                                    </section>
                                    <footer>
                                        <br>
                                        <a class="basoModal" href="#fermer" title="Fermer la fenêtre">Fermer</a>
                                    </footer>
                                </div>
                            </div>

                            <!--*********************************************************
                                                    Stock
                            ***********************************************************-->

                            <div class="hautCommander">
                            <a href="#oModal<?= $cat->id ?>" class="plusbouton"><b>Choisir ma taille</b></a>
                            </div>
                        </div>
                        <!--  <a href="#"><?php var_dump(VariablesGlobales::$LaCat) ?>
                      <img class="logo" src="public/images/panier.png" title="Ajouter au panier"/> </a> -->
                    </aside>
                </div>
            </div>
        </div>

        <!--*********************************************************
                                    Desciption
        ***********************************************************-->
        <div class="w3-content">
            <div class="mySlides">

                <h1><br>Vêtement : <?= $cat->nom ?></h1>
                <div class="w3-center">
                    <button class="bouton" onclick="currentDiv(1)"><b>Le vêtement</b></button>
                    <button class="bouton" onclick="currentDiv(2)"><b>Description du vêtement</b></button>
                </div>
                <div class="larticle">
                    <!--<div class="img-larticle">
                        <img style="box-shadow: red 7px 6px 0px 0px;border: solid 3px black;" src="public/images/vetement/<?= $cat->categorie ?>/<?= $cat->images ?>" alt="photo" />
                    </div>-->
                    <aside class="description">
                        <div class="contenu-larticle">
                            <h1><?= $cat->description ?></h1>
                        </div>
                        <!--  <a href="#"><?php var_dump(VariablesGlobales::$LaCat) ?>
                      <img class="logo" src="public/images/panier.png" title="Ajouter au panier"/> </a> -->
                    </aside>
                </div>
            </div>
        </div>
        <?php } ?>
    </article>
</div>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
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
