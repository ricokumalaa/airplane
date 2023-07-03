CREATE OR REPLACE PROCEDURE sp_rico_ap_transits_insert
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_flight_id                    IN rico_ap_transits.flight_id%TYPE,
    in_destination                  IN rico_ap_transits.destination%TYPE,
    in_arrival_time                 IN rico_ap_transits.arrival_time%TYPE,
    in_departure_time               IN rico_ap_transits.departure_time%TYPE,
    in_create_by                    IN rico_ap_transits.create_by%TYPE
)
AS
    v_count NUMBER := 0;
    v_temp NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    INSERT INTO rico_ap_transits
    (
        id,
        flight_id,
        destination,
        arrival_time,
        departure_time,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_rico_ap_transits_id.NEXTVAL,
        in_flight_id,
        in_destination,
        in_arrival_time,
        in_departure_time,
        in_create_by,
        SYSDATE,
        1
    );

END;
/
SHOW ERRORS;