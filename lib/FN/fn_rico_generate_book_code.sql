CREATE OR REPLACE FUNCTION fn_rico_generate_book_code
RETURN VARCHAR2 IS
    out_result VARCHAR2(256);
BEGIN
    
    SELECT
        dbms_random.string('X', 6)
    INTO
        out_result
    FROM
        DUAL;

    return out_result;

END fn_rico_generate_book_code;
/
SHOW ERRORS;

SELECT fn_rico_generate_rent_code AS rent_code FROM DUAL;
