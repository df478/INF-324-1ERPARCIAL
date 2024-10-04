<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Impuesto de Propiedad</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            border: 1px solid #007bff;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h2>Consulta de Impuesto de Propiedad</h2>
            </div>
            <div class="card-body">
                <form action="TipoImpuesto" method="get">
                    <div class="form-group">
                        <label for="codigo_catastral">Código Catastral:</label>
                        <input type="text" id="codigo_catastral" name="codigo_catastral" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Consultar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
