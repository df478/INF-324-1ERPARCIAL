package com.mycompany.mavenproject1;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/TipoImpuesto")
public class TipoImpuestoServlet extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String codigoCatastral = request.getParameter("codigo_catastral");
        String tipoImpuesto = determinarTipoImpuesto(codigoCatastral);
        
        response.setContentType("text/html;charset=UTF-8");
        response.getWriter().write(getHtmlResponse(tipoImpuesto));
    }
    
    private String determinarTipoImpuesto(String codigoCatastral) {
        if (codigoCatastral.startsWith("1")) {
            return "Alto";
        } else if (codigoCatastral.startsWith("2")) {
            return "Medio";
        } else if (codigoCatastral.startsWith("3")) {
            return "Bajo";
        } else {
            return "Código catastral no válido";
        }
    }

    private String getHtmlResponse(String tipoImpuesto) {
        StringBuilder html = new StringBuilder();
        html.append("<!DOCTYPE html>")
            .append("<html lang='es'>")
            .append("<head>")
            .append("<meta charset='UTF-8'>")
            .append("<meta name='viewport' content='width=device-width, initial-scale=1.0'>")
            .append("<title>Resultado de Consulta</title>")
            .append("<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>")
            .append("<style>")
            .append("body { background-color: #f0f4f8; }")
            .append(".card { border-radius: 15px; }")
            .append(".card-header { background-color: #007bff; color: white; border-top-left-radius: 15px; border-top-right-radius: 15px; }")
            .append(".btn-primary { background-color: #28a745; border-color: #28a745; }")
            .append(".btn-primary:hover { background-color: #218838; border-color: #1e7e34; }")
            .append("</style>")
            .append("</head>")
            .append("<body>")
            .append("<div class='container mt-5'>")
            .append("<div class='card shadow'>")
            .append("<div class='card-header text-center'>")
            .append("<h3>Resultado de la Consulta</h3>")
            .append("</div>")
            .append("<div class='card-body text-center'>")
            .append("<h5 class='font-weight-bold'>Tipo de Impuesto:</h5>")
            .append("<h2 class='text-info'>")
            .append(tipoImpuesto)
            .append("</h2>")
            .append("<a href='index.jsp' class='btn btn-primary'>Realizar otra consulta</a>")
            .append("</div>")
            .append("</div>")
            .append("</div>")
            .append("</body>")
            .append("</html>");
        return html.toString();
    }
}
