CREATE OR REPLACE TYPE rico_arr_ap_seat_types
AS TABLE OF NUMBER;
/

CREATE OR REPLACE PROCEDURE sp_rico_ap_airplanes_insert
(
    out_code                        OUT NUMBER,
    out_msg                         OUT VARCHAR2,
    in_name                         IN rico_ap_airplanes.name%TYPE,
    in_airplane_brand               IN rico_ap_airplanes.airplane_brand%TYPE,
    in_airplane_model               IN rico_ap_airplanes.airplane_model%TYPE,
    in_registration_number          IN rico_ap_airplanes.registration_number%TYPE,
    in_color                        IN rico_ap_airplanes.color%TYPE,
    in_seat_type                    IN rico_arr_ap_seat_types,
    in_max_row                      IN rico_ap_airplanes.max_row%TYPE,
    in_max_column                   IN rico_ap_airplanes.max_column%TYPE,
    in_create_by                    IN rico_ap_airplanes.create_by%TYPE
)
AS
    v_count NUMBER := 0;
BEGIN
    out_code := 0;
	out_msg := 'OK';

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_airplanes
    WHERE 
        name = in_name
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Name Already Exist!';
        return;
    END IF;

    SELECT
        COUNT(*)
    INTO
        v_count
    FROM
        rico_ap_airplanes
    WHERE 
        registration_number = in_registration_number
        AND status = 1;

    IF v_count > 0 THEN
        out_code := 1;
	    out_msg := 'Registration Number Already Exist!';
        return;
    END IF;

    INSERT INTO rico_ap_airplanes
    (
        id,
        user_id,
        name,
        airplane_brand,
        airplane_model,
        registration_number,
        color,
        max_row,
        max_column,
        create_by,
        create_time,
        status
    )
    VALUES
    (
        seq_rico_ap_airplanes_id.NEXTVAL,
        in_create_by,
        in_name,
        in_airplane_brand,
        in_airplane_model,
        in_registration_number,
        in_color,
        in_max_row,
        in_max_column,
        in_create_by,
        SYSDATE,
        1
    );

    FOR i IN 1 .. in_seat_type.COUNT LOOP
        INSERT INTO rico_ap_airplane_seat_types
        (
            id,
            airplane_id,
            seat_type_id,
            create_by,
            create_time,
            status
        )
        VALUES
        (
            seq_rico_ap_ap_seat_types_id.NEXTVAL,
            seq_rico_ap_airplanes_id.CURRVAL,
            in_seat_type(i),
            in_create_by,
            SYSDATE,
            1
        );
    END LOOP; 

    FOR i IN 1 .. in_max_row LOOP
        
        FOR j IN 1 .. in_max_column LOOP
            INSERT INTO rico_ap_airplane_seats
            (
                id,
                airplane_id,
                seat_type_id,
                x,
                y,
                create_by,
                create_time,
                status
            )
            VALUES
            (
                seq_rico_ap_airplane_seats_id.NEXTVAL,
                seq_rico_ap_airplanes_id.CURRVAL,
                in_seat_type(1),
                i,
                j,
                in_create_by,
                SYSDATE,
                1
            );
        END LOOP;
  
    END LOOP; 

END;
/
SHOW ERRORS;