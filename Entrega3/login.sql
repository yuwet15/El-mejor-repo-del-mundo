CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
login (rut varchar, password varchar)

-- declaramos lo que retorna 
RETURNS tipo de dato AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
variable1;
variable2;

-- definimos nuestra función
BEGIN
	IF 'Usuario_pass' NOT IN (SELECT table_name FROM information_schema.tables WHERE table_schema = 'public')
	CREATE TABLE Usuario_pass(rut VARCHAR(10), password varchar(20));
    -- control de flujo
    IF condicion THEN
        pasa algo
    
    ELSE
        pasa otra cosa

    END IF;

    FOR condicion LOOP
        hacer cosas
    END LOOP;



-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql