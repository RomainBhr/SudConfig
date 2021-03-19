<div class="corp-article">
    <h1>Votre panier :</h1>
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
                <h4><u>Qui a pour matériau</u> : <?= $lecontenue->materiaux ?></h4>
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
</div>
