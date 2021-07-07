CREATE OR REPLACE FUNCTION

transferir_usuario(nombre varchar, rut_input varchar, edad integer, sexo varchar, cargo varchar, direccion_id integer)

RETURNS VOID AS $$

DECLARE
	idmax int;

BEGIN
  
	SELECT INTO idmax
	MAX(usuario_id)
	FROM usuarios;

	IF 'cargo' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD cargo VARCHAR(20);
        UPDATE usuarios SET cargo = 'usuario';
    END IF;

	IF rut_input NOT IN (SELECT rut FROM usuarios) THEN
		INSERT INTO usuarios values (idmax + 1, nombre, rut_input, edad, sexo, cargo);
		INSERT INTO direcciones values (idmax + 1, direccion_id);
	END IF;

END
$$ language plpgsql