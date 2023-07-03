CREATE SEQUENCE seq_rico_ap_seat_types_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_seat_types
(
    id                  NUMBER PRIMARY KEY,
    name                VARCHAR2(256),
    color               VARCHAR2(256),
    create_by           NUMBER,
    create_time         DATE,
    update_by           NUMBER,
    update_time         DATE,
    status              NUMBER,
    owner_id            NUMBER
);

CREATE SEQUENCE seq_rico_ap_ap_seat_types_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_airplane_seat_types
(
    id                  NUMBER PRIMARY KEY,
    airplane_id         NUMBER,
    seat_type_id        NUMBER,
    create_by           NUMBER,
    create_time         DATE,
    update_by           NUMBER,
    update_time         DATE,
    status              NUMBER,
    owner_id            NUMBER,
    FOREIGN KEY
    (
        airplane_id
    )
    REFERENCES rico_ap_airplanes
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

CREATE SEQUENCE seq_rico_ap_airplane_seats_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_airplane_seats
(
    id                  NUMBER PRIMARY KEY,
    airplane_id         NUMBER,
    seat_type_id        NUMBER,
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
        airplane_id
    )
    REFERENCES rico_ap_airplanes
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