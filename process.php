
<?php

//PHPMAILER

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';

//TEST
var_dump($mail);

//TEST FORMULAIRE SI IL N'EST PAS VIDE
$nom = (!empty($_POST['nom']))?$_POST["nom"]:"non renseigné";
$prenom = (!empty($_POST['prenom']))?$_POST["prenom"]:"non renseigné";
$email = (!empty($_POST['email']))?$_POST["email"]:"non renseigné";
$message = (!empty($_POST['message']))?$_POST["message"]:"non renseigné";

//autoFormat html

$autoFormat = "";
$autoFormat = "Nouveau message de : <b>".$prenom. " " .$nom. "</b>";
$autoFormat = "<hr/>";
$autoFormat = Stripslashes($message);

//Instanciation

$mail = new PHPMailer();

try {
    // //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    // $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'user@example.com';                     //SMTP username
    // $mail->Password   = 'secret';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email);
    $mail->addAddress("quentin.guirois@gmail.com", "Quentin Guirois"); //Add a recipient
    $mail->setLanguage('fr', '/optional/path/to/language/directory/');    
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    
    $mail->MsgHTML(nl2br($message));
    $mail->AltBody = 'Salut Quentin : Pas de chance, ta messagerie ne prend pas en compte le code html :(';
    
    //TEST DU FICHIER
    if(isset($_FILES['fichier']) && ($_FILES['fichier']['error'] == 0)) {

        $fichier = $_FILES['fichier']['name'];
        $chemin = $_FILES['fichier']['tmp_name'];
        
        //On joint le fichier
        $mail->Subject = 'Nouveau message de : '.$prenom. ' ' .$nom. ' avec le fichier :'.$fichier;
        $mail->addAttachment($chemin, $fichier);
        echo "<p class=\"alert alert-info\">Le fichier $fichier se trouve à l'emplacement $chemin </p>";
    } else {
        $mail->Subject = 'Nouveau message de : '.$prenom. ' ' .$nom. '.';
        echo "<p class=\"alert alert-info\">Mail envoyé sans PJ.</p>";
    }
    
    $mail->send();
    
    
} catch (Exception $e) {
    echo "<p class=\"alert alert-danger\"> Echec de l'envoi du message.</p>";
    echo "<p class=\"alert alert-danger\"> Une erreur est survenue: {$mail->ErrorInfo}</p>";
    echo "<br /><a href='quentin.Guirois.html'><button class=\"btn btn-primary\">Retour</button></a> ";
}
?>