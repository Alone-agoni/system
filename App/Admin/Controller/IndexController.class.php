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
}