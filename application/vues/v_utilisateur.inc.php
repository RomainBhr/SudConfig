<div class="corp-article">
    <span class="bleu">
        <span class="blanc">
            <span class="rouge">
                <h1>
                    Connectez-vous ici
                </h1>
            </span>
        </span>
    </span>
    <br>
    <h2 class='red'><?php echo VariablesGlobales::$message; ?></h2>
    <h2 class='red'><?php echo VariablesGlobales::$messageredirection; ?></h2>
    <br>
    <div class="larticle" style="margin-left: 15%">
        <div class="img-larticle">
            <form method=post>
                <table style="margin: auto">
                        <!-- Formualire pour remplir sa connexion -->
                        <tr>
                            <td style="float: right">
                                <h3>Pseudo :
                            <td><input type="text" class="input-text" name="pseudo" placeholder="Votre nom" required></p></td>

                        <tr>
                            <td>
                                <h3>Mot de passe :
                            <td style="width: 400px"><input type="password" class="input-text" name="pwd"
                                                            placeholder="Votre mot de passe" required></p></td>
                        <tr>
                            <td colspan="2">
                                <br>
                                <input name='connexion' type=submit class="bouton" value="Je me connecte !"
                                       style="width: 200px"><br>
                </table>
                <br><br>
            </form>
            <p>Mot de passe oublié ? <a href="index.php?cas=recuperationMdp">cliquer ici pour modifier votre mot de passe</a></p>
        </div>
        <aside style="border-left: solid 2px white">
            <div class="contenu-larticle2" >
                <h3>Quoi vous n'avez pas de compte ?<br><br><a class="bouton" href="index.php?cas=afficherCreerCompte" style="font-size: 15px; text-decoration: none; padding: 10px"> Créer un compte </a></h3>
            </div>
        </aside>
    </div>
</div>