DELIMITER //
CREATE TRIGGER generate_transaction_id
BEFORE INSERT ON tblpayments
FOR EACH ROW
BEGIN
    DECLARE max_cert_number INT;
    SET max_cert_number = COALESCE(
        (SELECT MAX(CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(trans_id, '-', -2), '-', -1) AS UNSIGNED)) FROM tblpayments), 0);
    
    SET NEW.trans_id = CONCAT(
        DATE_FORMAT(NOW(), '%d%m%Y'),
        '-',
        LPAD(FLOOR(RAND() * 10000), 6, '0')
    );
END;
//
DELIMITER ;

