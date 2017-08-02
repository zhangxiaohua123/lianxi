<?php
 function  jiekou($url,$https=true,$method="get",$data=null){
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
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

    function test_input($data){
      $data=trim($data);
      $data=stripslashes($data);
      $data=htmlspecialchars($data);
      return $data;
    }

    function  bubble_sort($data){
        $num=count($data);
        for($i=0;$i<$num;$i++){
          for($j=0;$j<$num-$i-1;$j++){
            if($data[$j]>$data[$j+1]){
              $temp=$data[$j+1]; 
              $data[$j+1]=$data[$j];
              $data[$j]=$temp;
            }
          }
        }
        return  $data;
    }