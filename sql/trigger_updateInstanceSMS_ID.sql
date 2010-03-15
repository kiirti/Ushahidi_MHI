USE mhidb;
ALTER TABLE sites ADD InstanceSMS_ID mediumint;
DROP TRIGGER IF EXISTS updateInstanceSMS_ID;
delimiter |
CREATE TRIGGER updateInstanceSMS_ID BEFORE UPDATE ON sites
FOR EACH ROW BEGIN
SET NEW.InstanceSMS_ID = NEW.id;
END
|
delimiter ;
