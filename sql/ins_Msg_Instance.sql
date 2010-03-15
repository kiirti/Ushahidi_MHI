use mhidb;
drop procedure if exists ins_Msg_Instance;
delimiter |
CREATE PROCEDURE ins_Msg_Instance()
BEGIN
DECLARE v_id bigint(20);
DECLARE v_parent_id          bigint(20);
DECLARE v_incident_id        int(11);
DECLARE v_user_id            int(11);
DECLARE v_reporter_id        bigint(20);
DECLARE v_service_messageid  varchar(100);
DECLARE v_message_from       varchar(100);
DECLARE v_message_to         varchar(100);
DECLARE v_message            text;
DECLARE v_message_detail     text;
DECLARE v_message_type       tinyint(4);
DECLARE v_message_date       datetime;
DECLARE v_message_level      tinyint(4);
DECLARE done INT DEFAULT 0;
DECLARE error_rows INT DEFAULT 0;
DECLARE success_rows INT DEFAULT 0;
DECLARE cur1 CURSOR FOR SELECT id, parent_id, incident_id, user_id, reporter_id, service_messageid, message_from, message_to, message, message_detail, message_type, message_date, message_level FROM message;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

SELECT CONCAT('----------Begin Timestamp : ',Now(),'-----------------');

OPEN cur1;

REPEAT
    FETCH cur1 INTO v_id, v_parent_id, v_incident_id, v_user_id, v_reporter_id, v_service_messageid, v_message_from, v_message_to, v_message, v_message_detail, v_message_type, v_message_date, v_message_level;
    IF NOT done THEN
	SET @parent_id = v_parent_id;
	SET @incident_id = v_incident_id;
	SET @user_id = v_user_id;
	SET @reporter_id = v_reporter_id;
	SET @service_messageid = v_service_messageid;
	SET @message_from = v_message_from;
	SET @message_to = v_message_to;
	SET @message = v_message;
	SET @message_detail = v_message_detail;
	SET @message_type = v_message_type;
	SET @message_date = v_message_date;
	SET @message_level = v_message_level;
	SET @instanceID = (select SUBSTRING(SUBSTRING_INDEX(v_message,' ',2),8));
	SET @instanceName = (select dbdatabase from sites where InstanceSMS_ID = @instanceID);
	SET @instanceName = (Select concat(@instanceName, '.message'));
	if @instanceName IS NULL then
 set @insertQuery = "Error";
 set error_rows = error_rows + 1;
	else
 set @insertQuery := CONCAT('insert into ', @instanceName, '(parent_id, incident_id, user_id, reporter_id, service_messageid, message_from, message_to, message, message_detail, message_type, message_date, message_level) values (?,?,?,?,?,?,?,?,?,?,?,?)');
 PREPARE stmt FROM @insertQuery;
 EXECUTE stmt USING @parent_id, @incident_id, @user_id, @reporter_id, @service_messageid, @message_from, @message_to, @message, @message_detail, @message_type, @message_date, @message_level;
 deallocate prepare stmt;
 delete from message where id = v_id;
 set success_rows = success_rows + 1;
	End if;
--	select @instanceID;
--	select @instanceName;
--	select @insertQuery;
--	select @message;
    END IF;
  UNTIL done END REPEAT;
CLOSE cur1;
SELECT CONCAT('Rows successfully processed : ', success_rows);
SELECT CONCAT('Rows with errors            : ', error_rows);
SELECT CONCAT('----------End Timestamp   : ',Now(),'-----------------');
END;
|
delimiter ;