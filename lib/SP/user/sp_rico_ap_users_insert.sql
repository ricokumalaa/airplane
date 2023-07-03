CREATE OR REPLACE PROCEDURE sp_rico_ap_users_insert
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_email                IN rico_ap_users.email%TYPE,
    in_password             IN rico_ap_users.password%TYPE,
    in_first_name           IN rico_ap_users.first_name%TYPE,
    in_last_name            IN rico_ap_users.last_name%TYPE,
    in_nik                  IN rico_ap_users.nik%TYPE,
    in_phone_number         IN rico_ap_users.phone_number%TYPE,
    in_address              IN rico_ap_users.address%TYPE,
    in_create_by            IN rico_ap_users.create_by%TYPE
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
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'NIK Already Exist!';
        return;
    END IF;

    INSERT INTO rico_ap_users
    (
        id,
        email,
        password,
        first_name,
        last_name,
        nik,
        phone_number,
        address,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_rico_ap_users_id.NEXTVAL,
        in_email,
        in_password,
        in_first_name,
        in_last_name,
        in_nik,
        in_phone_number,
        in_address,
        in_create_by,
        SYSDATE,
        1
    );

END;
/
SHOW ERRORS;