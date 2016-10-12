<?php
namespace Admin\Controller;

use Common\Model\UserModel;
use Think\Controller;

class UserController extends CommonController
{
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