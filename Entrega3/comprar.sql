CREATE OR REPLACE FUNCTION

comprar(rut_u varchar, tienda_id integer, direccion_id integer, producto_id integer, cantidad integer)

RETURNS VOID AS $$

DECLARE
  idmax int;
  id_usuario int;

BEGIN

    SELECT INTO idmax
    MAX(compra_id)
    FROM compras;

    SELECT INTO id_usuario
    usuario_id
    FROM usuarios
    WHERE rut = rut_u;

		INSERT INTO compras values (idmax + 1, id_usuario, tienda_id, direccion_id);
    INSERT INTO detalle values (idmax + 1, producto_id, cantidad);

END

$$ language plpgsql
