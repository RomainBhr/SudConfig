<?php

require_once "entete.inc.php";

$lelogo = 'http://rboehler.bts-sio.com/public/images/logo/logo.png';

$message = '    <div style="display: flex; margin: 0 auto; justify-content: center; text-align: center">
                <div style="background: #f1f1f1; width: 50%; text-align: center; padding: 110px 50px 140px 50px; box-shadow: black 5px 5px 7px 0px; margin-bottom: 25px; margin-top: 14px; ">
                <img src="http://boehler-romain.info/public/sudConfig/public/images/logo/logo.png" class="img-round" width="80" height="80" alt="logo" style="border-radius:50px; left: 50px; width:80px; height:80px;" />                
                <h1 style="color: red">Nouvelle utilisateur !</h1>
                <hr style="width: 90%; margin: 5%">
                <p><b>Email : </b>'. $_POST['emails']  .'</p>
                <p><b>Objet : </b> Nouvelle inscrit : '. VariablesGlobales::$nom .' '. VariablesGlobales::$prenom .'<br>
                <b>Message : </b> Il y a un nouveau sur la boutique ! </p>
                <p>Vous pouvez gérer son compte <a href="http://rboehler.bts-sio.com/index.php?cas=afficherProduits&categorie=3">ici !</a></p>
                <p>Ses infos : </p>
                <table style="margin: auto;border: solid #000 2px; border-radius: 23px;width: 95%;">
                <tr>
                    <td>
                        <p><b>Nom d\'utilisateur : </b>'. $_POST['login'] .'</p>
                        <hr style="width: 90%; margin: auto">
                    </td>
                <tr>
                    <td>
                        <p><b>Nom et prénom : </b>'. VariablesGlobales::$nom .' '. VariablesGlobales::$prenom .'</p>
                        <hr style="width: 90%; margin: auto">
                    </td>
                <tr>
                    <td>
                        <p><b>Email : </b>'. $_POST['emails'] .'</p>
                        <hr style="width: 90%; margin: auto">
                    </td>
                <tr>
                    <td>        
                        <p><b>Ville : </b>'. $_POST['ville'] .'</p>
                        <hr style="width: 90%; margin: auto">
                    </td>
                <tr>
                    <td>
                        <p><b>Rue : </b>'. $_POST['rue'] .'</p>
                        <hr style="width: 90%; margin: auto">
                    </td>
                <tr>
                    <td>
                        <p><b>CodePostal : </b>'. $_POST['codepostal'] .'</p>
                        <hr style="width: 90%; margin: auto">
                    </td>
                <tr>
                    <td>
                        <p><b>Pays : </b>'. $_POST['pays'] .'</p>
                        <hr style="width: 90%; margin: auto">
                    </td>
                <tr>
                    <td>
                        <p><b>Numéro : </b>'. $_POST['numero'] .'</p>
                    </td>
               </table>
                <p>Son code de validation est : <b>' . VariablesGlobales::$bytes . '</b> </p>
                </div>
                </div>
                ';

VariablesGlobales::$retour = mail("romrom210601@gmail.com" , 'Nouveau utilisateur : '. VariablesGlobales::$nom .' '. VariablesGlobales::$prenom .' ', $message, VariablesGlobales::$entete);
if (VariablesGlobales::$retour) {
    VariablesGlobales::$message = '<p>Le message a bien été envoyé.</p>';
}else{
    VariablesGlobales::$message = "<p>Le message ne c'est pas envoyé votre mail n'est peut être pas valide ?</p>";
}

?>