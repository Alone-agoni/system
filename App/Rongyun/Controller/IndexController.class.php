<?php
namespace Rongyun\Controller;

use Think\Controller;

class IndexController extends Controller{

    public function index()
    {
        $this->display();
    }
    /**
     * 融云用户1
     */
    public function user1(){
        // 模拟id为1的用户的登陆过程
        $user_data = M('RongyunUser')->field('id,name,face')->find(88);
        $_SESSION['rongyun_user']=array(
            'id'   =>$user_data['id'],
            'name' =>$user_data['name'],
            'face' =>$user_data['face']
        );
        // 获取融云key
        $rong_key_secret = get_rong_key_secret();
        $assign=array(
            'uid'        =>$user_data['id'], // 用户id
            'face'       =>$user_data['face'],// 头像
            'name'       =>$user_data['name'],// 用户名
            'rong_key'   =>$rong_key_secret['key'],// 融云key
            'rong_token' =>get_rongcloud_token($user_data['id'])//获取融云token
        );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 融云用户2
     */
    public function user2(){
        // 模拟id为2的用户的登陆过程
        $user_data = M('RongyunUser')->field('id,name,face')->find(89);
        $_SESSION['rongyun_user']=array(
            'id'   =>$user_data['id'],
            'name' =>$user_data['name'],
            'face' =>$user_data['face']
        );
        // 获取融云key
        $rong_key_secret=get_rong_key_secret();
        $assign=array(
            'uid'        =>$user_data['id'], // 用户id
            'face'       =>$user_data['face'],// 头像
            'name'       =>$user_data['name'],// 用户名
            'rong_key'   =>$rong_key_secret['key'],// 融云key
            'rong_token' =>get_rongcloud_token($user_data['id'])//获取融云token
        );
        $this->assign($assign);
        $this->display();
    }
}