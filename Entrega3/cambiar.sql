CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
cambiar (rut_u varchar, actual varchar, new varchar)

-- declaramos lo que retorna 
RETURNS VARCHAR(20) AS $$



-- definimos nuestra función
BEGIN
    -- control de flujo
    IF actual NOT IN (SELECT password_p FROM Usuario_pass WHERE rut_p = rut_u) THEN
        RETURN 'incorrect';
    ELSE
    	UPDATE Usuario_pass SET password_p = new WHERE rut_p = rut_u;
        RETURN 'Success';
    END IF;
-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql