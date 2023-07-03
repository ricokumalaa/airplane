CREATE SEQUENCE seq_rico_ap_transits_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_transits
(
    id                      NUMBER PRIMARY KEY,
    flight_id               NUMBER,
    destination             VARCHAR2(256),
    departure_time          DATE,
    arrival_time            DATE,
    create_by               NUMBER,
    create_time             DATE,
    update_by               NUMBER,
    update_time             DATE,
    status                  NUMBER,
    owner_id                NUMBER,
    FOREIGN KEY
    (
        flight_id
    )
    REFERENCES rico_ap_flights
    (
        id
    )
);