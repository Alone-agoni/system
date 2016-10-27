<?php
/**
 * 根据配置项获取对应的key和secret
 * @return array key和secret
 */
function get_rong_key_secret(){
    // 判断是需要开发环境还是生产环境的key
    if (C('RONG_IS_DEV')) {
        $key=C('RONG_DEV_APP_KEY');
        $secret=C('RONG_DEV_APP_SECRET');
    }else{
        $key=C('RONG_PRO_APP_KEY');
        $secret=C('RONG_PRO_APP_SECRET');
    }
    $data=array(
        'key'=>$key,
        'secret'=>$secret
    );
    return $data;
}

/**
 * 获取融云token
 * @param  integer $uid 用户id
 * @return integer      token
 */
function get_rongcloud_token($uid){
    // 从数据库中获取token
    $token = D('RongyunUser')->where("id=$uid")->getField('access_token');
    // 如果有token就返回
    if ($token) {
        return $token;
    }
    // 获取用户昵称和头像
    $user_data = M('RongyunUser')->field('name,face')->find($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    // 获取头像url格式
    $face = $user_data['face'];
    // 获取key和secret
    $key_secret = get_rong_key_secret();
    // 实例化融云
    $rong_cloud = new \Org\Xb\RongCloud($key_secret['key'],$key_secret['secret']);
    // 获取token
    $token_json  = $rong_cloud->getToken($uid,$user_data['name'],$face);
    $token_array = json_decode($token_json,true);
    // 获取token失败
    if ($token_array['code']!=200) {
        return false;
    }
    $token = $token_array['token'];
    $data = array(
        'id' => $uid,
        'access_token' => $token_array['token'],
    );
    // 插入数据库
    $result = M('RongyunUser')->save($data);
    if ($result) {
        return $token;
    }else{
        return false;
    }
}

/**
 * 更新融云头像
 * @param  integer $uid 用户id
 * @return boolear      操作是否成功
 */
function refresh_rongcloud_token($uid){
    // 获取用户昵称和头像
    $user_data=M('Users')->field('username,avatar')->getById($uid);
    // 用户不存在
    if (empty($user_data)) {
        return false;
    }
    $avatar=get_url($user_data['avatar']);
    // 获取key和secret
    $key_secret=get_rong_key_secret();
    // 实例化融云
    $rong_cloud=new \Org\Xb\RongCloud($key_secret['key'],$key_secret['secret']);
    // 更新融云用户头像
    $result_json=$rong_cloud->userRefresh($uid,$user_data['username'],$avatar);
    $result_array=json_decode($result_json,true);
    if ($result_array['code']==200) {
        return true;
    }else{
        return false;
    }
}