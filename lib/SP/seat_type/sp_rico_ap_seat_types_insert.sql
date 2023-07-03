CREATE OR REPLACE PROCEDURE sp_rico_ap_seat_types_insert
(
    out_code                OUT NUMBER,
    out_msg                 OUT VARCHAR2,
    in_name                 IN rico_ap_seat_types.name%TYPE,
    in_color                IN rico_ap_seat_types.color%TYPE,
    in_create_by            IN rico_ap_seat_types.create_by%TYPE
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
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Seat type Already Exist!';
        return;
    END IF;

    INSERT INTO rico_ap_seat_types
    (
        id,
        name,
        color,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_rico_ap_seat_types_id.NEXTVAL,
        in_name,
        in_color,
        in_create_by,
        SYSDATE,
        1
    );

END;
/
SHOW ERRORS;