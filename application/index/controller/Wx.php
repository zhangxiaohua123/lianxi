<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db; 
class  Wx  extends Controller{
	public  function  getOrderNum(){
		$yCode=array('A','B','C','D','E','F','G','H','I','J');
		$orderSn=$yCode[intval(date('Y'))-2011].strtoupper(dechex(date('m'))).
		date('d').substr(time(),5).substr(microtime(),2,5).sprintf('%02d',rand(0,99));
		dump($orderSn);
		echo '<hr />';
		dump(dechex(date('m')));//把十进制转换为十六进制;
		echo '<hr />';
		dump(sprintf('%02d',rand(0,99)));//把百分号（%）符号替换成一个作为参数进行传递的变量;
	}

	public  function file_list($path){
		if($handle=opendir($path)){
			while(false !== ($file=readdir($handle))){
				if($file !='.' && $file != '..'){
					if(is_dir($path."/".$file)){
						echo $path.":".$file."<br />";
						file_list($path."/".$file);
					}else{
						echo $path.":".$file."<br />";
					}
				}
			}
		}
	}

	
	public  function  fdl(){
		//防盗链
		// if(isset($_SERVER['HTTP_REFERER'])){
		// 	if(strpos($_SERVER['HTTP_REFERER'],"http://www.123.com")===0){
		// 		echo '可以访问';
		// 	}else{
		// 		echo 'no';
		// 	}                                                                        
		// }
		//获取服务器和客户端ip
		// dump($_SERVER['SERVER_ADDR']);
		// dump($_SERVER['REMOTE_ADDR']);
		// 
		// 
		//算法： 冒泡！归并！二分查找-递归！二分查找-非递归！快速排序！选择排序！插入排序
	}
	//二分查找(数组里查找某个元素)
	function  bin_sch($array,$low,$high,$k){
		if($low<=$high){
			$mid=intval(($low+$high)/2);
			if($array[$mid]==$k){
				return $mid;
			}elseif($k<$array[$mid]){
				return bin_sch($array,$low,$mid-1,$k);
			}else{
				return bin_sch($array,$mid+1,$high,$k);
			}
		}
		return -1;
	}
	//顺序查找
	function  seq_sch($array,$n,$k){
		$array[$n]=$k;
		for($i=0;$i<$n;$i++){
			if($arrray[$i]==$k){
				break;
			}
		}
		if($i<$n){
			return $i;
		}else{
			return -1;
		}
	}

	//线性表的删除（数组中实现）
	function  delete_array_element($array,$i){
		$len=count($array);
		for($j=$i;$j<$len;$j++){
			$array[$j]=$array[$j+1];
		}
		array_pop($array);//删除数组中最后一个元素
		return $array;
	}
	//1、冒泡排序
	function bubble_sort(){
		$array=[20,90,89,80,34,14];
		$count=count($array);
		if($count<=0)return false;
		for($i=0;$i<$count;$i++){
			for($j=0;$j<$count-$i-1;$j++){
				if($array[$j]>$array[$j+1]){
					$tmp=$array[$j];
					$array[$j]=$array[$j+1];
					$array[$j+1]=$tmp;
				}
			}
		}
		dump($array);
	}

	//2、快速排序
	function  quick_sort($array){
		if(count($array)<=1)return $array;
		$key=$array[0];
		$left_arr=array();
		$right_arr=array();
		for($i=1;$i<count($array);$i++){
			if($array[$i]<=$key){
				$left_arr[]=$array[$i];
			}else{
				$right_arr[]=$array[$i];
			}
		}
		$left_arr=quick_sort($left_arr);
		$right_arr=quick_sort($right_arr);
		return array_merge($left_arr,array($key),$right_arr);
	}


	public  function   strtest(){
		// strcmp($s1,$s2); // $s1>$c2   0 - 如果两个字符串相等   <0 - 如果 string1 小于 string2    >0 - 如果 string1 大于 string2
		// strstr()// — 查找字符串的首次出现
	}

	//3、并归排序
	function  Merge(&$arr,$left,$mid,$right){
		$i=$left;
		$j=$mid+1;
		$k=0;
		$temp=array();
		while($i<$mid && $j<=$right){
			if($arr[$i]<=$arr[$j]){
				$temp[$k++]=$arr[$i++];
			}else{
				$temp[$k++]=$arr[$j];
			}
		}
		while($i<=$mid){
			$temp[$k++]=$arr[$i++];
		}
		while($j<=$right){
			$temp[$k++]=$arr[$j++];
		}
		for($i=$left,$j=0;$i<=$right;$i++;$j++){
			$arr[$i]=$temp[$j];
		}
	}
	
	function  MergeSort(&$arr,$left,$right){
		if($left<$right){
			$mid=floor(($left+$right)/2);
			MergeSort($arr,$left,$mid);
			MergeSort($arr,$mid+1,$right);
			Merge($arr,$left,$mid,$right);
		}
	}
	//4、二分查找-递归
	function  bin_search($arr,$low,$high,$value){
		if($low>$high){
			return false;
		}else{
			$mid=floor(($low+$high)/2);
			if($value == $arr[$mid]){
				return $mid;
			}elseif($value<$arr[$mid]){
				return bin_search($arr,$low,$mid-1,$value);
			}else{
				return bin_search($arr,$mid+1,$high,$value);
			}
		}
	}

	//5、二分查找-非递归
	function  bin_search($arr,$low,$high,$value){
		while($low<=$high){
			$mid=floor(($low+$high)/2);
			if($value=== $arr[$mid]){
				return $mid;
			}elseif($value <$arr[$mid]){
				$high=$mid-1;
			}else{
				$low=$mid+1;
			}
		}
		return false;
	}
	//6、选择排序
	function select_sort($arr){
		$n=count($arr);
		for($i=0;$i<$n;$i++){
			$k=$i;
			for($j=$i+1;$j<$n;$j++){
				if($arr[$j]<$arr[$k]){
					$k=$j;
				}
			}
			if($k != $i){
				$temp=$arr[$i];
				$arr[$i]=$arr[$k];
				$arr[$k]=$temp;
			}
		}
		return $arr;
	}

	//7、插入排序
	function  insert_sort($arr){
		$n=count($arr);
		for($i=1;$i<$n;$i++){
			$tmp=$arr[$i];
			$j=$i-1;
			while($arr[$j]>$tmp){
				$arr[$j+1]=$arr[$j];
				$arr[$j]=$tmp;
				$j--;
				if($j<0){
					break;
				}
			}
		}
		return $arr;
	}
}