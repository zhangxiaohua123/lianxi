<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db; 
class  Str  extends Controller{
	public  function   test(){
		$arr=array('bill'=>'60','tom'=>'23','sally'=>'40');
		// krsort($arr);//数组按照键名降序排列
		// ksort($arr);//数组按键名升序排列
		// arsort($arr);//数组按键值降序排列
		// asort($arr);//数组按键值升序排列
		dump($arr);
	}
	
}
