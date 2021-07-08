CREATE OR REPLACE FUNCTION

comprar(rut_u varchar, id_tienda integer, direccion_id integer)

RETURNS integer AS $$

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

	INSERT INTO compras values (idmax + 1, id_usuario, id_tienda, direccion_id);
    INSERT INTO detalle (compra_id, producto_id, cantidad) SELECT idmax + 1 AS compra_id, producto_id, cantidad FROM carrito WHERE rut = rut_u AND tienda_id = id_tienda;
    DELETE FROM carrito WHERE rut = rut_u AND tienda_id = id_tienda;

    RETURN idmax+1;

END

$$ language plpgsql
