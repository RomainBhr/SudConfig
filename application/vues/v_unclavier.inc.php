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
                            <a href="index.php?cas=afficherClavier&categorie=<?= $cat->idClavier ?>">Clavier <?= $cat->libelleClavier ?></a>
                        </h3>
                    </h1>
                    <br />
                </span>
            </span>
        </span>
    <article>
        <h1><br>Custom ton clavier : <?= $cat->libelleClavier ?>  </h1>
        <div class="larticleClav">
            <form method="post">
                <table class="leclavier">
                    <tr>
                        <?php foreach (VariablesGlobales::$touche as $unetouche){ ?>
                            <?php if ($unetouche->libelleTou == "echap") { ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php }
                            }
                            foreach (VariablesGlobales::$touche as $unetouche){
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
                                $unetouche->libelleTou == "f12"){  ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php       }
                        }
                        echo "</tr><tr>";foreach (VariablesGlobales::$touche as $unetouche){
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
                                $unetouche->libelleTou == "supp"){ ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php } ?>
                        <?php }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche){
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
                                $unetouche->libelleTou == "$"){ ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php } if ($unetouche->libelleTou == "entrée"){?>
                                <td class="touche" rowspan="2" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php }
                        }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche){
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
                                $unetouche->libelleTou == "*"){ ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php }
                        }
                        echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche){
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
                                $unetouche->libelleTou == "!"){ ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                                <?php } }
                                foreach (VariablesGlobales::$touche as $unetouche){
                                if ($unetouche->libelleTou == "▼"){ ?>
                                <td class="touche" colspan="2" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php }
                            }
                            echo "<td></td>";
                            foreach (VariablesGlobales::$touche as $unetouche){
                                if ($unetouche->libelleTou == "↑"){ ?>
                                <td class='touche' style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php }
                        } echo "</tr><tr>";
                        foreach (VariablesGlobales::$touche as $unetouche){ ?>
                            <?php if ($unetouche->libelleTou == "ctrl1" ||
                                $unetouche->libelleTou == "win" ||
                                $unetouche->libelleTou == "alt1" ||
                                $unetouche->libelleTou == "altgr" ||
                                $unetouche->libelleTou == "fn" ||
                                $unetouche->libelleTou == "autre" ||
                                $unetouche->libelleTou == "ctrl2"){ ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                                <?php }if ($unetouche->libelleTou == "space"){ ?>
                                <td class="touche" colspan="4" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php } } echo "<td></td>";foreach (VariablesGlobales::$touche as $unetouche){
                                if ($unetouche->libelleTou == "←" ||
                                    $unetouche->libelleTou == "↓" ||
                                    $unetouche->libelleTou == "→"){ ?>
                                <td class="touche" style="background: <?= $unetouche->couleur ?>; color: <?= $unetouche->txtcouleur ?>"><?= $unetouche->libelleTou ?></td>
                            <?php } }
                         ?>
                </table>
                <div class="contenu-larticle">
                    <br>
                        <h3 class="noir center">Vous devez choisir le style de clavier :</h3>
                        <select name="option" class="bouton-select">
                            <?php foreach (VariablesGlobales::$categoriedestouches as $unecat){ ?>
                                <option value="<?= $unecat->prixToucheCat?>"><?= $unecat->libelleCatT ?> - <?= $unecat->prixToucheCat?> €</option>
                            <?php } ?>
                        </select>
                    <br>
                    <br>
                    <h3 class="noir center">Vous pouvez valider la commande :</h3>
                    <h4 class="noir">Le prix de départ est de <span class="prix"><?= number_format($cat->prix,2,',',' ') ?> €</span></h4>
                    <input name="personnalise" type="submit" class="bouton" value="Custom le clavier !">
                </div>
            </form>
        </div>
        <?php } ?>
    </article>
</div>