CREATE OR REPLACE FUNCTION

transferir_usuario(nombre varchar, rut varchar, edad integer, sexo varchar, cargo varchar)

RETURNS VOID AS $$

DECLARE
	idmax int;

BEGIN
  
	SELECT INTO idmax
	MAX(usuario_id)
	FROM usuarios;

  IF rut NOT IN (SELECT rut FROM usuarios) THEN
		INSERT INTO personal values (idmax + 1, nombre, rut, edad, sexo, NULL, cargo);
	END IF;

END
$$ language plpgsql