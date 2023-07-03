CREATE SEQUENCE seq_rico_ap_users_id
    START WITH 1
    INCREMENT BY 1;

CREATE TABLE rico_ap_users
(
    id                  NUMBER PRIMARY KEY,
    first_name          VARCHAR2(256),
    last_name           VARCHAR2(256),
    email               VARCHAR2(256),
    password            VARCHAR2(256),
    nik                 VARCHAR2(256),
    phone_number        VARCHAR2(256),
    address             VARCHAR2(256),
    create_by           NUMBER,
    create_time         DATE,
    update_by           NUMBER,
    update_time         DATE,
    status              NUMBER,
    owner_id            NUMBER
);