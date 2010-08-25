#!/bin/bash

# Script to run the upd_SMSID_In_SitesTable procedure to update InstanceSMS_ID field with the row ID
mysql -h kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com -uemoksha -pem0ksh2 mhidb --skip-column-names -e "call upd_SMSID_In_SitesTable();" >> /root/kiirti/multiple/mog/Ushahidi_MHI/log/kiirti_SMSID_Creation.log 2>&1

# This script below will call the frontlinesms url using rows in the message table
cd /root/kiirti/multiple/mog/Ushahidi_MHI && php scripts/sms_instance_post.php >> /root/kiirti/multiple/mog/Ushahidi_MHI/log/kiirti_sms_instance_post.log 2>&1
