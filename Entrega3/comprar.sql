CREATE OR REPLACE FUNCTION

comprar(rut_u varchar, direccion_id integer, tienda_id integer)

RETURNS VOID AS $$

DECLARE
  max_id int;

BEGIN

  	IF rut_u NOT IN (SELECT rut_p FROM Usuario_pass) THEN
		INSERT INTO Usuario_pass(rut_p, password_p)
		SELECT rut_u, substring(rut_u,5,4);
	END IF;

END
$$ language plpgsql
