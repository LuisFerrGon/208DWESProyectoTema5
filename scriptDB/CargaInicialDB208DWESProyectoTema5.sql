/**
 * Author:  Luis Ferreras
 * Created: 19 nov 2024
 */
INSERT INTO DB208DWESProyectoTema5.T01_Usuario
    (T01_CodUsuario, T01_Password, T01_Perfil)
VALUES
    ('admin', SHA2(CONCAT('admin', 'paso'),256), 'administrador')
;
INSERT INTO DB208DWESProyectoTema5.T01_Usuario
    (T01_CodUsuario, T01_Password)
VALUES
    ('victor', SHA2(CONCAT('victor', 'paso'),256)),
    ('alex', SHA2(CONCAT('alex', 'paso'),256)),
    ('jesus', SHA2(CONCAT('jesus', 'paso'),256)),
    ('heraclio', SHA2(CONCAT('heraclio', 'paso'),256)),
    ('amor', SHA2(CONCAT('amor', 'paso'),256)),
    ('ivan', SHA2(CONCAT('ivan', 'paso'),256)),
    ('antonio', SHA2(CONCAT('antonio', 'paso'),256)),
    ('gisela', SHA2(CONCAT('gisela', 'paso'),256))
;
INSERT INTO DB208DWESProyectoTema5.T02_Departamento
    (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenDeNegocio)
VALUES
    ('CMP', 'Compra', 1000),
    ('VNT', 'Venta', 500.50),
    ('MKT', 'Marketing', 40.02)
;