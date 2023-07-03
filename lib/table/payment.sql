CREATE SEQUENCE seq_rico_ap_payments_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_payments
(
    id                      NUMBER PRIMARY KEY,
    name                    VARCHAR2(256),
    create_by               NUMBER,
    create_time             DATE,
    update_by               NUMBER,
    update_time             DATE,
    status                  NUMBER,
    owner_id                NUMBER
);