<?php
header('Content-Type: application/json');
if( isset(URLPos::getURLObjects()[2]) && (URLPos::getURLObjects()[2]=="dados") ){
  $retorno = array('code'=>0,'msg'=>'OK!');
  $UID = intval(Cookie::get("UID"));
  $data=DBCon::dbQuery("SELECT * FROM inova_cliente WHERE id_cli=$UID;");
  $U_Data=array();
  if($data->num_rows==1){
    $linha = $data->fetch_array(MYSQLI_BOTH);
    foreach ($linha as $k_id => $coluna){
      $U_Data[$k_id]=$coluna;
      //array_push($U_Data, $coluna);
    }
  }

  $retorno['dados']=$U_Data;

  echo json_encode( $retorno );
}if( isset(URLPos::getURLObjects()[2]) && (URLPos::getURLObjects()[2]=="login") ){
  $retorno = array('code'=>0,'msg'=>'OK!');
  $mail=$_POST["unm"];$upass=$_POST["pass"];
  $data=DBCon::dbQuery("SELECT * FROM inova_cliente WHERE email='$mail' AND passwd='$upass';");
  if($data->num_rows==1){
    $procFetch=$data->fetch_array(MYSQLI_BOTH);
    Cookie::set("UID",intval($procFetch['id_cli']));
  }else{
    $retorno = array('code'=>1,'msg'=>'E-mail ou senha incorretos. Verifique seus dados.');
    Cookie::del("UID");
  }
  echo json_encode( $retorno );
}if( isset(URLPos::getURLObjects()[2]) && (URLPos::getURLObjects()[2]=="logout") ){
  if(Cookie::get("UID")!==false){
  $retorno = array('code'=>0,'msg'=>'OK!');
  Cookie::del("UID");
}else $retorno = array('code'=>1,'msg'=>'O usuário não estava logado. Sessão encerrada.');
  echo json_encode( $retorno );
}
?>
