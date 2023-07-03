CREATE SEQUENCE seq_rico_ap_tickets_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_tickets
(
    id                  NUMBER PRIMARY KEY,
    flight_id           NUMBER,
    book_id             NUMBER,
    seat_type_id        NUMBER,
    name                VARCHAR2(256),
    x                   NUMBER,
    y                   NUMBER,
    create_by           NUMBER,
    create_time         DATE,
    update_by           NUMBER,
    update_time         DATE,
    status              NUMBER,
    owner_id            NUMBER,
    FOREIGN KEY
    (
        flight_id
    )
    REFERENCES rico_ap_flights
    (
        id
    ),
    FOREIGN KEY
    (
        book_id
    )
    REFERENCES rico_ap_books
    (
        id
    ),
    FOREIGN KEY
    (
        seat_type_id
    )
    REFERENCES rico_ap_seat_types
    (
        id
    )
);