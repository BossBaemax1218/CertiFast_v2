DELIMITER //
CREATE TRIGGER generate_req_cert_id
BEFORE INSERT ON tblresident_requested
FOR EACH ROW
BEGIN
    DECLARE max_cert_number INT;
    SET max_cert_number = COALESCE(
        (SELECT MAX(CAST(SUBSTRING(req_cert_id, 10) AS UNSIGNED)) FROM tblresident_requested), 0);
    
    SET max_cert_number = max_cert_number + FLOOR(RAND() * 1000); -- Generating a random value to add
    
    SET NEW.req_cert_id = CONCAT(DATE_FORMAT(NOW(), '%Y%m%d'), '-', LPAD(max_cert_number + 1, 4, '0'));
END;
//
DELIMITER ;
