CREATE SEQUENCE seq_rico_ap_airplanes_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_airplanes
(
    id                      NUMBER PRIMARY KEY,
    user_id                 NUMBER,
    name                    VARCHAR2(256),
    registration_number     VARCHAR2(256),
    color                   VARCHAR2(256),
    airplane_model          VARCHAR2(256),
    airplane_brand          VARCHAR2(256),
    max_row                 NUMBER,
    max_column              NUMBER,
    create_by               NUMBER,
    create_time             DATE,
    update_by               NUMBER,
    update_time             DATE,
    status                  NUMBER,
    owner_id                NUMBER,
    FOREIGN KEY
    (
        user_id
    )
    REFERENCES rico_ap_users
    (
        id
    )
);