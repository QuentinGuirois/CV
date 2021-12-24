<?php

$nom = $_POST['nom'];
$telephone = $_POST['telephone'];
$message = $_POST['message'];
$email = $_POST['email'];

$to = "quentin.guirois@gmail.com"; // Adresse email du destinataire
$mail_body = $nom . "\n" . $telephone . "\n" . $message . "\n" . $email; // Corps de l'email
$subject = "Contact CV"; // Sujet de l'email
$envoi = mail($to, $subject, $mail_body);
if ($envoi) {
    echo "mail envoyé avec succès";
} else {
    echo "erreur lors de l'envoi du mail";
}

echo "<p><a href='quentinGuirois.html'>Retour</a></p>";

