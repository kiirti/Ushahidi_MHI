#!/bin/bash

# This creates a db, a db user and populates the db using the ushahidi script

# what to create
user=$1
pass=$2
name=$3
admin_user=$4
admin_pass=$5
admin_email=$6
site_name=$7
site_tagline=$8

# how to connect
super_admin="admin"
super_db="mhidb"
dbuser="emoksha"
dbpass="em0ksh2"
dbhost="kiirtidb.c4iuunoxp2j3.us-east-1.rds.amazonaws.com"
dbscript="/root/kiirti/multiple/mog/Ushahidi_MHI/instances/sql/ushahidi.sql"

## This needs to be the name of the instance kiirti runs on
site_host="domU-12-31-38-01-BC-B1.compute-1.internal"

if [ "$name" == "" ]; then
echo "usage: create_instance.sh user pass dbname"
exit 0
fi

do_db="CREATE DATABASE $name"
do_user="CREATE USER '$user'@'$site_host' IDENTIFIED BY '$pass'"
do_perm="GRANT ALL ON $name.* TO '$user'@'$site_host'"
do_create="\. $dbscript"
do_admin="UPDATE users SET username='$admin_user', email='$admin_email', password='$admin_pass'"
do_sa="replace into users (email, username, password) select email,username,password from $super_db.users where username = '$super_admin'"
do_sa_one="insert into roles_users (user_id,role_id) select id,1 from users where username = '$super_admin'"
do_sa_two="insert into roles_users (user_id,role_id) select id,2 from users where username = '$super_admin'"
do_sa_three="insert into roles_users (user_id,role_id) select id,3 from users where username = '$super_admin'"
do_sitename="update settings set site_name = '$site_name'"
do_site_tagline="update settings set site_tagline = '$site_tagline'"

echo $do_db
echo $do_db  | mysql -u $dbuser -p$dbpass -h $dbhost
echo $do_user
echo $do_user | mysql -u $dbuser -p$dbpass -h $dbhost
echo $do_perm
echo $do_perm | mysql -u $dbuser -p$dbpass -h $dbhost
echo $do_create
echo $do_create | mysql -u $user -p$pass $name -h $dbhost
echo $do_admin
echo $do_admin | mysql -u $user -p$pass $name -h $dbhost
echo $do_sa
echo $do_sa | mysql -u $dbuser -p$dbpass $name -h $dbhost
echo $do_sa_one
echo $do_sa_one | mysql -u $user -p$pass $name -h $dbhost
echo $do_sa_two
echo $do_sa_two | mysql -u $user -p$pass $name -h $dbhost
echo $do_sa_three
echo $do_sa_three | mysql -u $user -p$pass $name -h $dbhost
echo $do_sitename
echo $do_sitename | mysql -u $user -p$pass $name -h $dbhost
echo $do_site_tagline
echo $do_site_tagline | mysql -u $user -p$pass $name -h $dbhost
