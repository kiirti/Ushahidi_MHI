#!/bin/bash
# Script to run the ins_Msg_Instance stored procedure
# This SP checks the mhidb message table and inserts the rows present in the respective instance db
mysql -uroot -pem0ksh2 mhidb --skip-column-names -e "call ins_Msg_Instance();" >> /root/kiirti/multiple/mog/Ushahidi_MHI/log/kiirti_SMS_insert_SP.log 2>&1
