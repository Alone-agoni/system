<?php
/**
 * 自动化生成model
 */
function create_model()
{
    //获取数据库所有表
    $db = M();
    $tables = $db->query($sql = 'show tables');
    foreach($tables as $val)
    {
        $tablename  = $val[key($val)];//通过关联数组key获取value
        $tablenames = explode('_',$tablename);//将表名分割成数组
        unset($tablenames[0]);//去掉表前缀
        foreach($tablenames as $k=>$v)
        {
            $tablenames[$k] = strtoupper(substr($v,0,1)).substr($v,1);//将首字母转为大写
        }
        $filename = implode("",$tablenames);
        $filepath = "./App/Common/Model/".$filename."Model.class.php";//组合成想要的文件名
        //判读文件是否存在
        if(!file_exists($filepath))
        {
            //将写文件
            if(file_put_contents($filepath,model_tpl($filename)))
            {
                #echo "<font color='green'>".$filename."Model写入成功...！！！</font><br>";
            }else{
                #echo "<font color='red'>".$filename."Model写入失败...！！！</font><br>";
            }
        }else{
            #echo "<font color='blue'>".$filename."Model已经存在...！！！</font><br>";
        }
    }
}

/**
 * 自动化生成model模板
 */
function model_tpl($tablenames)
{
    $content = "";
    //php标签
    $content .= "<?php\r\n\r\n";
    //命名空间
    $content .= "namespace Common\\Model;\r\n\r\n";
    //use
    $content .= "use Think\\Model;\r\n\r\n";
    //class开始
    $content .= "class {$tablenames}Model extends Model{\r\n";
    //定义静态属性table
    $content .= "    /*定义静态成员属性*/\r\n";
    $content .= "    public static \$table = \"{$tablenames}\" ;//表名\r\n\r\n";
    $content .= "    /*定义静态成员方法*/\r\n\r\n";
    //rows方法
    $content .= "    /*获取所有数据*/\r\n";
    $content .= "    public static function rows(\$where=\"1\",\$field=\"*\",\$order=\"id DESC\")\r\n";
    $content .= "    {\r\n";
    $content .= "        \$rows = M(self::\$table)->where(\$where)->field(\$field)->order(\$order)->select();\r\n";
    $content .= "        return \$rows;\r\n";
    $content .= "    }\r\n\r\n";
    //row_byid方法
    $content .= "    /*通过id获取一条数据*/\r\n";
    $content .= "    public static function row_byid(\$id,\$field=\"*\")\r\n";
    $content .= "    {\r\n";
    $content .= "        \$row = M(self::\$table)->field(\$field)->find(\$id);\r\n";
    $content .= "        return \$row;\r\n";
    $content .= "    }\r\n\r\n";
    //row_bywhere方法
    $content .= "    /*通过条件获取一条数据*/\r\n";
    $content .= "    public static function row_bywhere(\$where=\"1\",\$field=\"*\")\r\n";
    $content .= "    {\r\n";
    $content .= "        \$row = M(self::\$table)->where(\$where)->field(\$field)->find();\r\n";
    $content .= "        return \$row;\r\n";
    $content .= "    }\r\n\r\n";
    //store方法
    $content .= "    /*添加一条数据*/\r\n";
    $content .= "    public static function store(\$data)\r\n";
    $content .= "    {\r\n";
    $content .= "        return M(self::\$table)->add(\$data);\r\n";
    $content .= "    }\r\n\r\n";
    //update方法
    $content .= "    /*修改一条数据*/\r\n";
    $content .= "    public static function update(\$data)\r\n";
    $content .= "    {\r\n";
    $content .= "        return M(self::\$table)->save(\$data);\r\n";
    $content .= "    }\r\n\r\n";
    //destory方法
    $content .= "    /*删除一条数据*/\r\n";
    $content .= "    public static function destory(\$id)\r\n";
    $content .= "    {\r\n";
    $content .= "        return M(self::\$table)->delete(\$id);\r\n";
    $content .= "    }\r\n";
    //class结束
    $content .= "}";
    return $content;
}

/**
 * 快速生成controller
 */
function create_controller($cname)
{
    $filename = $cname."Controller.class.php";
    $pathname = MODULE_PATH."Controller/".$filename;
    if(!file_exists($pathname))
    {
        file_put_contents($pathname,controller_tpl($cname));
    }else{
        echo $filename."已经存在...!!!";
    }
}

/**
 * 快速生成controller模板
 */
function controller_tpl($cname)
{
    $content = "";
    $content .= "<?php\r\n";
    $content .= "namespace Admin\\Controller;\r\n\r\n";
    $content .= "use Think\\Controller;\r\n\r\n";
    $content .= "class {$cname}Controller extends CommonController\r\n";
    $content .= "{\r\n";
    /*index方法*/
    $content .= "    /*列表视图*/\r\n";
    $content .= "    public function index()\r\n";
    $content .= "    {\r\n";
    $content .= "        \$this->display();\r\n";
    $content .= "    }\r\n";
    /*create方法*/
    $content .= "    /*添加视图*/\r\n";
    $content .= "    public function create()\r\n";
    $content .= "    {\r\n";
    $content .= "        \$this->display();\r\n";
    $content .= "    }\r\n";
    /*store方法*/
    $content .= "    /*添加动作*/\r\n";
    $content .= "    public function store()\r\n";
    $content .= "    {\r\n";
    $content .= "        \$data = [\r\n\r\n";
    $content .= "        ];\r\n";
    $content .= "    }\r\n";
    /*edit方法*/
    $content .= "    /*修改视图*/\r\n";
    $content .= "    public function edit(\$id)\r\n";
    $content .= "    {\r\n";
    $content .= "        \$this->display();\r\n";
    $content .= "    }\r\n";
    /*update方法*/
    $content .= "    /*修改动作*/\r\n";
    $content .= "    public function update()\r\n";
    $content .= "    {\r\n";
    $content .= "        \$data = [\r\n\r\n";
    $content .= "        ];\r\n";
    $content .= "    }\r\n";
    /*destory方法*/
    $content .= "    /*修改视图*/\r\n";
    $content .= "    public function destory(\$id)\r\n";
    $content .= "    {\r\n\r\n";
    $content .= "    }\r\n";
    $content .= "}";
    return $content;
}