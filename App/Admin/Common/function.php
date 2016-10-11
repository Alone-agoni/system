<?php
/**
 * 获取系统信息
 */
function system_info(){
    $Row = array(
        '操作系统'=>PHP_OS,
        '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
        'PHP运行方式'=>php_sapi_name(),
        'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
        '上传附件限制'=>ini_get('upload_max_filesize'),
        '执行时间限制'=>ini_get('max_execution_time').'秒',
        '服务器时间'=>date("Y年n月j日 H:i:s"),
        '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
        '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
        '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
        'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
        'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
        'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
    );
    return $Row;
}

/**
 * 第一步，将数据转换成树形数组
 * 无限极分类树型菜单
 */
function tree($data,$pid=0,$level=1)
{
    $tree = [];
    foreach($data as $k=>$v)
    {
        if($v['pid'] == $pid)
        {
            $v['son'] = tree($data,$v['id'],$level+1);
            if(empty($v['son'])) unset($v['son']);
            $v['level'] = $level;//等级，后面格式化显示要用到
            $tree[] = $v;
        }
    }
    return $tree;
}

/**
 * 第二步
 * 树形菜单转二维数组
 */
function sort_tree($tree)
{
    static $item = [];
    foreach($tree as $k=>$v)
    {
        $v['html'] = tree_html($v['level'],4);//计算格式化样式
        if(isset($v['son']))
        {
            $son = $v['son'];
            unset($v['son']);
            $item[] = $v;
            sort_tree($son);
        }else{
            $item[] = $v;
        }
    }
    return $item;
}

/**
 * 第三步
 * 根据菜单等级计算&nbsp;的个数
 */
function tree_html($level,$num=4)
{
    $total = ($level-1)*$num;
    $string = '';
    for($i=0;$i<=$total;$i++) $string .= "&nbsp;";
    return $total==0?$string:$string."|_";
}