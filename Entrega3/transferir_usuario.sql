CREATE OR REPLACE FUNCTION

transferir_usuario(nombre varchar, rut_input varchar, edad integer, sexo varchar, cargo varchar, direccion_id integer)

RETURNS VOID AS $$

DECLARE
	idmax int;
	idmax2 int;

BEGIN
  
	SELECT INTO idmax
	MAX(personal_id)
	FROM personal;

	SELECT INTO idmax2
	MAX(usuario_id)
	FROM usuarios;

  IF rut_input NOT IN (SELECT rut FROM personal) THEN
		INSERT INTO personal values (idmax + 1, nombre, rut_input, edad, sexo, NULL, cargo);
	END IF;
	IF rut_input NOT IN (SELECT rut FROM usuarios) THEN
		INSERT INTO usuarios values (idmax2 + 1, nombre, rut_input, edad, sexo);
		INSERT INTO direcciones values (idmax2 + 1, direccion_id);
	END IF;

END
$$ language plpgsql