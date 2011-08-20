#!/bin/sh

#public_html/install/go-pear.phar list-packages

#pear channel-discover pear.ethna.jp
#pear update-channels
#pear install -a ethna/ethna

mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < schema/example_bbs_mysql.sql
mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < schema/example_mysql.sql
mysql -h FLX_DB_HOST -u FLX_DB_USER FLX_DB_NAME < schema/session_mysql.sql
