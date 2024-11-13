CREATE DATABASE IF NOT EXISTS carpi_shop;
USE carpi_shop;
CREATE TABLE IF NOT EXISTS inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
);
ALTER TABLE inventario ADD COLUMN descripcion TEXT;
INSERT INTO inventario (nombre, descripcion, precio, stock) VALUES
('Pestañas 3D', 'Pestañas de alta calidad', 12.50, 100),
('Pegamento Ultra', 'Pegamento de larga duración', 8.99, 50),
('Pinzas de Precisión', 'Pinzas para aplicación precisa', 5.75, 80),
('Removedor de Pegamento', 'Elimina pegamento sin residuos', 6.25, 30),
('Pestañas Volumen', 'Pestañas de volumen natural', 15.00, 70),
('Cepillo de Pestañas', 'Cepillo para pestañas', 3.50, 120),
('Pegamento Rápido', 'Pegamento de secado rápido', 9.99, 40),
('Pestañas Coloridas', 'Pestañas en varios colores', 16.99, 60),
('Pegamento Hipoalergénico', 'Para pieles sensibles', 10.50, 25),
('Pinzas Curvas', 'Pinzas de precisión curvas', 7.75, 90),
('Cinta Adhesiva', 'Cinta para aplicaciones', 2.50, 100),
('Gel de Limpieza', 'Gel para limpiar pestañas', 6.99, 85),
('Pegamento Resistente al Agua', 'Para climas húmedos', 11.00, 45),
('Pestañas Naturales', 'Para un look natural', 13.50, 60),
('Espejo de Mano', 'Espejo para ver detalles', 4.99, 95),
('Pinzas de Pestañas', 'Pinzas multiusos', 6.00, 70),
('Desinfectante para Pestañas', 'Desinfectante especializado', 5.50, 100),
('Pestañas con Brillo', 'Pestañas con efecto brillante', 14.50, 55),
('Kit de Aplicación', 'Kit completo para aplicación', 19.99, 35),
('Aceite Nutritivo', 'Aceite para cuidar pestañas', 8.75, 75);