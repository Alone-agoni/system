<?php
namespace Admin\Controller;

use Common\Model\MenuModel;
use Think\Controller;

class IndexController extends CommonController
{
    public function index(){
        $Row = system_info();
        $this->assign('Row',$Row);
        /*查询菜单*/
        $Menu = MenuModel::rows(1,'*','id ASC');
        $auth=new \Think\Auth();
        foreach($Menu as $key=>$val)
        {
            $rule_name = $val['mca'];
            $result = $auth->check($rule_name,session('uid'));
            $rel = explode('/',$rule_name);
            $Menu[$key]['rel'] = $rel[1].'_'.$rel[2];
            if(!$result){
                unset($Menu[$key]);
            }
        }
        $Tree = tree($Menu);
        $this->assign('Tree',$Tree);
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

    /*自动生成模型*/
    public function create_model()
    {
        create_model();
        $this->dwz_success('创建成功','1');
    }
}