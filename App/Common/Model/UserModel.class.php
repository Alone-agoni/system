<?php

namespace Common\Model;

use Think\Model;

class UserModel extends Model{
    /*定义静态成员属性*/
    public static $table = "User" ;//表名

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
        $row['group'] = AuthGroupAccessModel::row_bywhere("uid=$id");
        return $row;
    }

    /*通过条件获取一条数据*/
    public static function row_bywhere($where="1",$field="*")
    {
        $row = M(self::$table)->where($where)->field($field)->find();
        return $row;
    }

    /*添加一条数据*/
    public static function store($data,$group)
    {
        M(self::$table)->startTrans();//开启事物
        $uid = M(self::$table)->add($data);//添加用户
        $data = [];
        foreach($group as $key=>$val)
        {
            $data[] = [
                'uid' => $uid,
                'group_id' => $val,
            ];
        }
        $result = AuthGroupAccessModel::store($data);//添加用户所属组
        if($uid && $result)
        {
            M(self::$table)->commit();//提交事物
            return true;
        }else{
            M(self::$table)->rollback();//回滚
        }
    }

    /*修改一条数据*/
    public static function update($data,$group)
    {
        M(self::$table)->save($data);
        AuthGroupAccessModel::destory($data['id']);
        $item = [];
        foreach($group as $key=>$val)
        {
            $item[] = [
                'uid' => $data['id'],
                'group_id' => $val,
            ];
        }
        AuthGroupAccessModel::store($item);//添加用户所属组
        return true;
    }

    /*修改用户登录信息*/
    public static function update_login($data)
    {
        M(self::$table)->save($data);
    }

    /*删除一条数据*/
    public static function destory($id)
    {
        M(self::$table)->startTrans();//开启事物
        $result1 = M(self::$table)->delete($id);
        $result2 = AuthGroupAccessModel::destory($id);
        if($result1 && $result2)
        {
            M(self::$table)->commit();//提交事物
            return true;
        }else{
            M(self::$table)->rollback();//回滚
        }
    }

    /*查询用户列表，查询用户所属组*/
    public static function users_group()
    {
        $rows = self::rows();//用户列表
        foreach($rows as $key=>$val)
        {
            $items = AuthGroupAccessModel::rows_bywhere('uid='.$val['id']);//用户所属组
            $string = '';
            foreach($items as $k=>$v)
            {
                $title = AuthGroupModel::row_bywhere("id=".$v['group_id'],'title');//组名
                $string .= $title['title'].'、';
            }
            $rows[$key]['title'] = trim($string,'、');
        }
        return $rows;
    }
}