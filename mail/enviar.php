<?php

// Cargar el autoloader de Composer
require 'vendor/autoload.php';

// Importar las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Verificar si se recibe un POST
if ($_POST) {
    // Sanear las entradas
    $asunto = htmlspecialchars($_POST['asunto']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
}

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;   // Habilitar salida de depuración
    $mail->isSMTP();                         // Usar SMTP
    $mail->Host       = 'smtp.gmail.com';     // Servidor SMTP de Gmail
    $mail->SMTPAuth   = true;                 // Habilitar autenticación SMTP
    $mail->Username   = '123hola45xd@gmail.com'; // Tu dirección de correo de Gmail
    $mail->Password   = 'Hola1234567';  // La contraseña o la contraseña de aplicación si tienes 2FA activada
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilitar TLS implícito
    $mail->Port       = 465;                 // Puerto para SMTP con encriptación SMTPS

    // Definir los destinatarios
    $mail->setFrom('123hola45xd@gmail.com', 'Amir');  // Remitente
    $mail->addAddress('123hola45xd@gmail.com', 'Michael Gay');      // Destinatario

    // Contenido del correo
    $mail->isHTML(true);           // Establecer el formato del correo como HTML
    $mail->Subject = $asunto;      // Asunto
    $mail->Body    = $descripcion; // Cuerpo del correo

    // Enviar el correo
    $mail->send();
    header("Location:correo.php");  // Redirigir a la página de confirmación
    echo "Correo enviado exitosamente";
} catch (Exception $e) {
    echo "Error en el envío: {$mail->ErrorInfo}";
}

?>
