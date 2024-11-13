CREATE TABLE inventario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    stock INT DEFAULT 100
);

-- Insertar 20 productos con 100 unidades cada uno
INSERT INTO inventario (nombre, stock)
VALUES 
    ('Producto 1', 100),
    ('Producto 2', 100),
    ('Producto 3', 100),
    ('Producto 4', 100),
    ('Producto 5', 100),
    ('Producto 6', 100),
    ('Producto 7', 100),
    ('Producto 8', 100),
    ('Producto 9', 100),
    ('Producto 10', 100),
    ('Producto 11', 100),
    ('Producto 12', 100),
    ('Producto 13', 100),
    ('Producto 14', 100),
    ('Producto 15', 100),
    ('Producto 16', 100),
    ('Producto 17', 100),
    ('Producto 18', 100),
    ('Producto 19', 100),
    ('Producto 20', 100);