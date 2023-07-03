CREATE OR REPLACE PROCEDURE sp_rico_ap_flights_delete
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_flight_id                    IN rico_ap_flights.id%TYPE,
    in_update_by                    IN rico_ap_flights.update_by%TYPE
)
AS
    v_count NUMBER := 0;
    v_temp NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT 
        COUNT(t.id)
    INTO
        v_count
    FROM
        rico_ap_flights f 
    JOIN rico_ap_tickets t ON f.id = t.flight_id
    WHERE
        f.id = in_flight_id
        AND f.departure_time >= SYSDATE
        AND f.status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Cannot delete this flight due to booked seats!';
        return;
    END IF;

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_flights
    WHERE
        status = 1;

    IF v_count = 0 THEN
        out_code := 1;
	    out_msg := 'Flight does not exist!';
        return;
    END IF;

    UPDATE rico_ap_flights
    SET
        status = 0
    WHERE 
        id = in_flight_id
        AND status = 1;

    UPDATE rico_ap_transits
    SET
        status = 0
    WHERE 
        flight_id = in_flight_id
        AND status = 1;

END;
/
SHOW ERRORS;