<?php
session_start();
include 'conexion.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Verificar el rol
$rol = $_SESSION['rol'];

// Mostrar mensaje de confirmación
if (isset($_SESSION['mensaje'])) {
    echo "<div class='alert alert-info'>" . $_SESSION['mensaje'] . "</div>";
    unset($_SESSION['mensaje']);
}

// Manejo de eliminación de propiedad
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_catastro'])) {
    $id_catastro = intval($_POST['id_catastro']);
    
    // Preparar la consulta para eliminar la propiedad
    $stmt = $conn->prepare("DELETE FROM Catastro WHERE id_catastro = ?");
    $stmt->bind_param("i", $id_catastro);
    
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Propiedad eliminada correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar la propiedad: " . $stmt->error;
    }

    $stmt->close();
}

// Listado de Propiedades
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Propiedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Listado de Propiedades</h1>
        
        <div class="mb-3">
            <p class="text-center">Bienvenido, <?= $_SESSION['usuario'] ?>! Rol: <?= ucfirst($rol) ?></p>
        </div>
        
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <?php if ($rol === 'funcionario'): ?>
                    <a href="registro.php" class="btn btn-success">Registrar Nueva Propiedad</a>
                <?php endif; ?>
            </div>
            <div>
                <form action="logout.php" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>
            </div>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Zona</th>
                    <th>Superficie</th>
                    <th>Distrito</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM Catastro");
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['id_catastro'] ?></td>
                    <td><?= $row['zona'] ?></td>
                    <td><?= $row['superficie'] ?></td>
                    <td><?= $row['distrito'] ?></td>
                    <td>
                        <?php if ($rol === 'funcionario'): ?>
                            <a href="cambio.php?id_catastro=<?= $row['id_catastro'] ?>" class="btn btn-warning btn-sm">Actualizar</a>
                            <form action="eliminar.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_catastro" value="<?= $row['id_catastro'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?');">Eliminar</button>
                            </form>
                        <?php else: ?>
                            <a href="detalles.php?id_catastro=<?= $row['id_catastro'] ?>" class="btn btn-info btn-sm">Ver Detalles</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
