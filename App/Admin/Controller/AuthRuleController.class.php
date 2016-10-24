<?php
namespace Admin\Controller;

use Common\Model\AuthRuleModel;
use Think\Controller;

class AuthRuleController extends CommonController
{
    /*列表视图*/
    public function index()
    {
        $rows = AuthRuleModel::rows(1,"*","id ASC");
        $tree = tree($rows);
        $item = sort_tree($tree);
        $this->assign('rows',$item);
        $this->display();
    }

    /*添加视图*/
    public function create()
    {
        $this->display();
    }

    /*添加动作*/
    public function store()
    {
        $data = [
            'name'  => I('name'),
            'title' => I('title'),
        ];
        if(AuthRuleModel::store($data))
        {
            $this->dwz_success('添加权限成功','','AuthRule_index');
        }else{
            $this->dwz_error('添加权限失败!!!');
        }
    }

    /*修改视图*/
    public function edit($id)
    {
        $row = AuthRuleModel::row_byid($id);
        $this->assign('row',$row);
        $this->display();
    }

    /*修改动作*/
    public function update()
    {
        $data = [
            'id'    => I('id'),
            'name'  => I('name'),
            'title' => I('title'),
        ];
        if(AuthRuleModel::update($data) !== false)
        {
            $this->dwz_success('修改权限成功','','AuthRule_index');
        }else{
            $this->dwz_error('修改权限失败');
        }
    }

    /*删除动作*/
    public function destory($id)
    {
        $row = AuthRuleModel::row_bywhere("pid=$id");
        if(!empty($row))
        {
            $this->dwz_error('该权限还有子权限，请先删除子权限');die;
        }
        if(AuthRuleModel::destory($id))
        {
             $this->dwz_success('删除权限成功','1','AuthRule_index');
        }else{
             $this->dwz_error('删除权限失败!!!');
        }
    }

    /*添加子权限视图*/
    public function create_sub($pid)
    {
        $this->assign('pid',$pid);
        $this->display();
    }

    /*添加子权限*/
    public function store_sub()
    {
        $data = [
            'pid'   => I('pid'),
            'name'  => I('name'),
            'title' => I('title'),
        ];
        if(AuthRuleModel::store($data))
        {
            $this->dwz_success('添加子权限成功','','AuthRule_index');
        }else{
            $this->dwz_error('添加子权限失败!!!');
        }
    }
}