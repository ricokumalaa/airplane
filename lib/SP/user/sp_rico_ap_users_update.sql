CREATE OR REPLACE PROCEDURE sp_rico_ap_users_update
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_id                   IN rico_ap_users.id%TYPE,
    in_email                IN rico_ap_users.email%TYPE,
    in_first_name           IN rico_ap_users.first_name%TYPE,
    in_last_name            IN rico_ap_users.last_name%TYPE,
    in_nik                  IN rico_ap_users.nik%TYPE,
    in_phone_number         IN rico_ap_users.phone_number%TYPE,
    in_address              IN rico_ap_users.address%TYPE,
    in_update_by            IN rico_ap_users.update_by%TYPE
)
AS
    v_count NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_users
    WHERE 
        email = in_email 
        AND id != in_id
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Email Already Exist!';
        return;
    END IF;

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_users
    WHERE 
        nik = in_nik
        AND id != in_id
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'NIK Already Exist!';
        return;
    END IF;

    UPDATE rico_ap_users
    SET
        email = in_email,
        first_name = in_first_name,
        last_name = in_last_name,
        nik = in_nik,
        phone_number = in_phone_number,
        address = in_address,
        update_by = in_update_by,
        update_time = SYSDATE
    WHERE
        id = in_id;
END;
/
SHOW ERRORS;