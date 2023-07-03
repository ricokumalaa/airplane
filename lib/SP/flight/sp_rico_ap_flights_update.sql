CREATE OR REPLACE PROCEDURE sp_rico_ap_flights_update
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_flight_id                    IN rico_ap_flights.id%TYPE,
    in_airplane_id                  IN rico_ap_flights.airplane_id%TYPE,
    in_origin                       IN rico_ap_flights.origin%TYPE,
    in_destination                  IN rico_ap_flights.destination%TYPE,
    in_departure_time               IN rico_ap_flights.departure_time%TYPE,
    in_arrival_time                 IN rico_ap_flights.arrival_time%TYPE,
    in_duration_time                IN rico_ap_flights.duration_time%TYPE,
    in_available_baggage            IN rico_ap_flights.available_baggage%TYPE,
    in_adult_price                  IN rico_ap_flights.adult_price%TYPE,
    in_child_price                  IN rico_ap_flights.child_price%TYPE,
    in_baggage_price                IN rico_ap_flights.baggage_price%TYPE,
    in_update_by                    IN rico_ap_flights.update_by%TYPE
)
AS
    v_count NUMBER := 0;
    v_temp NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    UPDATE rico_ap_flights
    SET
        airplane_id = in_airplane_id,
        origin = in_origin,
        destination = in_destination,
        departure_time = in_departure_time,
        arrival_time = in_arrival_time,
        duration_time = in_duration_time,
        available_baggage = in_available_baggage,
        adult_price = in_adult_price,
        child_price = in_child_price,
        baggage_price = in_baggage_price,
        update_by = in_update_by,
        update_time = SYSDATE
    WHERE 
        id = in_flight_id
        AND status = 1;

END;
/
SHOW ERRORS;