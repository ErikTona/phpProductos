<?php
session_start();

// Generar un token si no existe
if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    // Verificar el token global
    if ($_POST['global_token'] !== $_SESSION['global_token']) {
        die("Acceso denegado: token no válido.");
    }

    // Recoger datos del formulario
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    // Verificar que ambos campos están llenos
    if (!empty($correo) && !empty($contraseña)) {
        // Iniciar cURL para hacer la petición a la API
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'email' => $correo, 
                'password' => $contraseña
            ),
        ));

        // Ejecutar la petición
        $response = curl_exec($curl);
        curl_close($curl);

        // Decodificar la respuesta JSON
        $response_data = json_decode($response, true);

        // Verificar si la autenticación fue exitosa
        if (isset($response_data['code']) && $response_data['code'] == 200) {
            // Guardar el token en la sesión
            $_SESSION['auth_token'] = $response_data['data']['token'];

            // Redirigir a home.php
            header('Location: ../home.php');
            exit();
        } else {
            // Si la autenticación falla, redirigir al login con error
            header('Location: ../index.html?error=1');
            exit();
        }
    } else {
        // Si faltan campos, redirigir al login con error
        header('Location: ../index.html?error=2');
        exit();
    }
} else {
    // Si no se envió un POST o la acción no es login, redirigir al login
    header('Location: ../index.html');
    exit();
}

// Para pruebas: echo de la respuesta de autenticación
echo isset($response) ? $response : "No se realizó ninguna petición.";
?>
