CREATE OR REPLACE PROCEDURE sp_rico_ap_transits_delete
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_id                           IN rico_ap_transits.id%TYPE,
    in_update_by                    IN rico_ap_transits.update_by%TYPE
)
AS
    v_count NUMBER := 0;
    v_temp NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_transits
    WHERE
        id = in_id
        AND status = 1;

    IF v_count = 0 THEN
        out_code := 1;
	    out_msg := 'Transit does not exist!';
        return;
    END IF;

    DELETE FROM rico_ap_transits
    WHERE 
        id = in_id
        AND status = 1;

END;
/
SHOW ERRORS;