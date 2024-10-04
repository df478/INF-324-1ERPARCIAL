CREATE DATABASE BDEleazar;

USE BDEleazar;

-- Tabla Persona
CREATE TABLE Persona (
    id_persona INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    ci VARCHAR(20) NOT NULL UNIQUE,
    direccion VARCHAR(200),
    telefono VARCHAR(15)
);

-- Tabla Catastro
CREATE TABLE Catastro (
    id_catastro INT AUTO_INCREMENT PRIMARY KEY,
    zona VARCHAR(50) NOT NULL,
    xini DECIMAL(10, 6) NOT NULL,
    yini DECIMAL(10, 6) NOT NULL,
    xfin DECIMAL(10, 6) NOT NULL,
    yfin DECIMAL(10, 6) NOT NULL,
    superficie DECIMAL(10, 2) NOT NULL,
    ci VARCHAR(20) NOT NULL,
    distrito VARCHAR(50),
    codigo_catastral VARCHAR(20) NOT NULL UNIQUE,
    FOREIGN KEY (ci) REFERENCES Persona(ci) ON DELETE CASCADE
);

-- Inserción de datos en la tabla Persona
INSERT INTO Persona (nombre, apellido, ci, direccion, telefono) VALUES
('Moisés', 'González', '12345678', 'Av. Buenos Aires #213', '12345678'),
('Ana', 'Pérez', '87654321', 'C/Murillo #423', '87654321'),
('Juan', 'Martínez', '11223344', 'Calle Tarija #789', '11223344'),
('Lucía', 'Rodríguez', '55667788', 'Av. 16 de Julio #321', '55667788');

-- Inserción de propiedades en la tabla Catastro con nuevos códigos catastrales
INSERT INTO Catastro (zona, xini, yini, xfin, yfin, superficie, ci, distrito, codigo_catastral) VALUES
('Achachicala', 12.345678, -67.890123, 12.345679, -67.890122, 100.00, '12345678', 'Distrito 1', '1-001-ACH-001'),
('Calacoto', 12.345680, -67.890125, 12.345681, -67.890124, 200.00, '12345678', 'Distrito 2', '1-002-CAL-002'),
('Chicani', 12.345682, -67.890127, 12.345683, -67.890126, 150.00, '87654321', 'Distrito 1', '1-003-CHI-003'),
('Chijini', 12.345684, -67.890129, 12.345685, -67.890128, 250.00, '11223344', 'Distrito 2', '2-001-CHI-004'),
('Chualluma', 12.345686, -67.890131, 12.345687, -67.890130, 300.00, '55667788', 'Distrito 3', '2-002-CHU-005'),
('Garita de Lima', 12.345688, -67.890133, 12.345689, -67.890132, 180.00, '12345678', 'Distrito 1', '2-003-GAR-006'),
('Irpavi', 12.345690, -67.890135, 12.345691, -67.890134, 220.00, '87654321', 'Distrito 2', '3-001-IRP-007'),
('Mallasa', 12.345692, -67.890137, 12.345693, -67.890136, 275.00, '11223344', 'Distrito 3', '3-002-MAL-008'),
('Miraflores (La Paz)', 12.345694, -67.890139, 12.345695, -67.890138, 150.00, '55667788', 'Distrito 1', '3-003-MIR-009'),
('Munaypata', 12.345696, -67.890141, 12.345697, -67.890140, 120.00, '12345678', 'Distrito 2', '1-004-MUN-010'),
('Obrajes', 12.345698, -67.890143, 12.345699, -67.890142, 210.00, '87654321', 'Distrito 1', '2-004-OBR-011'),
('Pampahasi', 12.345700, -67.890145, 12.345701, -67.890144, 240.00, '11223344', 'Distrito 3', '2-005-PAM-012'),
('Pura Pura', 12.345702, -67.890147, 12.345703, -67.890146, 190.00, '55667788', 'Distrito 2', '3-004-PUR-013'),
('San Jorge (La Paz)', 12.345704, -67.890149, 12.345705, -67.890148, 160.00, '12345678', 'Distrito 1', '1-005-SAN-014'),
('San Miguel (La Paz)', 12.345706, -67.890151, 12.345707, -67.890150, 230.00, '87654321', 'Distrito 2', '2-006-SAN-015'),
('Següencoma', 12.345708, -67.890153, 12.345709, -67.890152, 280.00, '11223344', 'Distrito 3', '3-005-SEG-016'),
('Sopocachi', 12.345710, -67.890155, 12.345711, -67.890154, 150.00, '55667788', 'Distrito 1', '1-006-SOP-017'),
('Villa Fátima (La Paz)', 12.345712, -67.890157, 12.345713, -67.890156, 100.00, '12345678', 'Distrito 2', '2-007-VIL-018'),
('Villa Victoria (La Paz)', 12.345714, -67.890159, 12.345715, -67.890158, 300.00, '87654321', 'Distrito 3', '3-006-VIL-019');

-- Tabla Usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('funcionario', 'dueño') NOT NULL,
    ci VARCHAR(20) NOT NULL,
    FOREIGN KEY (ci) REFERENCES Persona(ci) ON DELETE CASCADE
);

-- Inserción de datos en la tabla Usuarios
INSERT INTO Usuarios (nombre, contraseña, rol, ci) VALUES
('admin', 'admin123', 'funcionario', '12345678'),  -- Usuario admin
('dueno1', 'dueno123', 'dueño', '87654321'),         -- Usuario normal
('dueno2', 'dueno123', 'dueño', '11223344'),
('dueno3', 'dueno123', 'dueño', '55667788');
