CREATE SEQUENCE seq_rico_ap_flights_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_flights
(
    id                      NUMBER PRIMARY KEY,
    airplane_id             NUMBER,
    origin                  VARCHAR2(256),
    destination             VARCHAR2(256),
    departure_time          DATE,
    arrival_time            DATE,
    duration_time           DATE,
    available_baggage       NUMBER,
    adult_price             NUMBER,
    child_price             NUMBER,
    baggage_price           NUMBER,
    create_by               NUMBER,
    create_time             DATE,
    update_by               NUMBER,
    update_time             DATE,
    status                  NUMBER,
    owner_id                NUMBER,
    FOREIGN KEY
    (
        airplane_id
    )
    REFERENCES rico_ap_airplanes
    (
        id
    )
);