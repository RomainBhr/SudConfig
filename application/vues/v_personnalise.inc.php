<div class="corp-article">
    <?php
    foreach (VariablesGlobales::$LaCat as $cat)
    {
    ?>
    <span class="bleu">
            <span class="blanc">
                <span class="rouge">
                    <h1 class="moins1">
                        Vous êtes dans la personnalisation de votre clavier <?= $cat->libelleClavier ?> </u>
                        <h3 class="moins1">
                            <a href="index.php">Accueil</a> / <a
                                    href="index.php?cas=afficherProduits&categorie=<?= $cat->idCat ?>"><?= $cat->libelleCat ?></a> /
                            <a href="index.php?cas=afficherClavier&categorie=<?= $cat->idClavier ?>">Clavier <?= $cat->libelleClavier ?></a> /
                            <a href="index.php?cas=afficherMesPersonnalisations"> #<?= $cat->compteur ?></a>
                        </h3>
                    </h1>
                    <br/>
                </span>
            </span>
        </span>
    <article>
        <br>
        <h2 class='red'><?php echo VariablesGlobales::$message2; ?></h2>
        <h1>Custom ton clavier <u>#<?= $cat->compteur ?></u>
            <?php if ($cat->favori == 1) { ?>
                <span style="color: #00a1ff">★</span>
            <?php } ?>
        </h1>
        <h4 style="color: black; text-align: left;"><span class="red">*</span> Le prix d'une touche est de 0,10€
            <a href="#oModalSupprimer" class="bouton"> Supprimer la customisation </a></h4>
        <div class="larticle">
            <form method="post" style="text-align: left;">
                <table class="leclavier">
                    <tr>
                        <?php foreach (VariablesGlobales::$touche as $unetouche) { ?>
                            <?php if ($unetouche->libelleTou == "echap") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "f1" ||
                                $unetouche->libelleTou == "f2" ||
                                $unetouche->libelleTou == "f3" ||
                                $unetouche->libelleTou == "f4" ||
                                $unetouche->libelleTou == "f5" ||
                                $unetouche->libelleTou == "f6" ||
                                $unetouche->libelleTou == "f7" ||
                                $unetouche->libelleTou == "f8" ||
                                $unetouche->libelleTou == "f9" ||
                                $unetouche->libelleTou == "f10" ||
                                $unetouche->libelleTou == "f11" ||
                                $unetouche->libelleTou == "f12") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "²" ||
                                $unetouche->libelleTou == "1" ||
                                $unetouche->libelleTou == "2" ||
                                $unetouche->libelleTou == "3" ||
                                $unetouche->libelleTou == "4" ||
                                $unetouche->libelleTou == "5" ||
                                $unetouche->libelleTou == "6" ||
                                $unetouche->libelleTou == "7" ||
                                $unetouche->libelleTou == "8" ||
                                $unetouche->libelleTou == "9" ||
                                $unetouche->libelleTou == "0" ||
                                $unetouche->libelleTou == ")" ||
                                $unetouche->libelleTou == "=" ||
                                $unetouche->libelleTou == "supp") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php } ?>
                        <?php }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "tab" ||
                                $unetouche->libelleTou == "a" ||
                                $unetouche->libelleTou == "z" ||
                                $unetouche->libelleTou == "e" ||
                                $unetouche->libelleTou == "r" ||
                                $unetouche->libelleTou == "t" ||
                                $unetouche->libelleTou == "y" ||
                                $unetouche->libelleTou == "u" ||
                                $unetouche->libelleTou == "i" ||
                                $unetouche->libelleTou == "o" ||
                                $unetouche->libelleTou == "p" ||
                                $unetouche->libelleTou == "^" ||
                                $unetouche->libelleTou == "$") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                            if ($unetouche->libelleTou == "entrée") { ?>
                                <td class="touche" rowspan="2"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "maj" ||
                                $unetouche->libelleTou == "q" ||
                                $unetouche->libelleTou == "s" ||
                                $unetouche->libelleTou == "d" ||
                                $unetouche->libelleTou == "f" ||
                                $unetouche->libelleTou == "g" ||
                                $unetouche->libelleTou == "h" ||
                                $unetouche->libelleTou == "j" ||
                                $unetouche->libelleTou == "k" ||
                                $unetouche->libelleTou == "l" ||
                                $unetouche->libelleTou == "m" ||
                                $unetouche->libelleTou == "ù" ||
                                $unetouche->libelleTou == "*") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "▲" ||
                                $unetouche->libelleTou == "<" ||
                                $unetouche->libelleTou == "w" ||
                                $unetouche->libelleTou == "x" ||
                                $unetouche->libelleTou == "c" ||
                                $unetouche->libelleTou == "v" ||
                                $unetouche->libelleTou == "b" ||
                                $unetouche->libelleTou == "n" ||
                                $unetouche->libelleTou == "?" ||
                                $unetouche->libelleTou == ";" ||
                                $unetouche->libelleTou == "/" ||
                                $unetouche->libelleTou == "!") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "▼") { ?>
                                <td class="touche" colspan="2"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        echo "<td></td>";
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "↑") { ?>
                                <td class='touche'
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche) { ?>
                            <?php if ($unetouche->libelleTou == "ctrl1" ||
                                $unetouche->libelleTou == "win" ||
                                $unetouche->libelleTou == "alt1" ||
                                $unetouche->libelleTou == "altgr" ||
                                $unetouche->libelleTou == "fn" ||
                                $unetouche->libelleTou == "autre" ||
                                $unetouche->libelleTou == "ctrl2") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                            if ($unetouche->libelleTou == "space") { ?>
                                <td class="touche" colspan="4"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        echo "<td></td>";
                        foreach (VariablesGlobales::$touche as $unetouche) {
                            if ($unetouche->libelleTou == "←" ||
                                $unetouche->libelleTou == "↓" ||
                                $unetouche->libelleTou == "→") { ?>
                                <td class="touche"
                                    style="background: <?= $unetouche->couleurperso ?>; color: <?= $unetouche->txtcouleur ?>">
                                    <a href="#oModal<?= $unetouche->libelleTou ?>"
                                       class="white-a"><?= $unetouche->libelleTou ?></a></td>
                            <?php }
                        }
                        ?>
                </table>
            </form>
            <h3 style="margin: 50px">Prix : <span class="prix"><?= number_format($cat->prixModif, 2, ',', ' ') ?> €</span></h3>
            <br>
            <aside>
                <!--<div class="artplus"><a><img class="img-round2" src="<?php echo Chemins::IMAGES . 'loop.png'; ?>"> Voir plus de détails</a></div>-->
                <div class="contenu-larticle2">
                    <form method="post">
                        <?php if ($cat->favori == 1){ ?>
                            <input class="submit bouton" type="submit" name="sup" value="Supprimer des Favoris">
                        <?php } else { ?>
                            <input class="submit bouton" type="submit" name="add" value="Ajouter aux Favoris ★">
                        <?php } ?>
                    </form>
                    <br>
                    <a href="#oModalValid" class="submit bouton">Valider ma customisation</a>
                </div>
            </aside>
        </div>
        <!-- **********************************************************
                                oModal validation
        ************************************************************-->
        <div class="oModal" id="oModalValid">
            <div>
                <header>
                    <h2>Votre customisation<a class="hautoModal" href="#fermer" title="Fermer la fenêtre">X</a></h2>
                </header>
                <section>
                    <div>
                        <h2 class='center red'>Êtes-vous sur de vouloir confirmer cette customisation ?</h2>
                        <br/>
                        <form method="post">
                            <input name="valider" value="Valider ma customisation" class="submit bouton" type="submit">
                        </form>
                        <br/>
                    </div>
                </section>
                <footer>
                    <br/>
                    <a class="basoModal" href="#fermer" title="Fermer la fenêtre">Fermer</a>
                </footer>
            </div>
        </div>
        <!-- **********************************************************
                                oModal Supprimer
        ************************************************************-->
        <div class="oModal" id="oModalSupprimer">
            <div>
                <header>
                    <h2>Supprimer<a class="hautoModal" href="#fermer" title="Fermer la fenêtre">X</a></h2>
                </header>
                <section>
                    <div>
                        <h2 class='center red'>Êtes-vous sur de vouloir supprimer cette customisation ?</h2>
                        <br/>
                        <form method="post">
                            <input name="supprimer" value="Oui supprimer cette customisation" type="submit"
                                   class="bouton">
                        </form>
                        <br/>
                    </div>
                </section>
                <footer>
                    <br/>
                    <a class="basoModal" href="#fermer" title="Fermer la fenêtre">Fermer</a>
                </footer>
            </div>
        </div>
        <!-- **********************************************************
                               oModal touche
        ************************************************************-->
        <?php foreach (VariablesGlobales::$touche as $unetouche) { ?>
            <div class="oModal" id="oModal<?= $unetouche->libelleTou ?>">
                <div>
                    <header>
                        <h2>Votre modification<a class="hautoModal" href="#fermer" title="Fermer la fenêtre">X</a></h2>
                    </header>
                    <section>
                        <div>
                            <h2 class='center red'><?php echo VariablesGlobales::$message; ?></h2>
                            <h2>
                                <br/>

                                <p> Vous avez choisit la touche <u><?= $unetouche->libelleTou ?></u>
                                    <br>qui a pour couleur le <span
                                            style="background: <?= $unetouche->couleurperso ?>; border: 1px solid #000; padding: 10px; width: 10px; height: 10px; font-size: 0px;margin-left: 10px;"> </span>
                                </p>
                                <form method="post" class="formulaire" style="text-align: center; display: initial;">
                                    <?php VariablesGlobales::$lid = $unetouche->idTouches; ?>
                                    <input type="hidden" name="id" value="<?= $unetouche->idTouches; ?>">
                                    <select name="couleur" class="bouton">
                                        <?php foreach (VariablesGlobales::$toutesLescouleurs as $uneCouleur) { ?>
                                            <option data-target="cl1" value="<?= $uneCouleur->couleurHtag ?>"
                                                    style="background: <?= $uneCouleur->couleurHtag ?>"
                                                    class="couleur"><?= $uneCouleur->libelleCouleur ?></option>
                                        <?php } ?>
                                    </select>
                                    <input data-role="update" id="update" value="Valider cette couleur"
                                           name="subcouleur" type="submit" class="submit bouton"/>
                                </form>
                                <?php if ($unetouche->couleurperso != "#000") { ?>
                                    <form method="post" style="text-align: center; display: initial;">
                                        <input name="revenir" type="submit" value="Revenir à la couleur d'origine"
                                               class="submit bouton">
                                        <input type="hidden" name="couleurdef" value="<?= $unetouche->idTouches; ?>"
                                               readonly="readonly">
                                    </form>
                                <?php } ?>
                                <br/>
                            </h2>
                        </div>
                    </section>
                    <footer>
                        <br/>
                        <a class="basoModal" href="#fermer" title="Fermer la fenêtre">Fermer</a>
                    </footer>
                </div>
            </div>
        <?php }
        } ?>
    </article>
</div>
