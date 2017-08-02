<?php
namespace app\img\controller;
use think\Controller;
use think\Db;
use think\Request;
class Index extends Controller{
    public function index(){
        return $this->fetch();
    }
    public function pricustomer(){
        $user=Db::name('User')->where('sid','neq',0)order('id desc')->select();
        $this->assign('user',$user);
        return $this->fetch();
    }
    public function pubcustomer(){
        $user=Db::name('User')->where('sid',0)->order('id desc')->select();
        $this->assign('user',$user);
        return $this->fetch();
    }

}