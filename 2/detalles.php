<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener el ID de la propiedad
if (!isset($_GET['id_catastro'])) {
    header("Location: index.php");
    exit;
}

$id_catastro = intval($_GET['id_catastro']);

// Obtener los detalles de la propiedad
$stmt = $conn->prepare("SELECT * FROM Catastro WHERE id_catastro = ?");
$stmt->bind_param("i", $id_catastro);
$stmt->execute();
$result = $stmt->get_result();
$propiedad = $result->fetch_assoc();

if (!$propiedad) {
    echo "Propiedad no encontrada.";
    exit;
}

// Obtener el rol del usuario
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Detalles de la Propiedad</h1>
        
        <div class="mb-3">
            <p class="text-center">Bienvenido, <?= $_SESSION['usuario'] ?>! Rol: <?= ucfirst($rol) ?></p>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Zona: <?= htmlspecialchars($propiedad['zona']) ?></h5>
                <p class="card-text"><strong>ID:</strong> <?= $propiedad['id_catastro'] ?></p>
                <p class="card-text"><strong>Superficie:</strong> <?= $propiedad['superficie'] ?> m²</p>
                <p class="card-text"><strong>Distrito:</strong> <?= htmlspecialchars($propiedad['distrito']) ?></p>
                <p class="card-text"><strong>CI del propietario:</strong> <?= htmlspecialchars($propiedad['ci']) ?></p>
            </div>
        </div>

        <div class="mt-4">
            <a href="index.php" class="btn btn-primary">Volver al Listado</a>
            <?php if ($rol === 'funcionario'): ?>
                <a href="cambio.php?id_catastro=<?= $propiedad['id_catastro'] ?>" class="btn btn-warning">Actualizar Propiedad</a>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
