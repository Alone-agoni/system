<?php
namespace Admin\Controller;

use Admin\Model\MenuModel;
use Think\Controller;

class MenuController extends CommonController
{
    public function index()
    {
        $rows = MenuModel::menus();
        $this->assign('rows',$rows);
        $this->display();
    }

    public function create()
    {
        $this->display();
    }

    public function store()
    {
        $data = [
            'name' => I('name'),
            'mca'  => I('mca'),
            'sort' => I('sort'),
        ];
        if(MenuModel::store($data))
        {
            $this->dwz_success('添加顶级菜单成功','closeCurrent','menu_index');
        }else{
            $this->dwz_error('添加顶级菜单失败');
        }
    }

    public function create_sub($pid)
    {
        $row = MenuModel::get_menu_by_id($pid);
        $this->assign('row',$row);
        $this->display();
    }

    public function store_sub()
    {
        $data = [
            'pid'  => I('pid'),
            'name' => I('name'),
            'mca'  => I('mca'),
            'sort' => I('sort'),
        ];
        if(MenuModel::store($data))
        {
            $this->dwz_success('添加子级菜单成功','closeCurrent','menu_index');
        }else{
            $this->dwz_error('添加子级菜单失败');
        }
    }
}