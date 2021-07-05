CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
login (rut_u varchar, password_u varchar)

-- declaramos lo que retorna 
RETURNS VARCHAR(20) AS $$



-- definimos nuestra función
BEGIN
    -- control de flujo
    IF rut_u NOT IN (SELECT rut_p FROM Usuario_pass) THEN
        RETURN 'No_user';
    END IF;
    IF password_u IN (SELECT password_p FROM Usuario_pass WHERE rut_p = rut_u) THEN
        RETURN 'Success';
    ELSE
        RETURN 'Password incorrect';
    END IF;
-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql