CREATE OR REPLACE PROCEDURE sp_rico_ap_payments_delete
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_id                   IN rico_ap_payments.id%TYPE,
    in_update_by            IN rico_ap_payments.update_by%TYPE
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
        rico_ap_payments
    WHERE 
        id = in_id
        AND status = 1;

    IF v_count = 0 THEN
        out_code := 1;
	    out_msg := 'Payment Does Nnt Exist';
        return;
    END IF;

    UPDATE rico_ap_payments
    SET 
        status = 0,
        update_time = SYSDATE,
        update_by = in_update_by
    WHERE
        id = in_id;

END;
/
SHOW ERRORS;