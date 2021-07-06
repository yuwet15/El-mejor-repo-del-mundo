CREATE OR REPLACE FUNCTION

transferir_usuario(id integer, nombre varchar, rut varchar, edad varchar)

RETURNS VOID AS $$

BEGIN
  
  IF rut NOT IN (SELECT rut FROM usuarios) THEN
		INSERT INTO usuarios values (id, nombre, rut, edad, NULL)
	END IF;

END
$$ language plpgsql