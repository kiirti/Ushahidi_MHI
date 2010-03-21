#!/bin/bash
# Script to run the upd_SMSID_In_SitesTable procedure to update InstanceSMS_ID field with the row ID
mysql -h kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com -uemoksha -pem0ksh2 mhidb --skip-column-names -e "call upd_SMSID_In_SitesTable();" >> /root/kiirti/multiple/mog/Ushahidi_MHI/log/kiirti_SMSID_Creation.log 2>&1
# Script to run the ins_Msg_Instance stored procedure
# This SP checks the mhidb message table and inserts the rows present in the respective instance db
mysql -h kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com -uemoksha -pem0ksh2 mhidb --skip-column-names -e "call ins_Msg_Instance();" >> /root/kiirti/multiple/mog/Ushahidi_MHI/log/kiirti_SMS_insert_SP.log 2>&1
