CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
crear_tabla()

-- declaramos lo que retorna 
RETURNS VOID AS $$

-- declaramos las variables a utilizar si es que es necesario

-- definimos nuestra función
BEGIN
  -- control de flujo
  	IF 'Usuario_pass' NOT IN (SELECT table_name FROM information_schema.tables WHERE table_schema = 'public') THEN
  		CREATE TABLE Usuario_pass(rut_p VARCHAR(10), password_p varchar(20));
	END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql


