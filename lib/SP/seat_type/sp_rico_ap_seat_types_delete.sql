CREATE OR REPLACE PROCEDURE sp_rico_ap_seat_types_delete
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_id                   IN rico_ap_seat_types.id%TYPE,
    in_update_by            IN rico_ap_seat_types.update_by%TYPE
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
        rico_ap_airplane_seat_types
    WHERE
        seat_type_id = in_id
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
        out_msg := 'Cannot delete seat type while it is used!';
        return;
    END IF;

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_seat_types
    WHERE 
        id = in_id
        AND status = 1;

    IF v_count = 0 THEN
        out_code := 1;
	    out_msg := 'Seat type does not exist!';
        return;
    END IF;

    UPDATE rico_ap_seat_types
    SET 
        update_time = SYSDATE,
        update_by = in_update_by,
        status = 0
    WHERE
        id = in_id;

END;
/
SHOW ERRORS;