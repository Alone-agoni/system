<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends CommonController
{
    public function index(){
        $Row = system_info();
        $this->assign('Row',$Row);
        $this->display();
    }

    /*自动生成控制器*/
    public function create_controller()
    {
        if($_POST)
        {
            $cname = I('name');
            create_controller($cname);
            $this->dwz_success('创建成功');
        }else{
            $this->display();
        }
    }
}