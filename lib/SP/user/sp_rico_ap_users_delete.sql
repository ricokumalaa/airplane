CREATE OR REPLACE PROCEDURE sp_rico_ap_users_delete
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_id                   IN rico_ap_users.id%TYPE,
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
        id = in_id
        AND status = 1;

    IF v_count = 0 THEN
        out_code := 1;
	    out_msg := 'User does not exist!';
        return;
    END IF;

    UPDATE rico_ap_users
    SET
        update_by = in_update_by,
        update_time = SYSDATE,
        status = 0
    WHERE
        id = in_id;
END;
/
SHOW ERRORS;