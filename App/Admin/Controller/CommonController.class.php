<?php
namespace Admin\Controller;

use Think\Controller;
class CommonController extends Controller{
    public function _initialize()
    {
        header("Content-type:text/html;charset=utf-8");
        //session('uid',null);
        $uid = session('uid');
        if(empty($uid) || !isset($uid))
        {
            $this->redirect("Login/index");
        }
    }

    /**
     * 服务器转回navTabId可以把那个navTab标记为reloadFlag=1, 下次切换到那个navTab时会重新载入内容.
     * callbackType如果是closeCurrent就会关闭当前tab
     * 只有callbackType="forward"时需要forwardUrl值
     */
    public function dwz_success($msg='操作成功',$closeCurrent='',$navTabId='')
    {
        $data = [
            'statusCode'   => 200,
            'message'      => $msg.'!!!',
            'navTabId'     => $navTabId,
            'forwardUrl'   => '',
            'callbackType' => $closeCurrent==""?"closeCurrent":$closeCurrent,
        ];
        echo json_encode($data);die;
    }

    public function dwz_error($msg='操作失败')
    {
        $data = [
            'statusCode'   => 300,
            'message'      => $msg.'!!!',
        ];
        echo json_encode($data);die;
    }
}