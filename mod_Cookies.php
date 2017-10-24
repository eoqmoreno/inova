<?php
class Cookie{
public static function get($kname){
  if(isset($_COOKIE[$kname])) return $_COOKIE[$kname]; else return false;
}
public static function set($kname,$val){
  setcookie($kname,$val,time()+60*60*24*30,"/");
  return true;
}
public static function del($kname){
  setcookie($kname,"",time()-1,"/");
  unset($_COOKIE[$kname]);
  return true;
}
}
?>
