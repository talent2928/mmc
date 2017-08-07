<?php
// +----------------------------------------------------------------------
// | 虫妈邻里团
// +----------------------------------------------------------------------
// | Copyright (c) 2015-2016 T-Rex All rights reserved.
// +----------------------------------------------------------------------
// | Date：2016/4/14
// +----------------------------------------------------------------------
// | Author: panghu <panghu1024@gmail.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Exception;
use Think\Model;
use Think\Page;

class AdminModel extends Model {

    protected $autoCheckFields  =   false;

    /**
     * 管理员登录
     * @param string $admin_name
     * @param string $pass_word
     * @return mixed
     * @throws Exception
     */
    public function login($admin_name = '',$pass_word = ''){
        //预判段
        if(empty($admin_name)){
            throw new Exception('账号不能为空!');
        }
        if(empty($pass_word)){
            throw new Exception('密码不能为空!');
        }

        //防止暴力破解登录
        $login_count = intval(S('login_deny:'.$admin_name));
        if($login_count > 10){
            throw new Exception('该账号已被锁定!');
        }

        try{
            //查询管理员信息
            $admin_info = $this->table($this->tablePrefix.'admin')->where('admin_name=\'%s\'',$admin_name)->find();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        //检查账号
        if(empty($admin_info)){
            throw new Exception('账号不存在!');
        }
        //检查密码
        if($admin_info['pass_word']!=sha1($pass_word)){
            //登录限制
            $login_count += 1;

            S('login_deny:'.$admin_name,$login_count,array('type'=>'file','expire'=>300));

            throw new Exception('密码不正确!');
        }
        //检查状态
        if($admin_info['state']==0){
            throw new Exception('账号已禁用!');
        }

        return $admin_info;
    }

    /**
     * 保存管理员信息
     * @param $admin_id
     * @param $pass_word
     * @return null
     * @throws Exception
     */
    public function info_edit($admin_id,$pass_word){
        if(!$admin_id){
            throw new Exception('请登录后操作!');
        }

        if(empty($pass_word)){
            throw new Exception('请填写正确的密码!');
        }

        try{
            $this->table($this->tablePrefix.'admin')->where('admin_id=%d',$admin_id)->save(array('pass_word'=>sha1($pass_word)));
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 管理员总数
     * @return mixed
     * @throws Exception
     */
    public function get_admin_count(){
        try{
            $count = $this->table($this->tablePrefix.'admin')->count();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $count;
    }

    /**
     * 管理员列表
     * @param $page
     * @return mixed
     * @throws Exception
     */
    public function get_admin_list(Page $page){
        try{
            $list = $this->table($this->tablePrefix.'admin')
                ->join('LEFT JOIN '.$this->tablePrefix.'role r ON '.$this->tablePrefix.'admin.role_id=r.role_id')
                ->field($this->tablePrefix.'admin.*,r.role_name')
                ->limit($page->firstRow,$page->listRows)->select();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $list;
    }

    /**
     * 获取账号信息
     * @param int $admin_id
     * @return mixed
     * @throws Exception
     */
    public function get_admin_info($admin_id = 0){
        try{
            $info = $this->table($this->tablePrefix.'admin')->where('admin_id=%d',$admin_id)->find();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $info;
    }

    /**
     * 添加管理员
     * @param $admin_name
     * @param $pass_word
     * @param $role_id
     * @return null
     * @throws Exception
     */
    public function add_admin($admin_name,$pass_word,$real_name,$role_id){
        if(!$admin_name){
            throw new Exception('账号必须填写!');
        }

        if(empty($pass_word)){
            throw new Exception('请填写正确的密码!');
        }

        try{
            $this->table($this->tablePrefix.'admin')->add((array('admin_name'=>$admin_name,'pass_word'=>sha1($pass_word),'real_name'=>$real_name,'role_id'=>$role_id,'create_date'=>date('Y-m-d H:i:s'))));
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 编辑账号
     * @param int $admin_id
     * @param string $admin_name
     * @param string $pass_word
     * @param string $real_name
     * @param int $role_id
     * @return null
     * @throws Exception
     */
    public function edit_admin($admin_id = 0,$admin_name = '',$pass_word = '',$real_name = '',$role_id = 0){
        if(!$admin_name){
            throw new Exception('账号必须填写!');
        }

        if(empty($real_name)){
            throw new Exception('请填写姓名!');
        }
        if(!$role_id){
            throw new Exception('请选择角色!');
        }

        try{
            $data['admin_name'] = $admin_name;
            $data['real_name'] = $real_name;
            if($pass_word){
                $data['pass_word'] = sha1($pass_word);
            }
            $data['role_id'] = $role_id;

            $this->table($this->tablePrefix.'admin')->where('admin_id=%d',$admin_id)->save($data);
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 获取角色权限
     * @param int $admin_id
     * @return array
     * @throws Exception
     */
    public function get_role_power($role_id = 0){
        if(!$role_id){
            throw new Exception('非法ID!');
        }

        try{
            $list = $this->table($this->tablePrefix.'role_power')
                ->join('LEFT JOIN '.$this->tablePrefix.'power p ON '.$this->tablePrefix.'role_power.power_id=p.power_id')
                ->where('role_id=%d',$role_id)
                ->field('power_hash')
                ->select();

            foreach ($list as $k=>$v){
                $power[] = $v['power_hash'];
            }

        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $power;
    }

    /**
     * 获取角色权限id
     * @param int $role_id
     * @return array
     * @throws Exception
     */
    public function get_role_power_id($role_id = 0){
        if(!$role_id){
            throw new Exception('非法ID!');
        }

        try{
            $list = $this->table($this->tablePrefix.'role_power')
                ->join('LEFT JOIN '.$this->tablePrefix.'power p ON '.$this->tablePrefix.'role_power.power_id=p.power_id')
                ->where('role_id=%d',$role_id)
                ->field('p.power_id')
                ->select();

            foreach ($list as $k=>$v){
                $power[] = $v['power_id'];
            }

        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $power;
    }

    /**
     * 更改角色权限
     * @param int $role_id
     * @param int $power_id
     * @return null
     * @throws Exception
     */
    public function change_role_power($role_id = 0,$power_id = 0){
        if(!$role_id){
            throw new Exception('非法角色ID!');
        }
        if(!$power_id){
            throw new Exception('非法权限ID!');
        }

        try{
            $info = $this->table($this->tablePrefix.'role_power')->where('role_id=%d AND power_id=%d',$role_id,$power_id)->find();

            if($info){
                $this->table($this->tablePrefix.'role_power')->where('role_power_id=%d',$info['role_power_id'])->delete();
            }else{
                $data['role_id'] = $role_id;
                $data['power_id'] = $power_id;
                $this->table($this->tablePrefix.'role_power')->add($data);
            }
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 获取所有派送员
     * @return mixed
     * @throws Exception
     */
    public function get_courier_all(){
        try{
            $list = $this->table($this->tablePrefix.'admin')->where('role_name=\'派送员\'')->field('admin_id,real_name')->select();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $list;
    }

    /**
     * 获取所有店长
     * @return mixed
     * @throws Exception
     */
    public function get_owner_all(){
        try{
            $list = $this->table($this->tablePrefix.'admin')->where('role_name=\'店长\'')->field('admin_id,real_name')->select();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $list;
    }

    /**
     * 获取角色总数
     * @return mixed
     * @throws Exception
     */
    public function get_role_count(){
        try{
            $count = $this->table($this->tablePrefix.'role')->count();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $count;
    }

    /**
     * 角色列表
     * @param Page $page
     * @return mixed
     * @throws Exception
     */
    public function get_role_list(Page $page){
        try{
            $list = $this->table($this->tablePrefix.'role')->limit($page->firstRow,$page->listRows)->select();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $list;
    }

    /**
     * 获取所有角色
     * @param Page $page
     * @return mixed
     * @throws Exception
     */
    public function get_role_all(){
        try{
            $list = $this->table($this->tablePrefix.'role')->select();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $list;
    }

    /**
     * 添加角色
     * @param string $role_name
     * @return null
     * @throws Exception
     */
    public function add_role($role_name = ''){
        if(!$role_name){
            throw new Exception('请填写角色名称!');
        }

        try{
            $this->table($this->tablePrefix.'role')->add(array('role_name'=>$role_name));
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 角色编辑
     * @param int $role_id
     * @param string $role_name
     * @return null
     * @throws Exception
     */
    public function edit_role($role_id = 0,$role_name = ''){
        if(!$role_id){
            throw new Exception('非法ID!');
        }

        if(!$role_name){
            throw new Exception('请填写角色名称!');
        }

        try{
            $this->table($this->tablePrefix.'role')->where('role_id=%d', $role_id)->save(array('role_name'=>$role_name));
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 获取角色信息
     * @param int $role_id
     * @return mixed
     * @throws Exception
     */
    public function get_role_info($role_id = 0){
        try{
            $info = $this->table($this->tablePrefix.'role')->where('role_id=%d',$role_id)->find();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $info;
    }

    /**
     * 获取所有权限分类
     * @return mixed
     * @throws Exception
     */
    public function get_power_cat_all(){
        try{
            $list = $this->table($this->tablePrefix.'power_cat')->select();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $list;
    }

    /**
     * 获取权限分类信息
     * @param int $cat_id
     * @return mixed
     * @throws Exception
     */
    public function get_power_cat_info($cat_id = 0){
        try{
            $info = $this->table($this->tablePrefix.'power_cat')->where('cat_id=%d',$cat_id)->find();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $info;
    }

    /**
     * 添加权限分类
     * @param string $cat_name
     * @return null
     * @throws Exception
     */
    public function add_power_cat($cat_name = ''){
        if(!$cat_name){
            throw new Exception('请填写分类名称!');
        }

        try{
            $this->table($this->tablePrefix.'power_cat')->add(array('cat_name'=>$cat_name));
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 编辑权限分类
     * @param int $cat_id
     * @param string $cat_name
     * @return null
     * @throws Exception
     */
    public function edit_power_cat($cat_id = 0 ,$cat_name = ''){
        if(!$cat_id){
            throw new Exception('非法ID!');
        }
        if(!$cat_name){
            throw new Exception('请填写分类名称!');
        }

        try{
            $this->table($this->tablePrefix.'power_cat')->where('cat_id=%d',$cat_id)->save(array('cat_name'=>$cat_name));
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 删除权限分类
     * @param int $cat_id
     * @return null
     * @throws Exception
     */
    public function delete_power_cat($cat_id = 0){
        if(!$cat_id){
            throw new Exception('非法ID!');
        }

        try{
            $this->table($this->tablePrefix.'power_cat')->where('cat_id=%d',$cat_id)->delete();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 获取权限列表
     * @param Page $page
     * @return mixed
     * @throws Exception
     */
    public function get_power_list(Page $page){
        try{
            $list = $this->table($this->tablePrefix.'power')
                ->join(' LEFT JOIN '.$this->tablePrefix.'power_cat c ON '.$this->tablePrefix.'power.cat_id=c.cat_id')
                ->field($this->tablePrefix.'power.*,c.cat_name')
                ->limit($page->firstRow,$page->listRows)->select();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $list;
    }

    public function get_power_format(){
        try{
            $list = $this->table($this->tablePrefix.'power')
                ->join(' LEFT JOIN '.$this->tablePrefix.'power_cat c ON '.$this->tablePrefix.'power.cat_id=c.cat_id')
                ->field($this->tablePrefix.'power.*,c.cat_name')
                ->select();

            foreach ($list as $k=>$v){
                $format[$v['cat_id']]['cat_name'] = $v['cat_name'];
                $format[$v['cat_id']]['power'][] = $v;
            }

        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $format;
    }

    /**
     * 获取权限数量
     * @return mixed
     * @throws Exception
     */
    public function get_power_count(){
        try{
            $count = $this->table($this->tablePrefix.'power')->count();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $count;
    }

    /**
     * 获取权限信息
     * @param int $power_id
     * @return mixed
     * @throws Exception
     */
    public function get_power_info($power_id = 0){
        try{
            $info = $this->table($this->tablePrefix.'power')->where('power_id=%d',$power_id)->find();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return $info;
    }

    /**
     * 添加权限
     * @param int $cat_id
     * @param string $power_name
     * @param string $power_hash
     * @return null
     * @throws Exception
     */
    public function add_power($cat_id = 0,$power_name = '',$power_hash = ''){
        if(!$cat_id){
            throw new Exception('非法ID!');
        }
        if(!$power_name){
            throw new Exception('请填写权限名称!');
        }
        if(!$power_hash){
            throw new Exception('请填写权限哈希!');
        }

        try{
            $data['cat_id'] = $cat_id;
            $data['power_name'] = $power_name;
            $data['power_hash'] = $power_hash;

            $this->table($this->tablePrefix.'power')->add($data);
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 权编辑权限
     * @param int $power_id
     * @param int $cat_id
     * @param string $power_name
     * @param string $power_hash
     * @return null
     * @throws Exception
     */
    public function edit_power($power_id = 0,$cat_id = 0,$power_name = '',$power_hash = ''){
        if(!$power_id){
            throw new Exception('非法ID!');
        }
        if(!$cat_id){
            throw new Exception('非法ID!');
        }
        if(!$power_name){
            throw new Exception('请填写权限名称!');
        }
        if(!$power_hash){
            throw new Exception('请填写权限哈希!');
        }

        try{
            $data['cat_id'] = $cat_id;
            $data['power_name'] = $power_name;
            $data['power_hash'] = $power_hash;

            $this->table($this->tablePrefix.'power')->where('power_id=%d',$power_id)->save($data);
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }

    /**
     * 删除权限
     * @param int $power_id
     * @return null
     * @throws Exception
     */
    public function delete_power($power_id = 0){
        if(!$power_id){
            throw new Exception('非法ID!');
        }

        try{
            $this->table($this->tablePrefix.'power')->where('power_id=%d',$power_id)->delete();
        }catch (Exception $e){
            throw new Exception('系统错误!');
        }

        return null;
    }
}