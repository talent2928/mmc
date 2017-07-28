<?php
namespace Home\Controller;
use Think\Controller;
class VerifycodeController extends Controller {
    public function index(){
        $this->display();
    }

    public function create(){
        $Verify = new \Think\Verify();
        $Verify->entry();
    }

    public function check_verify()
    {
        //print_r($_SESSION);//12345
        $code = I("verifycode");
        $verify = new \Think\Verify();
        if($verify->check($code)){
            $result_array = array("status"=>0,"msg"=>"成功");
        }else{
            $result_array = array("status"=>-1,"msg"=>"失败");
        };
        $this->ajaxReturn($result_array);

    }


}
