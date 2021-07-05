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
        INSERT INTO usuarios values(idmax + 1, nombre, rut_u, edad, sexo);
        SELECT INTO direc_id direcciones_id FROM Comunas WHERE direccion_n = direccion;
        INSERT INTO direcciones values(direc_id, idmax + 1);
        INSERT into claves values(idmax + 1, password);
        RETURN 'TRUE';
    
    ELSE
        RETURN 'Rut_existente';

    END IF;



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql