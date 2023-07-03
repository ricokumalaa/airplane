CREATE OR REPLACE PROCEDURE sp_rico_ap_seat_types_update
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_id                   IN rico_ap_seat_types.id%TYPE,
    in_name                 IN rico_ap_seat_types.name%TYPE,
    in_color                IN rico_ap_seat_types.color%TYPE,
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
        rico_ap_seat_types
    WHERE 
        color = in_color
        AND id != in_id
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Color Already Exist!';
        return;
    END IF;

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_seat_types
    WHERE 
        name = in_name
        AND id != in_id
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Seat type Already Exist!';
        return;
    END IF;

    UPDATE rico_ap_seat_types
    SET 
        name = in_name,
        color = in_color,
        update_time = SYSDATE,
        update_by = in_update_by
    WHERE
        id = in_id;

END;
/
SHOW ERRORS;