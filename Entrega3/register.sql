CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
register(nombre varchar, rut_u varchar, edad int, sexo varchar, direccion_n varchar, cargo_u varchar)

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
            INSERT INTO usuarios values(idmax + 1, nombre, rut_u, edad, sexo, cargo_u);
            SELECT INTO direc_id direccion_id FROM Comunas WHERE direccion_n = direccion;
            INSERT INTO direcciones values(idmax + 1, direc_id);
            RETURN 'TRUE';
        END IF;
        
    
    ELSE
        RETURN 'Rut_existente';

    END IF;



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql