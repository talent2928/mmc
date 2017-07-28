<?php
return array(
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'rm-bp1a84eb24n08zc7co.mysql.rds.aliyuncs.com', // 服务器地址
    'DB_NAME'   => 'mmc', // 数据库名
    'DB_USER'   => 'mmc', // 用户名
    'DB_PWD'    => 'mmc_2016', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'mmc_', // 数据库表前缀
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, //



    //Redis
    'REDIS_HOST'  => '10.10.218.54',
    'REDIS_PORT'  => 6379,
    'REDIS_AUTH'  => 'rwredis',


    //
    'URL_MODEL'     => 0, //URL模式
    'ALLOW_OPT'     => ['Home:Admin:login'],//允许未登录操作URI


    //存储
    //七牛
    'STORAGE_QN' => [
        'maxSize'          => 5 * 1024 * 1024,//文件大小
        'rootPath'         => './',
        'saveName'         => ['uniqid', ''],
        'autoSub'	=> true,
        'subName'	=> array('date', 'Ymd'),
        'driver'           => 'Qiniu',
        'driverConfig'     => [
            'secretKey' => 'JsSuQzhSpW7QDn6wSzY0vUcSazPgn3AWKYykCs_K',
            'accessKey' => 'SxNgtKSASweaUJeF_GW9Zov7-HHI4MR4iPNjTN7s',
            'domain'    => 'o7mc55ynq.bkt.clouddn.com',
            'bucket'    => 'mmc-dev',
        ]
    ],
);