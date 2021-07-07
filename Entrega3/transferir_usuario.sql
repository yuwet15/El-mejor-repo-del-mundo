CREATE OR REPLACE FUNCTION

transferir_usuario(id integer, nombre varchar, rut varchar, edad varchar, sexo varchar, cargo varchar)

RETURNS VOID AS $$

BEGIN
  
  IF rut NOT IN (SELECT rut FROM usuarios) THEN
		INSERT INTO personal values (id, nombre, rut, edad, sexo, NULL, cargo);
	END IF;

END
$$ language plpgsql