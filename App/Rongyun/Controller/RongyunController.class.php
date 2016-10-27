<?php
namespace Rongyun\Controller;

use Think\Controller;

class RongyunController extends Controller{
    /**
     * 传递一个、或者多个用户id
     * 获取用户头像用户名；用来组合成好友列表
     */
    public function get_user_info(){
        $uids=I('post.uids');
        // 组合where数组条件
        $map=array(
            'id'=>array('in',$uids)
        );
        $data=M('RongyunUser')
            ->field('id,name,face')
            ->where($map)
            ->select();
        $this->ajax_return($data,'获取用户数据成功',0);
    }

    /**
     * 返回iso、Android、ajax的json格式数据
     * @param  array  $data           需要发送到前端的数据
     * @param  string  $error_message 成功或者错误的提示语
     * @param  integer $error_code    状态码： 0：成功  1：失败
     * @return string                 json格式的数据
     */
    function ajax_return($data='',$error_message='成功',$error_code=1){
        $all_data=array(
            'error_code'=>$error_code,
            'error_message'=>$error_message,
        );
        if ($data!=='') {
            $all_data['data']=$data;
            // app 禁止使用和为了统一字段做的判断
            $reserved_words=array('id','title','price','product_title','product_id','product_category','product_number');
            foreach ($reserved_words as $k => $v) {
                if (array_key_exists($v, $data)) {
                    echo 'app不允许使用【'.$v.'】这个键名 —— 此提示是function.php 中的ajax_return函数返回的';
                    die;
                }
            }
        }
        // 如果是ajax或者app访问；则返回json数据 pc访问直接p出来
        echo json_encode($all_data);
        exit(0);
    }
}