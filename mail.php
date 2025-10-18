<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $form_name = $_POST['NOMBRE'];
    $email = $_POST['CORREO'];
    $phone = $_POST['phone'];
    $no_of_persons = $_POST['Cantidad_de_invitador'];
    $date_picker = $_POST['date-picker'];
    $time_picker = $_POST['time-picker'];
    $preferred_food = $_POST['Menu'];
    $occasion = $_POST['ocasión'];

    // Validar datos
    if (empty($form_name)) {
        echo '<div class="error_message">¡Atención! Debes ingresar tu nombre.</div>';
        exit();
    }
    if (empty($email)) {
        echo '<div class="error_message">¡Atención! Por favor ingresa una dirección de correo electrónico válida.</div>';
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="error_message">¡Atención! Has ingresado una dirección de correo electrónico inválida.</div>';
        exit();
    }
    if (empty($date_picker)) {
        echo '<div class="error_message">¡Atención! Por favor ingresa la fecha.</div>';
        exit();
    }

    // Configurar el destinatario del correo y el asunto
    $to = "##############"; // Cambia esto al correo donde deseas recibir los mensajes
    $subject = "Nueva Reservación";

    // Construir el cuerpo del mensaje
    $message = "
    Nombre: $form_name
    Correo Electrónico: $email
    Teléfono: $phone
    Cantidad de Invitados: $no_of_persons
    Fecha: $date_picker
    Hora: $time_picker
    Preferencia de Comida: $preferred_food
    Ocasión: $occasion
    ";

    // Encabezados
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Enviar el correo
    if (mail($to, $subject, $message, $headers)) {
        // Éxito al enviar el correo
        echo "<fieldset>";
        echo "<div id='success_page'>";
        echo "<h1>Correo Electrónico Enviado Exitosamente.</h1>";
        echo "<p>Gracias <strong>$form_name</strong>, tu mensaje ha sido enviado. Nos pondremos en contacto contigo pronto.</p>";
        echo "</div>";
        echo "</fieldset>";
    } else {
        // Error al enviar el correo
        echo '<div class="error_message">Error al enviar la reservación. Por favor, intenta de nuevo más tarde.</div>';
    }
} else {
    // Si el método de solicitud no es POST
    echo "Método de solicitud no soportado.";
}
?>
