<?php
return array(
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'mmc', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '123456', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'mmc_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, //



    //Redis
    'REDIS_HOST'  => '192.168.1.179',
    'REDIS_PORT'  => 6379,
    'REDIS_AUTH'  => 'rwredis',


    //
    'URL_MODEL'     => 0, //URL模式
    'ALLOW_OPT'     => array('Admin:Admin:login'),//允许未登录操作URI

);