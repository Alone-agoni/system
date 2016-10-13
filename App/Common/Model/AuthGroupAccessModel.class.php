<?php

namespace Common\Model;

use Think\Model;

class AuthGroupAccessModel extends Model{
    /*定义静态成员属性*/
    public static $table = "AuthGroupAccess" ;//表名

    /*定义静态成员方法*/

    /*获取所有数据*/
    public static function rows($where="1",$field="*",$order="id DESC")
    {
        $rows = M(self::$table)->where($where)->field($field)->order($order)->select();
        return $rows;
    }

    /*通过id获取一条数据*/
    public static function row_byid($id,$field="*")
    {
        $row = M(self::$table)->field($field)->find($id);
        return $row;
    }

    /*通过条件获取一条数据*/
    public static function row_bywhere($where="1",$field="*")
    {
        $row = M(self::$table)->where($where)->field($field)->find();
        return $row;
    }

    /*添加一条数据*/
    public static function store($data)
    {
        return M(self::$table)->add($data);
    }

    /*修改一条数据*/
    public static function update($data)
    {
        return M(self::$table)->save($data);
    }

    /*删除一条数据*/
    public static function destory($id)
    {
        return M(self::$table)->delete($id);
    }
}