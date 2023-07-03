CREATE OR REPLACE PROCEDURE sp_rico_ap_airplanes_update
(
    out_code                            OUT NUMBER,
    out_msg                             OUT VARCHAR2,
    in_id                               IN rico_ap_airplanes.id%TYPE,
    in_name                             IN rico_ap_airplanes.name%TYPE,
    in_airplane_brand                   IN rico_ap_airplanes.airplane_brand%TYPE,
    in_airplane_model                   IN rico_ap_airplanes.airplane_model%TYPE,
    in_registration_number              IN rico_ap_airplanes.registration_number%TYPE,
    in_color                            IN rico_ap_airplanes.color%TYPE,
    in_max_row                          IN rico_ap_airplanes.max_row%TYPE,
    in_max_column                       IN rico_ap_airplanes.max_column%TYPE,
    in_update_by                        IN rico_ap_airplanes.update_by%TYPE
)
AS
    v_count NUMBER := 0;
    v_x NUMBER := 0;
    v_y NUMBER := 0;
    v_seat_type NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM   
        rico_ap_flights
    WHERE
        airplane_id = in_id
        AND departure_time >= SYSDATE;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Cannot update seat row and column due to ongoing flight!';
        return;
    END IF;

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_airplanes
    WHERE 
        name = in_name
        AND id != in_id
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Name Already Exist!';
        return;
    END IF;

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_airplanes
    WHERE 
        registration_number = in_registration_number
        AND id != in_id
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Registration Number Already Exist!';
        return;
    END IF;

    SELECT
        max_row
    INTO
        v_x
    FROM
        rico_ap_airplanes
    WHERE
        id = in_id
        AND status = 1;

    SELECT
        max_column
    INTO
        v_y
    FROM
        rico_ap_airplanes
    WHERE
        id = in_id
        AND status = 1;

    IF (v_x != in_max_row) OR (v_y != in_max_column) THEN
        DELETE FROM 
            rico_ap_airplane_seats
        WHERE
            airplane_id = in_id;

        SELECT
            *
        INTO
            v_seat_type
        FROM
            (
            SELECT
                rst.id
            FROM
                rico_ap_airplane_seat_types rast
                JOIN rico_ap_seat_types rst ON rast.seat_type_id = rst.id
            WHERE
                rast.airplane_id = in_id 
                AND rast.status = 1
            ORDER BY
                rst.id
            )
        WHERE
            rownum = 1;
        

        FOR i IN 1 .. in_max_row LOOP
        
            FOR j IN 1 .. in_max_column LOOP
                INSERT INTO rico_ap_airplane_seats
                (
                    id,
                    airplane_id,
                    seat_type_id,
                    x,
                    y,
                    create_by,
                    create_time,
                    status
                )
                VALUES
                (
                    seq_rico_ap_airplane_seats_id.NEXTVAL,
                    in_id,
                    v_seat_type,
                    i,
                    j,
                    in_update_by,
                    SYSDATE,
                    1
                );
            END LOOP;
    
        END LOOP;
        
    END IF;

    UPDATE rico_ap_airplanes
    SET 
        name = in_name,
        airplane_brand = in_airplane_brand,
        airplane_model = in_airplane_model,
        registration_number = in_registration_number,
        color = in_color,
        max_row = in_max_row,
        max_column = in_max_column,
        update_time = SYSDATE,
        update_by = in_update_by
    WHERE
        id = in_id
        AND status = 1;

END;
/
SHOW ERRORS;