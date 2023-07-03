CREATE OR REPLACE TYPE rico_arr_ap_seat_row_column
AS TABLE OF NUMBER;
/

CREATE OR REPLACE TYPE rico_arr_ap_passanger_name
AS TABLE OF VARCHAR2(256);
/
SHOW ERRORS;

CREATE OR REPLACE PROCEDURE sp_rico_ap_books_insert
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_flight_id                    IN rico_ap_books.flight_id%TYPE,
    in_payment_id                   IN rico_ap_books.payment_id%TYPE,
    in_seat_type_id                 IN rico_ap_tickets.seat_type_id%TYPE,
    in_adult_passanger              IN rico_ap_books.adult_passanger%TYPE,
    in_child_passanger              IN rico_ap_books.child_passanger%TYPE,
    in_additional_baggage           IN rico_ap_books.additional_baggage%TYPE,
    in_total_ticket                 IN rico_ap_books.total_ticket%TYPE,
    in_total_price                  IN rico_ap_books.total_price%TYPE,
    in_x                            IN rico_arr_ap_seat_row_column,
    in_y                            IN rico_arr_ap_seat_row_column,
    in_passangers_name               IN rico_arr_ap_passanger_name,
    in_create_by                    IN rico_ap_books.create_by%TYPE
)
AS
    v_count NUMBER := 0;
    v_book_code VARCHAR2(6);
BEGIN
    out_code := 0;
	out_msg := 'OK';

    LOOP
        SELECT
            fn_rico_generate_book_code
        INTO 
            v_book_code
        FROM 
            DUAL;

        SELECT 
            count(*)
        INTO
            v_count
        FROM
            rico_ap_books
        WHERE 
            code = v_book_code;

        IF v_count = 0 THEN
            EXIT;
        END IF;
    END LOOP;

    INSERT INTO rico_ap_books
    (
        id,
        flight_id,
        payment_id,
        user_id,
        code,
        adult_passanger,
        child_passanger,
        additional_baggage,
        total_ticket,
        total_price,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_rico_ap_books_id.NEXTVAL,
        in_flight_id,
        in_payment_id,
        in_create_by,
        v_book_code,
        in_adult_passanger,
        in_child_passanger,
        in_additional_baggage,
        in_total_ticket,
        in_total_price,
        in_create_by,
        SYSDATE,
        1
    );

    FOR i IN 1 .. in_total_ticket LOOP
        
        INSERT INTO rico_ap_tickets
        (
            id,
            book_id,
            flight_id,
            seat_type_id,
            name,
            x,
            y,
            create_by,
            create_time,
            status
        )
        VALUES
        (
            seq_rico_ap_tickets_id.NEXTVAL,
            seq_rico_ap_books_id.CURRVAL,
            in_flight_id,
            in_seat_type_id,
            in_passangers_name(i),
            in_x(i),
            in_y(i),
            in_create_by,
            SYSDATE,
            1
        );

    END LOOP;

END;
/
SHOW ERRORS;