DELIMITER //
CREATE TRIGGER generate_national_id
BEFORE INSERT ON tblresident
FOR EACH ROW
BEGIN
    DECLARE max_brgy_number INT;
    SET max_brgy_number = COALESCE(
        (SELECT MAX(CAST(SUBSTRING(national_id, 13) AS UNSIGNED)) FROM tblresident), 0);
    SET max_brgy_number = max_brgy_number + FLOOR(RAND() * 10000);
    
    SET NEW.national_id = CONCAT(
        'BLA-',
        DATE_FORMAT(NOW(), '%Y%m%d'),
        LPAD(max_brgy_number, 6, '0')
    );
END;
//
DELIMITER ;
