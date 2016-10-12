<?php
namespace Admin\Controller;

use Common\Model\LogModel;
use Common\Model\UserModel;
use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->display();
    }

    /**
     * 登录
     */
    public function doLogin()
    {
        //接收数据
        $username = I('u');
        $password = I('p');
        //根据用户名查询数据
        $row = UserModel::row_bywhere("username='$username'");
        //返回登录失败提示
        if(empty($row)){
            $this->ajaxReturn(['status'=>0,'msg'=>'账号或密码错误!!!']);die;
        }
        if($row['password'] != md5($password))
        {
            $this->ajaxReturn(['status'=>0,'msg'=>'账号或密码错误!!!']);die;
        }
        if($row['status'] == 0)
        {
            $this->ajaxReturn(['status'=>0,'msg'=>'账号状态异常!!!']);die;
        }
        //登录成功存储登录session
        $this->write_session($row);
        //修改用户信息
        $data = [
            'id' => $row['id'],
            'logintime' => time(),
            'login_ip' => get_client_ip()
        ];
        UserModel::update($data);
        //添加用户登录日志
        $log = [
            'userid'=> $row['id'],
            'username' => $row['username'],
            'logintime' => time(),
            'loginip' => get_client_ip()
        ];
        LogModel::store($log);
        //返回登录成功提示
        $this->ajaxReturn(['status'=>1,'msg'=>'登录成功!!!']);die;
    }

    /**
     * 存储登录session
     */
    private function write_session($user)
    {
        session('uid',$user['id']);
        session('uname',$user['username']);
        session('logintime',date('Y-m-d H:i:s',$user['logintime']));
        session('loginip',$user['loginip']);
        session('status',$user['status']);
    }

    /**
     * 退出登录
     */
    public function out()
    {
        session_destroy();
        $this->redirect("Login/index");
    }
}