<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
    public function test(){
        $arraylist = new \Org\Util\ArrayList();
        $b = 1212345679;
        $test_logic = new \Home\Logic\TestLogic();
        //$admin = new \Admin\Controller\TestController();
        //$admin = A('Admin/Test');
        //print_r($admin);
        echo U('Test/test',array('cate_id'=>1,'status'=>1));
        $test_logic->test();
        //$data['status']  = 1;
        //$data['content'] = 'content';
        //$this->ajaxReturn($data);
        //$this->error('新增失败');
        //$this->success('新增成功', 'Test/test',5,true);
       // $this->redirect('Admin/Test/test', array('cate_id' => 2), 5, '页面跳转中...');
        $_POST['name'] = 'wl';
        $param = I('session.');
        $param = I('get.id');
        $param = I('param.');
        $param = I('cookie.');
        $param = I('server.');
        $param = I('param.id');
        $param = I('id');
        print_r($param);
        //echo REQUEST_METHOD;
        //exit;
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');

        /*spl_autoload_register(function ($class) {
            echo $class;
            //include 'classes/' . $class . '.class.php';
            //include basename($class) .'.php';exit;
            //echo "\\".$class .'.php';exit;
            //echo $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$class .'.php';
            //include $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$class .'.php';
        });*/
        //$test_obj = M("test1")->select();
        $libs = new \Common\Common\CommonLibs();
        //echo $libs->getClientIp();exit;
       $test_obj = new \Home\Model\TestModel();
        $test_obj = M("test2");;
        $result = $test_obj->select();
        //$result = $test_obj->limit(5)->select();
        //$result = $test_obj->table("test1 t,t_order_201501 o")->where("t.pid =o.f_uid")->select();
        //$result = $test_obj->table("test1 t,t_order_201501 o,test2 t2")->where("t.pid =o.f_uid and t2.pid=t.pid")->select();
        //$result = $test_obj->order("pid,number desc")->where("pid=1")->limit(1)->field("id,name")->select();
        //$result = $test_obj->field("pid,number,sum(number) totalsum")->group("pid,number")->having("totalsum>=1")->select();
        //$result = $test_obj->field("id")->table('test1,t_order_201501')->select();
        //$result = $test_obj->join(" t_order_201501 on t_order_201501.f_uid = test1.pid")->join(" test2 on test1.pid = test2.pid")->select();//left join t_order_201501 on t_order_201501.f_uid = test1.pid


        /*$data_array['name'] = "分类7";
        $data_array['pid'] = 6;
        $data_array['number'] = 3;
        $result = $test_obj->create($data_array);//进行验证
        $test_obj->add();*/

        /*$test_obj->name = "分类9";
        $test_obj-> pid =2;
        $result =  $test_obj->add();*/


        /*$test_obj->number = 8;;
        $result = $test_obj->where("id=12")->save();*/
        //$result = $test_obj->delete_data(12);
        //var_dump($result);exit;
        ///print_r( $test_obj);
        //$util = new \Home\Common\Util();
        //echo $util->getClientIp();
        //echo getClientIp();exit;
        //$a = new \ut;
        //echo $a->getClientIp();
        //echo getServerIp();
        print_r( $result);
        echo "<br>";
        $libs = new \Home\Common\Libs();
        echo $libs->getServerIp();

        print_r(C("DB_NAME") );
        define("TEST_DEFINE",123456);
        $this->assign("data_array",$result);
        $this->assign("test",2);
        $this->assign("test_array",array(1,2,3));
        $this->assign("show_array",array("name"=>"wl","id"=>2,"number"=>array("code"=>'2')));

        $this->display();
        //http://dev9.pay.kingnet.com/test/thinkphp/?s=/Home/Test/test/name/1/id/2 http://dev9.pay.kingnet.com/test/thinkphp/?a=Home&c=Test&a=test&id=1
    }
}
