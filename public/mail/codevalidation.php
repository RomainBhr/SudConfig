<?php

require_once "entete.inc.php";

$lelogo = 'http://rboehler.bts-sio.com/public/images/logo/icon.png';

$message = '<div style="display: flex; margin: 0 auto; justify-content: center; text-align: center">
                <div style="background: #f1f1f1; width: 50%; text-align: center; padding: 110px 50px 140px 50px; box-shadow: black 5px 5px 7px 0px; margin-bottom: 25px; margin-top: 14px;">
                    <img src="http://boehler-romain.info/public/sudConfig/public/images/logo/logo.png" class="img-round" width="80" height="80" alt="logo" style="border-radius:50px; left: 50px; width:80px; height:80px;" />
                    <h1 style="color: red">Votre nouveau code :</h1>
                    <hr style="width: 90%; margin: 5%">
                    <b>Votre nouveau code : </b>' . VariablesGlobales::$bytes .'<br>
                    <b>Lien pour valider votre code : </b> <a href="http://rboehler.bts-sio.com/index.php?cas=Validation">http://rboehler.bts-sio.com/index.php?cas=Validation</a>
                </div>
            </div>';
VariablesGlobales::$retour = mail($_SESSION['email'] , 'Votre nouveau code ! ', $message, VariablesGlobales::$entete);
if (VariablesGlobales::$retour) {
    VariablesGlobales::$message = '<p>Le message a bien été envoyé.</p>';
}else{
    VariablesGlobales::$message = "<p>Le message ne c'est pas envoyé votre mail n'est peut être pas valide ?.</p>";
}
?>