CREATE OR REPLACE PROCEDURE sp_r_ap_ap_seat_types_update
(
    out_code                            OUT NUMBER,
    out_msg                             OUT VARCHAR2,
    in_id                               IN rico_ap_airplanes.id%TYPE,
    in_seat_to_add                      IN rico_arr_ap_seat_to_add,
    in_seat_to_remove                   IN rico_arr_ap_seat_to_remove,
    in_create_by                        IN rico_ap_airplane_seat_types.create_by%TYPE
)
AS
    v_count NUMBER := 0;
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
        AND departure_time >= SYSDATE
        AND status = 1;

    IF v_count >0 THEN
        out_code := 1;
	    out_msg := 'Cannot update seat type due to ongoing flight!';
        return;
    END IF;

    IF in_seat_to_add.COUNT > 0 THEN
        
        FOR i IN 1 .. in_seat_to_add.COUNT LOOP
            INSERT INTO rico_ap_airplane_seat_types
            (
                id,
                airplane_id,
                seat_type_id,
                create_by,
                create_time,
                status
            )
            VALUES
            (
                seq_rico_ap_ap_seat_types_id.NEXTVAL,
                in_id,
                in_seat_to_add(i),
                in_create_by,
                SYSDATE,
                1
            );
        END LOOP;

    END IF;

    IF in_seat_to_remove.COUNT > 0 THEN

        FOR i IN 1 .. in_seat_to_remove.COUNT LOOP
            DELETE FROM rico_ap_airplane_seat_types
            WHERE
                airplane_id = in_id
                AND seat_type_id = in_seat_to_remove(i);

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

            UPDATE rico_ap_airplane_seats
            SET
                seat_type_id = v_seat_type
            WHERE
                airplane_id = in_id
                AND seat_type_id = in_seat_to_remove(i);

        END LOOP;

    END IF;

END;
/
SHOW ERRORS;

CREATE OR REPLACE TYPE rico_arr_ap_seat_to_add
AS TABLE OF NUMBER;
/

CREATE OR REPLACE TYPE rico_arr_ap_seat_to_remove
AS TABLE OF NUMBER;
/