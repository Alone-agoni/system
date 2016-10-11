<?php
namespace Admin\Model;

use Think\Model;

class MenuModel extends Model
{
    public static function menus()
    {
        $rows = M('Menu')->order('sort ASC,id ASC')->select();
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

    public static function destory($mid)
    {
        return M('Menu')->delete($mid);
    }

    public static function update($data)
    {
        return M('Menu')->save($data);
    }
}