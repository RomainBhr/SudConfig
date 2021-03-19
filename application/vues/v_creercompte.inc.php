<div class="corp-article">
    <span class="bleu">
        <span class="blanc">
            <span class="rouge">
                <h1>
                    Creer votre compte ici :
                </h1>
            </span>
        </span>
    </span>

    <br>
    <h2 class='red'><?php echo VariablesGlobales::$message; ?></h2>
    <br>
    <div class="fond-default">
        <table style="margin: auto">
                <h1 class="center white">
                    <u>Veuillez remplir tout les champs avec le petit <span class="red">*</span></u>
                </h1>
                <form method=post>
                        <!-- Formualire pour remplir sa connexion -->
                            <tr>
                                <td style="float: right">
                                    <h3>Nom d'utilisateur <span class="red">*</span>
                                <td><input type="text" class="input-text margin-tab-rigth" name="login" placeholder="Votre pseudo" required></h3></td>

                                <td style="float: right">
                                    <h3>Nom <span class="red">*</span>
                                <td><input type="text" class="input-text margin-tab-rigth" name="nom" placeholder="Votre nom" ></h3></td>

                            <tr>
                                <td style="float: right">
                                    <h3>Prenom <span class="red">*</span>
                                <td><input type="text" class="input-text margin-tab-rigth" name="prenom" placeholder="Votre prenom" ></h3></td>

                                <td style="float: right">
                                    <h3>Date de naissance <span class="red">*</span>
                                <td>
                                    <input name=datedenaissance class="input-text margin-tab-rigth" type="date" placeholder="Votre date de naissance" required></h3></td>
                            <tr>
                                <td style="float: right">
                                    <h3>Civilite <span class="red">*</span>
                                <td>
                                    <div>
                                        <input type="radio" name=civilite value="homme" checked>
                                        <label><i><span class="white">Homme |</span></label>
                                        <input type="radio" name=civilite value="femme">
                                        <label><i><span class="white">Femme |</span></label>
                                        <input type="radio" name=civilite value="autre">
                                        <label><i><span class="white">Autre</span></label>
                                    </div></h3></td>

                                <td style="float: right">
                                    <h3>Numéro <span class="red">*</span>
                                <td><input type="text" class="input-text margin-tab-rigth" name="numero" placeholder="Numéro sans espace ex : 0606060606" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"></h3></td>
                            </tr>

                        <tr>
                            <td style="float: right">
                                <h3>Email <span class="red">*</span>
                            <td><input type="email" class="input-text margin-tab-rigth" name="emails" placeholder="Votre email" ></h3></td>

                            <td style="float: right">
                                <h3>Ville <span class="red">*</span>
                            <td><input type="text" class="input-text margin-tab-rigth" name="ville" placeholder="Votre ville" ></h3></td>

                        <tr>
                            <td style="float: right">
                                <h3>Rue <span class="red">*</span>
                            <td><input type="text" class="input-text margin-tab-rigth" name="rue" placeholder="Votre rue" ></h3></td>

                            <td style="float: right">
                                <h3>Code postal <span class="red">*</span>
                            <td><input type="" class="input-text margin-tab-rigth" name="codepostal" placeholder="Votre code postal" pattern="/ [0-9]\-/"></h3></td>

                        <tr>
                            <td style="float: right">
                                <h3>Pays <span class="red">*</span>
                            <td><input type="text" class="input-text margin-tab-rigth" name="pays" placeholder="Votre pays" ></h3></td>

                            <td style="float: right">
                                <h3>Complement d'adresse :
                            <td><input type="text" class="input-text margin-tab-rigth" name="complementadresse" placeholder="Votre complement d'adresse"></h3></td>

                        <tr>
                            <td style="float: right">
                                <h3>Mot de passe <span class="red">*</span>
                            <td><input type="password" class="input-text margin-tab-rigth" name="pwd" placeholder="Votre mot de passe" ></h3></td>
                    </tr>
                        <tr>
                            <td colspan="4">
                                <br>
                                <input name='creercompte' type=submit class="bouton" value="Je créer un compte"
                                       style="width: 200px"><br>

                    <br><br>
                </form>
        </table>
    </div>
</div>