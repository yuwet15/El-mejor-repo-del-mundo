CREATE OR REPLACE FUNCTION

transferir_usuario(nombre varchar, rut_input varchar, edad integer, sexo varchar, cargo varchar)

RETURNS VOID AS $$

DECLARE
	idmax int;

BEGIN
  
	SELECT INTO idmax
	MAX(personal_id)
	FROM personal;

  IF rut_input NOT IN (SELECT rut FROM personal) THEN
		INSERT INTO personal values (idmax + 1, nombre, rut_input, edad, sexo, NULL, cargo);
	END IF;

END
$$ language plpgsql