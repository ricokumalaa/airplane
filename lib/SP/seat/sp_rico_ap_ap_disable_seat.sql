CREATE OR REPLACE TYPE rico_arr_ap_max_row
AS TABLE OF NUMBER;
/

CREATE OR REPLACE TYPE rico_arr_ap_max_column
AS TABLE OF NUMBER;
/

CREATE OR REPLACE PROCEDURE sp_rico_ap_ap_disable_seat
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_airplane_id                  IN rico_ap_airplane_seats.airplane_id%TYPE,
    in_seat_type_id                 IN rico_ap_airplane_seats.seat_type_id%TYPE,
    in_x                            IN rico_arr_ap_max_row,
    in_y                            IN rico_arr_ap_max_column,
    in_create_by                    IN rico_ap_airplane_seats.create_by%TYPE,
    in_update_by                    IN rico_ap_airplane_seats.update_by%TYPE
)
AS
    v_count NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    FOR i IN 1 .. in_x.COUNT LOOP

        SELECT
            COUNT(*)
        INTO
            v_count
        FROM
            rico_ap_flights rf
            LEFT JOIN rico_ap_tickets rt ON rf.id = rt.flight_id
        WHERE
            rt.x = in_x(i)
            AND rt.y = in_y(i)
            AND rf.airplane_id = in_airplane_id
            AND rf.departure_time >= SYSDATE;
        
        IF v_count > 0 THEN
            out_code := 1;
            out_msg := 'Cannot delete seat due to ongoing flight!';
            return;
        END IF;
            
    END LOOP;


    FOR i IN 1 .. in_x.COUNT LOOP

        DELETE FROM rico_ap_airplane_seats
        WHERE 
            airplane_id = in_airplane_id
            AND x = in_x(i)
            AND y = in_y(i)
            AND status = 1;

    END LOOP;

END;
/
SHOW ERRORS;