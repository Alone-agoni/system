<?php
namespace Admin\Controller;

use Common\Model\AuthGroupAccessModel;
use Common\Model\AuthGroupModel;
use Common\Model\UserModel;
use Think\Controller;

class UserController extends CommonController
{
    /*列表视图*/
    public function index()
    {
        $rows = UserModel::users_group();
        $this->assign('rows',$rows);
        $this->display();

    }

    /*添加视图*/
    public function create()
    {
        /*查询用户组*/
        $rows = AuthGroupModel::rows();
        $this->assign('rows',$rows);
        $this->display();
    }

    /*添加动作*/
    public function store()
    {
        $data = [
            'username' => I('username'),
            'password' => md5(I('password')),
            'status'   => I('status'),
            'status'   => I('status'),
        ];
        $group = I('group_id');
        $uid = UserModel::store($data,$group);
        if($uid)
        {
            foreach($group as $key=>$val)
            {
                $item = [
                    'uid' => $uid,
                    'group_id' => $val,
                ];
                AuthGroupAccessModel::store($item);
            }
            $this->dwz_success('添加管理员成功','','User_index');
        }else{
            $this->dwz_error('添加管理员失败');
        }
    }

    /*修改视图*/
    public function edit($id)
    {
        $row  = UserModel::row_byid($id);//查询用户及用户所属组
        $rows = AuthGroupModel::rows();//查询用户组
        $assign = [
            'row' => $row,
            'rows' => $rows,
        ];
        $this->assign($assign);
        $this->display();
    }

    /*修改动作*/
    public function update()
    {
        $data = [
            'id'       => I('id'),
            'username' => I('username'),
            'status'   => I('status'),
        ];
        if(!empty(I('password')))
        {
            $data['password'] = md5(I('password'));
        }
        $group = I('group_id');
        if(UserModel::update($data,$group))
        {
            $this->dwz_success('修改管理成功!!!','','User_index');
        }else{
            $this->dwz_error('修改管理失败!!!');
        }
    }

    /*删除动作*/
    public function destory($id)
    {
        if(UserModel::destory($id))
        {
            $this->dwz_success('删除管理员成功','1','User_index');
        }else{
             $this->dwz_error('删除管理员失败');
        }
    }

    public function edit_pwd()
    {
        $this->display();
    }

    public function update_pwd()
    {
        $uid = session('uid');
        $pwd = I('pwd');
        $password = I('password');
        $row = UserModel::row_byid($uid);
        if($row['password'] != md5($pwd))
        {
            $this->dwz_error('原始密码错误');
        }
        $data = [
            'id' => $uid,
            'password' => md5($password)
        ];
        if(UserModel::update($data) !== false)
        {
            $this->dwz_success('修改密码成功，下次登录生效');
        }else{
            $this->dwz_error('修改密码失败');
        }
    }
}