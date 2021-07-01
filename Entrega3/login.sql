CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
login (rut_u varchar, password_u varchar)

-- declaramos lo que retorna 
RETURNS tipo de dato AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
variable1;
variable2;

-- definimos nuestra función
BEGIN
	IF 'Usuario_pass' NOT IN (SELECT table_name FROM information_schema.tables WHERE table_schema = 'public') THEN
	   CREATE TABLE Usuario_pass(rut VARCHAR(10), password varchar(20));
       INSERT INTO Usuario_pass(rut, password)
       SELECT rut, substring(rut,5,4)
       FROM Usuarios;
       INSERT INTO Usuario_pass(rut, password)
       SELECT rut, substring(rut,5,4)
       FROM Personal;
    END IF;
    -- control de flujo
    IF rut_u NOT IN (SELECT rut FROM Usuario_pass) THEN
        RETURN FALSE;
    END IF;
    IF password_u IN (SELECT password FROM Usuario_pass WHERE rut = rut_U) THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql