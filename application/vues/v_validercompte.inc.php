<div class="corp-article">
    <span class="bleu">
        <span class="blanc">
            <span class="rouge">
                <h1>
                    Valider votre compte ici :
                </h1>
            </span>
        </span>
    </span>
    <br>
    <h2 class='red'><?php echo VariablesGlobales::$message; ?></h2>
    <h2 class='red'><?php echo VariablesGlobales::$messageredirection; ?></h2>
    <br>
    <h3 class="noir">Un code à été envoyé à l'adresse suivante : <span class="red"><?php echo $_SESSION['email']?></span>, vérifier vos spam !</h3>
    <div class="larticle" style="margin-left: 15%">
            <form method=post>
                <input name="code" type="text" class="input-text" placeholder="Code ...">
                <br>
                <input name="validercompte" type="submit" class="bouton" style="margin-top: 20px">
            </form>
    </div>
    <form method=post>
        <input name="modifMdp" type="submit" class="bouton" value="Renvoyer un code" style="margin-top: 20px">
    </form>
</div>