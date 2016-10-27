<?php
return array(
	//'配置项'=>'配置值'
    'URL_HTML_SUFFIX'   => '',
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . '/Public/Admin',
    ),

    //***********************************权限控制**********************************
    'AUTH_CONFIG' => array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'think_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'think_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'think_auth_rule', //权限规则表
        'AUTH_USER' => 'think_user'//用户信息表
    ),

    //***********************************邮件服务器**********************************
    'EMAIL_FROM_NAME'        => '827400818@qq.com',   // 发件人
    'EMAIL_SMTP'             => 'smtp.qq.com',   // smtp
    'EMAIL_USERNAME'         => '827400818@qq.com',   // 账号
    'EMAIL_PASSWORD'         => 'vtrcwkchnannbebc',   // 密码  注意: 163和QQ邮箱是授权码；不是登录的密码
    'EMAIL_SMTP_SECURE'      => 'ssl',   // 链接方式 如果使用QQ邮箱；需要把此项改为  ssl
    'EMAIL_PORT'             => '465', // 端口 如果使用QQ邮箱；需要把此项改为  465

    //***********************************滑动验证码**********************************
    'GEETEST_ID'             => '034b9cc862456adf05398821cefc94eb',//极验id  仅供测试使用
    'GEETEST_KEY'            => 'b7f064b9ae813699de794303f0b0e76f',//极验key 仅供测试使用
);