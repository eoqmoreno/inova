<?php
class DBCon{
public static $DB=array('db' => 'inova',
'user' => 'root',
'pass' => 'ino@4321',
'addr' => 'localhost',
'encoding' => 'utf8',
'timezone' => 'America/Fortaleza');

public static function getDB(){
  $con = new mysqli(self::$DB['addr'],self::$DB['user'],self::$DB['pass'],self::$DB['db']);
  $con->set_charset(self::$DB['encoding']);
  date_default_timezone_set(self::$DB['timezone']);
  if (mysqli_connect_errno()){
      printf("Conexao falhou: %s\n", mysqli_connect_error());
      exit();
  }
  return $con;
}
public static function dbQuery($sql,$systm="NONE"){
  $mdb=self::getDB();
  $RESU=$mdb->query($sql);
  if(!$RESU){
    $data=date("Y-m-d H:i:s");
    $dberr=$mdb->error . " | COMANDO= ".$sql;
    $mdb->query("INSERT INTO inova_sys_err VALUES(null,'$systm','$dberr','$data');");
    return false;
  }else return $RESU;
}
}
?>
