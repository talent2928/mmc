<?php
// +----------------------------------------------------------------------
// | 虫妈邻里团
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 T-Rex All rights reserved.
// +----------------------------------------------------------------------
// | Date：2016/4/12
// +----------------------------------------------------------------------
// | Author: panghu <panghu1024@gmail.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Think\CmsController;
use Think\Exception;

class AdminController extends CmsController {

    public function login(){
        if(IS_POST){
            $admin_name = trim(I('admin_name',''));
            $pass_word = trim(I('pass_word',''));
            try{
                $admin = new \Admin\Model\AdminModel();
                $_SESSION['admin_info'] = $admin->login($admin_name,$pass_word);
               // $this->redirect('Admin/Index/index');
            }catch (Exception $e){
                $this->ajaxReturn(array('status'=>-1,'msg'=>$e->getMessage()));
            }
        }

        $this->display();
    }

    //登出
    public function logout(){

        //清除session
        session_destroy();

        $this->redirect('Admin/login');
    }

    //管理员列表
    public function admin_list(){
        try{
            $admin = new \Admin\Model\AdminModel();
            $this->count = $admin->get_admin_count();

            $Page = new \Think\Page($this->count,25);//

            $admin_list = $admin->get_admin_list($Page);
        }catch (Exception $e){
            $this->error($e->getMessage(),U('Admin/admin_list'));
        }
        $this->page = $Page->show();
        $this->list = $admin_list;
        $this->display();
    }

    //管理员编辑
    public function admin_edit(){

        $admin_id = I('admin_id',0,'intval');
        $admin = new \Admin\Model\AdminModel();

        if(IS_POST){
            $admin_name = trim(I('admin_name',''));
            $pass_word = trim(I('pass_word',''));
            $real_name = trim(I('real_name',''));
            $role_id = trim(I('role_id',0,'intval'));

            try{

                $admin->edit_admin($admin_id,$admin_name,$pass_word,$real_name,$role_id);
            }catch (Exception $e){
                $this->ajaxReturn(array('status'=>-1,'msg'=>$e->getMessage()));
            }

            $this->ajaxReturn(array('status'=>1,'msg'=>'ok'));
        }
        $this->info = $admin->get_admin_info($admin_id);
        $this->role_list = $admin->get_role_all();
        $this->title = '编辑管理员';
        $this->display();
    }

    //添加管理员
    public function admin_add(){
        $admin = new \Admin\Model\AdminModel();

        if(IS_POST){
            $admin_name = trim(I('admin_name',''));
            $pass_word = trim(I('pass_word',''));
            $real_name = trim(I('real_name',''));
            $role_id = trim(I('role_id',0));

            try{

                $admin->add_admin($admin_name,$pass_word,$real_name,$role_id);
            }catch (Exception $e){
                $this->ajaxReturn(array('status'=>-1,'msg'=>$e->getMessage()));
            }

            $this->ajaxReturn(array('status'=>1,'msg'=>'ok'));
        }

        $this->role_list = $admin->get_role_all();
        $this->title = '添加管理员';
        $this->display();
    }

}