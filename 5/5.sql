SELECT 
    p.nombre,
    p.apellido,
    MAX(CASE 
        WHEN SUBSTRING(c.codigo_catastral, 1, 1) = '1' THEN 'Alto' 
        WHEN SUBSTRING(c.codigo_catastral, 1, 1) = '2' THEN 'Medio' 
        WHEN SUBSTRING(c.codigo_catastral, 1, 1) = '3' THEN 'Bajo' 
        ELSE 'Desconocido' 
    END) AS tipo_impuesto
FROM 
    Persona p
JOIN 
    Catastro c ON p.ci = c.ci
GROUP BY 
    p.id_persona;


SELECT 
    p.nombre,
    p.apellido,
    MAX(tipo_impuesto) AS tipo_impuesto
FROM 
    Persona p
JOIN 
    Catastro c ON p.ci = c.ci
JOIN 
    (SELECT 
         ci,
         SUBSTRING(codigo_catastral, 1, 1) AS primer_caracter,
         (SELECT 
              CASE 
                  WHEN SUBSTRING(codigo_catastral, 1, 1) = '1' THEN 'Alto'
                  WHEN SUBSTRING(codigo_catastral, 1, 1) = '2' THEN 'Medio'
                  WHEN SUBSTRING(codigo_catastral, 1, 1) = '3' THEN 'Bajo'
                  ELSE 'Desconocido'
              END) AS tipo_impuesto
     FROM 
         Catastro) AS c_tipo ON c.ci = c_tipo.ci
GROUP BY 
    p.id_persona, p.nombre, p.apellido;
