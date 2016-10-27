<?php
namespace Admin\Controller;

use Common\Model\UserModel;

class FuncController extends CommonController{
    /*生成二维码*/
    public function qrcode()
    {
        $text = "http://www.baidu.com";
        $path = "./Uploads/qrcode/qrcode.png";
        create_qrcode($text,$path);
        $this->assign('path',substr($path,1));
        $this->display();
    }

    /*导出Excel视图*/
    public function export_excel()
    {
        $rows = UserModel::rows();
        $this->assign('rows',$rows);
        $this->display();
    }

    /*导出Excel*/
    public function export_xls()
    {
        $rows = UserModel::rows();
        $data[0] = [
            'id'        => 'ID号',
            'username'  => '管理员名称',
            'password'  => '管理员密码',
            'status'    => '管理员状态',
            'logintime' => '登录时间',
            'loginip'   => '登录IP'
        ];
        $item = array_merge($data,$rows);
        create_xls($item,'think_user.xls');
    }

    /*导出Csv*/
    public function export_csv()
    {
        $rows = UserModel::rows();
        $data[0] = [
            'id'        => 'Id号',
            'username'  => '管理员名称',
            'password'  => '管理员密码',
            'status'    => '管理员状态',
            'logintime' => '登录时间',
            'loginip'   => '登录IP',
        ];
        $item = array_merge($data,$rows);
        create_csv($item,"think_user.csv");
    }

    /*导入Excel*/
    public function import_xls()
    {
        $data = import_excel('./Uploads/excel/think_user.xls');
        unset($data[1]);
        var_dump($data);
    }

    /*导入Csv*/
    public function import_csv()
    {
        $data = file_get_contents('./Uploads/excel/think_user.csv');
        $data = explode("\r\n", $data);
        unset($data[0]);
        unset($data[count($data)]);
        $item = [];
        foreach($data as $key=>$val)
        {
            $list = explode(',',$val);
            foreach($list as $k=>$v)
            {
                $list[$k] = trim($v);
            }
            $item[] = $list;
        }
        var_dump($item);
    }

    /**
     * 生成pdf
     */
    public function pdf(){
        if($_POST)
        {
            $content = $_POST['editorValue'];
            create_pdf($content,'content');
        }else{
            $this->display();
        }
    }

    /*发送邮件*/
    public function send_email()
    {
        if($_POST)
        {
            $email   = I('email');
            $title   = I('title');
            $content = $_POST['editorValue'];
            $result  = send_email($email,$title,$content);
            if ($result['error']==1) {
                $this->dwz_error($result['message']);
            }
            $this->dwz_success('邮件发送成功','','Func_send_email');
        }else{
            $this->display();
        }
    }

    /*滑动验证*/
    public function geetest_check()
    {
        $this->display();
    }

    /*geetest生成验证码*/
    public function geetest_show_verify()
    {
        $geetest_id  = C('GEETEST_ID');
        $geetest_key = C('GEETEST_KEY');
        $geetest=new \Org\Xb\Geetest($geetest_id,$geetest_key);
        $user_id = "test";
        $status  = $geetest->pre_process($user_id);
        $_SESSION['geetest']=array(
            'gtserver'=>$status,
            'user_id'=>$user_id
        );
        echo $geetest->get_response_str();
    }

    /*geetest验证*/
    public function geetest_submit_check()
    {
        $data = $_POST;
        if (geetest_chcek_verify($data)) {
            $this->dwz_success('验证成功');
        }else{
            $this->dwz_error('验证失败');
        }
    }
}
