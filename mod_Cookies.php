<?php
class Cookie{
public static function get($kname){
  return $_COOKIE[$kname];
}
public static function set($kname,$val){
  setcookie($kname,$val,time()+60*60*24*30,"/");
  return true;
}
public static function del($kname){
  unset($_COOKIE[$kname]);
  setcookie($kname,"",time()-1);
  return true;
}
}
?>
