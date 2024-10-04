<?php
include 'conexion.php';

// Cargar propiedad para actualizar
$id_catastro = $_GET['id_catastro'] ?? null;
$propiedad = null;

if ($id_catastro) {
    $propiedad = $conn->query("SELECT * FROM Catastro WHERE id_catastro = $id_catastro")->fetch_assoc();
}

// Actualizar propiedad
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_catastro = $_POST['id_catastro'];
    $zona = $_POST['zona'];
    $xini = $_POST['xini'];
    $yini = $_POST['yini'];
    $xfin = $_POST['xfin'];
    $yfin = $_POST['yfin'];
    $superficie = $_POST['superficie'];
    $ci = $_POST['ci'];
    $distrito = $_POST['distrito'];

    $sql = "UPDATE Catastro SET zona = ?, xini = ?, yini = ?, xfin = ?, yfin = ?, superficie = ?, ci = ?, distrito = ? WHERE id_catastro = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisssi", $zona, $xini, $yini, $xfin, $yfin, $superficie, $ci, $distrito, $id_catastro);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Propiedad actualizada con éxito.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Actualizar Propiedad</h1>
        <?php if ($propiedad): ?>
            <form method="POST" class="mt-4">
                <input type="hidden" name="id_catastro" value="<?= $propiedad['id_catastro'] ?>">
                <div class="mb-3">
                    <label for="zona" class="form-label">Zona:</label>
                    <input type="text" name="zona" class="form-control" value="<?= $propiedad['zona'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="xini" class="form-label">Coordenada X Inicial:</label>
                    <input type="text" name="xini" class="form-control" value="<?= $propiedad['xini'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="yini" class="form-label">Coordenada Y Inicial:</label>
                    <input type="text" name="yini" class="form-control" value="<?= $propiedad['yini'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="xfin" class="form-label">Coordenada X Final:</label>
                    <input type="text" name="xfin" class="form-control" value="<?= $propiedad['xfin'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="yfin" class="form-label">Coordenada Y Final:</label>
                    <input type="text" name="yfin" class="form-control" value="<?= $propiedad['yfin'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="superficie" class="form-label">Superficie:</label>
                    <input type="number" name="superficie" step="0.01" class="form-control" value="<?= $propiedad['superficie'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="ci" class="form-label">Carnet de Identidad:</label>
                    <select name="ci" class="form-select" required>
                        <?php
                        $personas = $conn->query("SELECT ci, nombre, apellido FROM Persona");
                        while ($persona = $personas->fetch_assoc()) {
                            $selected = $persona['ci'] == $propiedad['ci'] ? 'selected' : '';
                            echo "<option value='" . $persona['ci'] . "' $selected>" . $persona['nombre'] . " " . $persona['apellido'] . " (" . $persona['ci'] . ")</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="distrito" class="form-label">Distrito:</label>
                    <input type="text" name="distrito" class="form-control" value="<?= $propiedad['distrito'] ?>" required>
                </div>
                <button type="submit" class="btn btn-warning">Actualizar</button>
            </form>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">Propiedad no encontrada.</div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="index.php" class="btn btn-secondary">Volver al Listado</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
