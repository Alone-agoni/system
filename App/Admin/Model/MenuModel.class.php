<?php
namespace Admin\Model;

use Think\Model;

class MenuModel extends Model
{
    public static function menus()
    {
        $rows = M('Menu')->select();
        return $rows;
    }

    public static function get_menu_by_id($id){
        $row = M('Menu')->find($id);
        return $row;
    }

    public static function store($data)
    {
        return M('Menu')->add($data);
    }
}