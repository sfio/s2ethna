<?php
/*
 * s2ethna-ini.php
 *
 * update:
 */
$config = array(
    // site
    'url' => '',

    // debug
    // (to enable ethna_info and ethna_unittest, turn this true)
    'debug' => false,

    // db
    // sample-1: single db
    // 'dsn' => 'mysql://user:password@server/database',
    //
    // sample-2: single db w/ multiple users
    // 'dsn'   => 'mysql://rw_user:password@server/database', // read-write
    // 'dsn_r' => 'mysql://ro_user:password@server/database', // read-only
    //
    // sample-3: multiple db (slaves)
    // 'dsn'   => 'mysql://rw_user:password@master/database', // read-write(master)
    // 'dsn_r' => array(
    //     'mysql://ro_user:password@slave1/database',         // read-only(slave)
    //     'mysql://ro_user:password@slave2/database',         // read-only(slave)
    // ),

    // log
    // sample-1: sigile facility
    'log_facility'          => 'echo',
    'log_level'             => 'warning',
    'log_option'            => 'pid,function,pos',
    'log_filter_do'         => '',
    'log_filter_ignore'     => 'Undefined index.*%%.*tpl',
    // sample-2: mulitple facility
    //'log' => array(
    //    'echo'  => array(
    //        'level'         => 'warning',
    //    ),
    //    'file'  => array(
    //        'level'         => 'notice',
    //        'file'          => '/var/log/s2ethna.log',
    //        'mode'          => 0666,
    //    ),
    //    'alertmail'  => array(
    //        'level'         => 'err',
    //        'mailaddress'   => 'alert@ml.example.jp',
    //    ),
    //),
    //'log_option'            => 'pid,function,pos',
    //'log_filter_do'         => '',
    //'log_filter_ignore'     => 'Undefined index.*%%.*tpl',

    // memcache
    // sample-1: single (or default) memcache
    // 'memcache_host' => 'localhost',
    // 'memcache_port' => 11211,
    // 'memcache_use_connect' => false,
    // 'memcache_retry' => 3,
    // 'memcache_timeout' => 3,
    //
    // sample-2: multiple memcache servers (distributing w/ namespace and ids)
    // 'memcache' => array(
    //     'namespace1' => array(
    //         0 => array(
    //             'memcache_host' => 'cache1.example.com',
    //             'memcache_port' => 11211,
    //         ),
    //         1 => array(
    //             'memcache_host' => 'cache2.example.com',
    //             'memcache_port' => 11211,
    //         ),
    //     ),
    // ),

    // csrf
    // 'csrf' => 'Session',

    // ���ƥʥ�
    'maintenance' => false,

    // �ǥ�󥹥ȥ졼�����
    'demonstration' => false,
    'demonstration_dsn' => 'mysql://root:pass@localhost/s2con',
    'demonstration_page' => '1',

);
?>
