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
if ($rol !== 'funcionario') {
    header("Location: index.php");
    exit;
}

// Comprueba si se ha enviado el id_catastro
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
    $conn->close();

    // Redirige a index.php después de la eliminación
    header("Location: index.php");
    exit;
} else {
    // Si no se ha enviado id_catastro, redirige a index
    header("Location: index.php");
    exit;
}
?>
