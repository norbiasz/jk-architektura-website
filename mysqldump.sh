#!/bin/bash
if [ ! -d /var/www/db ]; then
    mkdir /var/www/db
fi

mysqldump -u root -proot scotchbox > /var/www/db/dump-`date +%Y-%m-%d_%H.%M.%S`.sql;