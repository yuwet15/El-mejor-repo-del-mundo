CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
insertar_en_tabla(rut_u varchar)

-- declaramos lo que retorna 
RETURNS VOID AS $$

-- declaramos las variables a utilizar si es que es necesario

-- definimos nuestra función
BEGIN
  -- control de flujo
  	IF rut_u NOT IN (SELECT rut_p FROM Usuario_pass) THEN
		INSERT INTO Usuario_pass(rut_p, password_p)
		SELECT rut, substring(rut,5,4);
	END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql


