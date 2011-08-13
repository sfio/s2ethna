#!/bin/sh

php public_html/install/pyrus.phar mypear ~/lib/PEAR
php public_html/install/pyrus.phar list-packages
php public_html/install/pyrus.phar install PEAR
php public_html/install/pyrus.phar list-packages

#pear channel-discover pear.ethna.jp
#pear update-channels
#pear install -a ethna/ethna

mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < example_bbs_mysql.sql
mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < example_mysql.sql
mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < session_mysql.sql
