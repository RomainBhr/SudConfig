<div class="corp-article">
    <h1>Votre panier :</h1>
    <form method="post">
        <input value="Vider panier" name="vider" type="submit" class="boutonpaiment">
    </form>

    <div class="flex-paiment">
        <div class="lePanier">
            <h3>Vos customisations de clavier :</h3>
            <h4 class="red"><?php echo VariablesGlobales::$message; ?></h4>
            <?php
            foreach (VariablesGlobales::$lesPaniers as $lecontenue)
            {
                VariablesGlobales::$test2 = $lecontenue->idCommande;
            ?>
                <div class="contenue-panier">
                    <h4><u>Votre customisation numéro</u> : #<?= $lecontenue->compteur ?> Clavier <?= $lecontenue->libelleClavier ?></h4>
                    <h4><u>Le prix est de</u> : <span class="prix"><?= $lecontenue->prixModif ?> €</span></h4>
                    <h4><u>Qui a pour matériau</u> : <?= $lecontenue->libmateriaux ?></h4>
                </div>
            <?php } ?>
            <h3 style=" margin-top: 40px;">Vos Articles :</h3>
            <h4 class="red"><?php echo VariablesGlobales::$message2; ?></h4>
            <?php
            foreach (VariablesGlobales::$LesArticles as $unarticle)
            {
            ?>
            <div class="contenue-panier" style="margin-top: 15px">
                <h4><u>Votre article</u> : <?= $unarticle->libelle ?></h4>
                <h4><u>De catégorie</u> : <?= $unarticle->libelleCat ?>
                <h4><u>Le prix est de</u> : <span class="prix"><?= $unarticle->prix ?> €</span></h4>
                <h4><u>Quantité</u> : <?= $unarticle->quantite ?></h4>
            </div>
            <?php } ?>
        </div>
        <div class="paiment">
            <h3><u>Mon panier :</u></h3>
            <br>
            <h4><?php echo VariablesGlobales::$Panier; ?> <u>Article<?php if(VariablesGlobales::$Panier > 1){ echo "s"; }?></u></h4>
            <h4><u>Livraison</u> : Varie selon vos choix</h4>
            <br>
            <h4><u>Prix total (HT)</u> : <span class="prix"><?php echo VariablesGlobales::$prixTotal ?> €</span></h4>
            <br>
            <h4><u>TVA</u> : 20%</h4>
            <h4><u>Prix total (TTC)</u> : <span class="prix"><?php echo VariablesGlobales::$prixTotalTTC ?> €</span></h4>
            <br>
            <?php if (VariablesGlobales::$lesProduits == null){ ?>
                <h4 style="text-align: center; color: red">Vous ne pouvez pas passer de commande si votre panier est vide !</h4>
            <?php }else{ ?>
                <a style="margin-top: 50px" href="index.php?cas=passerCommande" class="boutonpaiment">Passer commande</a>
            <?php } ?>
            <br>
        </div>
    </div>
</div>
