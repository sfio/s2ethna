#!/bin/sh

php pyrus.phar mypear ~/src/my-project/pear
php pyrus.phar install PEAR2_HTTP_Request
php pyrus.phar list-packages

#pear channel-discover pear.ethna.jp
#pear update-channels
#pear install -a ethna/ethna

mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < example_bbs_mysql.sql
mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < example_mysql.sql
mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < session_mysql.sql
