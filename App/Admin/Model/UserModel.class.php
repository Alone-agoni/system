<?php
namespace Admin\Model;

use Think\Model;

class UserModel extends Model
{
    public static function get_row_by_username($username){
        $row = M("User")->where("username='{$username}'")->find();
        return $row;
    }

    public static function get_row_by_id($userid)
    {
        $row = M("User")->where("id='{$userid}'")->find();
        return $row;
    }

    public static function update($data)
    {
        return M('User')->save($data);
    }
}