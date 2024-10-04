<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $zona = $_POST['zona'];
    $xini = $_POST['xini'];
    $yini = $_POST['yini'];
    $xfin = $_POST['xfin'];
    $yfin = $_POST['yfin'];
    $superficie = $_POST['superficie'];
    $ci = $_POST['ci'];
    $distrito = $_POST['distrito'];

    $sql = "INSERT INTO Catastro (zona, xini, yini, xfin, yfin, superficie, ci, distrito) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisss", $zona, $xini, $yini, $xfin, $yfin, $superficie, $ci, $distrito);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Propiedad registrada con éxito.</div>";
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
    <title>Registrar Propiedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Registrar Propiedad</h1>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="zona" class="form-label">Zona:</label>
                <input type="text" name="zona" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="xini" class="form-label">Coordenada X Inicial:</label>
                <input type="text" name="xini" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="yini" class="form-label">Coordenada Y Inicial:</label>
                <input type="text" name="yini" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="xfin" class="form-label">Coordenada X Final:</label>
                <input type="text" name="xfin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="yfin" class="form-label">Coordenada Y Final:</label>
                <input type="text" name="yfin" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="superficie" class="form-label">Superficie:</label>
                <input type="number" name="superficie" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ci" class="form-label">Carnet de Identidad:</label>
                <select name="ci" class="form-select" required>
                    <?php
                    $result = $conn->query("SELECT ci, nombre, apellido FROM Persona");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['ci'] . "'>" . $row['nombre'] . " " . $row['apellido'] . " (" . $row['ci'] . ")</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="distrito" class="form-label">Distrito:</label>
                <input type="text" name="distrito" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <div class="mt-4">
            <a href="index.php" class="btn btn-secondary">Volver al Listado</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
