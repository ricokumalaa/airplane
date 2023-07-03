CREATE OR REPLACE PROCEDURE sp_rico_ap_transits_update
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_id                           IN rico_ap_transits.id%TYPE,
    in_flight_id                    IN rico_ap_transits.flight_id%TYPE,
    in_destination                  IN rico_ap_transits.destination%TYPE,
    in_departure_time               IN rico_ap_transits.departure_time%TYPE,
    in_arrival_time                 IN rico_ap_transits.arrival_time%TYPE,
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
        out_msg := 'This transit does not exist!';
        return;
    END IF;

    UPDATE rico_ap_transits
    SET
        destination = in_destination,
        arrival_time = in_arrival_time,
        departure_time = in_departure_time,
        update_by = in_update_by,
        update_time = SYSDATE
    WHERE 
        id = in_id
        AND status = 1;

END;
/
SHOW ERRORS;