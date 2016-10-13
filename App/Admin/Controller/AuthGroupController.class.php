<?php
namespace Admin\Controller;

use Common\Model\AuthGroupModel;
use Think\Controller;

class AuthGroupController extends CommonController
{
    /*列表视图*/
    public function index()
    {
        $rows = AuthGroupModel::rows();
        $this->assign('rows',$rows);
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
            'title' => I('title'),
        ];
        if(AuthGroupModel::store($data))
        {
            $this->dwz_success('添加用户组成功','','AuthGroup_index');
        }else{
            $this->dwz_error('添加用户组失败');
        }
    }

    /*修改视图*/
    public function edit($id)
    {
        $row = AuthGroupModel::row_byid($id);
        $this->assign('row',$row);
        $this->display();
    }

    /*修改动作*/
    public function update()
    {
        $data = [
            'id'    => I('id'),
            'title' => I('title'),
        ];
        if(AuthGroupModel::update($data) !== false)
        {
            $this->dwz_success('修改用户组成功','','AuthGroup_index');
        }else{
            $this->dwz_error('修改用户组失败');
        }
    }

    /*删除动作*/
    public function destory($id)
    {
        if(AuthGroupModel::destory($id))
        {
             $this->dwz_success('删除用户组成功','1','AuthGroup_index');
        }else{
             $this->dwz_error('删除用户组失败');
        }
    }
}