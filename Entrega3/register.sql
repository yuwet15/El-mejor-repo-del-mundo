CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
register(nombre varchar, rut_u varchar, edad int, sexo varchar, direccion_n varchar)

-- declaramos lo que retorna 
RETURNS VARCHAR(20) AS $$

DECLARE
idmax int;
direc_id int;
-- definimos nuestra función
BEGIN
	--encontramos el ultimo id
	SELECT INTO idmax
	MAX(usuario_id)
	FROM usuarios;

    -- control de flujo
    IF rut_u NOT IN (select rut from usuarios) THEN
        IF direccion_n not in (select direccion FROM Comunas) THEN
            RETURN 'No_direccion';
        ELSE
            RETURN 'TRUE1';
            INSERT INTO usuarios values(idmax + 1, nombre, rut_u, edad, sexo);
            RETURN 'TRUE2';
            SELECT INTO direc_id direccion_id FROM Comunas WHERE direccion_n = direccion;
            RETURN 'TRUE2';
            INSERT INTO direcciones values(direc_id, idmax + 1);
            RETURN 'TRUE3';
            SELECT insertar_en_tabla(rut_u);
            RETURN 'TRUE4';
        END IF;
        
    
    ELSE
        RETURN 'Rut_existente';

    END IF;



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql