use mhidb;
drop procedure if exists upd_SMSID_In_SitesTable;
delimiter |
CREATE PROCEDURE upd_SMSID_In_SitesTable()
BEGIN
SELECT CONCAT('----------Begin Timestamp : ',Now(),'-----------------');
update sites set InstanceSMS_ID=id where InstanceSMS_ID is null;
SELECT CONCAT('Row(s) affected : ', row_count());
SELECT CONCAT('----------End Timestamp   : ',Now(),'-----------------');
END;
|
delimiter ;
