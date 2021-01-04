<?php

$str = "hi  how   are  you      hi   there   jfjoea   fef";

echo $str;
echo "\r\n";
echo numsSpace($str,7);

function numsSpace(string $str,int $predictCounter):bool{
  $counter=0;
  $before = null;
  for($i=0;$i<strlen($str);$i++){
    if($str[$i]==';'){
      return false;
    }
    if($str[$i]==' ' && $before==' '){

    }else if($str[$i]==' '){
      $before = ' ';
      $counter++;
    }
    $before = $str[$i];
  }
  return $counter==$predictCounter ? true : false;
}