<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db; 
class Index extends  Controller
{
	//创建多级目录的php函数
    public function create_dir($path='fhfh',$method=07777){
       if(is_dir($path)){
       	return '该目录已存在！';
       }else{
       	if(mkdir($path,$method=0777,true)){
       		return '创建目录成功！';
       	}else{
       		return '创建目录失败！';
       	}
       }
    }

    public  function  request($url,$https=true,$method="get",$data=null){
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,ture);
        if($https === true){
          curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
          curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        }
        if($method=== 'post'){
          curl_setopt($ch,CURLOPT_POST,false);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        $str=curl_exec($ch);
        curl_close($ch);
        return $str;
    }

    public function readJson(){
      $personJson='{"name":"tom","age":18,"job":"php"}';
      $personObj=json_decode($personJson);
      dump($personObj);
      $personArr=json_decode($personJson,true);
      dump($personArr);
    }

    public function testrequest(){
      $url="http://lianxi.com/index/index/readJson";
      $content=jiekou($url,true);
      dump($content);
    }

    public function weather(){
      $city=Request::instance()->param('city');
      // dump($city);exit;
      $url="http://api.map.baidu.com/telematics/v2/weather?location=".$city."&ak=B8aced94da0b345579f481a1294c9094";
      $content=jiekou($url,false);
      $content=simplexml_load_string($content);
      // dump($content);exit;
      $todayData=$content->results->result[0];
      $res='实时温度：'.$todayData->date;
      dump($res);
    }

    public function getAreaByPhone(){
      $phone=Request::instance()->param('phone');
      $url="http://cx.shouji.360.cn/phonearea.php?number=".$phone;
      $content=jiekou($url,false);
      $content=json_decode($content);
      $str="当前查询号码为:".$phone."<br />";
      $str.='省份：'.$content->data->province."<br />";
      $str.='城市:'.$content->data->city."<br />";
      $str.='运营商:'.$content->data->sp."<br />";
      dump($str);
    }


    public function fanzhuan(){
        $str="hel_gip_oll";
        $str1=lcfirst(str_replace(' ','',ucwords(join(' ',explode('_',$str)))));
        dump($str1);//helGipOll
        $str2=lcfirst('Hello World');
        dump($str2);
    }

    // public function jstest(){
    //   if(Request::instance()->isPost()){
    //     $name=test_input($_POST['name']);
    //     $email=test_input($_POST['email']);
    //     if(!preg_match("/^[a-zA-Z ]*$/",$name)){
    //       $error1='只允许字母或空格!';
    //       dump($error1);
    //     }
    //     if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
    //       $error2='Invalid email  format';
    //       dump($error2);
    //     }
    //     dump($name);
    //   }
    //   return $this->fetch();
    // }
     


    public function jstest(){ 
        vendor("weixin.jssdk"); 
        $appid = 'wx8304ad33eda1cbfe';
        $appsecret = '48f9a8342d4db04cb7b9abe1d4bc99b7';
        $jssdk = new \JSSDK($appid,$appsecret);
        $signPackage = $jssdk->GetSignPackage();
        $this->assign('signPackage',$signPackage);
        return $this->fetch();
    }

    // public function choujiang(){
    //   $prize=array(34,32,34);
    //   $prizeList=array('小礼品一','谢谢惠顾','小礼品二');
    //   $times=10;
    //   $max=0;
    //   foreach($prize as $k=>$v){
    //     $max=$v*$times+$max;
    //     $row['v']=$max;
    //     $row['k']=$k;
    //     $prizeZone[]=$row;
    //   }
    //   $max--;
    //   $rand=mt_rand(0,$max);
    //   $zone=1;
    //   foreach($prizeZone as $k=>$v){
    //     if($rand >= $v['v']){
    //       if($rand >= $prizeZone[$k+1]['v']){
    //         continue;
    //       }else{
    //         $zone=$prizeZone[$k+1]['k'];
    //         break;
    //       }
    //     }
    //     $zone=$v['k'];
    //     break;
    //   }
    //   dump($prizeList[$zone]);
    // }

    public  function choujiang(){
      $prize=array('20','20','60');
      $prizeList=array('一','二','三');
      $times=10;
      $max=0;
      foreach($prize as $k=>$v){
        $max=$v*$times+$max;
        $row['v']=$max;
        $row['k']=$k;
        $prizeZone[]=$row;
      }
      $max--;
      $rand=mt_rand(0,$max);
      $zone=1;
      foreach($prizeZone as $k=>$v){
        if($rand>=$v['v']){
          if($rand>=$prizeZone[$k+1]['v']){
            continue;
          }else{
            $zone=$prizeZone[$k+1]['k'];
            break;
          }
        }
        $zone=$v['k'];
        break;
      }
     dump($prizeList[$zone]);
    }

    public function  jiujiu(){
      for($i=1;$i<=9;$i++){
        for($j=1;$j<=$i;$j++){
          echo "$i*$j=".$i*$j." ";
        }
        echo '<br />';
      }
    }
     
    public  function guolv(){
       $str='who\'s xiaoming';
       // $str=stripslashes('who\'s xiaoming');
       dump($str);
    }


    public function kwreplace(){
      $str="hellowordkeklala";
      vendor('kwreplace'); 
      $res=new KeyReplace($str,array("l"=>"w"),true,array(1=>'a'),false);
      dump($res);
    }


    public function sendEmail(){
      $to = "1424779356@qq.com";
      $subject = "Test mail";
      $message = "Hello! This is a simple email message.";
      $from = "1424779356@qq.com";
      $headers = "From: $from";
      mail($to,$subject,$message,$headers);
    }


    public function zz(){
       $weigeti='W3CSchool 在线教程的网址是 http://e.jb51.net/ ，你能把这个网址替换成正确的网址吗？';
       $res=preg_replace("/http:\/\/\w+\.jb51\.net\//","http://e.jb51.net/w3c/",$weigeti);
       dump($res);
    }

    public  function  th(){
      $num ='www.jb51.net'; 
      $string ="this string has four words. <br>"; 
      // $string =ereg_replace('four', $num, $string); //ereg已经被淘汰
      $string =preg_replace('/four/', $num, $string); 
      echo $string;
    } 

    public  function bubble(){
         $arr=[19,34,35,46,56,5,1,0];
         $res=bubble_sort($arr);
         dump($res);
    }


    public  function   str_test(){
      // $str=" hello world nice too meet you too how are you";
      // $leng=strlen('you');
      // $postion=strpos($str,'you');
      // $res=substr_replace($str,'me',$postion,$leng);
      // dump($res);
      $str="how_are_you";
      $res=lcfirst(ucwords(str_replace('_',' ',$str)));
      dump($res);
    }
   public function   test(){
        // $str=date('Ymd');
        // $str=ROOT_PATH;
        $str1=ceil(10/3);
        $str2=floor(10/3);
        // dump($str1);
        echo  $str1;
        echo  '<br />';
        echo  $str2;
   }


   public function db_test(){
       // $arr=Db::name('test')->order('id')->limit(3,1)->select();
       // dump($arr);
       $array=[['id'=>1,'name'=>'tom'],['id'=>2,'name'=>'Jack'],['id'=>3,'name'=>'xiaoming']];
       $last=$array[count($array)-1]['id'];
       dump($last);
   } 


   public function lp(){

     return $this->fetch();
   }
    
    
   public  function   index($sid=0){
    if(Request::instance()->isPost()){
      $data=Request::instance()->post();
      $file=request()->file('photo');
      if($file != null){
        $path=ROOT_PATH.'public/uploads/images';
        $info=$file->validate(['sieze'=>1567800,'ext'=>'jpg,png,gif'])->move($path);
        if($info){
          $str=$info->getSaveName();
          $str=str_replace('\\','/',$str);
          $data['photo']='/uploads/images/'.$str;
        }
      }
      $data['add_time']=$data['upd_time']=time();
      // dump($data);exit;
      $result=Db::name('User')->insert($data);
      if($result){
        $this->success('注册成功');
      }else{
        $this->error('注册失败');
      }
    }
     $this->assign('sid',$sid);
     return $this->fetch();
   }
   


   public function  hstest(){
      $res=mt_rand(1,10)/10;
      dump($res);
   }

    public function xin(){
      $str = "<div>欢迎访问脚本之家<a href=http://www.jb51.net>www.jb51.net</a></div>";
      $str = htmlspecialchars_decode($str);
      $str = preg_replace("/<a[^>]*>(.*?)<\/a>/is", "$1", $str);
      echo $str;
    }


    public  function  arr(){
      $arr=array(19,20,90,80,23,87,45);
      //sort($arr);
      $len=count($arr);
      for($i=0;$i<$len;$i++){
        for($j=0;$j<$len-$i-1;$j++){
          if($arr[$j]>$arr[$j+1]){
            $temp=$arr[$j+1];
            $arr[$j+1]=$arr[$j];
            $arr[$j]=$temp;
          }
        }
      }
      dump($arr);
    }
    
}

