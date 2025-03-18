CREATE TABLE responsable (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Responsable VARCHAR(100),
    Apellidos_Responsable VARCHAR(100),
    Tipo_Documento_Responsable VARCHAR(50),
    Documento_Responsable VARCHAR(50),
    Lugar_Expedicion_Responsable VARCHAR(100),
    Fecha_de_Nacimiento_Responsable DATE,
    Edad_Responsable INT,
    Estado_Civil_Responsable VARCHAR(50),
    Categoria_Responsable VARCHAR(50),
    Nombre_Empresa_Responsable VARCHAR(100),
    Telefono_Oficina_Responsable VARCHAR(20),
    Direccion_Oficina_Responsable VARCHAR(200),
    Telefono_Responsable VARCHAR(20),
    Email_Responsable VARCHAR(100),
    Celular_Responsable VARCHAR(20)
);
