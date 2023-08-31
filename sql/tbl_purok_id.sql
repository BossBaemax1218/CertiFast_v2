DELIMITER //
CREATE TRIGGER generate_req_cert_purok_id
BEFORE INSERT ON tblpurok_records
FOR EACH ROW
BEGIN
    DECLARE max_cert_number INT;
    SET max_cert_number = COALESCE(
        (SELECT MAX(CAST(SUBSTRING(national_id, 10) AS UNSIGNED)) FROM tblpurok_records), 0);
    
    SET max_cert_number = max_cert_number + FLOOR(RAND() * 1000);
    
    SET NEW.national_id = CONCAT(DATE_FORMAT(NOW(), '%Y%m%d'), '-', LPAD(max_cert_number + 1, 4, '0'));
END;
//
DELIMITER ;
