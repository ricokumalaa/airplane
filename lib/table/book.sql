CREATE SEQUENCE seq_rico_ap_books_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_books
(
    id                              NUMBER PRIMARY KEY,
    flight_id                       NUMBER,
    payment_id                      NUMBER,
    user_id                         NUMBER,
    code                            VARCHAR2(6),
    adult_passanger                 NUMBER,
    child_passanger                 NUMBER,
    additional_baggage              NUMBER,
    total_ticket                    NUMBER,
    total_price                     NUMBER,
    create_by                       NUMBER,
    create_time                     DATE,
    update_by                       NUMBER,
    update_time                     DATE,
    status                          NUMBER,
    owner_id                        NUMBER,
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
        payment_id
    )
    REFERENCES rico_ap_payments
    (
        id
    ),
    FOREIGN KEY
    (
        user_id
    )
    REFERENCES rico_ap_users
    (
        id
    )
);