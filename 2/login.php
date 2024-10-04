<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    // Consulta para validar el usuario
    $sql = "SELECT * FROM Usuarios WHERE nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar la contraseña (deberías usar password_hash y password_verify en producción)
        if ($usuario['contraseña'] === $contraseña) {
            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            color: #fff;
        }
        .container {
            background: rgba(0, 0, 0, 0.7); /* Fondo oscuro y transparente para la tarjeta */
            border-radius: 15px;
            padding: 30px;
            margin-top: 100px;
        }
        .btn-custom {
            background-color: #ff4757; /* Color personalizado para el botón */
            border: none;
        }
        .btn-custom:hover {
            background-color: #ff6b81; /* Efecto hover para el botón */
        }
        .alert {
            color: #f8d7da;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Iniciar Sesión</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            <a href="http://localhost:8080/mavenproject1/index.jsp" class="btn btn-custom mt-3">Ir a la Página Principal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
