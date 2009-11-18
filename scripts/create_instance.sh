#!/bin/bash

# This creates a db, a db user and populates the db using the ushahidi script

# what to create
user=$1
pass=$2
name=$3
admin_user=$4
admin_pass=$5
admin_email=$6

# how to connect
dbuser="root"
dbpass="em0ksh2"
dbscript="/root/kiirti/multiple/ushahidi/sql/ushahidi.sql"

if [ "$name" == "" ]; then
echo "usage: create_instance.sh user pass dbname"
exit 0
fi

do_db="CREATE DATABASE $name"
do_user="CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass'"
do_perm="GRANT ALL ON $name.* TO '$user'@'localhost'"
do_create="\. $dbscript"
do_admin="UPDATE users SET username='$admin_user', email='$admin_email', password='$admin_pass'"

echo $do_db
echo $do_db  | mysql -u $dbuser -p$dbpass  
echo $do_user
echo $do_user | mysql -u $dbuser -p$dbpass 
echo $do_perm
echo $do_perm | mysql -u $dbuser -p$dbpass 
echo $do_create
echo $do_create | mysql -u $user -p$pass $name
echo $do_admin
echo $do_admin | mysql -u $user -p$pass $name
