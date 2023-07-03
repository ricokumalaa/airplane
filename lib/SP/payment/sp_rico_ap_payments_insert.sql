CREATE OR REPLACE PROCEDURE sp_rico_ap_payments_insert
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_name                 IN rico_ap_payments.name%TYPE,
    in_create_by            IN rico_ap_payments.create_by%TYPE
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
        name = in_name
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Payment Already Exist!';
        return;
    END IF;

    INSERT INTO rico_ap_payments
    (
        id,
        name,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_rico_ap_payments_id.NEXTVAL,
        in_name,
        in_create_by,
        SYSDATE,
        1
    );

END;
/
SHOW ERRORS;